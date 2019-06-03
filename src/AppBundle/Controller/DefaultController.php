<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;

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
     * @Route("/listar_reservaciones", name="listar_reservaciones")
     */
    public function listarReservacionesAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Reservacion::class);
        $reservaciones = $repo->findAll();
        //var_dump($reservaciones);
        return $this->render('reservaciones/lista_reservaciones.html.twig', array('reservaciones'=>$reservaciones));
    }
}

