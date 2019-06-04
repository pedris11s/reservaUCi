<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reservacion
 *
 * @ORM\Table(name="reservacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservacionRepository")
 */
class Reservacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=50)
     */
    private $origen;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=50)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=10)
     */
    private $tipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


    /**
     * @var \Doctrine\Common\Collections\Collection|Usuario[]
     *
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="reservaciones")
     * @ORM\JoinTable(
     *  name="reservaciones_usuarios",
     *  joinColumns={
     *      @ORM\JoinColumn(name="reservacion_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    /**
     * @param Usuario $usuario
     */
    public function addUsuario(Usuario $usuario)
    {
        if ($this->usuarios->contains($usuario)) {
            return;
        }
        $this->usuarios->add($usuario);
        $usuario->addReservacion($this);
    }
    /**
     * @param Usuario $usuario
     */
    public function removeUsuario(Usuario $usuario)
    {
        if (!$this->usuarios->contains($usuario)) {
            return;
        }
        $this->usuarios->removeElement($usuario);
        $usuario->removeReservacion($this);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function getUsuarios()
    {
        return $this->usuarios;
    }
    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return Reservacion
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return Reservacion
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return Reservacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Reservacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Reservacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return bool
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

