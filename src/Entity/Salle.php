<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
#[ApiResource]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idSalle", type: "integer")]
    private ?int $idSalle = null;

    #[ORM\Column]
    private ?int $tailleSalle = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSalle = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $codePostal = null;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'Salle')]
    private Collection $lstSessions;

    public function __construct()
    {
        $this->lstSessions = new ArrayCollection();
    }

    public function getIdSalle(): ?int
    {
        return $this->idSalle;
    }

    public function getTailleSalle(): ?int
    {
        return $this->tailleSalle;
    }

    public function setTailleSalle(int $tailleSalle): static
    {
        $this->tailleSalle = $tailleSalle;

        return $this;
    }

    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    public function setNomSalle(string $nomSalle): static
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getLstSessions(): Collection
    {
        return $this->lstSessions;
    }

    public function addLstSession(Session $lstSession): static
    {
        if (!$this->lstSessions->contains($lstSession)) {
            $this->lstSessions->add($lstSession);
            $lstSession->setSalle($this);
        }

        return $this;
    }

    public function removeLstSession(Session $lstSession): static
    {
        if ($this->lstSessions->removeElement($lstSession)) {
            // set the owning side to null (unless already changed)
            if ($lstSession->getSalle() === $this) {
                $lstSession->setSalle(null);
            }
        }

        return $this;
    }
}
