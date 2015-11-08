<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 12.10.2015
 * Time: 10:09
 */

namespace App\Classes\Products;


use App\Classes\Currency\Converter;

abstract class AbstractProduct {

    protected $price;
    protected $currency;
    protected $description;
    protected $images;
    protected $thumbs;
    protected $name;
    protected $category;

    public function __construct(array $data)
    {
        $this->currency = $data['currency'];
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->images = $data['images'];
        $this->thumbs = $data['thumbs'];
        $this->name = $data['name'];
        $this->category = $data['category'];
    }

    protected function convert($currency)
    {
        $converter = new Converter($currency, $this->currency);
        return $converter->convert($this->price);
    }
    public function getPrice($currency)
    {
        return $this->convert($currency);
    }

    public function getImages()
    {
        return $this->images;
    }
    public function getThumbs()
    {
        return $this->thumbs;
    }

    public function getDescription($lang = 'ru')
    {
        switch($lang)
        {
            case 'ru':
                return str_replace(["\r\n", "\r", "\n"], '', $this->description['ru']);
            default:
                return str_replace(["\r\n", "\r", "\n"], '', $this->description['en']);
        }
    }

    public function getName($lang = 'ru')
    {
        switch($lang)
        {
            case 'ru':
                return $this->name['ru'];
            default:
                return $this->name['en'];
        }
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getAdminPrice()
    {
        return $this->price.' '.$this->currency;
    }

    public function getEditPrice()
    {
        return $this->price;
    }


    public function update(array $data)
    {
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->images = $data['images'];
        $this->name = $data['name'];
        $this->currency = $data['currency'];
    }

    public function setCategory($catId)
    {
        $this->category = $catId;
    }

    abstract function getDimensions();



}