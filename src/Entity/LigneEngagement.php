<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneEngagementRepository")
 */
class LigneEngagement
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
     * @ORM\Column(type="string", length=255)
     */
    private $designArt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomfour;

    /**
     * @ORM\Column(type="integer")
     */
    private $numfact;

    /**
     * @ORM\Column(type="date")
     */
    private $datefact;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Engagement", inversedBy="ligneEngagements")
     */
    private $Engagement;

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

    public function getDesignArt(): ?string
    {
        return $this->designArt;
    }

    public function setDesignArt(string $designArt): self
    {
        $this->designArt = $designArt;

        return $this;
    }

    public function getNomfour(): ?string
    {
        return $this->nomfour;
    }

    public function setNomfour(string $nomfour): self
    {
        $this->nomfour = $nomfour;

        return $this;
    }

    public function getNumfact(): ?int
    {
        return $this->numfact;
    }

    public function setNumfact(int $numfact): self
    {
        $this->numfact = $numfact;

        return $this;
    }

    public function getDatefact(): ?\DateTimeInterface
    {
        return $this->datefact;
    }

    public function setDatefact(\DateTimeInterface $datefact): self
    {
        $this->datefact = $datefact;

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

    public function getEngagement(): ?Engagement
    {
        return $this->Engagement;
    }

    public function setEngagement(?Engagement $Engagement): self
    {
        $this->Engagement = $Engagement;

        return $this;
    }
}
