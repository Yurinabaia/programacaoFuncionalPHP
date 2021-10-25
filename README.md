# Programação Funcional com pela Alura


## Inicio: Releembrando funções

## Segunda Etapa: Manipulando Arrays

~~~php

    $arrayModificado =  array_map('nomeFuncion', $dados);
    //ou
    $function = fn () => return  $pais['Pais'] = strtoupper($pais['Pais'];
    array_map($function , $dados);


    //Array filter funciona da seguinte forma: 
    //Se quero remover todos os números impares da minha lista
    //eu uso array filter passando uma função que retorne apenas números pares $variavel % 2 == 0
    $arrayModificado = array_filter($dados,'verificarDadosArray');

//Array reduce tem como função reduzir o array em apenas um unico valor
//Reduce pecorrer o vetor e buscar os valores de forma funcional
    $numerDescobrir = array_reduce($br['Estados'], 'funcaioAcumulativa', 0);


~~~

## Terceira Etapa: Conceitos Funcionais 

~~~php

return fn ($a, $b) :int => $a + $b;
//Array function
//Array function é usado apenas quando a função tem apenas um return. 
~~~

## Quarta Etapa: Usando Pipe() 

~~~php 
function pipe(callable ...$funcoes):callable
 //Os três pontinhos significar vou passar varias funções ao mesmo tempo
//Quando passar os parametros baiscamente ele transofrma em array de funções
{
    return fn ($valor) => 
    array_reduce($funcoes, fn ($valorAcumulado, callable $funcaoAtual ) => 
    $funcaoAtual($valorAcumulado), $valor
    );
}   

$teste = fn (array $pais): bool => strpos($pais['Pais'], 'Brasil') !== false;


$paisCaixaAlta = fn ($dados) =>  array_map('converteFuncoesLetra', $dados);
$filtrandoDadosSemEspaco = fn ($dados) => array_filter($dados,$teste);

$retornoPipe = pipe($filtrandoDadosSemEspaco,$paisCaixaAlta);//Aqui vou executar varias funções 
//ao mesmo tempo, basta incluir no parametro do pipe
$dados = $retornoPipe($dados);
var_dump($dados );

~~~


### Quinta Etapa: Mônadas com a Class Maybe

~~~php 
<?php
//Classe genérica para receber qualquer valor 
//e retorna se null ou existe um valor

namespace Alura\Fp;

class Maybe {
    private $valor;

    public function __construct($valor) {
        $this->valor = $valor;
    }

    public static function of($valor) {
        return new self($valor);//Self é usado quando o metodo é statico, parecido com this 
        //sua chamada é com :: 
    }

    public function isNothinq() : bool {//Verifica se o valor de entra é null
        return $this->valor === null;
    } 
    public  function getValor ($default) {
        return $this->valor == null ? $default : $this->valor;
    }

    public function map(callable $funcao) {
        if($this->isNothinq()) {
            return Maybe::of($this->valor);
        }
        $valor = $funcao($this->valor);

        return Maybe::of($valor);
    }
}

echo Maybe::of(null)
->map(fn($num) => $num*2)
->map(fn($num) => $num + 10 )
->getValor(0);
~~~