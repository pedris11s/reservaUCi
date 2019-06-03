<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservacion;
use AppBundle\Entity\Usuario;

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
        //$repo = $this->getDoctrine()->getRepository(Usuario::class);
        //$usuarios = $repo->findAll();
        //var_dump($reservaciones);
        return $this->render('usuarios/lista_usuarios.html.twig');
    }
}

