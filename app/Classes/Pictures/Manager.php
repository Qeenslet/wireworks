<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 16.10.2015
 * Time: 7:06
 */

namespace App\Classes\Pictures;


class Manager {

    protected $included;
    protected $newNames;
    protected $thumbs;

    const WIDTH = 150;
    const HEIGHT = 150;
    const PATH = 'media/uploads/';
    const LOCAL_PATH = 'media/uploads/temporary/';

    public function __construct(array $included, array $excluded = null)
    {
        if (isset ($excluded))
        foreach ($included as $picture)
        {
            if(in_array($picture, $excluded))
            {
                unlink(self::LOCAL_PATH.$picture);
                continue;
            }
            $this->included[] = $picture;
        }
        else
        {
            $this->included = $included;
        }

    }

    public function prepareImages()
    {
        foreach($this->included as $picture)
        {
            $newName = date('y_m_d').'_'.$picture;
            $this->thumbs[] = 'small_'.$newName;
            $this->crop($newName, self::LOCAL_PATH.$picture);
            $this->newNames[] = $newName;
        }
        $this->clear();
    }

    protected function crop($newName, $oldName)
    {
        $big=imagecreatefromjpeg($oldName);
        list($width_src, $height_src) = getimagesize($oldName);

        //search for center point of the picture
        $c_w = $width_src/2;
        $c_h = $height_src/2;
        //defining the borders of the new picture
        if ($width_src>$height_src)
            $dim = $c_h;
        else
            $dim = $c_w;
        $x = $c_w-$dim;
        $y = $c_h-$dim;
        $dim *= 2;
        //creating new square picture
        $small = imagecreatetruecolor($dim, $dim);

        imagecopy ($small, $big, 0, 0, $x, $y, $dim, $dim);
        // new thumb
        $smaller = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        imagecolorallocate($smaller, 255, 255, 255);

        imagecopyresampled($smaller,
            $small,
            0,
            0,
            0,
            0,
            self::WIDTH,
            self::HEIGHT,
            $dim,
            $dim);
        imagejpeg($smaller, self::PATH.'small_'.$newName);
        imagejpeg($big, self::PATH.$newName);

        imagedestroy($smaller);
        imagedestroy($small);
        imagedestroy($big);

    }

    protected function clear()
    {
        foreach($this->included as $one)
        {
            unlink(self::LOCAL_PATH.$one);
        }
    }

    public function getNewPictures()
    {
        return $this->newNames;
    }

    public function getThumbs()
    {
        return$this->thumbs;
    }
}