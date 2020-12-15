<?php


namespace App\Contracts;


interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function mergeDataFromProviders(): array ;



}
