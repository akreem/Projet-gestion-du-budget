<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneDevisViergeRepository")
 */
class LigneDevisVierge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produit;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DevisVierge", inversedBy="ligneDevisVierges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devisVierge;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDevisVierge(): ?DevisVierge
    {
        return $this->devisVierge;
    }

    public function setDevisVierge(?DevisVierge $devisVierge): self
    {
        $this->devisVierge = $devisVierge;

        return $this;
    }

}
