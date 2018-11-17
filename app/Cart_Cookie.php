<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cookie;
use Response;
use Illuminate\Http\Request;

class Cart_Cookie extends Model {
    
    //Determina o nome e tempo do cookie
    private $cookie_name = 'cart';
    private $time = 60*24*7;
    
    public function setCook($bookArray){//Metodo utilizado para setar o valor no cookie
        Cookie::queue($this->cookie_name, serialize($bookArray), $this->time, '/');
        ///setcookie($this->cookie_name, serialize($bookArray), time() + $this->time, '/');
    }
    
    public function getCook(){//Metodo usado para receber os valores do cookie
        return unserialize(Cookie::get($this->cookie_name));
        //return unserialize($_COOKIE[$this->cookie_name]);
    }
    
    //Metodo utilizado para adicionar no cart
    public function add_cart($isbn) {
        // Se o cookie já existir irá receber os valores contidos nele
        if (isset($_COOKIE[$this->cookie_name])) {
            $bookArray = $this->getCook();
            //Se no array recebido houver uma posição com o isbn fornecido irá incrementar em 1
            //se não houver irá adicionar a esta posição a quantidade 1
            if (isset($bookArray[$isbn])) {
                $bookArray[$isbn] += 1;
            } else {
                $bookArray[$isbn] = 1;
            }
            //em ambos os casos irá realizar o setcookie com o item inserido
            $this->setCook($bookArray);
        } else {
            //se o cookie não existir irá atribuir a bookArray na posição do isbn o valor 1 e inicializará o cookie
            $bookArray[$isbn] = 1;
            $this->setCook($bookArray);
        }
        return $bookArray;
    }

    //Metodo que atualiza a quantidade de um item do cart
    public function update_cart($isbn, $quant) {
        $quantity = (int) $quant;
        //recebe o array do cookie
        $bookArray = $this->getCook();
        //para a posição passada atualiza para a nova quantia
        $bookArray[$isbn] = $quantity;
        //depois retorna o array atualizado para o cookie
        $this->setCook($bookArray);

        return $bookArray;
    }

    //Metodo que exclui um item do cart
    public function delete_cart($isbn) {
        //Recebe o array do cookie
        $bookArray = $this->getCook();
        //para a posição passada realiza o unset
        unset($bookArray[$isbn]);
        //depois retorna o array para o cookie
        $this->setCook($bookArray);

        return $bookArray;
    }

}
