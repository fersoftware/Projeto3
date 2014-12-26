<?php
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST')
{
    //Gambeta, essa preula de formulário nao quer sumir
    //então eu mato na marra com IF

    $esconda = 1;


    ?>


    <div class="alert alert-success">
        <h3>Dados Enviados com Sucesso!</h3>
        <h4>Abaixo seguem os dados que você enviou.</h4>
        <p>
            <b>Nome:</b> <?php echo  $_POST['nome']?><br>
            <b>Sobrenome:</b> <?php echo  $_POST['sobrenome']?><br>
            <b>Email:</b> <?php echo  $_POST['email']?><br>
            <b>Assunto:</b> <?php echo  $_POST['assunto']?><br>
            <b>Mensagem:</b> <?php echo  $_POST['mensagem']?><br>

        </p>
        <br><a href="?p=home">Clique Aqui para Retornar </a>
    </div>
<?php
}
?>
<link class="cssdeck" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
// Voce vai desaparecer na marra
if(!isset($esconda)) {
    ?>
    <div id="formcontatos" style="display: block">
        <form class="well span8" action="/contatos" method="post">
            <div class="row">
                <div class="span3">
                    <label>Nome</label>
                    <input type="text" class="span3" name="nome" placeholder="Seu Pimeiro Nome">
                    <label>Sobrenome</label>
                    <input type="text" class="span3" name="sobrenome" placeholder="Seu Sobrenome">
                    <label>Email</label>
                    <input type="text" class="span3" name="email" placeholder="Seu Endereço de Email">
                    <label>Assunto
                        <select id="assunto" name="assunto" class="span3">
                            <option value="nenhum" selected="">Escolha Um:</option>
                            <option value="servicos">Serviços em Geral</option>
                            <option value="sugestoes">Sugestões</option>
                            <option value="produtos">Sobre o Produto</option>
                        </select>
                    </label>
                </div>
                <div class="span5">
                    <label>Mensagem</label>
                    <textarea name="mensagem" id="mensagem" class="input-xlarge span5" rows="10"></textarea>
                </div>

                <button type="submit" onclick="toggle_visibility('formcontatos')" class="btn btn-primary pull-right">
                    Enviar
                </button>
            </div>
        </form>
    </div>
<?php
}
?>
<script type="text/javascript">


    function toggle_visibility(x) {
        var e = document.getElementById(x);
        e.style.display = 'none';
    }


</script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>