<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Reservacion;
use AppBundle\Form\ReservacionType;

/**
 * @Route("/reservaciones")
 */
class GestionReservacionesController extends Controller
{
    /**
     * @Route("/listar", name="listar_reservaciones")
     */
    public function listarReservacionesAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Reservacion::class);
        $reservaciones = $repo->findAll();

        return $this->render('reservaciones/lista_reservaciones.html.twig', array('reservaciones'=>$reservaciones));
    }

    /**
     * @Route("/add", name="add_reservacion")
     */
    public function addReservacionAction(Request $request)
    {
        $obj = new Reservacion();
        $form = $this->createForm(ReservacionType::class, $obj);

        $form = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $obj = $form->getData();
            $obj->setEstado('FALSE');
            $obj->setFecha($obj->getFecha()->format('d-m-Y H:i'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            return $this->redirectToRoute('listar_reservaciones');
        }

        // //var_dump($reservaciones);
        return $this->render('reservaciones/add_reservacion.html.twig', array('form'=> $form->createView()));
    }
}

