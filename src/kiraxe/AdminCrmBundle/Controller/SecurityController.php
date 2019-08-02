<?php


namespace kiraxe\AdminCrmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use kiraxe\AdminCrmBundle\Entity\User;

/**
 * Login controller.
 *
 * @Route("login")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/", name="login_index", methods={"GET"})
     */
    public function indexAction(AuthenticationUtils $authenticationUtils, UserPasswordEncoderInterface $encoder)
    {

        /*$em = $this->getDoctrine()->getManager();

        $user = new User();
        $plainPassword = 'ryanpass';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
        $user->setUsername('kiraxe');
        $user->setEmail('kiraxe@yandex.ru');

        $em->persist($user);
        $em->flush();*/

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}