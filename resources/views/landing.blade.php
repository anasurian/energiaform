<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Economia de Energia - Pague até 20% menos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 md:py-16">
        
        <!-- Hero Section -->
        <div class="text-center mb-8 md:mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 px-4">
                Economize todo mês pagando menos pela sua energia!
            </h1>
        </div>

        <!-- Seção Economia e Sustentabilidade (Primeira Tela) -->
        <div id="selecao-tipo" class="mb-16">
            <div class="space-y-4 max-w-2xl mx-auto px-4">
                <!-- Card Residencial -->
                <button onclick="selecionarTipo('Residencial')" class="group w-full bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 cursor-pointer border-2 border-transparent hover:border-green-200">
                    <div class="flex justify-center mb-4 transform group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('images/home.png') }}" alt="Sua casa" class="w-32 h-32 md:w-40 md:h-40 object-contain">
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-center text-gray-900 group-hover:text-green-600 transition-colors">
                        Sua casa
                    </h3>
                </button>

                <!-- Card Comercial -->
                <button onclick="selecionarTipo('Comercial')" class="group w-full bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 cursor-pointer border-2 border-transparent hover:border-blue-200">
                    <div class="flex justify-center mb-4 transform group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('images/business.png') }}" alt="Sua empresa" class="w-32 h-32 md:w-40 md:h-40 object-contain">
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-center text-gray-900 group-hover:text-blue-600 transition-colors">
                        Sua empresa
                    </h3>
                </button>
            </div>
        </div>

        <!-- Formulário (Segunda Tela - Oculto inicialmente) -->
        <div id="formulario-container" class="hidden">
            <div class="max-w-2xl mx-auto">
                <!-- Botão Voltar -->
                <button onclick="voltarSelecao()" class="mb-6 flex items-center text-gray-600 hover:text-gray-800 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Voltar
                </button>

                <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-10">
                    
                    @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <p class="font-bold">Sucesso!</p>
                        <p>Recebemos seus dados! Nossa equipe irá calcular sua economia e entrar em contato pelo WhatsApp.</p>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <p class="font-bold">Atenção:</p>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2 text-center">
                        Calcule sua economia
                    </h2>
                    <p id="tipo-selecionado-texto" class="text-center text-gray-600 mb-6"></p>

                    <form action="{{ route('lead.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <!-- Campo Hidden para Tipo de Cliente -->
                        <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="">

                        <!-- Campos para RESIDENCIAL (Casa) -->
                        <div id="campos-residencial" class="space-y-5">
                            <!-- Nome Completo -->
                            <div>
                                <label for="nome" class="block text-gray-700 font-semibold mb-2">
                                    Nome completo *
                                </label>
                                <input 
                                    type="text" 
                                    id="nome" 
                                    name="nome" 
                                    value="{{ old('nome') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition"
                                    placeholder="Digite seu nome completo"
                                >
                            </div>
                        </div>

                        <!-- Campos para COMERCIAL/RURAL (Empresa) -->
                        <div id="campos-empresa" class="space-y-5 hidden">
                            <!-- Razão Social -->
                            <div>
                                <label for="razao_social" class="block text-gray-700 font-semibold mb-2">
                                    Razão Social *
                                </label>
                                <input 
                                    type="text" 
                                    id="razao_social" 
                                    name="razao_social" 
                                    value="{{ old('razao_social') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                    placeholder="Digite a razão social da empresa"
                                >
                            </div>

                            <!-- CNPJ -->
                            <div>
                                <label for="cnpj" class="block text-gray-700 font-semibold mb-2">
                                    CNPJ *
                                </label>
                                <input 
                                    type="text" 
                                    id="cnpj" 
                                    name="cnpj" 
                                    value="{{ old('cnpj') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                    placeholder="00.000.000/0000-00"
                                    maxlength="18"
                                >
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label for="whatsapp" class="block text-gray-700 font-semibold mb-2">
                                WhatsApp *
                            </label>
                            <input 
                                type="tel" 
                                id="whatsapp" 
                                name="whatsapp" 
                                value="{{ old('whatsapp') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition"
                                placeholder="(00) 00000-0000"
                            >
                        </div>

                        <!-- Cidade -->
                        <div>
                            <label for="cidade" class="block text-gray-700 font-semibold mb-2">
                                Cidade *
                            </label>
                            <input 
                                type="text" 
                                id="cidade" 
                                name="cidade" 
                                value="{{ old('cidade') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition"
                                placeholder="Digite sua cidade"
                            >
                        </div>

                        <!-- Valor da Conta -->
                        <div>
                            <label for="valor_conta" class="block text-gray-700 font-semibold mb-2">
                                Valor médio da conta de luz (R$) *
                            </label>
                            <input 
                                type="number" 
                                id="valor_conta" 
                                name="valor_conta" 
                                value="{{ old('valor_conta') }}"
                                step="0.01"
                                min="0"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition"
                                placeholder="Ex: 250.00"
                            >
                        </div>

                        <!-- Foto da Conta -->
                        <div>
                            <label for="foto_conta" class="block text-gray-700 font-semibold mb-2">
                                Foto da conta de energia (opcional)
                            </label>
                            <div class="relative">
                                <input 
                                    type="file" 
                                    id="foto_conta" 
                                    name="foto_conta" 
                                    accept="image/jpeg,image/jpg,image/png,application/pdf"
                                    class="hidden"
                                    onchange="mostrarNomeArquivo(this)"
                                >
                                <label 
                                    for="foto_conta" 
                                    class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-green-500 transition bg-gray-50 hover:bg-green-50"
                                >
                                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span id="nome-arquivo" class="text-gray-600">Clique para enviar a foto</span>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Formatos aceitos: JPG, PNG ou PDF (máx. 5MB)</p>
                        </div>

                        <!-- Botão de Envio -->
                        <button 
                            type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold text-lg py-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-105"
                        >
                            Simular desconto
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-600">
            <p class="text-sm">© 2026 - Economia de Energia</p>
        </div>
    </div>

    <script>
        function mostrarNomeArquivo(input) {
            const nomeArquivo = document.getElementById('nome-arquivo');
            if (input.files && input.files[0]) {
                nomeArquivo.textContent = input.files[0].name;
                nomeArquivo.classList.add('text-green-600', 'font-semibold');
            } else {
                nomeArquivo.textContent = 'Clique para enviar a foto';
                nomeArquivo.classList.remove('text-green-600', 'font-semibold');
            }
        }

        function selecionarTipo(tipo) {
            // Ocultar seção de seleção
            document.getElementById('selecao-tipo').classList.add('hidden');
            
            // Mostrar formulário
            document.getElementById('formulario-container').classList.remove('hidden');
            
            // Definir o tipo de cliente no campo hidden
            document.getElementById('tipo_cliente').value = tipo;
            
            // Mostrar/ocultar campos específicos
            const camposResidencial = document.getElementById('campos-residencial');
            const camposEmpresa = document.getElementById('campos-empresa');
            const inputNome = document.getElementById('nome');
            const inputRazaoSocial = document.getElementById('razao_social');
            const inputCnpj = document.getElementById('cnpj');
            
            if (tipo === 'Residencial') {
                camposResidencial.classList.remove('hidden');
                camposEmpresa.classList.add('hidden');
                inputNome.required = true;
                inputRazaoSocial.required = false;
                inputCnpj.required = false;
                document.getElementById('tipo-selecionado-texto').textContent = 'Plano para sua casa';
            } else {
                camposResidencial.classList.add('hidden');
                camposEmpresa.classList.remove('hidden');
                inputNome.required = false;
                inputRazaoSocial.required = true;
                inputCnpj.required = true;
                document.getElementById('tipo-selecionado-texto').textContent = 'Plano para sua empresa';
            }
            
            // Scroll suave para o formulário
            document.getElementById('formulario-container').scrollIntoView({ behavior: 'smooth' });
        }

        // Máscara de CNPJ
        document.getElementById('cnpj').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });

        function voltarSelecao() {
            // Mostrar seção de seleção
            document.getElementById('selecao-tipo').classList.remove('hidden');
            
            // Ocultar formulário
            document.getElementById('formulario-container').classList.add('hidden');
            
            // Limpar campo hidden
            document.getElementById('tipo_cliente').value = '';
            
            // Scroll para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Se houver erros de validação, mostrar o formulário automaticamente
        @if($errors->any() || old('tipo_cliente'))
            document.addEventListener('DOMContentLoaded', function() {
                const tipoAntigo = '{{ old('tipo_cliente') }}';
                if (tipoAntigo) {
                    selecionarTipo(tipoAntigo);
                }
            });
        @endif
    </script>
</body>
</html>
