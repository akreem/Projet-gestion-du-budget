<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneRecapRepository")
 */
class LigneRecap
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
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produit;

    /**
     * @ORM\Column(type="float")
     */
    private $pu_ht;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TableauRecap", inversedBy="ligneRecaps")
     */
    private $TableauRecap;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LigneDevis", cascade={"persist", "remove"})
     */
    private $ligneDevis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomfournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addrf;

    /**
     * @ORM\Column(type="integer")
     */
    private $telf;

    /**
     * @ORM\Column(type="float")
     */
    private $montanttva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalttc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
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

    public function getProduit(): ?string
    {
        return $this->produit;
    }

    public function setProduit(string $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPuHt(): ?float
    {
        return $this->pu_ht;
    }

    public function setPuHt(float $pu_ht): self
    {
        $this->pu_ht = $pu_ht;

        return $this;
    }



    public function getTableauRecap(): ?TableauRecap
    {
        return $this->TableauRecap;
    }

    public function setTableauRecap(?TableauRecap $TableauRecap): self
    {
        $this->TableauRecap = $TableauRecap;

        return $this;
    }

    public function getLigneDevis(): ?ligneDevis
    {
        return $this->ligneDevis;
    }

    public function setLigneDevis(?ligneDevis $ligneDevis): self
    {
        $this->ligneDevis = $ligneDevis;

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

    public function getAddrf(): ?string
    {
        return $this->addrf;
    }

    public function setAddrf(string $addrf): self
    {
        $this->addrf = $addrf;

        return $this;
    }

    public function getTelf(): ?int
    {
        return $this->telf;
    }

    public function setTelf(int $telf): self
    {
        $this->telf = $telf;

        return $this;
    }

    public function getMontanttva(): ?float
    {
        return $this->montanttva;
    }

    public function setMontanttva(float $montanttva): self
    {
        $this->montanttva = $montanttva;

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
}
