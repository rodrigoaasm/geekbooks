<?php

namespace App\Http\Controllers;
date_default_timezone_set('America/Sao_Paulo');
use Illuminate\Http\Request;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\User;
use App\Order;
use App\OrderItem;

class OrderController extends Controller {

    private $order;
    private $orderItems;
    private $categoryCtr;
    private $historicalCtr;
    private $bookCtr;
    private $user;

    function __construct(Order $ord, OrderItem $ordit, User $us, BookController $book) {
        $this->order = $ord;
        $this->orderItems = $ordit;
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
        $this->historicalCtr = new HistoryController();
        $this->bookCtr = $book;
        $this->user = $us;
    }

    //Metodo utilizado para inserir um order
    public function insertCart($bookArray, $custID) {
        $time = $this->insertOrder($custID);
        $orderID = $this->getOrderByTime($custID, $time);
        foreach ($bookArray as $key => $item):
            $this->insertOrdemItem($item, $orderID);
        endforeach;
    }

    //Metodo utilizado para pegar do banco as order de uma dada pessoa
    public function getCart($email = null) {
        $categories = $this->categoryCtr->getCategories();
        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_ORDER, '/order/show', "Order Search");
        $histAcess = $this->historicalCtr->getHistoricalAcess();
        $message = "Please enter your email, to search your previous orders";
        $orderItems = Array();
        $orderDatas = Array();
        if ($email != null) {
            $orders = $this->getOrderByEmail($email);
            if ($orders != null) {
                foreach ($orders as $key => $item):
                    $orderID = $item['orderID'];
                    $orderItems[$orderID] = $this->getOrderItems($orderID);
                    $orderDatas[$orderID] = date("F d, Y h:i:s A", $item['orderdate']);
                endforeach;
            }else {
                $email = null;
                $message = "This Email doesn't have any order";
            }
        }
        return view("cart_view/order_view", compact("categories", "message", "orderDatas", "orderItems", "email", "histAcess"));
    }

    public function getSearch(Request $request) {
        $post = $request->except('_token'); //Recuperando informações passadas via post
        $email = $post['email'];
        return $this->getCart($email); 
    }

    //Metodo utilizado para se obter os items de uma order
    private function getOrderItems($orderID) {
        $orders = $this->orderItems->where('orderID', $orderID)->get();
        return $this->bookCtr->returnBookOrders($orders);
    }

    //Metodo utilizado para se obter as roders de um dado email
    private function getOrderByEmail($email) {
        $custID = $this->verifyUser($email);
        if ($custID < 0) {
            return null;
        } else {
            $orders = $this->order->where('custID', $custID)->get();
            return $orders;
        }
    }

    //Metodo utilizado para verificar se o email foi previamente cadastrado
    private function verifyUser($email) {
        $userFound = $this->user->where('email', $email)->first();
        if ($userFound) {
            return $userFound['custID'];
        } else {
            return -1;
        }
    }

    //Metodo utilizado para se obter o orderID
    private function getOrderByTime($custID, $time) {
        $order = $this->order->where('custID', $custID)
                        ->where('orderdate', $time)->first();
        return $order['orderID'];
    }

    //Metodo utilizado para inserir uma ordem
    private function insertOrder($custID) {
        $time = time();
        $order = new Order();
        $order->custID = $custID;
        $order->orderdate = $time;
        $order->save();
        return $time;
    }

    //Metodo utilizado para inserir um item de uma ordem
    private function insertOrdemItem($item, $orderID) {
        $ordemItem = new OrderItem();
        $ordemItem->orderID = $orderID;
        $ordemItem->ISBN = $item['ISBN'];
        $ordemItem->qty = $item['quantity'];
        $ordemItem->price = $item['price'];
        $ordemItem->save();
    }

}
