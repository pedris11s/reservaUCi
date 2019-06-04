<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $roles;

     /**
     * @var \Doctrine\Common\Collections\Collection|Reservacion[]
     *
     * @ORM\ManyToMany(targetEntity="Reservacion", mappedBy="usuarios")
     */
    protected $reservaciones;

    public function __construct()
    {
        $this->reservaciones = new ArrayCollection();
    }
    
    /**
     * @param Reservacion $reservacion
     */
    public function addReservacion(Reservacion $reservacion)
    {
        if ($this->reservaciones->contains($reservacion)) {
            return;
        }
        $this->reservaciones->add($reservacion);
        $reservacion->addUsuario($this);
    }
    /**
     * @param Reservacion $reservacion
     */
    public function removeUser(Reservacion $reservacion)
    {
        if (!$this->reservaciones->contains($reservacion)) {
            return;
        }
        $this->reservaciones->removeElement($reservacion);
        $reservacion->removeUsuario($this);
    }
    // other properties and methods

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        $roles = json_decode($this->roles);
        return $roles;
    }

    public function setRoles($roles)
    {
        $roles_json = json_encode($roles);
        return $this->roles=$roles_json;
    }

    public function eraseCredentials()
    {
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
}
