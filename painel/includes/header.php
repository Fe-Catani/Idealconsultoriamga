<?php
// Tentativa de incluir o config padrão
if (file_exists('config.php')) {
    include('config.php');
} elseif (file_exists('assets/php/config.php')) {
    include('assets/php/config.php');
} else {
    die('Erro: Arquivo de configuração não encontrado.');
}

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: painel/assets/php/login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<?php
// Detecta o nível correto para voltar à raiz do painel
$nivel_path = str_contains($_SERVER['REQUEST_URI'], '/painel/assets/php/') ? '../../' : '';
$logoPath = file_exists('../img/logo.png') ? '../img/logo.png' : 'assets/img/logo.png';
$currentPage = basename($_SERVER['PHP_SELF']);
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-xl">


<a class="navbar-brand d-flex align-items-center" href="<?= $nivel_path ?>index.php">
    <img src="<?= $logoPath ?>" alt="Logo" width="140" class="me-2">
</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
<a class="nav-link <?= $currentPage === 'index.php' ? 'active-menu' : '' ?>" href="<?= $nivel_path ?>index.php">
    <i class="fas fa-home me-1"></i> Home
</a>
                </li>

                <?php if ($user['tipo_usuario'] === 'admin'): ?>
                <li class="nav-item">
<a class="nav-link <?= $currentPage === 'criar_usuario.php' ? 'active-menu' : '' ?>" href="<?= $nivel_path ?>assets/php/criar_usuario.php">
    <i class="fas fa-user-plus me-1"></i> Criar Usuário
</a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="fas fa-key me-1"></i> Alterar Senha
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= $nivel_path ?>assets/php/logout.php">
                        <i class="fas fa-sign-out-alt me-1"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .active-menu {
        color: orange !important;
        font-weight: bold;
    }
</style>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
