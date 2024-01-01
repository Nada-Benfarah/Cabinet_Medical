<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdonnanceRepository::class)]
class Ordonnance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfOrdoonnace = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $medicamentList = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDateOfOrdoonnace(): ?\DateTimeInterface
    {
        return $this->dateOfOrdoonnace;
    }

    public function setDateOfOrdoonnace(\DateTimeInterface $dateOfOrdoonnace): static
    {
        $this->dateOfOrdoonnace = $dateOfOrdoonnace;

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

    public function getMedicamentList(): ?string
    {
        return $this->medicamentList;
    }

    public function setMedicamentList(string $medicamentList): static
    {
        $this->medicamentList = $medicamentList;

        return $this;
    }
}
