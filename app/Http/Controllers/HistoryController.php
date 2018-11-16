<?php

namespace App\Http\Controllers;

use App\HistoricalAccessElement;

class HistoryController extends Controller
{
    private $cookie_name = 'historyAcess_geekBooks';
    private $time = 600000 * 10;
    private $arrayHistoryAcess;
    
    public function addHistoricalAccessElement($page,$link,$title){        
        $this->arrayHistoryAcess = array();        
        if (isset($_COOKIE[$this->cookie_name])) {//Verifica se existe cookie
            $this->arrayHistoryAcess = unserialize($_COOKIE[$this->cookie_name]);//se existir recupera os dados
            
            $historyAcess = new HistoricalAccessElement($page,$link,$title);//Inicia elemento historico
            $flagPosicionado = false;
            foreach($this->arrayHistoryAcess as $h){//Passa por todos os elementos historicos
                /*Se o elemento historico instaciado agora tiver um valor de 
                 * hieraquia menor que o elemento da iteração, faz a substituição*/                 
                if(($h->getHierc() >= $historyAcess->getHierc())  && $flagPosicionado == false){
                    $posic = array_search($h,$this->arrayHistoryAcess);//Buscando posição do elemento de iteração
                    //inserido elemento criado no local do elemento de iteração
                    $this->arrayHistoryAcess[$posic] = $historyAcess;
                    $flagPosicionado = true;
                }else if($flagPosicionado == true){//Excluir todos os elementos que venham depois do substituido
                    $posic = array_search($h,$this->arrayHistoryAcess);
                    unset($this->arrayHistoryAcess[$posic]);
                }
            }   
            
            //Caso o elemento criado seja menor que todos os outro insere no final da lista
            if($flagPosicionado == false){
                $this->arrayHistoryAcess[] = $historyAcess;
            }       
            setcookie($this->cookie_name, serialize($this->arrayHistoryAcess), time() + $this->time, '/');           
        }else{//Se o cookie não existir cria ele 
            $this->arrayHistoryAcess[] = new HistoricalAccessElement($page,$link,$title);
            setcookie($this->cookie_name, serialize($this->arrayHistoryAcess), time() + $this->time, '/');   
        }
    }
    
    public function clearHistoricalAccessElement(){
        //se o cookie exitir limpa ele
        if (isset($_COOKIE[$this->cookie_name])) {
            $this->arrayHistoryAcess = array();
            setcookie($this->cookie_name, serialize($this->arrayHistoryAcess), time() + $this->time, '/');   
        }
    }  
   
    public function getHistoricalAcess(){
        //retorna a lista de elementos historicos
        if (isset($_COOKIE[$this->cookie_name])) {
            return $this->arrayHistoryAcess;
        }else{
            return array();
        }
    }
    
}
    

