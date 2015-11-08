<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 27.10.2015
 * Time: 14:57
 */

namespace App\Classes;


class shoppingCart {

    protected $id = [];
    protected $quantity = [];

    public function addToCart($id, $ammount = 1)
    {
        if(in_array($id, $this->id))
        {
            $this->quantity[$id] += $ammount;
        }
        else
        {
            $this->id[] = $id;
            $this->quantity[$id] = $ammount;
        }
    }

    protected function dropItem($id)
    {
        unset($this->quantity[$id]);
        $newArray = [];
        foreach($this->id as $item)
        {
            if($item == $id)
                continue;
            $newArray[] = $item;
        }
        $this->id = $newArray;
    }

    public function remove($id, $ammount = 1)
    {
        if($this->quantity[$id] == $ammount)
        {
            $this->dropItem($id);
        }
        else
        {
            $this->quantity[$id] -= $ammount;
        }
    }

    public function getProducts()
    {
        return $this->id;
    }

    public function getAmmounts()
    {
        return $this->quantity;
    }

    public function getTotalItems()
    {
        $total = 0;
        foreach ($this->quantity as $itemsNumber)
        {
            $total += $itemsNumber;
        }
        return $total;
    }

    public function getProductAmount($id)
    {
        return $this->quantity[$id];
    }

    public function setItemAmount($id, $amount)
    {
        if ($amount == 0)
            $this->dropItem($id);
        else
            $this->quantity[$id] = $amount;
    }

    public static function getCart()
    {
        $key = \Request::cookie('shoppingCart');
        return \App\Cart::where('key', $key)->first();
    }

    public static function unsetCart()
    {
        $key = \Request::cookie('shoppingCart');
        $cart = \App\Cart::where('key', $key)->first();
        $cookie = \Cookie::forget('shoppingCart');
        $cart->delete();
        return $cookie;

    }
}