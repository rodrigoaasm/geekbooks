
function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
            // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

 function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
 }
 
 var navDefault = null; 

 function expandImg(){
     var nav = document.getElementById('flipkart-navbar'); 
     var title = document.getElementById('title_book').innerHTML;
     var isbn = document.getElementById('isbn_book').innerHTML;
         
     /*Remodelagem do navbar*/
     navDefault = nav.innerHTML;
     nav.innerHTML  = "";     //limpando navbar
     
     
     var tableNav = document.createElement('table');//Gerando tabela 
     tableNav.classList.add('col-sm-12');     
     var rowNav = document.createElement('tr');     
     var bodyTable = document.createElement('tbody');
     bodyTable.appendChild(rowNav);//Adicionando linha ao corpo
     tableNav.appendChild(bodyTable);//Adicionando corpo a tabela
  
     var titleNav = document.createElement('span');//Gerando titulo
     titleNav.innerHTML = title;
     titleNav.classList.add('h5');     
     
     var colNav1 = document.createElement('td');//Gerando celula da tabela 
     colNav1.classList.add('col-sm-10');
     colNav1.appendChild(titleNav);//Inserido titulo na celula

     var elemtBack = document.createElement('button');//Gerando botão de saída
     elemtBack.type = 'button';     
     elemtBack.classList.add('btn');
     elemtBack.classList.add('btn-default');     
     elemtBack.innerHTML = "X";   
     elemtBack.addEventListener('click', minimizeImg); // Carregando listenner de volta
     
     var colNav2 = document.createElement('td'); //Gerando segunda celula da tabela    
     colNav2.classList.add('col-sm-2'); 
     colNav2.classList.add('text-right');
     colNav2.appendChild(elemtBack);//Inserido botão a celula
 
     rowNav.appendChild(colNav1);//Inserido tabelas as linhas
     rowNav.appendChild(colNav2); 
     nav.appendChild(tableNav);//Inserido tabela no nav 
             
     var elemtImg = document.createElement('img');//Gerando imagem 
     elemtImg.style="padding-top: 10em;";      
     elemtImg.src = 'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'+isbn+'.01.LZZZZZZZ.jpg'
     elemtImg.alt = title;
     elemtImg.classList.add('img-responsive'); 
     elemtImg.classList.add("center-block");
          
     var elemtDiv = document.createElement('div'); //Gerando div de fundo  
     elemtDiv.style = 'position:fixed;top:1px;height:100%; width:100%;background-color:rgba(0, 0, 0,1);';
     elemtDiv.id = "bigImg";
     elemtDiv.classList.add('text-center'); 
     elemtDiv.appendChild(elemtImg);

     document.body.appendChild(elemtDiv);//Inserido no HTML
 }
 
 function minimizeImg(){     
     var nav = document.getElementById('flipkart-navbar'); 
     var elemtDiv = document.getElementById('bigImg');
     nav.innerHTML = navDefault; //Restaura nav      
     document.body.removeChild(elemtDiv); // remove imagem
 }