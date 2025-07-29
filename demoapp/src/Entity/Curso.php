<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(type: 'integer')]
    private ?int $horas = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $esOptativo = null;

    public function getId(): ?int { return $this->id; }
    public function getNombre(): ?string { return $this->nombre; }
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }
    public function getHoras(): ?int { return $this->horas; }
    public function setHoras(int $horas): self { $this->horas = $horas; return $this; }
    public function getEsOptativo(): ?bool { return $this->esOptativo; }
    public function setEsOptativo(bool $esOptativo): self { $this->esOptativo = $esOptativo; return $this; }
} 