<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ideal Consultoria Maringá</title>
    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="https://idealconsultoriamga.com.br/assets/images/logo.png" type="image/png">
    <!-- Ícone do site para dispositivos Apple -->
    <link rel="apple-touch-icon" href="https://idealconsultoriamga.com.br/assets/images/logo.png">
    <!-- CSS Personalizado -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Estilo Personalizado para o Alerta -->
    <style>
    /* Estilo do Alerta Moderno */
#modernAlert {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1050;
    width: 90%;
    max-width: 500px;
    padding: 20px;
    background: #fff; /* Fundo branco */
    color: #333; /* Texto em cor escura para contraste */
    border-radius: 15px; /* Bordas mais suaves */
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15); /* Sombras elegantes */
    display: none; /* Inicialmente oculto */
    animation: fadeIn 0.5s ease-out, slideIn 0.5s ease-out; /* Adicionada uma animação de deslizamento */
}

/* Título do Alerta */
#modernAlert h5 {
    font-size: 1.7rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #007bff; /* Azul para o título */
    text-align: center; /* Centraliza o texto */
}

/* Texto do Alerta */
#modernAlert p {
    font-size: 1rem;
    margin-bottom: 20px;
    line-height: 1.5;
    text-align: center; /* Centraliza o texto */
}

/* Botão de Fechar */
#modernAlert .btn-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.1); /* Fundo leve e translúcido */
    border: none;
    font-size: 1.2rem;
    color: #333; /* Cor escura para contraste */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease; /* Adicionando transições */
}

#modernAlert .btn-close:hover {
    background: rgba(0, 0, 0, 0.2); /* Aumenta a opacidade ao passar o mouse */
    transform: scale(1.1); /* Efeito de zoom ao passar o mouse */
}

/* Botão de Ação */
#modernAlert .btn-primary {
    background: #007bff; /* Fundo azul */
    color: #fff; /* Texto branco */
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 10px; /* Bordas arredondadas */
    transition: all 0.3s ease;
    display: block;
    margin: 0 auto; /* Centraliza o botão */
    box-shadow: 0px 5px 15px rgba(0, 123, 255, 0.3); /* Sombras no botão */
}

#modernAlert .btn-primary:hover {
    background: #0056b3;
    color: #fff;
    box-shadow: 0px 8px 20px rgba(0, 86, 179, 0.4); /* Sombras ao passar o mouse */
    transform: translateY(-3px); /* Efeito de elevação ao passar o mouse */
}

/* Animação de fade-in */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Animação de deslizamento */
@keyframes slideIn {
    from {
        transform: translate(-50%, -60%);
    }
    to {
        transform: translate(-50%, -50%);
    }
}
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Substituindo o texto "Ideal Consultoria" por uma imagem -->
        <a class="navbar-brand" href="#">
            <img src="https://idealconsultoriamga.com.br/assets/images/logo.png" alt="Ideal Consultoria" style="max-width: 100px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#fgts">FGTS</a></li>
                <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
                <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Alerta Moderno -->
<div id="modernAlert">
    <button type="button" class="btn-close" aria-label="Fechar" onclick="closeAlert()">&times;</button>
    <h5>🚨 Nova Modalidade de Crédito para Trabalhadores CLT!</h5>
    <p>Descubra agora como aproveitar essa nova linha de crédito inovadora e exclusiva. Entre em contato com nossos consultores para mais informações!</p>
    <a href="https://wa.me/5544991246780?text=Olá%20gostaria%20de%20saber%20mais%20sobre%20a%20nova%20modalidade%20de%20crédito%20para%20CLT."
       class="btn btn-primary" target="_blank">
        <i class="fa fa-whatsapp"></i> Fale Conosco
    </a>
</div>

<!-- Seção Hero -->
<section class="bg-primary text-white text-center py-5" id="fgts">
    <h2 class="display-4">Antecipe seu FGTS com a Ideal Consultoria</h2>
    <p class="lead">Oferecemos a possibilidade de antecipação do seu FGTS de maneira rápida e segura.</p>
    <a href="https://app.lotusmais.com.br/self-hiring/m1v9wzeiaib2" class="btn btn-light btn-lg" target="_blank">Solicitar Consulta</a>
</section>

<!-- Outros Conteúdos Mantidos -->

<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para Controle do Alerta -->
<script>
    function showAlert() {
        const alertElement = document.getElementById('modernAlert');
        if (alertElement) {
            alertElement.style.display = 'block'; // Exibe o alerta imediatamente
        }
    }

    function closeAlert() {
        const alertElement = document.getElementById('modernAlert');
        if (alertElement) {
            alertElement.style.display = 'none'; // Oculta o alerta
        }
    }

    // Exibe o alerta imediatamente ao carregar a página
    window.onload = function () {
        showAlert(); // Chama diretamente a função para exibir o alerta
    };
</script>
</body>

