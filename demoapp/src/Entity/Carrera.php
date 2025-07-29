<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Carrera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ordenanzaAprobacion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resolucionImplementacion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coneaAprobacion = null;

    public function getId(): ?int { return $this->id; }
    public function getNombre(): ?string { return $this->nombre; }
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }
    public function getOrdenanzaAprobacion(): ?string { return $this->ordenanzaAprobacion; }
    public function setOrdenanzaAprobacion(?string $ordenanzaAprobacion): self { $this->ordenanzaAprobacion = $ordenanzaAprobacion; return $this; }
    public function getResolucionImplementacion(): ?string { return $this->resolucionImplementacion; }
    public function setResolucionImplementacion(?string $resolucionImplementacion): self { $this->resolucionImplementacion = $resolucionImplementacion; return $this; }
    public function getConeaAprobacion(): ?string { return $this->coneaAprobacion; }
    public function setConeaAprobacion(?string $coneaAprobacion): self { $this->coneaAprobacion = $coneaAprobacion; return $this; }
} 