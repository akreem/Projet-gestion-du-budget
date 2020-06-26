<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EngagementRepository")
 */
class Engagement
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
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneEngagement", mappedBy="Engagement")
     */
    private $ligneEngagements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rubrique", inversedBy="engagements")
     */
    private $Rubrique;

    public function __construct()
    {
        $this->ligneEngagements = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection|LigneEngagement[]
     */
    public function getLigneEngagements(): Collection
    {
        return $this->ligneEngagements;
    }

    public function addLigneEngagement(LigneEngagement $ligneEngagement): self
    {
        if (!$this->ligneEngagements->contains($ligneEngagement)) {
            $this->ligneEngagements[] = $ligneEngagement;
            $ligneEngagement->setEngagement($this);
        }

        return $this;
    }

    public function removeLigneEngagement(LigneEngagement $ligneEngagement): self
    {
        if ($this->ligneEngagements->contains($ligneEngagement)) {
            $this->ligneEngagements->removeElement($ligneEngagement);
            // set the owning side to null (unless already changed)
            if ($ligneEngagement->getEngagement() === $this) {
                $ligneEngagement->setEngagement(null);
            }
        }

        return $this;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this->Rubrique;
    }

    public function setRubrique(?Rubrique $Rubrique): self
    {
        $this->Rubrique = $Rubrique;

        return $this;
    }
}
