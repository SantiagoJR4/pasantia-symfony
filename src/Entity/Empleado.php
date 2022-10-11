<?php

namespace App\Entity;

use App\Repository\EmpleadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmpleadoRepository::class)]
class Empleado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['empleo'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['empleo'])]
    private ?string $cargo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['empleo'])]
    private ?string $salario = null;

    #[ORM\OneToMany(mappedBy: 'empleado', targetEntity: Post::class)]
    private Collection $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getSalario(): ?string
    {
        return $this->salario;
    }

    public function setSalario(string $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    /*public function getPost(): Collection
    {
        return $this->post;
    }*/

    public function addPost(Post $post): self
    {
        if (!$this->post->contains($post)) {
            $this->post->add($post);
            $post->setEmpleado($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getEmpleado() === $this) {
                $post->setEmpleado(null);
            }
        }

        return $this;
    }
}
