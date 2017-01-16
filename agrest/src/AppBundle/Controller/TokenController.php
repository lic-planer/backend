<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class TokenController extends Controller
{
    /**
     * @Route(path="api/token-authentication", name="token_authentication")
     * @param Request $request
     * @return JsonResponse
     */
    public function tokenAuthentication(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $user = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findOneBy(['username' => $username]);
        if(!$user) {
            throw $this->createNotFoundException();
        }
        // password check
        if(!$this->get('security.password_encoder')->isPasswordValid($user, $password)) {
            throw $this->createAccessDeniedException();
        }
        // Use LexikJWTAuthenticationBundle to create JWT token that hold only information about user name
        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode(['username' => $user->getUsername()]);
        // Return genereted tocken
        return new JsonResponse(['token' => $token]);
    }
    /**
     * @Route(path="/secure-resource", name="secure_resource")
     */
    public function secureResource(){
        $data = [
            'username' => 'admin',
            'password' => 'admin123'
        ];
        return new JsonResponse($data);
    }
}
