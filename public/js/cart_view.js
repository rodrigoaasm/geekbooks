 //Adiciona um listener para cada item de quantidade
 //Quando sofrer alteração irá realizar o submit do form de atualização do item selecionado
$(document).ready(function(){    
    $('.cart_qty').on('blur',function(){
        var id = $(this).attr('id');
        $('#updateCart-'+id).submit();
    });
});        
