<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Book;
use App\Category;


class BookController extends Controller
{
    private $categoryCtr;
    private $historicalCtr;
    private $book;
    
    
    function __construct(Book $book) {
        $this->book = $book;
        $this->categoryCtr = new CategoryController();//Instancia Controlador de categorias
        $this->historicalCtr = new HistoryController();
    }
    
    private static function str_resume($texto,$tam){
        
        if(strlen($texto)> $tam){        
            $resumo = substr($texto,'0',$tam); //Cortar a string no numero de casas definido
            $lastPos = strrpos($resumo," ");//Busca a posição do ultimo caracter vazio
            $resumo = substr($resumo,0,$lastPos);//Corta a String da posição 0 até o ultimo caracter vazio

            return $resumo."...";
        }else return $texto;
    }
    
    public function byCategory($catID = null){       
        $categories = $this->categoryCtr->getCategories();//recuperando categorias
                
        if($catID == null){//Se não tiver nenhuma categoria selecionada coloca todas na tela
           $getBooks = $this->book->inRandomOrder()->limit(4)->get();
           $this->historicalCtr->clearHistoricalAccessElement();
        }else{//buscando livros por categoria
            $category = $this->categoryCtr->getCategory($catID); //Recuperando categoria que foi selecionada;            
            $getBooks = $category->books;//Recuperando os livros por categoria  
            $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_CATEGORY,
                    '/'.$catID, "Category '".$category['CategoryName']."'");
        }  
        
        $books = array();//Guardando dados em um array padronizado para as duas buscas
        foreach($getBooks as $book){//Resumindo descrições
            $book['description'] = $this::str_resume($book['description'],120); 
            $books[] = $book;
        }
        
        $histAcess = $this->historicalCtr->getHistoricalAcess();

        return view("books_view/books_view",compact("books","categories","histAcess"));
    }

    public function bySearch($keyWord){      
        $categories = $this->categoryCtr->getCategories();//recuperando categorias

        $books = $this->book
                ->join('bookauthorsbooks', 'bookdescriptions.ISBN', '=', 'bookauthorsbooks.ISBN')
                ->join('bookauthors', 'bookauthorsbooks.AuthorID', '=', 'bookauthors.AuthorID')
                ->where('title','LIKE','%'.$keyWord.'%')
                ->orWhere('description','LIKE','%'.$keyWord.'%')
                ->orWhere('publisher','LIKE','%'.$keyWord.'%')
                ->orWhere('nameF','LIKE','%'.$keyWord.'%')
                ->orWhere('nameL','LIKE','%'.$keyWord.'%')->get();              
                
        foreach($books as $book){//Resumindo descrições
            $book['description'] = $this::str_resume($book['description'],120);
        }
        
        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_SEARCH,
                    '/search/'.$keyWord, "Search '".$this::str_resume($keyWord." ",22)."'");        
        $histAcess = $this->historicalCtr->getHistoricalAcess();
   
        return view("books_view/books_view",compact("categories","books","keyWord","histAcess"));
    }
    
    public function bySearchPOST(Request $request){ 
         $post = $request->except('_token');//Recuperando informações passadas via post
         $keyWord = $post['search_books'];
         return $this->bySearch($keyWord);
    }
    
    public function show($isbn){
        $categories = $this->categoryCtr->getCategories();//recuperando categorias

        $book = $this->book->where('ISBN',$isbn)->first();         

        $this->historicalCtr->addHistoricalAccessElement(\App\HistoricalAccessElement::PAGE_BOOK,
                    '/show/'.$isbn,$this::str_resume($book["title"],22));        
        $histAcess = $this->historicalCtr->getHistoricalAcess();
        
        return view("books_view/book_show",compact("book","authors","categories","histAcess"));
    }
    
    public function returnBooks($bookArray){
        foreach($bookArray as $key => $value):
            $book = $this->book->where('ISBN',$key)->first();
            $item = array(
               'ISBN' => $book['ISBN'],
                'name' => $book['title'],
                'quantity'=>$value,
                'price'=>$book['price'],
                'total'=>$value*$book['price']
            );
            $bookArray[$key] = $item;
        endforeach;
        return $bookArray;
    }
}
