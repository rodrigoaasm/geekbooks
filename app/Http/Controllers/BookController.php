<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Book;
use App\Category;


class BookController extends Controller
{    
    
    private $categoryCtr;
    private $book;
    
    function __construct(Book $book) {
        $this->book = $book;
        $this->categoryCtr = new CategoryController();//Instancia Controlador de categorias
    }
    
    private static function str_resume($texto,$tam){
        $resumo = substr($texto,'0',$tam); //Cortar a string no numero de casas definido
	$lastPos = strrpos($resumo," ");//Busca a posição do ultimo caracter vazio
	$resumo = substr($resumo,0,$lastPos);//Corta a String da posição 0 até o ultimo caracter vazio
	
        return $resumo."...";
    }
    
    public function byCategory($catID = null){       
        $categories = $this->categoryCtr->getCategories();//recuperando categorias
                   
        if($catID == null){//Se não tiver nenhuma categoria selecionada coloca todas na tela
           $getBooks = $this->book->all();
           $title_body ="Home";
        }else{//buscando livros por categoria
            $category = $this->categoryCtr->getCategory($catID); //Recuperando categoria selecionada;            
            $getBooks = $category->books($catID);//Recuperando os livros por categoria  
            $title_body = "Category > ".$category['CategoryName'];
        }  
        
        $books = array();//Guardando dados em um array padronizado para as duas buscas
        foreach($getBooks as $book){//Resumindo descrições
            $book['description'] = $this::str_resume($book['description'],120); 
            $books[] = $book;
        }
        
        

        return view("books_view/books_view",compact("categories","books","title_body"));
    }
    
    
    public function bySearch(Request $request){        
        $post = $request->except('_token');//Recuperando informações passadas via post
        $categories = $this->categoryCtr->getCategories();//recuperando categorias
        
        $keyWord = $post['search_books'];
        $books = $this->book->where('title','LIKE','%'.$keyWord.'%')->get();                
                
        foreach($books as $book){//Resumindo descrições
            $book['description'] = $this::str_resume($book['description'],120);
        }
        
        $title_body = "Search > '".$keyWord."'";
   
        return view("books_view/books_view",compact("categories","books","keyWord","title_body"));
    }
}
