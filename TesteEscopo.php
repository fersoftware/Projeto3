<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/10/14
 * Time: 22:59
 */
echo '<h2>Passagem de valores na função anonima por referencia</h2>';

$nome = "Wesley";
$arr     = [1,2,3,4,5,6,7,8,9];

echo 'Valor nome ANTES de entrar na função: ' .$nome .'<br />';
$exibe = function( $x ) use( &$nome ) {
    $nome = 'Luis Alberto';
    echo 'x = ' . $x .' - Nome= '. $nome . '<br />';
};

array_walk( $arr,$exibe );

echo 'Valor nome APOS de entrar na função: ' .$nome .'<br />';