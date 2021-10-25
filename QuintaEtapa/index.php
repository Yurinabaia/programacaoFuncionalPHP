<?php

use Alura\Fp\Maybe;

//A diferença entre a etapa quatro da quinta, que estou trabalhando com Maybe
//Monada para não precisar utilizar if
//Além de poder usar ela como class generica

/***********************************PIPE LINE DE FUNÇÃO*********************************************************/
   //Mapeamento de array   
   
   /**  @var Maybe $dados  **/
   $dados = require 'manipulacao.php';
    
    $quantidade = count($dados->getValor([]));
  
   function converteFuncoesLetra (array $pais): array{
       $pais['Pais'] = strtoupper($pais['Pais']);//Mudando todos os dados do indice Pais do meu array para caixa alta
       return $pais;
   }




    $teste = fn (array $pais): bool => strpos($pais['Pais'], 'Brasil') !== false;


$paisCaixaAlta = fn (Maybe $dados) =>  Maybe::of(array_map('converteFuncoesLetra', $dados->getValor([])));
$filtrandoDadosSemEspaco = fn (Maybe $dados) => Maybe::of(array_filter($dados->getValor([]),$teste));



//Pipe significar fazer passar uma função que retorna outra função de forma que vai criado uma 
//lista de funções
function pipe(callable ...$funcoes):callable
 //Os três pontinhos significar vou passar varias funções ao mesmo tempo
//Quando passar os parametros baiscamente ele transofrma em array de funções
{
    return fn ($valor) => 
    array_reduce($funcoes, fn ($valorAcumulado, callable $funcaoAtual ) => 
    $funcaoAtual($valorAcumulado), $valor
    );
}   

$retornoPipe = pipe($filtrandoDadosSemEspaco,$paisCaixaAlta);//Aqui vou executar varias funções 
//ao mesmo tempo, basta incluir no parametro do pipe
$dados = $retornoPipe($dados);
var_dump($dados->getValor([]));

//Diferneça entre pipe e compose é que o pipe a função executadoa da esquerda para diretia
//Compose vai ser executada da direita para esquerda
//Neste exemplo acima o pipe iniciaria filtrandoDadosSemEspaço e em seguida buscara pais caixa alta

//Maneira de fazer abaixo, mas não muito convecional
//$dados = $filtrandoDadosSemEspaco($paisCaixaAlta($dados));
//Basicamente aqui é uma função que retorno dela outra função


/***********************************PIPE LINE DE FUNÇÃO*********************************************************/

require_once 'vendor/autoload.php';

//Mapeamento de array    
$dados = require 'manipulacao.php';

$teste = fn (array $pais): bool => strpos($pais['Pais'], 'Brasil') !== false;


$paisCaixaAlta = fn (Maybe $dados) =>  Maybe::of(array_map('converteFuncoesLetra', $dados->getValor([])));
$filtrandoDadosSemEspaco = fn (Maybe $dados) => Maybe::of(array_filter($dados->getValor([]),$teste));


//Vou usar a bilbioteca igorw para fazer o pipe line forma automaica, sem precisar criar na mão
//Baixar lib composer require igorw/compose
$retornoPipe = igorw\pipeline($filtrandoDadosSemEspaco,$paisCaixaAlta);//Aqui vou executar varias funções 
//ao mesmo tempo, basta incluir no parametro do pipe


$dados = $retornoPipe($dados);
var_dump($dados->getValor([]));

