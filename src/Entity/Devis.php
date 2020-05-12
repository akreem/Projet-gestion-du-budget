<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
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
    private $total_HT;

    /**
     * @ORM\Column(type="float")
     */
    private $total_tva;

    /**
     * @ORM\Column(type="float")
     */
    private $total_ttc;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneDevis", mappedBy="devis",orphanRemoval=true,cascade={"persist"})
     */
    private $ligneDevis;

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
    private $nom_fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addr_fournisseur;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $matricule_fiscale_fourn;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min="8",max="8",exactMessage="Numéro de Telephone doit contenir 8 chiffres")
     */
    private $tel_fourn;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min="8",max="8",exactMessage="Numéro de Fax doit contenir 8 chiffres")

     */
    private $fax_fourn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DevisVierge", inversedBy="devis")
     */
    private $devisVierge;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TabRecap", mappedBy="devis")
     */
    private $tabRecaps;




    public function __construct()
    {
        $this->ligneDevis = new ArrayCollection();
        $this->tabRecaps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalHT(): ?float
    {
        return $this->total_HT;
    }

    public function setTotalHT(float $total_HT): self
    {
        $this->total_HT = $total_HT;

        return $this;
    }

    public function getTotalTva(): ?float
    {
        return $this->total_tva;
    }

    public function setTotalTva(float $total_tva): self
    {
        $this->total_tva = $total_tva;

        return $this;
    }

    public function getTotalTtc(): ?float
    {
        return $this->total_ttc;
    }

    public function setTotalTtc(float $total_ttc): self
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }

    /**
     * @return Collection|LigneDevis[]
     */
    public function getLigneDevis(): Collection
    {
        return $this->ligneDevis;
    }

    public function addLigneDevi(LigneDevis $ligneDevi): self
    {
        if (!$this->ligneDevis->contains($ligneDevi)) {
            $this->ligneDevis[] = $ligneDevi;
            $ligneDevi->setDevis($this);
        }

        return $this;
    }

    public function removeLigneDevi(LigneDevis $ligneDevi): self
    {
        if ($this->ligneDevis->contains($ligneDevi)) {
            $this->ligneDevis->removeElement($ligneDevi);
            // set the owning side to null (unless already changed)
            if ($ligneDevi->getDevis() === $this) {
                $ligneDevi->setDevis(null);
            }
        }

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

    public function getNomFournisseur(): ?string
    {
        return $this->nom_fournisseur;
    }

    public function setNomFournisseur(string $nom_fournisseur): self
    {
        $this->nom_fournisseur = $nom_fournisseur;

        return $this;
    }

    public function getAddrFournisseur(): ?string
    {
        return $this->addr_fournisseur;
    }

    public function setAddrFournisseur(string $addr_fournisseur): self
    {
        $this->addr_fournisseur = $addr_fournisseur;

        return $this;
    }

    public function getMatriculeFiscaleFourn(): ?string
    {
        return $this->matricule_fiscale_fourn;
    }

    public function setMatriculeFiscaleFourn(string $matricule_fiscale_fourn): self
    {
        $this->matricule_fiscale_fourn = $matricule_fiscale_fourn;

        return $this;
    }

    public function getTelFourn(): ?int
    {
        return $this->tel_fourn;
    }

    public function setTelFourn(int $tel_fourn): self
    {
        $this->tel_fourn = $tel_fourn;

        return $this;
    }

    public function getFaxFourn(): ?int
    {
        return $this->fax_fourn;
    }

    public function setFaxFourn(int $fax_fourn): self
    {
        $this->fax_fourn = $fax_fourn;

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
    public function __toString()
    {
        return $this->nom_fournisseur.$this->num;
    }

    /**
     * @return Collection|TabRecap[]
     */
    public function getTabRecaps(): Collection
    {
        return $this->tabRecaps;
    }

    public function addTabRecap(TabRecap $tabRecap): self
    {
        if (!$this->tabRecaps->contains($tabRecap)) {
            $this->tabRecaps[] = $tabRecap;
            $tabRecap->setDevis($this);
        }

        return $this;
    }

    public function removeTabRecap(TabRecap $tabRecap): self
    {
        if ($this->tabRecaps->contains($tabRecap)) {
            $this->tabRecaps->removeElement($tabRecap);
            // set the owning side to null (unless already changed)
            if ($tabRecap->getDevis() === $this) {
                $tabRecap->setDevis(null);
            }
        }

        return $this;
    }


}
