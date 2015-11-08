<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 21.10.2015
 * Time: 8:21
 */

namespace App\Classes\Savers;


class categoryDeleter {

    protected $category;

    public function __construct($cat_id)
    {
        if($cat_id != 5)
        {
            $this->category = \App\Category::find($cat_id);
        }
    }

    public function delete()
    {
        if(isset($this->category))
        {
            foreach($this->category->products()->get() as $one)
            {
                $this->transfer($one);
            }
            $this->category->delete();
        }
    }

    protected function transfer(\App\Product $product)
    {
        $pData = unserialize($product->data);
        $pData->setCategory(5);
        $product->data = serialize($pData);
        $product->cat_id = 5;
        $product->save();
    }
}