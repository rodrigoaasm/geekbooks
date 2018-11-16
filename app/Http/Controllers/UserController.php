<?php namespace app\Http\Controllers;


use App\User;
use Request;

class UserController
{
    private $categoryCtr;


    function __construct() {
        $this->categoryCtr = new CategoryController();//Instancia Controlador de categorias
    }

    function login()
    {
        $categories = $this->categoryCtr->getCategories();
        return view('user_view/login')->with('categories',$categories);
    }

    function emailVerify()
    {
        $email = Request::input('email');
        $resposta = User::where('email','=',$email)->get();
        if ($resposta->count() == 0) {
            return view('user_view/form_user')->with('e',$email);
        } else {
            //Aqui decidir o que vai ser feito caso já haja o email cadastrado
            return redirect('/');
        }

    }

    function addUser()
    {
        $user = new User();
        $user->fname = Request::input('fname');
        $user->lname = Request::input('lname');
        $user->email = Request::input('email');
        $user->street = Request::input('street');
        $user->state = Request::input('state');
        $user->city = Request::input('city');
        $user->zip = Request::input('zip');

        $user->save();

        return redirect('/');
    }
}
