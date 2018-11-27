<h1>Obrigado por comprar na Geek Books</h1>
<p>Dados da sua compra.<br/></p>
@foreach($orders as $order)
<p>
    Item: {{$order['name']}} <br/>
    Quantidade: {{$order['quantity']}} <br/>
    Price: {{$order['price']}}<br/>
</p>
    @endforeach
<br/>O valor final da sua compra foi de R${{$total}}. (Este valor não inclui o frete)