<!-- Seção Serviços -->
<section class="py-5" id="servicos">
    <div class="container text-center">
        <h3 class="display-6 mb-5">Nossos Serviços</h3>
        <div class="row">
            <!-- Serviço: Antecipação de FGTS -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-light rounded h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Antecipação de FGTS</h4>
                        <p class="card-text">Somos a empresa número 1 do Paraná em antecipação de FGTS, oferecendo condições vantajosas para você.</p>
                    </div>
                    <div class="card-footer text-center mt-auto">
                        <!-- Link para WhatsApp ao clicar em "Saiba Mais" -->
                        <a href="https://wa.me/5544991246780?text=Olá%20gostaria%20de%20mais%20informações%20sobre%20antecipação%20de%20FGTS." 
                           class="btn btn-primary btn-sm" target="_blank">Saiba mais</a>
                    </div>
                </div>
            </div>

            <!-- Serviço: Empréstimo INSS -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-light rounded h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Empréstimo INSS</h4>
                        <p class="card-text">Empréstimos especiais para beneficiários do INSS com taxas acessíveis e prazos facilitados.</p>
                    </div>
                    <div class="card-footer text-center mt-auto">
                        <!-- Link para WhatsApp ao clicar em "Saiba Mais" -->
                        <a href="https://wa.me/554497185934?text=Olá%20gostaria%20de%20mais%20informações%20sobre%20empréstimos%20INSS." 
                           class="btn btn-primary btn-sm" target="_blank">Saiba mais</a>
                    </div>
                </div>
            </div>

            <!-- Serviço: Empréstimo Governo Paraná -->
            <div class="col-md-4 mb-4">
                <div class="card shadow border-light rounded h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Empréstimo Governo Paraná</h4>
                        <p class="card-text">Oferecemos financiamentos especiais com taxas baixas e prazos acessíveis para moradores do Paraná.</p>
                    </div>
                    <div class="card-footer text-center mt-auto">
                        <!-- Link para WhatsApp ao clicar em "Saiba Mais" -->
                        <a href="https://wa.me/554497394486?text=Olá%20gostaria%20de%20mais%20informações%20sobre%20empréstimos%20do%20Governo%20Paraná." 
                           class="btn btn-primary btn-sm" target="_blank">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção Conheça Nossa Equipe -->
<section class="py-5" id="equipe">
    <div class="container text-center">
        <h3 class="display-6 mb-5">Conheça Nossa Equipe</h3>
        <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000"> <!-- Automaticamente movendo a cada 2 segundos -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <!-- Membro da Equipe 1 -->
                        <div class="team-member col-12 col-sm-6 col-md-3 text-center mb-4">
                            <div class="rounded-circle mb-3" style="width: 150px; height: 150px; overflow: hidden; margin: 0 auto;">
                                <img src="https://idealconsultoriamga.com.br/assets/images/felipe-catani.png" alt="Funcionario 1" class="img-fluid" />
                            </div>
                            <h4>Felipe Catani</h4>
                            <p class="text-white">Consultor de FGTS</p>
                            <p class="mb-4">Felipe é especialista em antecipação de FGTS e está sempre pronto para oferecer soluções rápidas e seguras para nossos clientes.</p>
                            <a href="https://wa.me/5544991246780?text=Olá%20Felipe%20gostaria%20de%20mais%20informações." class="btn btn-primary">Saiba Mais</a>
                        </div>

                        <!-- Membro da Equipe 2 -->
                        <div class="team-member col-12 col-sm-6 col-md-3 text-center mb-4">
                            <div class="rounded-circle mb-3" style="width: 150px; height: 150px; overflow: hidden; margin: 0 auto;">
                                <img src="https://idealconsultoriamga.com.br/assets/images/elisangela.png" alt="Funcionario 2" class="img-fluid" />
                            </div>
                            <h4>Elisangela Neves</h4>
                            <p class="text-white">Consultora de Empréstimos</p>
                            <p class="mb-4">Elisangela é responsável por ajudar nossos clientes a escolher as melhores opções de empréstimos com as menores taxas do mercado.</p>
                            <a href="https://wa.me/4497394486?text=Olá%20Elisangela%20gostaria%20de%20mais%20informações." class="btn btn-primary">Saiba Mais</a>
                        </div>

                        <!-- Membro da Equipe 3 -->
                        <div class="team-member col-12 col-sm-6 col-md-3 text-center mb-4">
                            <div class="rounded-circle mb-3" style="width: 150px; height: 150px; overflow: hidden; margin: 0 auto;">
                                <img src="https://idealconsultoriamga.com.br/assets/images/thais.jpeg" alt="Funcionario 3" class="img-fluid" />
                            </div>
                            <h4>Thais Neves</h4>
                            <p class="text-white">Consultora de Empréstimos INSS</p>
                            <p class="mb-4">Thais é especialista em soluções financeiras para aposentados e pensionistas do INSS, com foco em atendimento personalizado.</p>
                            <a href="https://wa.me/5544997185934?text=Olá%20Thais%20gostaria%20de%20mais%20informações." class="btn btn-primary">Saiba Mais</a>
                        </div>

                        <!-- Membro da Equipe 4 -->
                        <div class="team-member col-12 col-sm-6 col-md-3 text-center mb-4">
                            <div class="rounded-circle mb-3" style="width: 150px; height: 150px; overflow: hidden; margin: 0 auto;">
                                <img src="https://idealconsultoriamga.com.br/assets/images/lisi.png" alt="Funcionario 4" class="img-fluid" />
                            </div>
                            <h4>Elisiane Neves</h4>
                            <p class="text-white">Consultora de FGTS</p>
                            <p class="mb-4">Lisi é especialista em antecipação de FGTS e está sempre pronta para oferecer soluções rápidas e seguras para nossos clientes.</p>
                            <a href="https://wa.me/5544998827395?text=Olá%20Lisi%20gostaria%20de%20mais%20informações." class="btn btn-primary">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ícone flutuante do WhatsApp -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://wa.me/5544991246780?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
  z-index:1000;" target="_blank">
<i style="margin-top:16px" class="fa fa-whatsapp"></i>
</a>

<?php include('includes/footer.php'); ?>

<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>