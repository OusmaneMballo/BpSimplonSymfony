<?php

namespace App\Entity;

use App\Repository\TypeFraisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeFraisRepository::class)
 */
class TypeFrais
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $frais;

    /**
     * @ORM\OneToMany(targetEntity=FraisBancaire::class, mappedBy="type_frais")
     */
    private $fraisBancaires;

    public function __construct()
    {
        $this->fraisBancaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFrais(): ?float
    {
        return $this->frais;
    }

    public function setFrais(float $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    /**
     * @return Collection|FraisBancaire[]
     */
    public function getFraisBancaires(): Collection
    {
        return $this->fraisBancaires;
    }

    public function addFraisBancaire(FraisBancaire $fraisBancaire): self
    {
        if (!$this->fraisBancaires->contains($fraisBancaire)) {
            $this->fraisBancaires[] = $fraisBancaire;
            $fraisBancaire->setTypeFrais($this);
        }

        return $this;
    }

    public function removeFraisBancaire(FraisBancaire $fraisBancaire): self
    {
        if ($this->fraisBancaires->contains($fraisBancaire)) {
            $this->fraisBancaires->removeElement($fraisBancaire);
            // set the owning side to null (unless already changed)
            if ($fraisBancaire->getTypeFrais() === $this) {
                $fraisBancaire->setTypeFrais(null);
            }
        }

        return $this;
    }
}
