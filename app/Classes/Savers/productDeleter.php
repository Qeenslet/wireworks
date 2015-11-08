<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 20.10.2015
 * Time: 12:50
 */

namespace App\Classes\Savers;


class productDeleter {

    protected $product;
    const PATH = 'media/uploads/';

    public function __construct($id)
    {
        $this->product = \App\Product::find($id);
    }

    public function delete()
    {
        if(isset($this->product))
        {
            $this->deleteImages();
            $this->product->delete();
        }
    }

    protected function deleteImages()
    {
        $data = unserialize($this->product->data);
        foreach($data->getImages() as $imageName)
        {
            $this->deleteSingleImage($imageName);
        }
        foreach($data->getThumbs() as $thumbName)
        {
            $this->deleteSingleImage($thumbName);
        }
    }

    protected function deleteSingleImage($imageName)
    {
        unlink(self::PATH.$imageName);
    }
}