<?php
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
$caminho = parse_url("HTTP://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$pagina = substr($caminho['path'],1,strlen($caminho['path'])); // tira a primeira / <-(barra)

$method = $_SERVER['REQUEST_METHOD'];
$esconda = 1;    
if($method == 'POST')
{
    require_once "../conexaoDB.php";
    $conn = conexaoDB();
    
     $sql = "SELECT
            access.passw,
            access.`user`
            FROM
            access
            WHERE
            access.`user` = :user";
        
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("user",$_POST['username']);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($res['user'] == $_POST['username'] AND password_verify($_POST['password'], $res['passw']))
    {
        session_start();
        $_SESSION['login'] = "1";
        header ("Location: index.php");
    }
    else
    {
        $esconda = 3;
    }
}

?>
<!DOCTYPE html>
<html lang="pt_br">
	<head>
		<meta charset="utf-8">
		<title>Gerenciador v1</title>
		<meta name="description" content="gerenciador aula de PHP">
		<meta name="author" content="Fersoftware">
		<meta name="keyword" content="gerenciador">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="css/style_v2.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">			
			<div class="box">            
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header">GERENCIADOR v1</h3>
					</div>
                    <?php
	                   if($esconda == 3)
                       {
                    ?>
                     <p class="bg-danger">Usuário e Senha Incorreta!</p>
                     <?php
	                   }
                        ?>
                    <form class="well span8" action="?p=login.php" method="post">
					<div class="form-group">
						<label class="control-label">Usuário</label>
						<input type="text" class="form-control" name="username" />
					</div>
					<div class="form-group">
						<label class="control-label">Senha</label>
						<input type="password" class="form-control" name="password" />
					</div>
					<div class="text-center">
                    <button type="submit" class="btn btn-primary pull-center">
                    Logar no Gerenciador
                </button>
                       
					</div> 
                    </form>
                    *Para logar - usuário: admin / senha: admin
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
