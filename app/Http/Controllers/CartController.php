<?php namespace App\Http\Controllers;

use App\Classes\shoppingCart;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cookie;
use Illuminate\Http\Request;

class CartController extends Controller {

	public function addToCart($id, $number = 1)
    {
        if(\Request::cookie('shoppingCart'))
        {
            $cartData = shoppingCart::getCart();
            $cart = unserialize($cartData->data);
            $cart->addToCart($id, $number);
            $sCart = serialize($cart);
            $cartData->data = $sCart;
            $cartData->save();
        }
        else
        {
            $cart = new shoppingCart();
            $cart->addToCart($id, $number);
            $sCart = serialize($cart);

            $ip=$_SERVER['REMOTE_ADDR'];
            $now = \Carbon\Carbon::now()->toDateTimeString();
            $token = md5($ip.$now);

            \Cookie::queue('shoppingCart', $token);
            \App\Cart::create(['key' => $token, 'data' => $sCart]);
        }


        return redirect()->back();
    }

    public function getCartAjax(Request $request)
    {
        $open = $request->input('open');
        if(!empty($open))
        {
            $cartData = shoppingCart::getCart();

            $cart = unserialize($cartData->data);
            $eachAmount = $cart->getAmmounts();
            $products = [];
            $currency = session('currency');
            $curSign = \App\Classes\Helpers\Arrays::currencyLogo($currency);
            foreach($cart->getProducts() as $id)
            {
                $item = \App\Product::find($id);
                $products[$id] = unserialize($item->data);
            }
            return view('response.cart', compact('products', 'eachAmount', 'currency', 'curSign'));
        }
        else
            abort('404');
    }

    public function appendItem(Request $request)
    {
        $id = $request->input('id');
        $amount = $request->input('amount');

        $cartData = shoppingCart::getCart();
        $cart = unserialize($cartData->data);

        if($amount == 'up')
            $cart->addToCart($id);
        else
        {
            $cart->remove($id);
        }
        $sCart = serialize($cart);
        $cartData->data = $sCart;
        $cartData->save();
        return '';
    }

    public function order()
    {
        $cartData = shoppingCart::getCart();
        $cart = unserialize($cartData->data);
        $cartId = $cartData->id;
        $eachAmount = $cart->getAmmounts();
        $products = [];
        $currency = session('currency');
        $curSign = \App\Classes\Helpers\Arrays::currencyLogo($currency);
        $total = 0;
        foreach($cart->getProducts() as $id)
        {
            $item = \App\Product::find($id);
            $products[$id] = unserialize($item->data);
            $total += $products[$id]->getPrice($currency) * $eachAmount[$id];
        }
        return view('template.order', compact('products', 'eachAmount', 'currency', 'curSign', 'total', 'cartId'));
    }

    public function changeAmount(Request $request)
    {
        $data = $request->except('_token');
        $cartData = shoppingCart::getCart();
        $cart = unserialize($cartData->data);
        $cart->setItemAmount($data['id'], $data['amount']);
        $sCart = serialize($cart);
        $cartData->data = $sCart;
        $cartData->save();
        return redirect()->back();

    }

    public function deleteItem(Request $request)
    {
        $id = $request->input('id');
        $cartData = shoppingCart::getCart();
        $cart = unserialize($cartData->data);
        $cart->setItemAmount($id, 0);
        $sCart = serialize($cart);
        $cartData->data = $sCart;
        $cartData->save();
        return redirect()->back();
    }

    public function apply(Requests\OrderRequest $request)
    {
        $order = $request->except('_token');
        $cartData = \App\Cart::find($order['cartCode']);
        $ip=$_SERVER['REMOTE_ADDR'];
        \App\Order::create(['name' => $order['name'],
                            'cart' => $cartData->data,
                            'email' => $order['email'],
                            'paytipe' => $order['payway'],
                            'address' => $order['zipcode']." ".$order['address'],
                            'ip' => $ip]);
        $cookie = shoppingCart::unsetCart();
        return redirect('/')->with('message', 'Ваша заказ принят к обработке')->withCookie($cookie);

    }


}
