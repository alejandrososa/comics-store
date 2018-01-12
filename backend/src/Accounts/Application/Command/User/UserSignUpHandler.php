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
use App\Accounts\Domain\Model\User\UserId;
use App\Accounts\Domain\Model\User\UserName;
use App\Accounts\Domain\Model\User\UserPassword;
use App\Accounts\Domain\Model\User\UserRepository;
use App\Accounts\Domain\Model\User\UserStatus;
use App\Accounts\Domain\Model\User\UserSurname;
use App\Common\Application\Command\Command;
use App\Common\Application\Command\CommandHandler;

/**
 * Class UserRegisterHandler
 * @package App\Accounts\Application\Command\User
 */
class UserSignUpHandler implements CommandHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserRegisterHandler constructor.
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
        if(!$command instanceof UserSignUpCommand){
            throw new \Exception('RegisterUserHandler can only handle RegisterUserCommand');
        }

        $user = User::createNewFrom(
            new UserName($command->getName()),
            new UserSurname($command->getSurname()),
            new UserEmail($command->getEmail()),
            UserPassword::encryptFrom($command->getPassword()),
            UserStatus::activated()
        );

        $this->repository->add($user);

        return $user;
    }
}