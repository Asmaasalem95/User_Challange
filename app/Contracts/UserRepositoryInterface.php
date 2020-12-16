<?php


namespace App\Contracts;


interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function mergeDataFromProviders(): array;

    /**
     * @param array $data
     * @return mixed
     */
    public function convertDataToCollection(array $data);


}
