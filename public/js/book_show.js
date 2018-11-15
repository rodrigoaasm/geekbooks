 var navDefault = null; 
 
$(document).ready(function(){    
    $('#img_book').click(expandImg);
});        

function expandImg(){ 
     navDefault = $('#flipkart-navbar').html(); 
     $('#flipkart-navbar').html("");    

     var tableNav = document.createElement('table');//Gerando tabela 
     tableNav.classList.add('col-sm-12');     
     var rowNav = document.createElement('tr');     
     var bodyTable = document.createElement('tbody');
     bodyTable.appendChild(rowNav);//Adicionando linha ao corpo
     tableNav.appendChild(bodyTable);//Adicionando corpo a tabela
  
     var titleNav = document.createElement('span');//Gerando titulo
     titleNav.innerHTML = $('#title_book').html();
     titleNav.classList.add('h5');     
     
     var colNav1 = document.createElement('td');//Gerando celula da tabela 
     colNav1.classList.add('col-sm-8');
     colNav1.appendChild(titleNav);//Inserido titulo na celula

     var elemtBack = document.createElement('button');//Gerando botão de saída
     elemtBack.type = 'button';     
     elemtBack.classList.add('btn');
     elemtBack.classList.add('btn-default');     
     elemtBack.innerHTML = "X";   
     elemtBack.addEventListener('click', minimizeImg); // Carregando listenner de volta
     
     var colNav2 = document.createElement('td'); //Gerando segunda celula da tabela    
     colNav2.classList.add('col-sm-4'); 
     colNav2.classList.add('text-right');
     colNav2.appendChild(elemtBack);//Inserido botão a celula
 
     rowNav.appendChild(colNav1);//Inserido tabelas as linhas
     rowNav.appendChild(colNav2); 
     $('#flipkart-navbar').append(tableNav);//Inserido tabela no nav 
             
     var elemtImg = document.createElement('img');//Gerando imagem 
     elemtImg.style="padding-top:5em;";      
     elemtImg.src = 'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'+$("#isbn_book").html()+'.01.LZZZZZZZ.jpg'
     elemtImg.alt = $('#title_book').html();
     elemtImg.classList.add('img-responsive'); 
     elemtImg.classList.add("center-block");
          
     var elemtDiv = document.createElement('div'); //Gerando div de fundo  
     elemtDiv.style = 'position:fixed;top:1px;height:100%; width:100%;background-color:rgba(0, 0, 0,1);';
     elemtDiv.id = "bigImg";
     elemtDiv.classList.add('text-center'); 
     elemtDiv.appendChild(elemtImg);

     $('body').append(elemtDiv);//Inserido no HTML
 }
 
 function minimizeImg(){    
     var elemtDiv = document.getElementById('bigImg');
     $('#flipkart-navbar').html( navDefault); //Restaura nav   
     document.body.removeChild(elemtDiv); // remove imagem
     $('#title_page').click(openNav);//retornando listeners
    $('#closeMySideNav').click(closeNav);
 }

