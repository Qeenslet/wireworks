<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 12.10.2015
 * Time: 12:36
 */

namespace App\Classes\Currency;


class Converter extends RateSucker{

    protected $currency;
    protected $baseCurrency;
    protected $rate;

    public function __construct($currencyTo, $currencyFrom = 'BYR')
    {
        parent::__construct();
        $this->currency = $currencyTo;
        $this->baseCurrency = $currencyFrom;

        if($currencyFrom == 'BYR')
        {
            $this->rate = $this->mainCurrencies[$this->currency];
        }
        else
        {
            $this->rate = $this->defineCrossRate();
        }

    }

    protected function defineCrossRate()
    {
        return ($this->mainCurrencies[$this->currency] / $this->mainCurrencies[$this->baseCurrency]);
    }

    public function convert($summ)
    {
       return $this->rounder($summ / $this->rate);
    }

    protected function rounder($summ)
    {
        switch($this->currency)
        {
            case 'RUB':
                $residual = $summ % 10;
                $mainPart = $summ - $residual;
                return (int)($mainPart + (($residual >=5) ? 10 : 0));
            case 'BYR':
                $residual = $summ % 500;
                $mainPart = $summ - $residual;
                return (int)($mainPart + (($residual >= 500) ? 1000: 0));
            default:
                return (int)round($summ);
        }
    }
}