<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PersonaRepository::class)]
class Persona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['persona'])]
    private ?int $id = null;

    
    #[ORM\Column(length: 255)]
    #[Groups(['persona'])]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    #[Groups(['persona'])]
    private ?string $apellido = null;

    #[ORM\Column]
    #[Groups(['persona'])]
    private ?int $celular = null;

    #[ORM\ManyToOne(inversedBy:'empleados')]
    #[Groups(['empleo'])]
    private ?Empleado $empleo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getCelular(): ?int
    {
        return $this->celular;
    }

    public function setCelular(int $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getEmpleo(): ?Empleado
    {
        return $this->empleo;
    }

    public function setEmpleo(?Empleado $empleo): self
    {
        $this->empleo = $empleo;

        return $this;
    }
}
