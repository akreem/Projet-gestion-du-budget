<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisViergeRepository")
 */
class DevisVierge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */    private $id;



    /**
     * @ORM\Column(type="date")
     */
    private $date_edition;

    /**
     * @ORM\Column(type="date")
     */
    private $date_limite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_devis_edit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneDevisVierge", mappedBy="devisVierge", orphanRemoval=true,cascade={"persist"})
     */
    private $ligneDevisVierges;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="devisVierge",orphanRemoval=true,cascade={"persist"})
     */
    private $devis;



    public function __construct()
    {
        $this->ligneDevisVierges = new ArrayCollection();
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEdition(): ?\DateTimeInterface
    {
        return $this->date_edition;
    }

    public function setDateEdition(\DateTimeInterface $date_edition): self
    {
        $this->date_edition = $date_edition;

        return $this;
    }

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->date_limite;
    }

    public function setDateLimite(\DateTimeInterface $date_limite): self
    {
        $this->date_limite = $date_limite;

        return $this;
    }

    public function getNbDevisEdit(): ?int
    {
        return $this->nb_devis_edit;
    }

    public function setNbDevisEdit(?int $nb_devis_edit): self
    {
        $this->nb_devis_edit = $nb_devis_edit;

        return $this;
    }

    /**
     * @return Collection|LigneDevisVierge[]
     */
    public function getLigneDevisVierges(): Collection
    {
        return $this->ligneDevisVierges;
    }

    public function addLigneDevisVierge(LigneDevisVierge $ligneDevisVierge): self
    {
        if (!$this->ligneDevisVierges->contains($ligneDevisVierge)) {
            $this->ligneDevisVierges[] = $ligneDevisVierge;
            $ligneDevisVierge->setDevisVierge($this);
        }

        return $this;
    }

    public function removeLigneDevisVierge(LigneDevisVierge $ligneDevisVierge): self
    {
        if ($this->ligneDevisVierges->contains($ligneDevisVierge)) {
            $this->ligneDevisVierges->removeElement($ligneDevisVierge);
            // set the owning side to null (unless already changed)
            if ($ligneDevisVierge->getDevisVierge() === $this) {
                $ligneDevisVierge->setDevisVierge(null);
            }
        }

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

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

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->setDevisVierge($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->contains($devi)) {
            $this->devis->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getDevisVierge() === $this) {
                $devi->setDevisVierge(null);
            }
        }

        return $this;
    }


}
