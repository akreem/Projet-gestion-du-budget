<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TableauRecapRepository")
 */
class TableauRecap
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $totalht;

    /**
     * @ORM\Column(type="float")
     */
    private $totaltva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalttc;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomfournisseur;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneRecap", mappedBy="TableauRecap", cascade={"persist"})
     */
    private $ligneRecaps;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Devis", cascade={"persist", "remove"})
     */
    private $Devis;

    public function __construct()
    {
        $this->ligneRecaps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalht(): ?float
    {
        return $this->totalht;
    }

    public function setTotalht(float $totalht): self
    {
        $this->totalht = $totalht;

        return $this;
    }

    public function getTotaltva(): ?float
    {
        return $this->totaltva;
    }

    public function setTotaltva(float $totaltva): self
    {
        $this->totaltva = $totaltva;

        return $this;
    }

    public function getTotalttc(): ?float
    {
        return $this->totalttc;
    }

    public function setTotalttc(float $totalttc): self
    {
        $this->totalttc = $totalttc;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNomfournisseur(): ?string
    {
        return $this->nomfournisseur;
    }

    public function setNomfournisseur(string $nomfournisseur): self
    {
        $this->nomfournisseur = $nomfournisseur;

        return $this;
    }



    /**
     * @return Collection|LigneRecap[]
     */
    public function getLigneRecaps(): Collection
    {
        return $this->ligneRecaps;
    }

    public function addLigneRecap(LigneRecap $ligneRecap): self
    {
        if (!$this->ligneRecaps->contains($ligneRecap)) {
            $this->ligneRecaps[] = $ligneRecap;
            $ligneRecap->setTableauRecap($this);
        }

        return $this;
    }

    public function removeLigneRecap(LigneRecap $ligneRecap): self
    {
        if ($this->ligneRecaps->contains($ligneRecap)) {
            $this->ligneRecaps->removeElement($ligneRecap);
            // set the owning side to null (unless already changed)
            if ($ligneRecap->getTableauRecap() === $this) {
                $ligneRecap->setTableauRecap(null);
            }
        }

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->Devis;
    }

    public function setDevis(?Devis $Devis): self
    {
        $this->Devis = $Devis;

        return $this;
    }

}
