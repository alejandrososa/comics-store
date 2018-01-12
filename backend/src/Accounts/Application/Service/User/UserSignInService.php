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
     * @return UserSignInResponse|UserDataTransformer
     */
    public function execute($request = null)
    {
        $this->assertEmailIsFree($request);

        $commandHandler = new UserSignInHandler($this->userRepository);
        $user = $commandHandler->handle(
            new UserSignInCommand(
                $request->email,
                $request->password
            )
        );

        return $this->setResult($user);
    }

    /**
     * @param $request
     * @throws UserAlreadyExistsException
     */
    private function assertEmailIsFree($request)
    {
        $userEmail = new UserEmail($request->email);
        $user = $this->userRepository->findByEmail($userEmail);

        if ($user) {
            throw new UserAlreadyExistsException();
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