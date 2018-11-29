<h1>Obrigado por comprar na Geek Books</h1>
<p>Dados da sua compra.<br/></p>
@foreach($orders as $order)
<p>
    Item: {{$order['name']}} <br/>
    Quantity: {{$order['quantity']}} <br/>
    Price: {{$order['price']}}<br/>
</p>
    @endforeach
<br/>Sub-Total R${{$total}}.
<br/>Shipping R${{$frete}}.
<br/>Total R${{$frete + $total}}.