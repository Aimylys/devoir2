<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\MetaData\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'location:item']),
            new GetCollection(normalizationContext: ['groups' => 'location:list'])])]
#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['location:list','location:item','client:list', 'client:item'])]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[Groups(['location:list','location:item','client:list', 'client:item'])]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[Groups(['location:list','location:item','client:list', 'client:item'])]
    private ?Bijou $bijou = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['location:list','location:item','client:list', 'client:item'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['location:list','location:item','client:list', 'client:item'])]
    private ?\DateTimeInterface $dateFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getBijou(): ?Bijou
    {
        return $this->bijou;
    }

    public function setBijou(?Bijou $bijou): static
    {
        $this->bijou = $bijou;

        return $this;
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
}
