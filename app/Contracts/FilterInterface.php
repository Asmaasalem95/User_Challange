<?php


namespace App\Contracts;


interface FilterInterface
{
    /**
     * @param $data
     * @param $value
     * @return mixed
     */
    public static function apply($data, $value);
}
