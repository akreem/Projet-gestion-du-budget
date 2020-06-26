<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
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
    private $puht;

    /**
     * @ORM\Column(type="float")
     */
    private $totalht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addrf;

    /**
     * @ORM\Column(type="integer")
     */
    private $telf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BonCommande", inversedBy="ligneCommandes")
     */
    private $BonCommande;

    /**
     * @ORM\Column(type="float")
     */
    private $montanttva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalttc;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LigneRecap", cascade={"persist", "remove"})
     */
    private $LigneRecap;

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

    public function getPuht(): ?float
    {
        return $this->puht;
    }

    public function setPuht(float $puht): self
    {
        $this->puht = $puht;

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

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;

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

    public function getBonCommande(): ?BonCommande
    {
        return $this->BonCommande;
    }

    public function setBonCommande(?BonCommande $BonCommande): self
    {
        $this->BonCommande = $BonCommande;

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

    public function getLigneRecap(): ?LigneRecap
    {
        return $this->LigneRecap;
    }

    public function setLigneRecap(?LigneRecap $LigneRecap): self
    {
        $this->LigneRecap = $LigneRecap;

        return $this;
    }
}
