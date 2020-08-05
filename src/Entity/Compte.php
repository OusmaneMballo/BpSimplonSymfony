<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 */
class Compte
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $cle_rip;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="float")
     */
    private $solde;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_fermeture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_ferm_tempo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_reouverture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCleRip(): ?string
    {
        return $this->cle_rip;
    }

    public function setCleRip(string $cle_rip): self
    {
        $this->cle_rip = $cle_rip;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateFermeture(): ?\DateTimeInterface
    {
        return $this->date_fermeture;
    }

    public function setDateFermeture(?\DateTimeInterface $date_fermeture): self
    {
        $this->date_fermeture = $date_fermeture;

        return $this;
    }

    public function getDateFermTempo(): ?\DateTimeInterface
    {
        return $this->date_ferm_tempo;
    }

    public function setDateFermTempo(?\DateTimeInterface $date_ferm_tempo): self
    {
        $this->date_ferm_tempo = $date_ferm_tempo;

        return $this;
    }

    public function getDateReouverture(): ?\DateTimeInterface
    {
        return $this->date_reouverture;
    }

    public function setDateReouverture(?\DateTimeInterface $date_reouverture): self
    {
        $this->date_reouverture = $date_reouverture;

        return $this;
    }
}