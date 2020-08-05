<?php

namespace App\Entity;

use App\Repository\FraisBancaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FraisBancaireRepository::class)
 */
class FraisBancaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $frais;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFrais::class, inversedBy="fraisBancaires")
     */
    private $type_frais;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="frais_bancaire")
     */
    private $compte;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTypeFrais(): ?TypeFrais
    {
        return $this->type_frais;
    }

    public function setTypeFrais(?TypeFrais $type_frais): self
    {
        $this->type_frais = $type_frais;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
