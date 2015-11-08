<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 18.10.2015
 * Time: 7:53
 */

namespace App\Classes\Savers;


use App\Classes\Pictures\Manager;
use App\Classes\Products\Product;

class productSaver extends abstractSaver{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->manageImages();
        $this->setNames();
        $this->setDesc();
        $this->unsetEmptyDimensions();
        parent::__construct();
    }

    function save()
    {
        $productData = new Product($this->data);
        try
        {
            \App\Product::create(['cat_id' => $this->data['category'], 'data' => serialize($productData)]);
            $this->commit();
        }
        catch(\PDOException $e)
        {
            $this->catchError($e);
        }
    }

    protected function manageImages()
    {
        if(isset($this->data['included']))
        {
            if (isset ($this->data['excluded'])) {
                $excluded = $this->data['excluded'];
            } else
                $excluded = null;
            $manager = new Manager($this->data['included'], $excluded);
            $manager->prepareImages();
            $this->data['images'] = $manager->getNewPictures();
            $this->data['thumbs'] = $manager->getThumbs();
        }
    }

    protected function setNames()
    {
        $this->data['name']['ru'] = $this->data['ruName'];
        if (isset($this->data['enName']) && strlen($this->data['enName']) > 0)
        {
            $this->data['name']['en'] = $this->data['enName'];
            unset($this->data['enName']);

        }
        else
            $this->data['name']['en'] = $this->data['ruName'];
        unset($this->data['ruName']);
    }
    protected function setDesc()
    {
        $this->data['description']['ru'] = $this->data['descRu'];
        if (isset($this->data['descEn']) && strlen($this->data['descEn']) > 0)
        {
            $this->data['description']['en'] = $this->data['descEn'];
            unset($this->data['descEn']);
        }
        else
            $this->data['description']['en'] = $this->data['descRu'];
        unset($this->data['descRu']);
    }

    protected function unsetEmptyDimensions()
    {
        $array=['longitude', 'height', 'diameter'];
        foreach($array as $dimension)
        {
            if(strlen($this->data[$dimension]) > 0)
                continue;
            else
                unset($this->data[$dimension]);
        }
    }
}