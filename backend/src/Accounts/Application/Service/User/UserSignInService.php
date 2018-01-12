<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 17:42
 */

namespace App\Accounts\Application\Service\User;

use App\Accounts\Application\Command\User\UserSigninCommand;
use App\Accounts\Application\Command\User\UserSigninHandler;
use App\Accounts\Application\Exception\UserAlreadyExistsException;
use App\Accounts\Application\Exception\UserNotExistsException;
use App\Accounts\Application\Request\User\UserSignInRequest;
use App\Accounts\Application\Response\User\UserSignInResponse;
use App\Accounts\Domain\Model\User\User;
use App\Accounts\Domain\Model\User\UserDataTransformer;
use App\Accounts\Domain\Model\User\UserDtoDataTransformer;
use App\Accounts\Domain\Model\User\UserEmail;
use App\Accounts\Domain\Model\User\UserRepository;
use App\Common\Application\Event\ApplicationService;
use League\Tactician\CommandBus;

/**
 * Class UserSignInService
 * @package App\Accounts\Application\Service\User
 */
class UserSignInService implements ApplicationService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserDataTransformer
     */
    private $userDataTransformer;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var User
     */
    private $user;

    /**
     * SignUpUserService constructor.
     * @param UserRepository $repository
     * @param CommandBus $bus
     * @param UserDataTransformer|null $transformer
     */
    public function __construct(UserRepository $repository, CommandBus $bus, UserDataTransformer $transformer = null){
        $this->userRepository = $repository;
        $this->userDataTransformer = $transformer;
        $this->commandBus = $bus;
    }

    /**
     * @param UserSignInRequest $request
     * @return UserSignInResponse|UserDataTransformer|mixed
     * @throws UserNotExistsException
     * @throws \Exception
     */
    public function execute($request = null)
    {
        $this->assertExistEmail($request);

        $commandHandler = new UserSignInHandler($this->userRepository);
        $result = $commandHandler->handle(new UserSignInCommand(
                $request->email,
                $request->password
            )
        );

        if($result instanceof User){
            return $this->setResult($result);
        }

        return $result;
    }

    /**
     * @param $request
     * @throws UserNotExistsException
     */
    private function assertExistEmail($request)
    {
        $userEmail = new UserEmail($request->email);
        $this->user = $this->userRepository->findByEmail($userEmail);

        if (!$this->user) {
            throw new UserNotExistsException();
        }
    }

    /**
     * @param User $user
     * @return UserSignInResponse|UserDataTransformer
     */
    private function setResult(User $user)
    {
        if(is_null($this->userDataTransformer)){
            $this->userDataTransformer = new UserDtoDataTransformer();
        }

        $this->userDataTransformer->write($user);
        return $this->userDataTransformer->read();
    }
}