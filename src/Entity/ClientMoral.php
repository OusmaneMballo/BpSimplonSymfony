<?php

namespace App\Entity;

use App\Repository\ClientMoralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientMoralRepository::class)
 */
class ClientMoral
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $raison_social;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $addresse;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $passwd;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $ninea;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="client_moral")
     */
    private $comptes;

    /**
     * @ORM\OneToMany(targetEntity=ClientPhysique::class, mappedBy="client_moral")
     */
    private $clientPhysiques;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->clientPhysiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->raison_social;
    }

    public function setRaisonSocial(string $raison_social): self
    {
        $this->raison_social = $raison_social;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(?string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPasswd(): ?string
    {
        return $this->passwd;
    }

    public function setPasswd(string $passwd): self
    {
        $this->passwd = $passwd;

        return $this;
    }

    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(string $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setClientMoral($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getClientMoral() === $this) {
                $compte->setClientMoral(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClientPhysique[]
     */
    public function getClientPhysiques(): Collection
    {
        return $this->clientPhysiques;
    }

    public function addClientPhysique(ClientPhysique $clientPhysique): self
    {
        if (!$this->clientPhysiques->contains($clientPhysique)) {
            $this->clientPhysiques[] = $clientPhysique;
            $clientPhysique->setClientMoral($this);
        }

        return $this;
    }

    public function removeClientPhysique(ClientPhysique $clientPhysique): self
    {
        if ($this->clientPhysiques->contains($clientPhysique)) {
            $this->clientPhysiques->removeElement($clientPhysique);
            // set the owning side to null (unless already changed)
            if ($clientPhysique->getClientMoral() === $this) {
                $clientPhysique->setClientMoral(null);
            }
        }

        return $this;
    }

}
