@include('../templates/headerbase')

<div class='container container-body'>

    <div class="row row-nav">
        <div class="col-sm-12 col-md-12">
            <span class="h2"><a href="{{url('/')}}"><small>Home > </small></a><small>{{$title_body}}</small></span>
        </div>
    </div>

    <h1>Your Cart</h1>
    <?php
    if (empty($_SESSION['cart']) ||
            count($_SESSION['cart']) == 0) :
        ?>
        <p>There are no items in your cart.</p>
    <?php else: ?>

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
                            <?php
                            foreach ($_SESSION['cart'] as $key => $item) :
                                $price = number_format($item['price'], 2);
                                $total = number_format($item['total'], 2);
                                ?>
                                <tr>
                                    <th><a href="{{url('show').'/'.$item['ISBN']}}{{'/home'}}"><?php echo $item['name']; ?></a></th>
                                    <td>$<?php echo $price; ?></td>
                                    <td><input type="text" class="cart_qty"
                                               name="newqty[<?php echo $key; ?>]"
                                               value="<?php echo $item['quantity']; ?>">
                                    </td>
                                    <td>$<?php echo $total; ?></td>
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
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr id="cart_footer">
                                <td colspan="3"><b>Subtotal</b></td>
                                <td><?php echo '$'.$subTotal;?></td>
                                <td></td>
                            <tr id="cart_frete">
                                <td colspan="3"><b>Frete</b></td>
                                <td><?php echo '$'.$frete;?></td>
                                <td></td>
                            </tr>
                            <tr id="cart_total">
                                <td colspan="3"><b>Total</b></td>
                                <td><?php echo '$'.$totalCart;?></td>
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
<?php endif; ?>
</body>
</html>
