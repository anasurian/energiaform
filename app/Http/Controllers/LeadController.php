<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function store(Request $request)
    {
        // Validações base
        $rules = [
            'tipo_cliente' => 'required|in:Residencial,Comercial,Rural',
            'whatsapp' => 'required|string|max:20',
            'cidade' => 'required|string|max:255',
            'valor_conta' => 'required|numeric|min:0',
            'foto_conta' => 'nullable|image|mimes:jpeg,jpg,png,pdf|max:5120'
        ];

        $messages = [
            'whatsapp.required' => 'O WhatsApp é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'valor_conta.required' => 'O valor da conta é obrigatório',
            'valor_conta.numeric' => 'O valor deve ser um número',
            'tipo_cliente.required' => 'O tipo de cliente é obrigatório',
            'foto_conta.image' => 'O arquivo deve ser uma imagem',
            'foto_conta.mimes' => 'A foto deve ser JPG, JPEG, PNG ou PDF',
            'foto_conta.max' => 'A foto não pode ter mais de 5MB'
        ];

        // Validações específicas por tipo
        if ($request->tipo_cliente === 'Comercial' || $request->tipo_cliente === 'Rural') {
            $rules['cnpj'] = 'required|string|max:18';
            $rules['razao_social'] = 'required|string|max:255';
            $messages['cnpj.required'] = 'O CNPJ é obrigatório para empresas';
            $messages['razao_social.required'] = 'A razão social é obrigatória';
        } else {
            $rules['nome'] = 'required|string|max:255';
            $messages['nome.required'] = 'O nome é obrigatório';
        }

        $validated = $request->validate($rules, $messages);

        // Upload da foto da conta
        if ($request->hasFile('foto_conta')) {
            $foto = $request->file('foto_conta');
            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/contas'), $nomeArquivo);
            $validated['foto_conta'] = 'uploads/contas/' . $nomeArquivo;
        }

        \App\Models\Lead::create($validated);

        return back()->with('success', true);
    }
}
