<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 19.10.2015
 * Time: 11:20
 */

namespace App\Classes\Savers;


use App\Classes\Pictures\EditManager;
use App\Classes\Products\Product;

class productUpdater extends productSaver{


    protected $id;

    public function __construct($id, array $data)
    {
        $this->id = $id;
        parent::__construct($data);
    }

    protected function manageImages()
    {
        if(isset($this->data['included']))
        {
            if (isset ($this->data['excluded'])) {
                $excluded = $this->data['excluded'];
            } else
                $excluded = null;
            $manager = new EditManager($this->data['included'], $excluded);
            $manager->prepareImages();
            $this->data['images'] = $manager->getNewPictures();
            $this->data['thumbs'] = $manager->getThumbs();
        }
    }

    function save()
    {
        $productData = new Product($this->data);
        $product = \App\Product::find($this->id);
        try
        {
            $product->data = serialize($productData);
            $product->cat_id = $this->data['category'];
            $product->save();
            $this->commit();
        }
        catch(\PDOException $e)
        {
            $this->catchError($e);
        }

    }
}