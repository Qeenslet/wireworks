<?php
/**
 * Created by PhpStorm.
 * User: egorg_000
 * Date: 18.10.2015
 * Time: 7:57
 */

namespace App\Classes\Savers;


abstract class abstractSaver {

    protected $error;
    protected $result;
    protected $message;

    public function __construct()
    {
        $this->error = 0;
        $this->result = 0;
        \DB::beginTransaction();
    }

    protected function commit()
    {
        if($this->error == 0)
        {
            \DB::commit();
        }
        $this->result = 1;
    }

    protected function catchError(\PDOException $e)
    {
        \DB::rollback();
        $this->error = 1;
        $this->message = $e->getMessage();
    }

    abstract function save();

    public function getStatus()
    {
        if($this->result == 1)
            return true;
        else
            return false;
    }

    public function getError()
    {
        if(isset($this->message))
            return $this->message;
        else
            return 'Неизвестная ошибка записи';
    }
}