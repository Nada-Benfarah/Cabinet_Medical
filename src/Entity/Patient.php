<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?DossierMedical $dossierMedical = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: RDV::class)]
    private Collection $RDV;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: consultation::class)]
    private Collection $consultation;

    public function __construct()
    {
        $this->RDV = new ArrayCollection();
        $this->consultation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossierMedical(): ?DossierMedical
    {
        return $this->dossierMedical;
    }

    public function setDossierMedical(DossierMedical $dossierMedical): static
    {
        $this->dossierMedical = $dossierMedical;

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
            $rDV->setPatient($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): static
    {
        if ($this->RDV->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getPatient() === $this) {
                $rDV->setPatient(null);
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
            $consultation->setPatient($this);
        }

        return $this;
    }

    public function removeConsultation(consultation $consultation): static
    {
        if ($this->consultation->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPatient() === $this) {
                $consultation->setPatient(null);
            }
        }

        return $this;
    }
}
