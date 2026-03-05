# Instruções para Reiniciar o Apache e Testar o Projeto

## ✅ Limpeza Concluída

Todos os arquivos do projeto "verima-marcas" foram removidos de `C:\xampp\htdocs`.

Agora existe apenas a pasta `energia` com a estrutura correta do Laravel.

## 📋 Configurações Aplicadas

### 1. Virtual Host (httpd-vhosts.conf)
Arquivo: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Configuração atual:
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/energia/public"
    ServerName localhost
</VirtualHost>
```

### 2. Arquivo Principal do Apache
O arquivo `C:\xampp\apache\conf\httpd.conf` já está com a linha ativa:
```apache
Include conf/extra/httpd-vhosts.conf
```

## 🔄 Próximos Passos

### 1. Reiniciar o Apache no XAMPP

Abra o Painel de Controle do XAMPP e:
- Clique em "Stop" no Apache
- Aguarde alguns segundos
- Clique em "Start" no Apache

### 2. Testar o Site

Após reiniciar o Apache, teste nos seguintes endereços:

#### Opção 1: Via Apache (porta 80)
```
http://localhost
```

#### Opção 2: Via Artisan Serve (porta 8000)
Abra o terminal na pasta do projeto e execute:
```bash
php artisan serve
```

Depois acesse:
```
http://127.0.0.1:8000
```

## 🎯 Resultado Esperado

Você deve ver a landing page de captura de leads com:
- Título: "Pague até 20% menos na sua conta de luz"
- Formulário com campos: nome, whatsapp, cidade, valor da conta, tipo de cliente
- Design moderno com Tailwind CSS

## ⚠️ Solução de Problemas

### Se aparecer erro 403 (Forbidden):
Verifique as permissões da pasta `public` do projeto.

### Se aparecer erro 500:
1. Verifique se o arquivo `.env` existe
2. Execute: `php artisan key:generate`
3. Verifique as permissões das pastas `storage` e `bootstrap/cache`

### Se o Apache não iniciar:
1. Verifique se a porta 80 não está sendo usada por outro programa
2. Verifique os logs em: `C:\xampp\apache\logs\error.log`

## 📊 Estrutura Final

```
C:\xampp\htdocs\
└── energia\
    ├── app\
    ├── bootstrap\
    ├── config\
    ├── database\
    ├── public\          ← DocumentRoot do Apache
    │   └── index.php
    ├── resources\
    ├── routes\
    ├── storage\
    ├── tests\
    └── vendor\
```

## ✨ Banco de Dados

A tabela `leads` já foi criada com os seguintes campos:
- id
- nome
- whatsapp
- cidade
- valor_conta
- tipo_cliente
- status (padrão: "novo")
- created_at
- updated_at
