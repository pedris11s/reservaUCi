<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/usuarios")
 */
class GestionUsuarioController extends Controller
{
    /**
     * @Route("/listar", name="listar_usuarios")
     */
    public function listarUsuariosAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Usuario::class);
        $usuarios = $repo->findAll();

        return $this->render('usuarios/lista_usuarios.html.twig', array('users'=>$usuarios));
    }

     /**
     * @Route("/add", name="add_user")
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

    /**
     * @Route("/delete/{id}", name="del_usuario")
     */
    public function deleteUsuarioAction(Request $request, $id=null)
    {
        $em = $this->getDoctrine()->getManager();
        if($id != null){
            $obj = $em->getRepository(Usuario::class)->find($id);
            $em->remove($obj);
            $em->flush();
            
        }
        $usuarios = $em->getRepository(Usuario::class)->findAll();
        return $this->render('usuarios/lista_usuarios.html.twig', array('users'=>$usuarios));
        
    }
}

