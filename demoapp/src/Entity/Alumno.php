<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: AlumnoRepository::class)]
class Alumno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellido = null;

    #[ORM\Column(length: 150, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $dni = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $cuil = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): ?string { return $this->nombre; }
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }
    public function getApellido(): ?string { return $this->apellido; }
    public function setApellido(string $apellido): self { $this->apellido = $apellido; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getDni(): ?string { return $this->dni; }
    public function setDni(string $dni): self { $this->dni = $dni; return $this; }
    public function getCuil(): ?string { return $this->cuil; }
    public function setCuil(string $cuil): self { $this->cuil = $cuil; return $this; }
}
