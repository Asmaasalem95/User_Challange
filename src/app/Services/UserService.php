<?php


namespace App\Services;


use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function getFilteredUsers(array $filters)
    {
        // TODO: Implement getFilteredUsers() method.
        return $this->repository->filter($filters);
    }
}
