<?php


namespace App\Contracts;


interface UserRepositoryInterface
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function filter(array $filters);

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
