<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Legajo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $numero = null;

    #[ORM\ManyToOne(targetEntity: Alumno::class)]
    private ?Alumno $alumno = null;

    #[ORM\ManyToOne(targetEntity: Carrera::class)]
    private ?Carrera $carrera = null;

    public function getId(): ?int { return $this->id; }
    public function getNumero(): ?string { return $this->numero; }
    public function setNumero(string $numero): self { $this->numero = $numero; return $this; }
    public function getAlumno(): ?Alumno { return $this->alumno; }
    public function setAlumno(?Alumno $alumno): self { $this->alumno = $alumno; return $this; }
    public function getCarrera(): ?Carrera { return $this->carrera; }
    public function setCarrera(?Carrera $carrera): self { $this->carrera = $carrera; return $this; }
} 