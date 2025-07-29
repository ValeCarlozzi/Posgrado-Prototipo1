<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Nota
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private ?float $valor = null;

    #[ORM\ManyToOne(targetEntity: Alumno::class)]
    private ?Alumno $alumno = null;

    #[ORM\ManyToOne(targetEntity: DictadoCurso::class)]
    private ?DictadoCurso $dictado = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documento = null;

    public function getId(): ?int { return $this->id; }
    public function getValor(): ?float { return $this->valor; }
    public function setValor(float $valor): self { $this->valor = $valor; return $this; }
    public function getAlumno(): ?Alumno { return $this->alumno; }
    public function setAlumno(?Alumno $alumno): self { $this->alumno = $alumno; return $this; }
    public function getDictado(): ?DictadoCurso { return $this->dictado; }
    public function setDictado(?DictadoCurso $dictado): self { $this->dictado = $dictado; return $this; }
    public function getDocumento(): ?string { return $this->documento; }
    public function setDocumento(?string $documento): self { $this->documento = $documento; return $this; }
} 