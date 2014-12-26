<?php
require_once "conexaoDB.php";

echo "#### Executando Fixture ####\n";

$conn = conexaoDB();

echo "Removendo tabela";
$conn->query("DROP TABLE IF EXISTS DadoSite;");
echo " - OK \n";

echo "Criando tabela";

$conn->query("
CREATE TABLE `DadoSite` (
`Id`  int NOT NULL AUTO_INCREMENT ,
`Descricao`  longtext CHARACTER SET utf8 NULL ,
`Pagina`  varchar(25) NULL ,
PRIMARY KEY (`Id`)
);");

echo " - OK\n";

echo "Inserindo dados\n";

$smt = $conn->prepare("INSERT INTO `DadoSite` (`Descricao`, `Pagina`) VALUES ('<div class=\"jumbotron\">\r\n\r\n    <h4>Projeto 3 - Banco de Dados</h4>\r\n\r\n    <p>Ao invés de trabalhar com require / include para incluir as páginas de conteúdo no site simples, você deverá agora trazer esse conteúdo de um banco de dados MySQL.</p>\r\n\r\n    <p>Você também precisará criar um arquivo de configuração&nbsp;(variáveis) para com o banco de dados e também as fixtures necessárias para que seja possível verificar dados de teste.</p>\r\n\r\n    <p>Não deixe de criar um sistema de busca por palavra-chave, ou seja, quando alguém buscar determinada palavra, o sistema deverá &nbsp;pesquisar nos conteúdos das páginas no banco de dados e listar as páginas que possuem a palavra buscada. Ao clicar nessa página, o usuário deverá ser redirecionado para a mesma.</p>\r\n\r\n    <p>A conexão deverá ser realizada via PDO.</p>\r\n\r\n    <h4>Projeto 2 - Ajustando as rotas</h4>\r\n    <p>Agora que você já possui um site simples e funcional com PHP, utilize os conhecimentos passados nesse capítulo para redirecionar todos os requests para seu index.php.</p>\r\n    <p>Logo, quando o usuário acessar site.com.br/contato, deverá ser chamada a página de contato.</p>\r\n    <p>REGRAS:</p>\r\n\r\n    <ol>\r\n        <li>Você deverá verificar sempre se o arquivo acessado existe</li>\r\n        <li>Você deverá apresentar uma mensagem de erro 404 caso a url acessada seja inválida (não esqueça de enviar o STATUS CODE 404)</li>\r\n        <li>Crie uma função para fazer a verificação das rotas</li>\r\n        <li>Registre&nbsp;cada uma das rotas em um array</li>\r\n    </ol>\r\n\r\n    <hr>\r\n    <h1>Primeiro Projeto - Site Simples em PHP</h1>\r\n    <p class=\"lead\">Nessa fase do projeto você deverá criar um pequeno site em PHP com os seguintes requisitos:\r\n        <br>Links de navegação: <b> Home,Empresa,Produtos,Serviços e Contato </b><br>\r\n        A estilização deverá ser feito utilizando o <b>Twitter Bootstrap </b><br>\r\n        <i> A manutenção desse pequeno site deve ser muito prática, ou seja, utilizando recursos do PHP, você evitará ter que ficar repetindo blocos HTML em diversos arquivos </i> <br>\r\n        <i>No rodapé do site, dever ser exibido </i> \"Todos os direitos reservados 2014 - <b>O ano precisa ser dinâmico </b><br>\r\n        <i>O usuário final não poderá mudar o comportamento da página, ou seja, o sistema tem que tratar os erros no caso de um parâmetro <b>GET</b> ter sido alterado de propósito<br>\r\n            O sistema deve ser MUITO simples, sem utilização de qualquer banco de dados, etc.<br>\r\n            A página de contato deve possuir um formulário de contato com os campos:</i><br>\r\n        <b>Nome,Email,Assunto e Mensagem </b><br>\r\n        <i>Quando o formulário for enviado, uma mensagem deve ser exibida para o usuário final:<br>\r\n            Dados enviados com sucesso, abaixo seguem os dados que você enviou<br>\r\n            Exibição dos campos preenchidos pelos usuário.</i></p>\r\n\r\n</div>', 'home');");
$smt->execute();

echo "\nInserido dados da pagina Home\n";

$smt = $conn->prepare("INSERT INTO `DadoSite` (`Descricao`, `Pagina`) VALUES ('<h3>Quem somos!</h3>\r\n<p>Somos quem você quizer! Você,<b> cliente </b>, é o nosso foco.</p>', 'empresa');");
$smt->execute();

echo "\nInserido dados da pagina Empresa\n";

$smt = $conn->prepare("INSERT INTO `DadoSite` (`Descricao`, `Pagina`) VALUES ('<h3>Nossos Produtos</h3>\r\n<p>Estamos estocando e em breve teremos promoções de até <b>40% de desconto</b>. <br> Aguarde!</p>', 'produtos');");
$smt->execute();

echo "\nInserido dados da pagina Produtos\n";

$smt = $conn->prepare("INSERT INTO `DadoSite` (`Descricao`, `Pagina`) VALUES ('<h3>Aqui é você que manda</h3>\r\n<h4>Somos a equipe \"Bombril\", mil e uma utilidades</h4>\r\n<p>Comprove você mesmo! Entre em <a href=\"contatos\">Contato</a></p>', 'servicos');");
$smt->execute();

echo "\nInserido dados da pagina Servicos\n";

$smt = $conn->prepare("INSERT INTO `DadoSite` (`Descricao`, `Pagina`) VALUES ('<h3>Desculpe! ERRO 404</h3>\r\n<p>Esta página não existe, <a href=\"home\"> clique aqui </a> para voltar para a <b>HOME</b> ou entre em <a href=\"contatos\">contato</a> com o nosso departamento de atendimento ao cliente</p>', 'pagina-nao-encontrada');");
$smt->execute();

echo "\nInserido dados da pagina-nao-encontrada\n";

echo "#### Concluído #### INSERCAO DE DADOS #####";


echo "Removendo tabela de USUARIO";
$conn->query("DROP TABLE IF EXISTS acess;");
echo " - OK \n";

echo "Criando tabela de USUARIO";

$conn->query("
CREATE TABLE `access` (
  `user` varchar(25) DEFAULT NULL,
  `passw` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

echo " - OK\n";

echo "Inserindo dados do USUARIO\n";

$smt = $conn->prepare("INSERT INTO `access` VALUES ('admin', '$2y$10$9gZG8VhBxG7UqUYTJ.QUyuoAmWJnXRfFiwa3UIFOGJ5Fg98TC8iM.');");
$smt->execute();

echo "\nInserido com Sucesso\n";

echo "#### Concluído ####";