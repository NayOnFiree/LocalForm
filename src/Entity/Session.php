<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\SessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class,strategy: 'ipartial', properties: ['titre','description','Utilisateur.nni'])]
#[ApiFilter(DateFilter::class, properties: ['dateDebut', 'dateFin'])]
#[ApiFilter(OrderFilter::class, properties: ['idSession','titre','dateDebut','dateFin','salle.nom' ])]

class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idSession", type: "integer")]
    private ?int $idSession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 25)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Salle::class)]
    #[ORM\JoinColumn(name: "salle", referencedColumnName: "idSalle")]
    private ?Salle $salle = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(name: "créateur", referencedColumnName: "nni", nullable: true)]
    private ?Utilisateur $Utilisateur = null;

    
    #[Groups(['DuréeSessionEnJours'])]
    public function getDureeSessionEnJours(): ?int
    {
        return 1 + $this->dateFin->diff($this->dateDebut)->days;
    }

    public function getIdSession(): ?int
    {
        return $this->idSession;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description; 
    }
    
    public function setDescription(string $description): static
    {
        $this->description = $description; 
        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getCreateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setCreateur(?Utilisateur $Utilisateur): static
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    
}
