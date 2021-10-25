<?php 

    /* Função iniciais de programação funcional */
    function  helo(): string //Metodo normal
    {
        return "Hello Word";
    }


    function word(callable $funcao): void //Metodo com callback
    {
       
        echo "<br>executnado outra função: ";
        echo $funcao();
    }
    
    word('helo');//Função delegate
    word(function () {return "Lambda";});//Função lambda



    /*Dados iniciais de clousure */
    echo "<br>";
    //Clousure são funções que aceitar escorpo externos
    $varaivel = "testes";
    $nomeClosure = function () use ($varaivel) 
    {
        echo $varaivel;
        return "usar outra função";
    };
    var_dump($nomeClosure);


    $dados = require_once("manipulacao.php");
    $cont = 0;
    //recuperando dados de forma funcional
    array_walk($valores, function () use($cont) //Array_walk pecorre o array sem depender do ponteiro
    {
        $cont++;
    });
    
    //Recuperando da forma correta
    $cont = count($valores);
    echo "<br>".$cont."<br>";











    /*Dados do array map e filter, manipulação de array*/
    //Valores de forma correta
    function mudarAlgoArrayMap(array $pais): array {
        return $pais;
    }

    function vetificarArray(array $pais): bool {
        return $pais!= null;
    }
    $valores = array_map('mudarAlgoArrayMap', $valores);//Mudar dentro da função 
    $valores = array_filter($valores,'vetificarArray');//Pesquisar valores dentro de um array
    var_dump($valores);






    







