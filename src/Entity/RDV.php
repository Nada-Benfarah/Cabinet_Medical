<?php

namespace App\Entity;

use App\Repository\RDVRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RDVRepository::class)]
class RDV
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfChecking = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfRDV = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOfIllness = null;

    #[ORM\Column(nullable: true)]
    private ?bool $notification = null;

    #[ORM\ManyToOne(inversedBy: 'RDV')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'RDV')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin = null;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfChecking(): ?\DateTimeInterface
    {
        return $this->dateOfChecking;
    }

    public function setDateOfChecking(\DateTimeInterface $dateOfChecking): static
    {
        $this->dateOfChecking = $dateOfChecking;

        return $this;
    }

    public function getDateOfRDV(): ?\DateTimeInterface
    {
        return $this->dateOfRDV;
    }

    public function setDateOfRDV(\DateTimeInterface $dateOfRDV): static
    {
        $this->dateOfRDV = $dateOfRDV;

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

    public function getTypeOfIllness(): ?string
    {
        return $this->typeOfIllness;
    }

    public function setTypeOfIllness(string $typeOfIllness): static
    {
        $this->typeOfIllness = $typeOfIllness;

        return $this;
    }

    public function isNotification(): ?bool
    {
        return $this->notification;
    }

    public function setNotification(?bool $notification): static
    {
        $this->notification = $notification;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }



}
