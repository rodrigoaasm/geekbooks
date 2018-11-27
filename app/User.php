<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'bookcustomers';
    public $timestamps = false;

    protected $fillable = array('fname', 'lname', 'email',
        'street', 'city', 'state', 'zip');
    protected $guarded = ['custID'];

    public $rules =[
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email',
        'street' => 'required',
        'city' => 'required',
        'state' => 'required|max:2',
        'zip' => 'required|regex:/^[0-9]{8}$/|numeric'
    ];

    public $email_rule = [
        'email' => 'required|email',
    ];

    public $email_mesage = [
        'email.required' => 'O campo email é obrigatório.',
        'email.email' => 'Formato de email inválido'
    ];

    public $mesages = [
        'fname.required' => 'O campo name é obrigatório.',
        'lname.required' => 'O campo last name é obrigatório.',
        'email.required' => 'O campo email é obrigatório.',
        'email.email' => 'Formato de email inválido',
        'street.required' => 'O campo street é obrigatório.',
        'city.required' => 'O campo city é obrigatório.',
        'state.required' => 'O campo sate é obrigatório.',
        'state.max' => 'O campo state deve conter apenas dois caracteres',
        'zip.required' => 'O campo zip é obrigatório.',
        'zip.regex' => 'O campo zip deve conter 8 digitos numéricos',
        'zip.numeric' => 'O campo zip deve conter apenas numeros'
    ];
}
