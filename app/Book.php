<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use App\Author;

class Book extends Model
{
    protected $table = "bookdescriptions";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe        
        'ISBN','title','description','price','publisher','pubdate','edition','pages',     
    ];    
    protected $primaryKey = 'ISBN';
    public $incrementing = false;    


    public function authors(){            
        return $this->belongsToMany(Author::class,'bookauthorsbooks','ISBN', 'AuthorID');
 
    }
}
