<?php
$method = $_SERVER['REQUEST_METHOD'];
$rest['Descricao'] = '';
$esconda = 1;
 
function limpa_html($x)
{
    $a = str_replace("<!DOCTYPE html>","",$x);
    $a = str_replace("<html>","",$a);
    $a = str_replace("<head>","",$a);
    $a = str_replace("</head>","",$a);
    $a = str_replace("<body>","",$a);
    $a = str_replace("</body>","",$a);
    $a = str_replace("</html>","",$a);
    $a = str_replace("[b]","<strong>",$a);
    $a = str_replace("[/b]","</strong>",$a);
    $a = str_replace("[i]","<i>",$a);
    $a = str_replace("[/i]","</i>",$a);
    $a = str_replace("[u]","<u>",$a);
    $a = str_replace("[/u]","</u>",$a);
    $a = str_replace("[img]","<img src='",$a);
    $a = str_replace("[/img]","'/>",$a);
    $a = str_replace("[url=","<a href='",$a);
    $a = str_replace("[/url]","</a>",$a);
    $a = str_replace("[color=","<font style='color:",$a);
    $a = str_replace("[/color]","</font>",$a);
    $a = str_replace("]","'>",$a);
    return trim($a);
}

if($method == 'POST')
{    
     if(isset($_POST['arq_page']))
     {
        $_SESSION['page'] = $_POST['arq_page'];
     }
    
    if(isset($_POST['wysiwig_full']) AND trim($_POST['wysiwig_full']) != '')
    {
       try {
       
               $sql = "UPDATE `DadoSite` SET 
                        `Descricao`= :dados 
                        WHERE (`Pagina`= :pagina)";
               
               $stmt = $conn->prepare($sql);
               $stmt->bindValue("pagina",$_SESSION['page']);
               $stmt->bindValue("dados",limpa_html($_POST['wysiwig_full']));
               $executar =  $stmt->execute();
               
                if ($executar) 
                {
			        echo "<div class='alert alert-success'><h3>Dados Gravados com Sucesso!</h3></div>";
                    $esconda = 1;
        		}
        		else 
                {
        			echo "<div class='alert alert-warning'><h3>ERRO ao Gravar!</h3></div>";
                    $esconda = 0;
        		}
       } 
       catch(PDOException $e) 
       { 
            echo 'Error: ' . $e->getMessage(); 
       }
       
        
    }
    
    if(isset($_POST['arq_page']))
    {
        $sql = "SELECT
        DadoSite.Descricao
        FROM
        DadoSite
        WHERE
        DadoSite.Pagina = :pagina";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("pagina",$_POST['arq_page']);
        $stmt->execute();
        $rest = $stmt->fetch(PDO::FETCH_ASSOC);
        $esconda = 0;
    }
}
?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="page_adm_home">Alterar Páginas</a></li>
			<li><a href="principal_adm">HOME</a></li>			
		</ol>		
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
  
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-edit"></i>
					<span>Gerenciador de Páginas</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
            <form class="form-horizontal" action="page_adm_home" method="post">
                          
				<h4 class="page-header">Selecione a página para alterar</h4>
			
					<div class="col-sm-12">
						<select class="form-control" name="arq_page">
                        <?php
	$sql = "SELECT
    DadoSite.Pagina
    FROM
    DadoSite
    ";

    $stmt = $conn->prepare($sql);    
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<option> -  </option>";
    
     foreach ($res as $b) 
     {
       echo "<option>" . $b['Pagina'] . "</option>";
     }

?>
						</select>
                                  
                    <div class="text-right">
						<button type="submit" class="btn btn-primary btn-label-center" style="margin-top:7px;">
							<span><i class="fa fa-save"></i>&nbsp; </span>Carregar a página
							</button>
					
				</div>   
					</div>
			
            </form>
              
                <form class="form-horizontal" action="page_adm_home" method="post">
                <?php
                if($esconda == 0)
                {
            	?>					
                    <div class="form-group-center">
                    <h4 class="page-header"><i class="fa fa-list"></i> Página selecionada: <?php echo isset($_POST['arq_page']) ? $_POST['arq_page'] : 'Nenhuma';?></h4>          						
						<textarea class="form-control" rows="5" name="wysiwig_full" id="wysiwig_full">                                
                         <?php
                        	echo $rest['Descricao'];
                        ?>
                        </textarea>
					</div>
                	<div class="clearfix"></div>
                    <div class="form-group">                    
                    <div class="text-center">
						<button type="submit" class="btn btn-primary btn-label-center">
							<span><i class="fa fa-save"></i>&nbsp; </span>Gravar esta página
							</button>
					</div>
				</div>     
                <?php
	              }
                  else
                  {
                     echo '<br><br><br>';
                  }
                ?>            
				</form>
                
			</div>
		</div>
       
	</div>
</div>