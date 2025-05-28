<?php
$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txtnome'];
    $senha = $_POST['txtsenha'];
    $confirmacao = $_POST['txtconfirmacao'];

    $dados = [
        'nome' => $nome,
        'senha' => $senha,
        'confirmacao' => $confirmacao
    ];

    $json = json_encode($dados);

    $opts = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $json
        ]
    ];

    $context = stream_context_create($opts);
    $result = json_decode(file_get_contents('http://localhost/inspetora/back-end/endpoints/post_user.php', false, $context), true);

    $mensagem = $result['mensagem'] ?? $result['erro'] ?? null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Cadastro</title>
</head>
<body>
<body>
    <div class="background">
        <img src="../assets/FundoDasTelas.png" alt="">
    </div>

    <div class="wave-container">
        <!-- Onda 1 (laranja) -->
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="onda-diagonal" xmlns="http://www.w3.org/2000/svg">
          <path fill="#FF6B00" d="M0,160 C180,280 360,40 540,160 C720,280 900,40 1080,160 C1260,280 1440,40 1440,160 L1440,320 L0,320 Z">
            <animate 
              attributeName="d" 
              dur="10s" 
              repeatCount="indefinite"
              values="
                M0,160 C180,280 360,40 540,160 C720,280 900,40 1080,160 C1260,280 1440,40 1440,160 L1440,320 L0,320 Z;
                M0,180 C180,60 360,300 540,180 C720,60 900,300 1080,180 C1260,60 1440,300 1440,180 L1440,320 L0,320 Z;
                M0,160 C180,280 360,40 540,160 C720,280 900,40 1080,160 C1260,280 1440,40 1440,160 L1440,320 L0,320 Z
              "
            />
          </path>
        </svg>
      
        <!-- Onda 2 (amarelo) -->
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="onda-diagonal onda-2" xmlns="http://www.w3.org/2000/svg">
          <path fill="#FFD700" fill-opacity="0.8" d="M0,180 C480,140 960,200 1440,180 L1440,320 L0,320 Z">
            <animate 
              attributeName="d" 
              dur="8s" 
              repeatCount="indefinite"
              values="
                M0,180 C480,140 960,200 1440,180 L1440,320 L0,320 Z;
                M0,200 C480,180 960,160 1440,200 L1440,320 L0,320 Z;
                M0,180 C480,140 960,200 1440,180 L1440,320 L0,320 Z
              " 
            />
          </path>
        </svg>
      </div>
      


    <header></header>

    <main>
        <section id="section_form">
            <div id="logo_formulario">
                <img src="../assets/DevTheBlaze.png" alt="Logo DevTheBlaze">
            </div>
            <!-- <div>
                <h1>Login</h1>
            </div> -->
            <form method="POST">
                <div class="input-container">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="txtnome" id="txtlogin" placeholder="Usuário">
                </div>

                <div class="input-container">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="txtsenha" id="txtsenha" placeholder="Senha">
                </div>

                <div class="input-container">
                <i class="bi bi-lock-fill"></i>
                    <input type="password" name="txtconfirmacao" id="txtconfirmacao" placeholder="Confirmar Senha">
                </div>

                <button type="submit">Cadastrar</button>

                <a href="index.php">Faça seu Login</a>
            </form>
        </section>
    </main>

    <footer></footer>

    <?php if ($mensagem):
        $icone = strpos($mensagem, 'sucesso') !== false ? 'success' : 'error';
        $titulo = strpos($mensagem, 'sucesso') !== false ? 'Sucesso' : 'Erro';
    ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: '<?= $icone ?>',
                title: '<?= $titulo ?>',
                text: <?= json_encode($mensagem) ?>
            });
        </script>
    <?php endif; ?>
</body>
</html>