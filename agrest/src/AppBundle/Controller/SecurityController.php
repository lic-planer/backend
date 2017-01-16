<?php
/**
 * Created by PhpStorm.
 * User: Alek
 * Date: 02.01.2017
 * Time: 22:54
 */
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        //will never be executed
    }
    /**
     * @Route("/token")
     */
    public function fetchToken(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy(['username' => $username]);
        if(!$user) {
            throw $this->createNotFoundException();
        }
        //check password
        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode(['username' => $user->getUsername()]);
        return new JsonResponse(['token' => $token]);
    }
}
