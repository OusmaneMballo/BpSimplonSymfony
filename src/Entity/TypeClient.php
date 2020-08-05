<?php

namespace App\Entity;

use App\Repository\TypeClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeClientRepository::class)
 */
class TypeClient
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
     * @ORM\OneToMany(targetEntity=ClientPhysique::class, mappedBy="typeClient")
     */
    private $client_physique;

    public function __construct()
    {
        $this->client_physique = new ArrayCollection();
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

    /**
     * @return Collection|ClientPhysique[]
     */
    public function getClientPhysique(): Collection
    {
        return $this->client_physique;
    }

    public function addClientPhysique(ClientPhysique $clientPhysique): self
    {
        if (!$this->client_physique->contains($clientPhysique)) {
            $this->client_physique[] = $clientPhysique;
            $clientPhysique->setTypeClient($this);
        }

        return $this;
    }

    public function removeClientPhysique(ClientPhysique $clientPhysique): self
    {
        if ($this->client_physique->contains($clientPhysique)) {
            $this->client_physique->removeElement($clientPhysique);
            // set the owning side to null (unless already changed)
            if ($clientPhysique->getTypeClient() === $this) {
                $clientPhysique->setTypeClient(null);
            }
        }

        return $this;
    }
}
