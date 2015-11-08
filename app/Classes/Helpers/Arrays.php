<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 18.10.2015
 * Time: 12:47
 */

namespace App\Classes\Helpers;


class Arrays {

    public static function dimensionNames()
    {
        return ['longitude' => 'Длина', 'diameter' => 'Диаметр', 'height' => 'Высота'];
    }

    public static function adminRouts()
    {
        return['mainAdmin'=>'Главная',
            'catList' => 'Категории',
            'addProduct' => 'Новый продукт',
            'productList'=>'Список продуктов',
            'addUser' => 'Новый пользователь',];
    }

    public static function currencyLogo($currency)
    {
        $array = ['EUR' => '<span class="glyphicon glyphicon-euro"></span>',
                'USD' => '<span class="glyphicon glyphicon-usd"></span>',
                'GBP' => '<span class="glyphicon glyphicon-gbp"></span>',
                'RUB' => '<span class="glyphicon glyphicon-ruble"></span>',
                'BYR' => '<span class="price">Br</span>'];
        return $array[$currency];
    }
}