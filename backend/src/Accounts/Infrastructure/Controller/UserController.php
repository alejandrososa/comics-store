<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 25/12/17
 * Time: 14:51
 */

namespace App\Accounts\Infrastructure\Controller;

use App\Accounts\Application\Exception\UserAlreadyExistsException;
use App\Accounts\Application\Exception\UserNotExistsException;
use App\Accounts\Application\Request\User\UserSignInRequest;
use App\Accounts\Application\Request\User\UserSignUpRequest;
use App\Accounts\Application\Service\User\UserSignInService;
use App\Accounts\Application\Service\User\UserSignUpService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Accounts\Infrastructure\Controller
 */
class UserController extends BaseController
{
    /**
     * Sign up users
     * @param Request $request
     * @return JsonResponse
     */
    public function signup(Request $request): JsonResponse
    {
        $result = [];
        $status = 201;

        try {
            $repository = $this->getDoctrine()->getRepository('Account:User\User');
            $signUpservice = new UserSignUpService($repository, $this->commandBus);
            $user = $signUpservice->execute(new UserSignUpRequest(
                $request->get('name'),
                $request->get('surname'),
                $request->get('email'),
                $request->get('password')
            ));
            $result['user']=$user;
        } catch (UserAlreadyExistsException $e) {
            $status = 409;
            $result['error'] = 'User already exist.';
        } catch (\Exception $e) {
            $status = 400;
            $result['error'] = $e->getMessage();
        }

        return $this->json($result, $status);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function signin(Request $request): JsonResponse
    {
        $result = [];
        $status = 200;

        try {
            $repository = $this->getDoctrine()->getRepository('Account:User\User');
            $signUpservice = new UserSignInService($repository, $this->commandBus);
            $user = $signUpservice->execute(new UserSignInRequest(
                $request->get('email'),
                $request->get('password')
            ));
            $result['user']=$user;
        } catch (UserNotExistsException $e) {
            $status = 404;
            $result['error'] = 'User not exist.';
        } catch (\Exception $e) {
            $status = 400;
            $result['error'] = $e->getMessage();
        }

        return $this->json($result, $status);
    }
}