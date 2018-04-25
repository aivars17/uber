<?php
/**
 * Created by PhpStorm.
 * User: sevskis
 * Date: 4/23/18
 * Time: 09:42
 */

namespace App\Service;


use App\Repository\UserRepository;

class UserService
{
    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function getAmount()
    {
        $users = $this->userRepository->findAll();
        return count($users);
    }
}