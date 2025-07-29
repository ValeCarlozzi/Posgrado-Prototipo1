<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Tarifa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private ?float $monto = null;

    #[ORM\ManyToOne(targetEntity: Curso::class)]
    private ?Curso $curso = null;

    #[ORM\ManyToOne(targetEntity: Carrera::class)]
    private ?Carrera $carrera = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $fechaFin = null;

    public function getId(): ?int { return $this->id; }
    public function getMonto(): ?float { return $this->monto; }
    public function setMonto(float $monto): self { $this->monto = $monto; return $this; }
    public function getCurso(): ?Curso { return $this->curso; }
    public function setCurso(?Curso $curso): self { $this->curso = $curso; return $this; }
    public function getCarrera(): ?Carrera { return $this->carrera; }
    public function setCarrera(?Carrera $carrera): self { $this->carrera = $carrera; return $this; }
    public function getFechaInicio(): ?\DateTimeInterface { return $this->fechaInicio; }
    public function setFechaInicio(\DateTimeInterface $fechaInicio): self { $this->fechaInicio = $fechaInicio; return $this; }
    public function getFechaFin(): ?\DateTimeInterface { return $this->fechaFin; }
    public function setFechaFin(?\DateTimeInterface $fechaFin): self { $this->fechaFin = $fechaFin; return $this; }
} 