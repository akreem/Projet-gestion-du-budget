<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonCommandeRepository")
 */
class BonCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="BonCommande", cascade={"persist"})
     */
    private $ligneCommandes;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\DevisVierge", inversedBy="bonCommandes")
     */
    private $devisVierge;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Datedition;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|LigneCommande[]
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setBonCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getBonCommande() === $this) {
                $ligneCommande->setBonCommande(null);
            }
        }

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

    public function getDevisVierge(): ?DevisVierge
    {
        return $this->devisVierge;
    }

    public function setDevisVierge(?DevisVierge $devisVierge): self
    {
        $this->devisVierge = $devisVierge;

        return $this;
    }

    public function getDatedition(): ?\DateTimeInterface
    {
        return $this->Datedition;
    }

    public function setDatedition(\DateTimeInterface $Datedition): self
    {
        $this->Datedition = $Datedition;

        return $this;
    }
}
