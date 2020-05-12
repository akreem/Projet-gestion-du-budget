<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BudgetRepository")
 */
class Budget
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
    private $annee;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $totalht;

    /**
     * @ORM\Column(type="float")
     */
    private $totalnpaye;

    /**
     * @ORM\Column(type="float")
     */
    private $totalpaye;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rubrique", mappedBy="budget", orphanRemoval=true,cascade={"persist"})
     */
    private $rubriques;

    public function __construct()
    {
        $this->rubriques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getTotalnpaye(): ?float
    {
        return $this->totalnpaye;
    }

    public function setTotalnpaye(float $totalnpaye): self
    {
        $this->totalnpaye = $totalnpaye;

        return $this;
    }

    public function getTotalpaye(): ?float
    {
        return $this->totalpaye;
    }

    public function setTotalpaye(float $totalpaye): self
    {
        $this->totalpaye = $totalpaye;

        return $this;
    }

    /**
     * @return Collection|Rubrique[]
     */
    public function getRubriques(): Collection
    {
        return $this->rubriques;
    }

    public function addRubrique(Rubrique $rubrique): self
    {
        if (!$this->rubriques->contains($rubrique)) {
            $this->rubriques[] = $rubrique;
            $rubrique->setBudget($this);
        }

        return $this;
    }

    public function removeRubrique(Rubrique $rubrique): self
    {
        if ($this->rubriques->contains($rubrique)) {
            $this->rubriques->removeElement($rubrique);
            // set the owning side to null (unless already changed)
            if ($rubrique->getBudget() === $this) {
                $rubrique->setBudget(null);
            }
        }

        return $this;
    }
}
