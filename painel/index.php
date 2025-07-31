
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Gestão de Clientes</title>
    <link rel="icon" href="https://idealconsultoriamga.com.br/assets/images/logo.png" type="image/png">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>


<?php include_once "includes/header.php"; ?>


<?php

// Verificar se a variável de sessão tipo_usuario está configurada corretamente
if (!isset($user['tipo_usuario'])) {
    die("Erro: tipo_usuario não está definido. Por favor, verifique o banco de dados.");
}

function setMessage($message, $type) {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function validateInput($data, $type) {
    $patterns = [
        'nome' => '/^[a-zA-Z\s]+$/',
        'telefone' => '/^[0-9]+$/',
        'cpf' => '/^[0-9]+$/'
    ];

    if (!preg_match($patterns[$type], $data)) {
        return false;
    }

    return true;
}

// Adicionar Cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cliente'])) {
    // Recebendo dados do formulário
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $documento = null;

    // Obter o nome do atendente com base no ID do usuário logado
    $sqlObterAtendente = "SELECT nome FROM usuarios WHERE id = ?";
    $stmtObterAtendente = $conn->prepare($sqlObterAtendente);
    $stmtObterAtendente->bind_param("i", $id);
    $stmtObterAtendente->execute();
    $resultadoAtendente = $stmtObterAtendente->get_result();

    if ($resultadoAtendente->num_rows == 1) {
        $rowAtendente = $resultadoAtendente->fetch_assoc();
        $atendente = $rowAtendente['nome'];
    } else {
        $atendente = "Desconhecido";
    }
    $stmtObterAtendente->close();

    // Validação dos campos
    if (!validateInput($cpf, 'cpf')) {
        setMessage("O CPF deve conter apenas números!", "error");
    } elseif (!validateInput($telefone, 'telefone')) {
        setMessage("O Telefone deve conter apenas números!", "error");
    } elseif (!validateInput($nome, 'nome')) {
        setMessage("O nome deve conter apenas letras!", "error");
    } else {
        // Verificar se CPF já existe
        $sqlVerificarCPF = "SELECT * FROM clientes WHERE cpf = ?";
        $stmtVerificarCPF = $conn->prepare($sqlVerificarCPF);
        $stmtVerificarCPF->bind_param("s", $cpf);
        $stmtVerificarCPF->execute();
        $resultadoCPF = $stmtVerificarCPF->get_result();

        if ($resultadoCPF->num_rows > 0) {
            setMessage("Erro: CPF já cadastrado!", "error");
        } else {
            // Lidar com upload de documento, se houver
            if (isset($_FILES['documento']) && $_FILES['documento']['error'] == UPLOAD_ERR_OK) {
                $uploadedFileName = basename($_FILES['documento']['name']);
                $uploadedFilePath = 'uploads/' . $uploadedFileName;

                // Movendo o arquivo para o diretório de uploads
                if (move_uploaded_file($_FILES['documento']['tmp_name'], $uploadedFilePath)) {
                    $documento = $uploadedFilePath;
                } else {
                    setMessage("Erro ao fazer upload do documento!", "error");
                }
            }

            // Inserir novo cliente com cadastrado_por
            $sqlInserirCliente = "INSERT INTO clientes (nome, telefone, cpf, atendente, documento, cadastrado_por) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInserirCliente = $conn->prepare($sqlInserirCliente);
            $stmtInserirCliente->bind_param("sssssi", $nome, $telefone, $cpf, $atendente, $documento, $id);

            if ($stmtInserirCliente->execute()) {
                setMessage("Cliente adicionado com sucesso!", "success");
            } else {
                setMessage("Erro ao adicionar o cliente!", "error");
            }
            $stmtInserirCliente->close();
        }

        $stmtVerificarCPF->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Pesquisar Cliente
$clientesResult = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pesquisa'])) {
    $pesquisa = $_POST['pesquisa'];
    $sqlPesquisar = "SELECT * FROM clientes WHERE (nome LIKE ? OR cpf LIKE ?) AND (cadastrado_por = ? OR ? = 'admin')";
    $stmtPesquisar = $conn->prepare($sqlPesquisar);
    $pesquisaParam = "%" . $pesquisa . "%";
    $stmtPesquisar->bind_param("ssis", $pesquisaParam, $pesquisaParam, $id, $user['tipo_usuario']);
    $stmtPesquisar->execute();
    $clientesResult = $stmtPesquisar->get_result();
    $stmtPesquisar->close();
} else {
    // Paginação de Clientes (Mostrar mais)
    $limite = 10;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $limite;

    if ($user['tipo_usuario'] === 'admin') {
        $sqlClientes = "SELECT * FROM clientes LIMIT ?, ?";
        $stmtClientes = $conn->prepare($sqlClientes);
        $stmtClientes->bind_param("ii", $inicio, $limite);
    } else {
        $sqlClientes = "SELECT * FROM clientes WHERE cadastrado_por = ? LIMIT ?, ?";
        $stmtClientes = $conn->prepare($sqlClientes);
        $stmtClientes->bind_param("iii", $id, $inicio, $limite);
    }

    $stmtClientes->execute();
    $clientes = $stmtClientes->get_result();
    $stmtClientes->close();
}

// Alterar senha do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nova_senha'])) {
    $nova_senha = $_POST['nova_senha'];
    $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
    $sqlAlterarSenha = "UPDATE usuarios SET senha = ? WHERE id = ?";
    $stmtAlterarSenha = $conn->prepare($sqlAlterarSenha);
    $stmtAlterarSenha->bind_param("si", $nova_senha_criptografada, $id);

    if ($stmtAlterarSenha->execute()) {
        setMessage("Senha alterada com sucesso!", "success");
    } else {
        setMessage("Erro ao alterar a senha!", "error");
    }

    $stmtAlterarSenha->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Excluir Cliente
if (isset($_GET['excluir'])) {
    $cliente_id = $_GET['excluir'];
    $sqlExcluirCliente = "DELETE FROM clientes WHERE id = ?";
    $stmtExcluirCliente = $conn->prepare($sqlExcluirCliente);
    $stmtExcluirCliente->bind_param("i", $cliente_id);

    if ($stmtExcluirCliente->execute()) {
        setMessage("Cliente excluído com sucesso!", "success");
    } else {
        setMessage("Erro ao excluir o cliente!", "error");
    }

    $stmtExcluirCliente->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>



<?php if (isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['message_type'] == 'success' ? 'alert-success' : 'alert-danger' ?>">
        <?= $_SESSION['message'] ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<div class="container mt-4">
    <div class="alert alert-primary d-flex align-items-center">
        <i class="fas fa-user-circle fa-lg me-2"></i>
        <strong>Seja bem-vindo, <?= htmlspecialchars($user['nome']); ?>!</strong>
    </div>

    <div class="row g-4">
        <!-- Formulário de Adição -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-user-plus me-2"></i>Adicionar Cliente
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label"><i class="fas fa-user"></i> Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label"><i class="fas fa-phone"></i> Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label"><i class="fas fa-id-card"></i> CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required>
                        </div>
                        <div class="mb-3">
                            <label for="documento" class="form-label"><i class="fas fa-file-upload"></i> Documento (opcional)</label>
                            <input type="file" class="form-control" id="documento" name="documento">
                        </div>
                        <button type="submit" name="add_cliente" class="btn btn-success w-100">
                            <i class="fas fa-plus-circle"></i> Adicionar Cliente
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Formulário de Pesquisa -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-search me-2"></i>Pesquisar Cliente
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite o nome ou CPF do cliente" required>
                        </div>
                        <button type="submit" class="btn btn-info w-100 text-white">
                            <i class="fas fa-search"></i> Pesquisar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultado da pesquisa -->
    <?php if (!empty($clientesResult) && $clientesResult->num_rows > 0): ?>
        <div class="row mt-4">
            <div class="col-12">
                <?php while ($cliente = $clientesResult->fetch_assoc()): ?>
                    <div class="card border-info shadow-sm mb-3">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-user"></i> Cliente encontrado
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-user"></i> Nome: <?= $cliente['nome'] ?></li>
                                <li class="list-group-item"><i class="fas fa-phone"></i> Telefone: <?= $cliente['telefone'] ?></li>
                                <li class="list-group-item"><i class="fas fa-id-card"></i> CPF: <?= $cliente['cpf'] ?></li>
                                <li class="list-group-item"><i class="fas fa-user-tie"></i> Atendente: <?= $cliente['atendente'] ?></li>
                                <?php if ($cliente['documento']): ?>
                                    <li class="list-group-item">
                                        <i class="fas fa-file"></i>
                                        <a href="<?= $cliente['documento'] ?>" target="_blank">Documento</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pesquisa'])): ?>
        <div class="alert alert-danger mt-4">Cliente não encontrado.</div>
    <?php endif; ?>

    <!-- Tabela de clientes -->
    <hr class="my-4">
    <h3><i class="fas fa-users me-2"></i>Clientes Cadastrados</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Atendente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($clientes->num_rows > 0): ?>
                    <?php while ($cliente = $clientes->fetch_assoc()): ?>
                        <tr>
                            <td><?= $cliente['id'] ?></td>
                            <td><?= $cliente['nome'] ?></td>
                            <td><?= $cliente['telefone'] ?></td>
                            <td><?= $cliente['cpf'] ?></td>
                            <td><?= $cliente['atendente'] ?></td>
                            <td class="text-center">
                                <?php if ($user['tipo_usuario'] === 'admin'): ?>
                                    <a href="?excluir=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhum cliente cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $pagina == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Anterior</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Próximo</a>
            </li>
        </ul>
    </nav>
</div>


<script>
    function validatePasswords() {
        const novaSenha = document.getElementById('nova_senha').value;
        const confirmarSenha = document.getElementById('confirmar_senha').value;
        
        if (novaSenha.length < 8) {
            alert('A nova senha deve ter pelo menos 8 caracteres.');
            return false;
        }
        
        if (!/[A-Z]/.test(novaSenha)) {
            alert('A nova senha deve conter pelo menos uma letra maiúscula.');
            return false;
        }
        
        if (!/[a-z]/.test(novaSenha)) {
            alert('A nova senha deve conter pelo menos uma letra minúscula.');
            return false;
        }
        
        if (!/[0-9]/.test(novaSenha)) {
            alert('A nova senha deve conter pelo menos um número.');
            return false;
        }
        
        if (novaSenha !== confirmarSenha) {
            alert('As senhas não coincidem. Por favor, tente novamente.');
            return false;
        }
        
        return true;
    }

    function togglePasswordVisibility(id) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
 
            </tbody>
        </table>
    </div>

    <footer>
        <span>v1.02</span> | Todos os direitos reservados &copy; 2025
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>