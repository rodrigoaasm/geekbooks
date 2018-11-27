<?php

namespace app\Http\Controllers;

use App\User;
use function foo\func;
use Illuminate\Support\Facades\Mail;
use Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\OrderController;

class UserController
{

    private $categoryCtr;
    private $cartCtr;
    private $historicalCtr;
    private $orderCtr;
    private $user;

    public function __construct(CartController $cart, User $userI, OrderController $ordControll)
    {
        $this->user = $userI;
        $this->cartCtr = $cart;
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
        $this->historicalCtr = new HistoryController();
        $this->orderCtr = $ordControll;
    }

    public function login()
    {
        $categories = $this->categoryCtr->getCategories();
        return view('user_view/login')->with('categories', $categories);
    }

    public function emailVerify()
    {
        $email = Request::input('email');
        $resposta = User::where('email', '=', $email)->get();
        $request = Request::all();
        $validate = validator($request, $this->user->email_rule, $this->user->email_mesage);
        if ($validate->fails()) {
            return redirect('/user')->withErrors($validate)->with('e', $email);
        } else {
            if ($resposta->count() == 0) {
                return view('user_view/form_user')->with('e', $email);
            } else {
                return view('user_view/form_user')->with('usr', $resposta[0]);
            }
        }

    }

    function checkUser()
    {
        $email = Request::input('email');
        $resposta = User::where('email', '=', $email)->get();
        $request = Request::all();
        $validate = validator($request, $this->user->rules, $this->user->mesages);
        if ($validate->fails()) {
            return view('user_view/form_user')->withErrors($validate)->with('usr', $request);
        } else {
            if ($resposta->count() != 0) {
                User::where('email', '=', $email)->update(array('fname' => Request::input('fname'),
                    'lname' => Request::input('lname'), 'street' => Request::input('street'), 'state' => Request::input('state'),
                    'city' => Request::input('city'), 'zip' => Request::input('zip')));
            } else {
                $user = new User();
                $user->fname = Request::input('fname');
                $user->lname = Request::input('lname');
                $user->email = Request::input('email');
                $user->street = Request::input('street');
                $user->state = Request::input('state');
                $user->city = Request::input('city');
                $user->zip = Request::input('zip');
                $user->save();
            }
            return $this->showOrderFinish($email);
        }

    }

    function updateUser($usr)
    {
        $user = User::where('email', '=', $usr['email'])->get();
        $user->update($usr);
    }

    //Metodo que realizara todos os procedimentos necessários para que seja disponibilizado a view de finish cart
    private function showOrderFinish($email)
    {
        //Recebe os dados do usuario
        $userFound = $this->user->where('email', $email)->first();
        $address = $userFound['street'] . ' - ' . $userFound['city'] . ' - ' . $userFound['state'] . ' - ' . $userFound['zip'];
        $categories = $this->categoryCtr->getCategories();
        $bookArray = $this->cartCtr->returnCartItems();

        //Realiza os calculos para atribuir nos campos de subtotal, frete e total
        $qty = $this->cartCtr->countQty($bookArray);
        $subTotal = $this->cartCtr->total($bookArray);
        $frete = $this->cartCtr->frete($qty);
        $totalCart = $frete + $subTotal;

        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_CART, '/cart/show', "You Cart");
        $histAcess = $this->historicalCtr->getHistoricalAcess();
        //Aqui decidir o que vai ser feito caso já haja o email cadastrado
        return view("cart_view/order_finish", compact("categories", "bookArray", "email", "address", "qty", "subTotal", "frete", "totalCart", "histAcess"));
    }

//Metodo que realizara todos os procedimentos necessários para que seja disponibilizado a view de finish cart
    public function showInfo()
    {
        $categories = $this->categoryCtr->getCategories();
        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_CART, '/cart/show', "You Cart");
        $histAcess = $this->historicalCtr->getHistoricalAcess();

        return view("user_view/info", compact("categories", "histAcess"));
    }

    //Metodo que recebera o email e adicionar os itens do cart no banco e depois removera os itens do cart
    public function addOrder()
    {
        $email = Request::input('email');
        //Recebe os dados do usuario
        $userFound = $this->user->where('email', $email)->first();
        $custID = $userFound['custID'];
        $orders = $this->cartCtr->returnCartItems();

        $total = 0;

        foreach ($orders as $order){
            $total += $order['price'] * $order['quantity'];
        }

        $data['email'] = $email;
        $data['orders'] = $orders;
        $data['total'] = $total;

        Mail::send('email_template.email_send', $data, function ($message) use ($data) {
            $message->from('geekbookscom222@gmail.com', 'geekbooks');
            $message->to($data['email']);
            $message->subject('Compra geek books');
        });
        //Chama o metodo utilizado para inserir os dados do cart no banco
        $this->orderCtr->insertCart($this->cartCtr->returnCartItems(), $custID);
        //Remove os dados do cart
        $this->cartCtr->removeCart();
        //Retorna para a main page
        return redirect('/');
    }

    public function addUser($usr)
    {
        if ($usr == null) {
            $user = new User();
            $user->fname = Request::input('fname');
            $user->lname = Request::input('lname');
            $user->email = Request::input('email');
            $user->street = Request::input('street');
            $user->state = Request::input('state');
            $user->city = Request::input('city');
            $user->zip = Request::input('zip');

            $user->save();
        } else {
            $usr->save();
        }

        return redirect('/');
    }

}
