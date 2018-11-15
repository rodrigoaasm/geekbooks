<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Cart_Cookie;

class CartController extends Controller {

    //Declaração de Variavéis
    private $categoryCtr;
    private $bookCtr;
    private $cartCookie;

    //Metodo construtor
    function __construct(BookController $BookCtr, Cart_Cookie $Cart) {
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
        $this->bookCtr = $BookCtr;
        $this->cartCookie = $Cart;
    }

    //Metodo show, mostra o carrinho, bem com seus valores
    public function show($isbn = null) {
        $categories = $this->categoryCtr->getCategories();
        $title_body = "Cart";
        $bookArray = Array();
        //Caso tenha recebido um valor o adicionara ao carrinho

        if (!isset($_COOKIE['cart'])) {
            if ($isbn != null) {
                $bookArray = $this->cartCookie->add_cart($isbn);
            } else {
                setcookie('cart', serialize($bookArray), time() + 64000 * 10, '/');
            }
        }
        else{
            if ($isbn != null) {
            $bookArray = $this->cartCookie->add_cart($isbn);
            }
            else{
                $bookArray = unserialize($_COOKIE['cart']);
            }
        }
        
        $bookArray = $this->bookCtr->returnBooks($bookArray);
        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $qty = $this->countQty($bookArray);
        $subTotal = $this->total($bookArray);
        $frete = $this->frete($qty);
        $totalCart = $frete + $subTotal;
        //Retorna a view do cart
        return view("cart_view/cart_view", compact("categories", "bookArray","qty","subTotal", "frete", "totalCart", "title_body"));
    }

    public function attCart(Request $request) {
        $post = $request->except('_token'); //Recuperando informações passadas via post
        $action = $post['action'];
        $categories = $this->categoryCtr->getCategories();
        $title_body = "Cart";
        $bookArray = Array();

        //Chamada do metodo, seja ele de remoção ou de atualização
        if ($action == 'delete') {
            $bookArray = $this->cartCookie->delete_cart($post['ISBN']);
        }
        $bookArray = $this->bookCtr->returnBooks($bookArray);
        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $qty = $this->countQty($bookArray);
        $subTotal = $this->total($bookArray);
        $frete = $this->frete($qty);
        $totalCart = $frete + $subTotal;
        //Retorna a view do cart
        return view("cart_view/cart_view", compact("categories", "bookArray","qty","subTotal", "frete", "totalCart", "title_body"));
    }

    public function total($bookArray) {
        $cont = 0;
        foreach ($bookArray as $book => $item):
            $cont += $item['price'] * $item['quantity'];
        endforeach;
        return $cont;
    }
    
    public function countQty($bookArray) {
        $cont = 0;
        foreach ($bookArray as $book => $item):
            $cont += $item['quantity'];
        endforeach;
        return $cont;
    }
    
    public function frete($cont) {
        $frete = 0;
        if ($cont > 0) {
            $frete = (5 * ($cont - 1)) + 10;
        }
        return $frete;
    }
    
    public function books(){
        $books = unserialize($_COOKIE['cart']);
        return $bookArray = $this->bookCtr->returnBooks($books);
    }
    
    private function openCartView() {
        $categories = $this->categoryCtr->getCategories();
        $title_body = "Cart";
        $bookArray = $this->bookCtr->returnBooks(unserialize($_COOKIE['cart']));
        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $subTotal = $this->total($bookArray);
        $frete = $this->cartCookie->calc_frete();
        $totalCart = $frete + $subTotal;
        //Retorna a view do cart
        return view("cart_view/cart_view", compact("categories", "bookArray", "subTotal", "frete", "totalCart", "title_body"));
   
    }

}
