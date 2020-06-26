<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RubriqueRepository")
 */
class Rubrique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Budget", inversedBy="rubriques")
     */
    private $budget;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Engagement", mappedBy="Rubrique")
     */
    private $engagements;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $engp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $engnp;



    public function __construct()
    {
        $this->engagements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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



    public function getBudget(): ?Budget
    {
        return $this->budget;
    }

    public function setBudget(?Budget $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return Collection|Engagement[]
     */
    public function getEngagements(): Collection
    {
        return $this->engagements;
    }

    public function addEngagement(Engagement $engagement): self
    {
        if (!$this->engagements->contains($engagement)) {
            $this->engagements[] = $engagement;
            $engagement->setRubrique($this);
        }

        return $this;
    }

    public function removeEngagement(Engagement $engagement): self
    {
        if ($this->engagements->contains($engagement)) {
            $this->engagements->removeElement($engagement);
            // set the owning side to null (unless already changed)
            if ($engagement->getRubrique() === $this) {
                $engagement->setRubrique(null);
            }
        }

        return $this;
    }

    public function getEngp(): ?float
    {
        return $this->engp;
    }

    public function setEngp(?float $engp): self
    {
        $this->engp = $engp;

        return $this;
    }

    public function getEngnp(): ?float
    {
        return $this->engnp;
    }

    public function setEngnp(?float $engnp): self
    {
        $this->engnp = $engnp;

        return $this;
    }

}
