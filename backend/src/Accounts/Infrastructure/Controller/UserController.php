<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 25/12/17
 * Time: 14:51
 */

namespace App\Accounts\Infrastructure\Controller;

use App\Accounts\Application\Exception\UserAlreadyExistsException;
use App\Accounts\Application\Service\User\UserSignUpService;
use App\Accounts\Infrastructure\Form\UserSignUpType;
use Elasticsearch\ClientBuilder;
use Symfony\Component\Form\FormError;
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
        $form = $this->createForm(UserSignUpType::class, null,['attr' => ['autocomplete' => 'off']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $request = $form->getData();
                $repository = $this->getDoctrine()->getRepository('Account:User\User');
                //$dtoTransformer = new UserDtoDataTransformer();

                $signUpservice = new UserSignUpService($repository, $this->commandBus);
                $signUpservice->execute($request);
            }
            catch (UserAlreadyExistsException $e) {
                $form->get('email')->addError(new FormError('Email is already registered by another user'));
            } catch (\Exception $e) {
                echo '<pre>';print_r([__LINE__,__CLASS__, __METHOD__,$e->getMessage()]);die();
                $form->addError(new FormError('There was an error, please get in touch with us'));
            }
        }
        return $this->render('user/signup.html.twig', [
            'texto' => 'Esto es una demo',
            'form' => $form->createView()
        ]);

        //https://github.com/dddinphp/last-wishes/blob/master/src/Lw/Domain/Model/User/UserRepository.php
    }

    public function users()
    {
        $client = ClientBuilder::create()->build();

        $response = $client->search([
            'index' => 'user-engine',
            'type' => 'users',
            'body' => [
//                'sort' => [
//                    'created_at'
//                ]
            ],
        ]);

        return [
            'users' => $response
        ];
    }
}