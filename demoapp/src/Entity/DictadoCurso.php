<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DictadoCurso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Curso::class)]
    private ?Curso $curso = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaFin = null;

    public function getId(): ?int { return $this->id; }
    public function getCurso(): ?Curso { return $this->curso; }
    public function setCurso(?Curso $curso): self { $this->curso = $curso; return $this; }
    public function getFechaInicio(): ?\DateTimeInterface { return $this->fechaInicio; }
    public function setFechaInicio(\DateTimeInterface $fechaInicio): self { $this->fechaInicio = $fechaInicio; return $this; }
    public function getFechaFin(): ?\DateTimeInterface { return $this->fechaFin; }
    public function setFechaFin(\DateTimeInterface $fechaFin): self { $this->fechaFin = $fechaFin; return $this; }
} 