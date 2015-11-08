<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 13.10.2015
 * Time: 6:25
 */

namespace App\Classes;


class Mapper {

    protected $objectCollection;
    public $countries;
    public $cities;
    public $cityCounts;

    public function __construct(array $results)
    {
        foreach($results as $one){
            $this->objectCollection[]=$one;
        }
        $this->sortOut();
    }

    protected function sortOut()
    {
        foreach ($this->objectCollection as $singleObject){

            if(array_key_exists('country', $singleObject)){
                if(array_key_exists('iso', $singleObject['country'])){
                    $this->saveCountry($singleObject['country']['id'], $singleObject['country']['iso']);
                }
            }
            if(array_key_exists('city', $singleObject)){
                if(array_key_exists('id', $singleObject['city'])){
                    $this->saveCity($singleObject['city']);
                }
            }
        }
    }

    protected function saveCountry($id, $iso){
        $this->countries[$id]=$iso;
    }

    protected function saveCity(array $city){
        $add=$this->increment($city['id']);
        if($add){
            $this->cities[]=$city;
        }

    }

    protected function increment($id){
        if(isset($this->cityCounts[$id])){
            $this->cityCounts[$id]+=1;
            return false;
        }
        else {
            $this->cityCounts[$id]=1;
            return true;
        }
    }
}