<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HistoryController;
use App\Book;
use App\Cart_Cookie;

class CartController extends Controller {

    //Declaração de Variavéis
    private $categoryCtr;
    private $historicalCtr;
    private $bookCtr;
    private $cartCookie;

    //Metodo construtor
    function __construct(BookController $BookCtr, Cart_Cookie $Cart) {
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
        $this->historicalCtr = new HistoryController();
        $this->bookCtr = $BookCtr;
        $this->cartCookie = $Cart;
    }

    //Metodo show, mostra o carrinho, bem com seus valores
    public function show($isbn = null) {
        $categories = $this->categoryCtr->getCategories();
        $bookArray = Array();
        //Se o cookie não existir irá verificar se foi passado um isbn, ou foi apenas acessado a tela de cart
        if (!isset($_COOKIE['cart'])) {
            if ($isbn != null) {//Se foi passado um isbn irá chamar o metodo de adicionar no cart
                $bookArray = $this->cartCookie->add_cart($isbn);
            } else {//Se não foi passado um isbn irá adicionar criar o cookie com vazio
                $this->cartCookie->setCook($bookArray);
            }
        } else {//Já se o cart existir irá fazer o mesmo teste acima com diferença que caso não haja isbn irá apenas receber o valor do cookie
            if ($isbn != null) {
                $bookArray = $this->cartCookie->add_cart($isbn);
            } else {
                $bookArray = $this->cartCookie->getCook();
            }
        }
        //Com o valor do cookie em mãos, irá chamar o controle de livros para retornar os dados do cart
        $bookArray = $this->bookCtr->returnBooks($bookArray);
        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $qty = $this->countQty($bookArray);
        $subTotal = $this->total($bookArray);
        $frete = $this->frete($qty);
        $totalCart = $frete + $subTotal;

        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_CART, '/cart/show', "You Cart");
        $histAcess = $this->historicalCtr->getHistoricalAcess();

        //Retorna a view do cart
        return view("cart_view/cart_view", compact("categories", "bookArray", "qty", "subTotal", "frete", "totalCart", "histAcess"));
    }

    //Metodo que atualizará o cart, seja por um delete ou por um atualizar da quantidade
    public function attCart(Request $request) {
        $post = $request->except('_token'); //Recuperando informações passadas via post
        $action = $post['action'];
        $categories = $this->categoryCtr->getCategories();
        $bookArray = Array();

        //Chamada do metodo, seja ele de remoção ou de atualização
        if ($action == 'delete') {
            $bookArray = $this->cartCookie->delete_cart($post['ISBN']);
        } else if ($action == 'update') {
            if ($post['quantity'] < 1) {//Se a quantidade for negativa ou 0 remove o livro
                $bookArray = $this->cartCookie->delete_cart($post['ISBN']);
            } else {//Se a quantidade for positiva atualiza o cookie
                $bookArray = $this->cartCookie->update_cart($post['ISBN'], $post['quantity']);
            }
        }
        $bookArray = $this->bookCtr->returnBooks($bookArray);
        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $qty = $this->countQty($bookArray);
        $subTotal = $this->total($bookArray);
        $frete = $this->frete($qty);
        $totalCart = $frete + $subTotal;

        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_CART, '/cart/show', "You Cart");
        $histAcess = $this->historicalCtr->getHistoricalAcess();

        //Retorna a view do cart
        return view("cart_view/cart_view", compact("categories", "bookArray", "qty", "subTotal", "frete", "totalCart", "histAcess", "histAcess"));
    }

    //Metódo que obterá o valor do sub total, multiplicando o valor do livro por sua quantidade
    public function total($bookArray) {
        $cont = 0;
        foreach ($bookArray as $book => $item):
            $cont += $item['price'] * $item['quantity'];
        endforeach;
        return $cont;
    }

    //Metodo que realiza a contagem das quantidades que serão listadas e utilizadas posteriormente no frete
    public function countQty($bookArray) {
        $cont = 0;
        foreach ($bookArray as $book => $item):
            $cont += $item['quantity'];
        endforeach;
        return $cont;
    }

    //Metodo que receberá a quantidade e retornará o valor do frete
    public function frete($cont) {
        $frete = 0;
        if ($cont > 0) {
            //irá multiplar por 5 a quantidade que passar de 2, e depois somará 10
            //Atingindo assim a condicional de que para o primeiro livro o frete é 10 e depois para cada é 5
            $frete = (5 * ($cont - 1)) + 10;
        }
        return $frete;
    }
}
