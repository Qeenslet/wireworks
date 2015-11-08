<div class="logotext">
<a href="#" onclick="openCart()"><h3><span class="glyphicon glyphicon-shopping-cart"></span></h3></a>
</div>

<div class="modal fade" id="ShopCart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Корзина товаров</h4>
            </div>
            <div class="modal-body" id="cartBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <a id="orderButton" href="{{route('makeOrder')}}" class="btn btn-primary">Перейти к оформлению</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->