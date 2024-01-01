<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: dossierMedical::class)]
    private Collection $dossierMedical;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: consultation::class)]
    private Collection $consultation;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: RDV::class)]
    private Collection $RDV;

    public function __construct()
    {
        $this->dossierMedical = new ArrayCollection();
        $this->consultation = new ArrayCollection();
        $this->RDV = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, dossierMedical>
     */
    public function getDossierMedical(): Collection
    {
        return $this->dossierMedical;
    }

    public function addDossierMedical(dossierMedical $dossierMedical): static
    {
        if (!$this->dossierMedical->contains($dossierMedical)) {
            $this->dossierMedical->add($dossierMedical);
            $dossierMedical->setMedecin($this);
        }

        return $this;
    }

    public function removeDossierMedical(dossierMedical $dossierMedical): static
    {
        if ($this->dossierMedical->removeElement($dossierMedical)) {
            // set the owning side to null (unless already changed)
            if ($dossierMedical->getMedecin() === $this) {
                $dossierMedical->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, consultation>
     */
    public function getConsultation(): Collection
    {
        return $this->consultation;
    }

    public function addConsultation(consultation $consultation): static
    {
        if (!$this->consultation->contains($consultation)) {
            $this->consultation->add($consultation);
            $consultation->setMedecin($this);
        }

        return $this;
    }

    public function removeConsultation(consultation $consultation): static
    {
        if ($this->consultation->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getMedecin() === $this) {
                $consultation->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RDV>
     */
    public function getRDV(): Collection
    {
        return $this->RDV;
    }

    public function addRDV(RDV $rDV): static
    {
        if (!$this->RDV->contains($rDV)) {
            $this->RDV->add($rDV);
            $rDV->setMedecin($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): static
    {
        if ($this->RDV->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getMedecin() === $this) {
                $rDV->setMedecin(null);
            }
        }

        return $this;
    }
}
