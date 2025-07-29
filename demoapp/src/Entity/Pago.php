<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Pago
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Alumno::class)]
    private ?Alumno $alumno = null;

    #[ORM\Column(length: 20)]
    private ?string $cuil = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $fechaPago = null;

    #[ORM\Column(type: 'integer')]
    private ?int $numeroCuota = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comprobante = null;

    public function getId(): ?int { return $this->id; }
    public function getAlumno(): ?Alumno { return $this->alumno; }
    public function setAlumno(?Alumno $alumno): self { $this->alumno = $alumno; return $this; }
    public function getCuil(): ?string { return $this->cuil; }
    public function setCuil(string $cuil): self { $this->cuil = $cuil; return $this; }
    public function getFechaPago(): ?\DateTimeInterface { return $this->fechaPago; }
    public function setFechaPago(\DateTimeInterface $fechaPago): self { $this->fechaPago = $fechaPago; return $this; }
    public function getNumeroCuota(): ?int { return $this->numeroCuota; }
    public function setNumeroCuota(int $numeroCuota): self { $this->numeroCuota = $numeroCuota; return $this; }
    public function getComprobante(): ?string { return $this->comprobante; }
    public function setComprobante(?string $comprobante): self { $this->comprobante = $comprobante; return $this; }
} 