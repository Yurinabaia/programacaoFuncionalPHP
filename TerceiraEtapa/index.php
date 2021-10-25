<?php 

//Array function, são metdos que retornar funções ou melhor funções que retornam funções

//Forma normal
function dividir(int $a, int $b): float {
    return $a/$b;
}

//Forma de um array Function
//Função de alta ordem
function arrayFunction(int $dividendo) {

    return function (int $num ) use ($dividendo) : float {
        return dividir($num,$dividendo);
    };
}
$div = arrayFunction(2);//Divisor

echo $div(3) .PHP_EOL;//Pode usar assim

echo "\n". arrayFunction(2)(6);

$dividir = arrayFunction(2);//Outra forma, armazenado um function com dividendo
echo"\n".  $dividir(5) .PHP_EOL;//Valor que vai ser dividio





/**********************************CALLABLE*************************************************************/
//Ordenação de array coom USORT
//Fere o principio de programação funcional, a regra da imutabilidade
$dados = require 'manipulacao.php';


//A função abaixo utilizar o callable que pede para retorna uma nova função no return

function comparadorAray(array $pais1, array $pais2): callable
{
    return function ($index) use ($pais1, $pais2): int {
        return $pais1[$index] <=> $pais2[$index];
    };
}

usort($dados,function (array $pais1, array $pais2) : int {
    //$estadosOne = $pais1['Estados'];
    //$estadosTwo = $pais2['Estados'];
    
    $compare = comparadorAray($pais1, $pais2);
    // return  $estadosOne > $estadosTwo ? -1 : 1;
    $comparacao = $compare('Estados');
    return  $comparacao;
    //Metodo espaçonave O mesmo efeito que o ternario mas simplificado e o contrario o retorno
});

print_r($dados);



/******************************Arrow Function*************************************************************/

//O Arraw Function funcionar para passar uma função apenas
//desta forma fn () => 
//Usado em funções que tem apenas um return

//Se a função tiver mais coisa além do return não usar o array function

//Se caso eu tiver mais de um return usar o array_map(function () { //Mais coisa além do return}, $array );

//Essa uma expressão lambda.

function comparadorArayFunction(array $pais1, array $pais2): callable
{
    return fn ($index) :int => $pais1[$index] <=> $pais2[$index];//Array function
}



usort($dados,function (array $pais1, array $pais2) : int {
    //$estadosOne = $pais1['Estados'];
    //$estadosTwo = $pais2['Estados'];
    
    $compare = comparadorAray($pais1, $pais2);
    // return  $estadosOne > $estadosTwo ? -1 : 1;
    $comparacao = $compare('Estados');
    return  $comparacao;
    //Metodo espaçonave O mesmo efeito que o ternario mas simplificado e o contrario o retorno
});

print_r($dados);