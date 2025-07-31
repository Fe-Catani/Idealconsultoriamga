<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_SESSION['id'])) {
    header("Location: /painel/index.php");
    exit();
}

require_once('config.php');

function clean_input($data) {
    return htmlspecialchars(trim($data));
}

function display_session_message() {
    if (!empty($_SESSION['message'])) {
        echo "<div class='alert alert-{$_SESSION['message_type']} alert-dismissible fade show' role='alert'>
                {$_SESSION['message']}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
        unset($_SESSION['message'], $_SESSION['message_type']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['senha'])) {
    $email = clean_input($_POST['email']);
    $senha = clean_input($_POST['senha']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Email inválido!";
        $_SESSION['message_type'] = "danger";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, senha, tipo_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nome, $senha_hash, $tipo);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['id'] = $id;
            $_SESSION['user_nome'] = $nome;
            $_SESSION['user_tipo'] = $tipo;
            $_SESSION['message'] = "Login bem-sucedido!";
            $_SESSION['message_type'] = "success";
            header("Location: /painel/index.php");
            exit();
        } else {
            $_SESSION['message'] = "Senha incorreta!";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Usuário não encontrado!";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Ideal Consultoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e2efff, #ffffff);
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
        }

        .login-container img {
            width: 140px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 10px 0 0 10px;
            border: 1px solid #ced4da;
        }

        .form-control {
            border-radius: 0 10px 10px 0;
            border: 1px solid #ced4da;
        }

        .toggle-password {
            background: transparent;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php display_session_message(); ?>

<div class="login-container text-center">
    <img src="https://idealconsultoriamga.com.br/assets/images/logo.png" alt="Logo Ideal Consultoria">
    <h4 class="mb-4">Acesso ao Sistema</h4>

    <form method="POST">
        <div class="mb-3 text-start">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="mb-4 text-start">
            <label for="senha" class="form-label">Senha</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="senha" name="senha" required>
                <button type="button" class="input-group-text toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-custom w-100">Entrar</button>
    </form>
</div>

<script>
    function togglePassword() {
        const senhaInput = document.getElementById('senha');
        const toggleIcon = document.getElementById('toggleIcon');
        senhaInput.type = senhaInput.type === 'password' ? 'text' : 'password';
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
