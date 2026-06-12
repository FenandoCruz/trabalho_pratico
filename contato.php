<?php
/**
 * Arquivo de processamento de formulário de contato
 * Recebe dados via POST e exibe confirmação
 */

// Definir tipo de resposta como HTML
header('Content-Type: text/html; charset=utf-8');

// Variáveis para armazenar dados e mensagens
$nome = '';
$email = '';
$mensagem = '';
$sucesso = false;
$erro = '';

// Processar dados se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber e sanitizar dados
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
    
    // Validações básicas
    if (empty($nome)) {
        $erro = 'Por favor, preencha o campo Nome.';
    } elseif (empty($email)) {
        $erro = 'Por favor, preencha o campo Email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Por favor, insira um email válido.';
    } elseif (empty($mensagem)) {
        $erro = 'Por favor, preencha o campo Mensagem.';
    } elseif (strlen($mensagem) < 10) {
        $erro = 'A mensagem deve ter pelo menos 10 caracteres.';
    } else {
        // Se tudo está válido
        $sucesso = true;
        
        // Aqui você poderia salvar em banco de dados ou enviar email
        // Por exemplo:
        // mail('seu@email.com', "Novo contato de $nome", $mensagem, "From: $email");
        // ou salvar em arquivo:
        // $dados = "Nome: $nome\nEmail: $email\nMensagem: $mensagem\n---\n";
        // file_put_contents('contatos.txt', $dados, FILE_APPEND);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .content {
            padding: 40px;
        }

        /* Mensagem de Sucesso */
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .alert-success h3 {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .alert-success p {
            line-height: 1.6;
        }

        /* Mensagem de Erro */
        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .alert-error h3 {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        /* Formulário */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .success-details {
            background-color: #f0f4ff;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .success-details p {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .success-details strong {
            color: #333;
        }

        @media (max-width: 600px) {
            .header {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .content {
                padding: 25px 20px;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                font-size: 16px; /* Previne zoom em iOS */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Entre em Contato</h1>
            <p>Envie sua mensagem e entrarei em contato em breve</p>
        </div>

        <div class="content">
            <?php if ($sucesso): ?>
                <!-- Mensagem de Sucesso -->
                <div class="alert-success">
                    <h3>✓ Mensagem Enviada com Sucesso!</h3>
                    <p>Obrigado por entrar em contato comigo. Recebi sua mensagem e responderei em breve.</p>
                    
                    <div class="success-details">
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p><strong>Mensagem:</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($mensagem)); ?></p>
                    </div>
                </div>

                <a href="contato.php" class="back-link">← Enviar outra mensagem</a>

            <?php else: ?>
                <!-- Mostrar Erro se Houver -->
                <?php if (!empty($erro)): ?>
                    <div class="alert-error">
                        <h3>⚠️ Erro ao Processar</h3>
                        <p><?php echo htmlspecialchars($erro); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Formulário de Contato -->
                <form method="POST" action="contato.php">
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            placeholder="Seu nome completo"
                            value="<?php echo htmlspecialchars($nome); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="seu@email.com"
                            value="<?php echo htmlspecialchars($email); ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="mensagem">Mensagem *</label>
                        <textarea 
                            id="mensagem" 
                            name="mensagem" 
                            placeholder="Escreva sua mensagem aqui..."
                            required
                        ><?php echo htmlspecialchars($mensagem); ?></textarea>
                    </div>

                    <button type="submit">Enviar Mensagem</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
