<?php


namespace App\Utilities\Filters;


use App\Contracts\FilterInterface;

class ProviderFilter implements FilterInterface
{
    /**
     * @param $data
     * @param $value
     * @return mixed
     */
    public static function apply($data, $value)
    {
        // TODO: Implement apply() method.
        return $data->where('provider', $value);
    }
}
