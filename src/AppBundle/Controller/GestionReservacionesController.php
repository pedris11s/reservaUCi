<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Reservacion;
use AppBundle\Form\ReservacionType;

use Symfony\Component\Security\Core\Security;
use AppBundle\Entity\Usuario;
use AppBundle\Form\EditReservacionType;

/**
 * @Route("/reservaciones")
 */
class GestionReservacionesController extends Controller
{
    /**
     * @Route("/listar", name="listar_reservaciones")
     */
    public function listarReservacionesAction(Request $request, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   

        $repo = $this->getDoctrine()->getRepository(Reservacion::class);
        $reservaciones = $repo->findAll();

        return $this->render('reservaciones/lista_reservaciones.html.twig', array('reservaciones'=>$reservaciones));
    }

    /**
     * @Route("/add", name="add_reservacion")
     */
    public function addReservacionAction(Request $request, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   

        $res = new Reservacion();
        $form = $this->createForm(ReservacionType::class, $res);

        $form = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($res);
            $em->flush();

            return $this->redirectToRoute('listar_reservaciones');
        }

        // //var_dump($reservaciones);
        return $this->render('reservaciones/add_reservacion.html.twig', array('form'=> $form->createView()));
    }

    /**
     * @Route("/{id}/delete", name="del_reservacion")
     */
    public function deleteReservacionAction(Request $request, $id=null, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   
            
        $em = $this->getDoctrine()->getManager();
        if($id != null){
            $obj = $em->getRepository(Reservacion::class)->find($id);
            $em->remove($obj);
            $em->flush();
            
        }
        //$reservaciones = $em->getRepository(Reservacion::class)->findAll();
        return $this->redirectToRoute('listar_reservaciones');
        
    }

    /**
     * @Route("/{id}/reservar", name="reservar")
     */
    public function reservarAction(Request $request, $id=null, Security $security)
    {   
        if($id != null){
            $em = $this->getDoctrine()->getManager();

            $userid = $security->getUser()->getId();
            $user = $em->getRepository(Usuario::class)->find($userid); 

            $reservacion = $em->getRepository(Reservacion::class)->find($id);

            if( $reservacion->getUsuarios()->contains($user) )
                $reservacion->removeUsuario($user);
            else
                $reservacion->addUsuario($user);

            $em->flush();
        }
        return $this->redirectToRoute('listar_reservaciones');
    }

    /**
     * @Route("/{id}/edit", name="edit_reservacion")
     */
    public function editReservacionAction(Request $request, $id=null, Security $security)
    {   
        $user = $security->getUser();
        if($user == NULL)
            return $this->redirectToRoute('login');   
        
        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository(Reservacion::class)->find($id);
        $form = $this->createForm(EditReservacionType::class, $res);

        $form = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            return $this->redirectToRoute('listar_reservaciones');
        }
        return $this->render('reservaciones/edit_reservacion.html.twig', array('form'=> $form->createView()));
        
    }
}

