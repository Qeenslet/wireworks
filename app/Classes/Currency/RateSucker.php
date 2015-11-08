<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 12.10.2015
 * Time: 12:11
 */

namespace App\Classes\Currency;


class RateSucker {

    protected $filename='currency.xml';
    protected $main = ['RUB', 'EUR', 'USD', 'GBP'];
    protected $sxml;
    protected $today;
    protected $mainCurrencies;

    protected function __construct ()
    {
        $now=time();

        $this->today=date("m/d/y");

        if(!@$statistics = stat($this->filename))
            $this->update();

        $lastup=$statistics['mtime'];

        if (($now-$lastup) > 43200)
            $this->update();

        $this->sxml=simplexml_load_file($this->filename);

        $this->updateMain();
    }

    protected function update()
    {
        $file=file_get_contents("http://www.nbrb.by/Services/XmlExRates.aspx?ondate=$this->today");
        file_put_contents($this->filename, $file);
    }

    protected function updateMain()
    {
        foreach ($this->sxml as $currency)
        {
            if(in_array($currency->CharCode, $this->main))
            {
                $key = (string)$currency->CharCode;
                $value = (float)$currency->Rate;
                $this->mainCurrencies[$key] = $value;
            }

        }
        $this->mainCurrencies['BYR'] = 1;
    }
}