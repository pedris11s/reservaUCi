<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Security\Core\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     */
    public function indexAction(Request $request, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   

        return $this->render('inicio/index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils, Security $security)
    {   
        $user = $security->getUser();
        if($user != NULL)
            return $this->redirectToRoute('inicio');   

        $error = $authUtils->getLastAuthenticationError();

        return $this->render('inicio/login.html.twig', array('error'=>$error));
    }
}

