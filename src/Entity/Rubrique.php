<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="float")
     */
    private $engagementnpaye;

    /**
     * @ORM\Column(type="float")
     */
    private $engagementpaye;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Budget", inversedBy="rubriques")
     */
    private $budget;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
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

    public function getEngagementnpaye(): ?float
    {
        return $this->engagementnpaye;
    }

    public function setEngagementnpaye(float $engagementnpaye): self
    {
        $this->engagementnpaye = $engagementnpaye;

        return $this;
    }

    public function getEngagementpaye(): ?float
    {
        return $this->engagementpaye;
    }

    public function setEngagementpaye(float $engagementpaye): self
    {
        $this->engagementpaye = $engagementpaye;

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
}
