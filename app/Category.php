<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use DB;

class Category extends Model
{
    protected $table = "bookcategories";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe
         'CategoryID','CategoryName'   
    ];
    
    protected $primaryKey = 'CategoryID';
    public $incrementing = false;
    
    /*Método responsável por fazer a recuperação dos livros atraves de um codigo SQL*/
    public function books(){
        
        return $this->belongsToMany(Book::class,'bookcategoriesbooks','CategoryID', 'ISBN');         
    }

}
