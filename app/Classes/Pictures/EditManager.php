<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 19.10.2015
 * Time: 10:47
 */

namespace App\Classes\Pictures;


class EditManager extends Manager{

    const WIDTH = 150;
    const HEIGHT = 150;
    const PATH = 'media/uploads/';
    const LOCAL_PATH = 'media/uploads/temporary/';
    const PREG_MATCH='/^\d{2}_\d{2}_\d{2}_.*$/u';

    protected $oldImagesLeft;
    protected $oldImagesDelete;
    protected $oldThumbs;

    public function __construct(array $included, array $excluded = null)
    {
        $this->oldImagesLeft = $this->divideCropped($included);
        $included = array_diff($included, $this->oldImagesLeft);
        if(isset($excluded))
        {
            $this->oldImagesDelete = $this->divideCropped($excluded);
            $excluded = array_diff($excluded, $this->oldImagesDelete);
            $this->deleteMarked();
            $this->oldImagesLeft = array_diff($this->oldImagesLeft, $this->oldImagesDelete);
        }
        $this->markOldThumbs();
        parent::__construct($included, $excluded);
    }

    protected function divideCropped(array $array)
    {
        $result = [];
        foreach($array as $one)
        {
            if(preg_match(self::PREG_MATCH, $one))
            {
                $result[] = $one;
            }
        }
        return $result;
    }

    protected function deleteMarked()
    {
        foreach($this->oldImagesDelete as $picture)
        {
            $imageBig = self::PATH.$picture;
            $thumb = self::PATH.'small_'.$picture;
            @unlink($imageBig);
            @unlink($thumb);
        }
    }

    protected function markOldThumbs()
    {
        foreach($this->oldImagesLeft as $one)
        {
            $this->oldThumbs[] = 'small_'.$one;
        }
    }

    public function getNewPictures()
    {
        if(!empty($this->newNames) && !empty($this->oldImagesLeft))
        {
            return array_merge($this->newNames, $this->oldImagesLeft);
        }
        elseif(!empty($this->newNames))
        {
            return $this->newNames;
        }
        else
            return $this->oldImagesLeft;

    }

    public function getThumbs()
    {
        if(!empty($this->thumbs) && !empty($this->oldThumbs))
        {
            return array_merge($this->thumbs, $this->oldThumbs);
        }
        elseif (!empty($this->thumbs))
        {
            return $this->thumbs;
        }
        else
            return $this->oldThumbs;
    }

    public function prepareImages()
    {
        if(!empty($this->included))
        {
            parent::prepareImages();
        }
    }
}