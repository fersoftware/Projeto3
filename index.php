<?php

date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

require_once "conexaoDB.php";
$conn = conexaoDB();

$caminho = parse_url("HTTP://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$pagina = substr($caminho['path'],1,strlen($caminho['path'])); // tira a primeira / <-(barra)

//Se não for digitada nenhum pagina a home será a padrao
if(strlen($pagina) == 0 )
{
    $pagina = 'home';
}

$pages = 'home,empresa,produtos,servicos,contatos';
if(!strstr($pages,$pagina))$pagina = 'pagina-nao-encontrada';//Se não tiver na lista de pages exibe pagina-nao-encontrada


function limita_caracteres($texto, $limite, $quebra = true) {
    $tamanho = strlen($texto);

    // Verifica se o tamanho do texto é menor ou igual ao limite
    if ($tamanho <= $limite) {
        $novo_texto = $texto;
        // Se o tamanho do texto for maior que o limite
    } else {
        // Verifica a opção de quebrar o texto
        if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)).'...';
            // Se não, corta $texto na última palavra antes do limite
        } else {
            // Localiza o útlimo espaço antes de $limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
            // Corta o $texto até a posição localizada
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)).'...';
        }
    }

    // Retorna o valor formatado
    return $novo_texto;
}

?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Primeiro Site v2.0.0 - Projeto Simples em PHP</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" style="background: darkgray;">
  <div class="container">
    <a href="/admin/"> [Acessar Admin] </a>
  </div>
</nav>
<div class="container">
<!-- ### Os unicos includes é o menu, contatos e rodapé ### -->
    <!-- ### As outras páginas são todas pelo banco de dados ### -->

    <div class="masthead">
        <h3 class="muted">Projeto Banco de Dados</h3>
        <?php require_once('includes/menu.php'); ?>
    </div>

    <?php


    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'POST')
    {
        if(isset($_POST['busca'])) {
            ?>

            <div class="alert alert-success">
                <h3>Resultado da Busca</h3>
                <hr>
                <p>
                    <?php

                    $sql = "SELECT
                    DadoSite.Descricao,
                    DadoSite.Pagina
                    FROM
                    DadoSite
                    WHERE
                    DadoSite.Descricao like :busca ";

                    $likeString = '%' . $_POST['busca'] . '%';
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(":busca", $likeString);
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($res) >= 1) {
                        foreach ($res as $b) {
                            echo "<a href='/" . $b['Pagina'] . "'> " . limita_caracteres(strip_tags($b['Descricao']), 100, false) . " - <strong>página " . $b['Pagina'] . "</strong> </a><br/>";
                        }
                    } else {
                        echo '<h3>Dados não encontrado</h3>';
                    }
                    ?>
                </p>
                <br><a href="?p=home">Clique Aqui para Retornar </a>
            </div>
        <?php
        }
    }

    $sql = "SELECT
    DadoSite.Descricao
    FROM
    DadoSite
    WHERE
    DadoSite.Pagina = :pagina";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue("pagina",$pagina);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($pagina == 'contatos')//Devido aos códigos em PHP foi melhor separar deixar fora do banco
    {
        require_once('includes/'.$pagina.'.php');
    }
    else
    {
        echo $res['Descricao'];// Todas as outras páginas estão aqui
    }

    ?>

    <hr>

    <?php require_once('includes/rodape.php'); ?>

</div>
</body>
</html>