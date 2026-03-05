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
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'cidade' => 'required|string|max:255',
            'valor_conta' => 'required|numeric|min:0',
            'tipo_cliente' => 'required|in:Residencial,Comercial,Rural'
        ], [
            'nome.required' => 'O nome é obrigatório',
            'whatsapp.required' => 'O WhatsApp é obrigatório',
            'cidade.required' => 'A cidade é obrigatória',
            'valor_conta.required' => 'O valor da conta é obrigatório',
            'valor_conta.numeric' => 'O valor deve ser um número',
            'tipo_cliente.required' => 'O tipo de cliente é obrigatório'
        ]);

        \App\Models\Lead::create($validated);

        return back()->with('success', true);
    }
}
