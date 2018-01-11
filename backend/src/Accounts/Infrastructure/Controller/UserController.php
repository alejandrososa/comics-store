<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 25/12/17
 * Time: 14:51
 */

namespace App\Accounts\Infrastructure\Controller;

use App\Accounts\Application\Exception\UserAlreadyExistsException;
use App\Accounts\Application\Request\User\UserSignUpRequest;
use App\Accounts\Application\Service\User\UserSignUpService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Accounts\Infrastructure\Controller
 */
class UserController extends BaseController
{
    public function signup(Request $request): Response
    {
        try {
            $userRequest = new UserSignUpRequest(
                $request->get('name'),
                $request->get('email')
            );
            $repository = $this->getDoctrine()->getRepository('Account:User\User');

            $signUpservice = new UserSignUpService($repository, $this->commandBus);
            $signUpservice->execute($userRequest);
        }
        catch (UserAlreadyExistsException $e) {
        } catch (\Exception $e) {
            echo '<pre>';print_r([__LINE__,__CLASS__, __METHOD__,$e->getMessage(), $e->getTrace()]);die();
        }

        //https://github.com/dddinphp/last-wishes/blob/master/src/Lw/Domain/Model/User/UserRepository.php
    }

    public function signin()
    {

    }
}