@include('../templates/headerbase')

<div class='container container-body'>

    <div class="row row-nav">
        <div class="col-sm-12 col-md-12">
            <span class="h2"><a href="{{url('/')}}"><small>Home > </small></a><small>{{$title_body}}</small></span>
        </div>
    </div>


    <div class="row">
        <div class ="col-sm-12 col-md-12 col-lg-10">
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
                        <tr>
                            <th>a Busca da felicidade</th>
                            <td>10</td>
                            <td><input type="text" class="cart_qty"
                                       name=""
                                       value="1">
                            </td>
                            <td>R$ 100,00</td>
                            <td>
                                <form action="." method="post">
                                    <input type="hidden" name="action"
                                           value="delete_product">
                                    <input type="hidden" name="product_id"
                                           value="">

                                    <input type="submit" value="Delete" class="btn btn-primary btn-sm">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>a Busca da felicidade</th>
                            <td>10</td>
                            <td><input type="text" class="cart_qty"
                                       name=""
                                       value="1">
                            </td>
                            <td>R$ 100,00</td>
                            <td>
                                <form action="." method="post">
                                    <input type="hidden" name="action"
                                           value="delete_product">
                                    <input type="hidden" name="product_id"
                                           value="">
                                    <input type="submit" value="Delete" class="btn btn-primary btn-sm">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr id="cart_footer">
                            <td colspan="3"><b>Subtotal</b></td>
                            <td>100</td>
                        <tr id="cart_frete">
                            <td colspan="3"><b>Frete</b></td>
                            <td>100</td>
                        </tr>
                        <tr id="cart_footer">
                            <td colspan="3"><b>Total</b></td>
                            <td>100</td>
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

</body>
</html>
