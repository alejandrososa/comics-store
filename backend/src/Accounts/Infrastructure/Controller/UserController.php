<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 25/12/17
 * Time: 14:51
 */

namespace App\Accounts\Infrastructure\Controller;

use App\Accounts\Application\Exception\UserAlreadyExistsException;
use App\Accounts\Application\Request\User\UserSignInRequest;
use App\Accounts\Application\Request\User\UserSignUpRequest;
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
        $status = 200;

        try {
            $userRequest = new UserSignUpRequest(
                $request->get('name'),
                $request->get('surname'),
                $request->get('email'),
                $request->get('password')
            );

            $repository = $this->getDoctrine()->getRepository('Account:User\User');
            $signUpservice = new UserSignUpService($repository, $this->commandBus);
            $user = $signUpservice->execute($userRequest);
            $result = ['user'=>$user];
        } catch (UserAlreadyExistsException $e) {
            $status = 409;
            $result = ['error'=>'User already exist.'];
        } catch (\Exception $e) {
            $status = 400;
            $result = ['error'=>$e->getMessage()];
        }

        return $this->json($result, $status);
    }


    public function signin(Request $request): JsonResponse
    {
        try {
            $userRequest = new UserSignInRequest(
                $request->get('email'),
                $request->get('password')
            );

            $repository = $this->getDoctrine()->getRepository('Account:User\User');
            $signUpservice = new UserSignUpService($repository, $this->commandBus);
            $user = $signUpservice->execute($userRequest);
            $result = ['user'=>$user];
        } catch (UserAlreadyExistsException $e) {
            $status = 409;
            $result = ['error'=>'User already exist.'];
        } catch (\Exception $e) {
            $status = 400;
            $result = ['error'=>$e->getMessage()];
        }

        return $this->json($result, $status);



        $opciones = ['cost' => 12];
        $p1 = password_hash('demo', PASSWORD_BCRYPT, $opciones);
        $p2 = password_hash('demo', PASSWORD_BCRYPT, $opciones);



        echo '<pre>';print_r([__LINE__,__CLASS__, __METHOD__,
        $p1==$p2?1:0,
        $p1,$p2,
        password_verify('demo', $p1)?1:0
    ]);die();
    }
}