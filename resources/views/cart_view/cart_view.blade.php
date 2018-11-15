@include('../templates/headerbase')

<div class='container container-body'>

    <div class="row row-nav">
        <div class="col-sm-12 col-md-12">
            <span class="h2"><a href="{{url('/')}}"><small>Home > </small></a><small>{{$title_body}}</small></span>
        </div>
    </div>

    <h1>Your Cart</h1>
    
    @if (empty($bookArray))
    
        <p>There are no items in your cart.</p>
    @else
       <!--$bookArray = $CartController->books();
              $subTotal = $CartController->total($bookArray);
              $frete = $CartController->frete();
              $totalCart = ($CartController->total($bookArray)+$CartController->frete());   
                -->
        <p>There are {{$qty}} itens on your cart!</p>
        <div class="row">
            <div class ="col-sm-12 col-md-12 col-lg-12">
                <form action="." method="post">
                    <input type="hidden" name="action" value="update">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Livro</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Total</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($bookArray as $key => $item)
                                
                                <tr>
                                    <th><a href="{{url('show').'/'.$item['ISBN']}}{{'/home'}}">{{$item['name']}}</a></th>
                                    <td>{{'$'.$item['price']}}</td>
                                    <td><form action="attCar" method="post">
                                        <input type="text" class="cart_qty"
                                               name="newqty[{{$item['ISBN']}}]"
                                               value="{{$item['quantity']}}">
                                        </form>
                                    </td>
                                    <td>{{'$'.$item['total']}}</td>
                                    <td>
                                        <form action="{{url('/cart/attCart')}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="action"
                                                   value="delete">
                                            <input type="hidden" name="ISBN"
                                                   value="{{$item['ISBN']}}">
                                            <input type="submit" value="Remove" class="btn btn-primary btn-sm">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr id="cart_footer">
                                <td colspan="3"><b>Subtotal</b></td>
                                <td>{{'$'.$subTotal}}</td>
                                <td></td>
                            <tr id="cart_frete">
                                <td colspan="3"><b>Frete</b></td>
                                <td>{{'$'.$frete}}</td>
                                <td></td>
                            </tr>
                            <tr id="cart_total">
                                <td colspan="3"><b>Total</b></td>
                                <td>{{'$'.$totalCart}}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                <div class="div-cart">
                    <button class="btn-primary">Continuar a Comprar</button>
                    <button class="btn-primary">Finalizar Compra</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</body>
</html>
