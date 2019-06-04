<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     */
    public function indexAction(Request $request)
    {
        return $this->render('inicio/index.html.twig');
    }
    /**
     * @Route("/listar_usuarios", name="listar_usuarios")
     */
    public function listarUsuariosAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repo->findAll();

        return $this->render('usuarios/lista_usuarios.html.twig', array('users'=>$usuarios));
    }

     /**
     * @Route("/add_user", name="add_user")
     */
    public function addUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        $form = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('listar_usuarios');
        }
        return $this->render('reservaciones/add_reservacion.html.twig', array('form'=> $form->createView()));
    }
}

