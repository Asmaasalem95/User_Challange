<?php


namespace App\Contracts;


interface ProviderTransformerInterface
{
    public function transform(array $providerData) :array ;

}
