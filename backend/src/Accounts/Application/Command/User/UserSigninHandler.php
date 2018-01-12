<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 2/01/18
 * Time: 14:46
 */

namespace App\Accounts\Application\Command\User;

use App\Accounts\Domain\Model\User\User;
use App\Accounts\Domain\Model\User\UserEmail;
use App\Accounts\Domain\Model\User\UserPassword;
use App\Accounts\Domain\Model\User\UserRepository;
use App\Common\Application\Command\Command;
use App\Common\Application\Command\CommandHandler;

/**
 * Class UserLoginHandler
 * @package App\Accounts\Application\Command\User
 */
class UserSigninHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserLoginHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Command $command
     * @return mixed
     * @throws \Exception
     */
    public function handle(Command $command)
    {
        if(!$command instanceof UserSigninCommand){
            throw new \Exception('UserLoginHandler can only handle UserLoginCommand');
        }

        $user = $this->repository->findByEmail(new UserEmail($command->getEmail()));

        if($user->verifyPassword($command->getPassword())){
            return $user;
        }

        return false;
    }
}