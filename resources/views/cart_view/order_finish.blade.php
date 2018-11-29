@include('../templates/headerbase')

<div class='container container-body footerAjust'>

    <h1>Your Cart</h1>
    <p>There are {{$qty}} itens on your cart!</p>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table">
                <thead class="theader">
                    <tr>
                        <th scope="col">Book</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($bookArray as $key => $item)
                    <tr>
                        <td><div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
                                    <img class=" imgs img-thumbnail"
                                         src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$item["ISBN"].'.01.MZZZZZZZ.jpg'}}"
                                         alt="{{$item["name"]}}">
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <a href="{{url('show').'/'.$item['ISBN']}}">{{$item['name']}}</a>
                                </div>
                            </div>
                            </div>
                        </td>
                        <td>{{'$'.$item['price']}}</td>
                        <td>{{$item['quantity']}}</td>
                        <td>{{'$'.$item['total']}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr id="cart_footer">
                        <td colspan="3"><b>Sub-total</b></td>
                        <td>{{'$'.$subTotal}}</td>
                    </tr>
                    <tr id="cart_frete">
                        <td colspan="3"><b>Shipping</b></td>
                        <td>{{'$'.$frete}}</td>
                    </tr>
                    <tr id="cart_total">
                        <td colspan="3"><b>Total</b></td>
                        <td>{{'$'.$totalCart}}</td>
                    </tr>
                    <tr id="cart_footer">
                        <td colspan="3"><b>Address</b></td>
                        <td>{{$address}}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="container">
                <ul class="list-unstyled list-inline text-center py-5">
                    <li>
                        <form action="{{url('/')}}" method="post">
                            <button type="submit" class="btn-primary btn-lg">Continue to Buy</button>
                        </form>
                    </li>
                    <li>
                        <form action="{{url('/user/finish')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="email" value="{{$email}}">
                            <button class="btn-primary btn-lg">Confirm Buy</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>

@include('../templates/footerBase')
