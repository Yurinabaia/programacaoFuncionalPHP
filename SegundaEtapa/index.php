<?php 

    //Mapeamento de array    
    $dados = require 'manipulacao.php';

    $cont = count($dados);

    echo "O número de paises: $cont";

    function converteFuncoesLetra (array $pais): array{
        $pais['Pais'] = strtoupper($pais['Pais']);//Mudando todos os dados do indice Pais do meu array para caixa alta
        return $pais;
    }

 $arrayModificado =    array_map('converteFuncoesLetra', $dados);

//var_dump($arrayModificado);

/*****************************************************************************************************/

    //Filtrando no array
    function verificarDadosArray(array $pais): bool {
       // return strpos($pais['Pais'], 'Brasil') !== false; //Forma de procurar em array versão php 7.4
       return str_contains('Brasil', $pais['Pais']);//Forma de filtrar em array versão PHP 8.0

    }

    $arrayModificado =  array_map('verificarDadosArray', $dados);
    //Array filter funciona da seguinte forma: 
    //Se quero remover todos os números impares da minha lista
    //eu uso array filter passando uma função que retorne apenas números pares $variavel % 2 == 0

    $arrayModificado = array_filter($dados,'verificarDadosArray');
    //var_dump($arrayModificado);




/*****************************************************************************************************/
//Array reduce tem como função reduzir o array em apenas um unico valor
//Reduce pecorrer o vetor e buscar os valores de forma funcional

function funcaioAcumulativa (int $valoAcumulativo, int $valorInicial) : int {
    return $valoAcumulativo + $valorInicial;
}
//O ultimo parametro simbolizar quando que iniciar o acumulativo da minha função
//Reduzindo apenas de um país
$br = $dados[0];
$numerDescobrir = array_reduce($br['Estados'], 'funcaioAcumulativa', 0);

//echo "\n$numerDescobrir";

    
//Reduzindo de todos os paises

$numerDescobrir = array_reduce($dados, function (int $valoAcumulativo, array $pais) 
{
    return $valoAcumulativo + array_reduce($pais['Estados'], 'funcaioAcumulativa',0);
},0);



/*****************************************************************************************************/
//Ordenação de array coom USORT
//Fere o principio de programação funcional, a regra da imutabilidade

usort($dados,function (array $pais1, array $pais2) : int {
    $estadosOne = $pais1['Estados'];
    $estadosTwo = $pais2['Estados'];

    // return  $estadosOne > $estadosTwo ? -1 : 1;
    return  $estadosTwo <=> $estadosOne;
    //Metodo espaçonave O mesmo efeito que o ternario mas simplificado e o contrario o retorno

});

var_dump($dados);



