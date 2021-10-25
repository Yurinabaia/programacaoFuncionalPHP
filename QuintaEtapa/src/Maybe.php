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