<?php


namespace App\Contracts;


interface UserServiceInterface
{

    public function getFilteredUsers(array $filters);
}
