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
}
