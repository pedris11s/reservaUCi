<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Core\Security;

/**
 * @Route("/usuarios")
 */
class GestionUsuarioController extends Controller
{
    /**
     * @Route("/listar", name="listar_usuarios")
     */
    public function listarUsuariosAction(Request $request, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   
            
        $repo = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repo->findAll();

        return $this->render('usuarios/lista_usuarios.html.twig', array('users'=>$usuarios));
    }

     /**
     * @Route("/add", name="add_user")
     */
    public function addUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   
            
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        $form = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setRoles(array('ROLE_USER'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('listar_usuarios');
        }
        return $this->render('reservaciones/add_reservacion.html.twig', array('form'=> $form->createView()));
    }

    /**
     * @Route("/delete/{id}", name="del_usuario")
     */
    public function deleteUsuarioAction(Request $request, $id=null, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   
            
        $em = $this->getDoctrine()->getManager();
        if($id != null){
            $obj = $em->getRepository(Usuario::class)->find($id);
            $em->remove($obj);
            $em->flush();
            
        }
        $usuarios = $em->getRepository(Usuario::class)->findAll();
        return $this->redirectToRoute('listar_usuarios');
    }
}

