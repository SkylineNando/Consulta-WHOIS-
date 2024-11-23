<?php
require_once 'vendor/mashape/unirest-php/src/Unirest.php'; // Certifique-se de que a biblioteca Unirest está instalada

$headers = array(
    "Accept" => "application/json",
    "Authorization" => "Token 2oroIPRSEKt0Ao1wGNenug" // Sua chave da API
);

$data = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["domain_name"])) {
    $inputUrl = htmlspecialchars(trim($_POST["domain_name"]));
    
    if (filter_var($inputUrl, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) || filter_var($inputUrl, FILTER_VALIDATE_URL)) {
        $url = "https://jsonwhoisapi.com/api/v1/whois?identifier=$inputUrl";

        $response = Unirest\Request::get($url, $headers);
        if ($response->code === 200) {
            $data = $response->body;
        } else {
            $error = "Não foi possível recuperar as informações WHOIS. Verifique o domínio.";
        }
    } else {
        $error = "Por favor, insira um domínio ou URL válido.";
    }
}

function formatValue($value) {
    if (is_array($value)) {
        return implode(", ", $value);
    }
    return htmlspecialchars($value ?? "");
}

function displayIfExists($label, $value) {
    if (!empty($value)) {
        echo "<p><span class='key'>$label:</span> " . formatValue($value) . "</p>";
    }
}

function hasData($data) {
    if (empty($data)) {
        return false;
    }
    if (is_array($data)) {
        return count(array_filter($data)) > 0;
    }
    return !empty($data);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consulta WHOIS</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="header sticky-top bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="navigation">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="../">
                                <img src="../images/logo.png" alt="Consulta WHOIS" loading="lazy">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
                                <ul class="navbar-nav">

                                    <li class="nav-item">
                                        <a class="active nav-link" href="#">Whois</a>
                                    </li>   
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/report/" >Denunciar</a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/contact/" >Contato</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-outline btn-outline-primary text-primary" href="../pages/signin/">Entrar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-primary btn-sm text-white" href="../pages/signup/">Inscreva-se</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="border-bottom section-padding">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                    <h1 class="fw-bold mb-3 text-dark-400">Bem-vindo à <strong class="text-primary">Consulta WHOIS</strong></h1>
                    <p class="mb-4 h4">Obtenha informações detalhadas sobre qualquer domínio ou IP!</p>
                </div>
                <div class="col-12 col-lg-6 offset-lg-1">
                    <div class="intro-form-exchange p-4 shadow-5 rounded bg-white">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label class="me-sm-2" for="domain_name">Digite um domínio ou IP:</label>
                                <div class="input-group">
                                    <input type="text" name="domain_name" id="domain_name" class="form-control" placeholder="Exemplo: google.com" required>
                                </div>
                            </div>
                            <?php if (!empty($error)): ?>
                                <p class="text-danger"><?php echo $error; ?></p>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary w-100 position-relative text-white mt-2">
                                Consultar WHOIS
                                <span class="btn-icon position-absolute">
                                    <i class="la la-arrow-right"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($data): ?>
        <section class="section-padding">
            <div class="container">
                <div class="whois-result p-4 shadow-5 rounded bg-white">
                    <h2 class="fw-bold mb-3 text-dark-400">Resultado da Consulta WHOIS</h2>

                    <div class="section">
                        <h3>Informações Básicas</h3>
                        <?php
                        displayIfExists("Domínio", $data->name ?? null);
                        displayIfExists("Data de Criação", $data->created ?? null);
                        displayIfExists("Data de Expiração", $data->expires ?? null);
                        displayIfExists("Última Atualização", $data->changed ?? null);
                        displayIfExists("DNSSEC", $data->dnssec ?? null);
                        displayIfExists("Registrado", $data->registered ?? null);
                        ?>
                    </div>

                    <?php if (is_array($data->nameservers ?? null)): ?>
                        <div class="section">
                            <h3>Servidores DNS</h3>
                            <ul>
                                <?php foreach ($data->nameservers as $nameserver): ?>
                                    <li><?php echo formatValue($nameserver); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

   
        <!--====================== Footer Start ======================-->
        <footer class="footer section-padding interested-join ">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="interested-join-content text-center">
              <div class="mb-4">
                <h2 class="text-dark-400 fw-bold text-white mb-3">Experimente o UbityPro hoje!</h2>
                <p class=" text-white">Descubra como podemos simplificar e fortalecer suas estratégias de compartilhamento de links online.</p>
              </div>
              <a href="#!" class="btn btn-primary btn-lg">Inscreva-se gratuitamente</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--====================== Footer End ======================-->
      <!--====================== Copyrights Start ======================-->
      <div class="copyrights bg-dark-blue py-4">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 col-md-6">
            <p class=" mb-0 text-center text-sm-start text-gray fs-6">Copyright &copy;<script>document.write(new Date().getFullYear()); </script><a href="#" class="copyright-links fw-bold text-gray ms-1 text-hover-primary"> UbityPro</a> All Rights Reserved.</p>
          </div>

          <div class="col-12 col-sm-4 col-md-6">
            <ul class="social list-group list-group-horizontal justify-content-center justify-content-sm-end mt-3 mt-sm-0">
              <li class="list-group-item border-0 bg-transparent p-0">
                <a href="../pages/help/" class="text-white px-2">Ajuda</a>
              </li>
              <li class="list-group-item border-0 bg-transparent p-0">
                <a href="../pages/report/" class="text-white px-2">Denunciar</a>
              </li>
              <li class="list-group-item border-0 bg-transparent p-0">
                <a href="../pages/faq/" class="text-white px-2">Privacidade</a>
              </li><li class="list-group-item border-0 bg-transparent p-0">
                <a href="../pages/contact" class="text-white px-2">Contato</a>
              </li>
             
            </ul>
            <!-- social-icons end -->
          </div>
          </div>
        </div>
      </div>
    <!--====================== Copyrights End ======================-->

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
