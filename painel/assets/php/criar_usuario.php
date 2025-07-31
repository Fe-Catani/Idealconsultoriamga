<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Controle</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Favicon e Estilo personalizado -->
    <link rel="icon" href="../../assets/images/logo.png" type="image/png">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php include_once "../../includes/header.php"; ?>

<div class="container py-4">
    <!-- Mensagem de sessão -->
    <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $message_type = $_SESSION['message_type'];
        echo "<div class='alert alert-{$message_type} alert-dismissible fade show' role='alert'>";
        echo "<i class='bi bi-info-circle me-2'></i>{$message}";
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button></div>";
        unset($_SESSION['message'], $_SESSION['message_type']);
    }

    $usuario_logado = $_SESSION['user_nome'];
    $tipo_usuario_logado = $_SESSION['user_tipo'];
    ?>


<div class="alert alert-primary d-flex align-items-center mb-4" role="alert">
    <i class="bi bi-person-plus me-2 fs-4"></i>
    <span class="fw-bold fs-5">Cadastrar Novo Usuário</span>
</div>


    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="POST" action="cadastrar_usuario.php">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    <?php if ($tipo_usuario_logado == 'admin'): ?>
                        <div class="col-md-6">
                            <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                            <select class="form-select" id="tipo_usuario" name="tipo_usuario">
                                <option value="regular">Regular</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="tipo_usuario" value="regular">
                    <?php endif; ?>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus-fill me-1"></i> Cadastrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h2 class="fw-bold mb-3"><i class="bi bi-people-fill me-2"></i>Lista de Usuários</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('config.php');
                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['nome']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td class="text-center"><?= ucfirst($row['tipo_usuario']); ?></td>
                        <td class="text-center">
                            <span class="badge <?= $row['ativo'] ? 'bg-success' : 'bg-secondary'; ?>">
                                <?= $row['ativo'] ? 'Ativo' : 'Inativo'; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($row['ativo']): ?>
                                <a href="alterar_status.php?alterar_status=inativo&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x-circle me-1"></i> Desativar
                                </a>
                            <?php else: ?>
                                <a href="alterar_status.php?alterar_status=ativo&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-check-circle me-1"></i> Ativar
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('senha');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>
</body>
</html>
