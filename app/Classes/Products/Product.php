<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 12.10.2015
 * Time: 10:54
 */

namespace App\Classes\Products;


class Product extends AbstractProduct{

    protected $longitude;
    protected $height;
    protected $diameter;

    public function __construct($data)
    {
        parent::__construct($data);
        if (isset ($data['longitude']))
            $this->longitude = $data['longitude'];
        if(isset($data['height']))
            $this->height = $data['height'];
        if(isset($data['diameter']))
            $this->diameter = $data['diameter'];
    }

    function getDimensions()
    {
        $array = [];
        if (isset ($this->longitude))
            $array['longitude'] = $this->longitude;
        if(isset($this->height))
            $array['height'] = $this->height;
        if(isset($this->diameter))
            $array['diameter'] = $this->diameter;
        return $array;
    }
}