<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdrepayementRepository")
 */
class Ordrepayement
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
    private $nomf;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $montantarabe;

    /**
     * @ORM\Column(type="integer")
     */
    private $idbancaire;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $preuve;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     */
    private $letitre;

    /**
     * @ORM\Column(type="integer")
     */
    private $classe;

    /**
     * @ORM\Column(type="integer")
     */
    private $section;

    /**
     * @ORM\Column(type="integer")
     */
    private $paragraph;

    /**
     * @ORM\Column(type="integer")
     */
    private $subparagraph;

    /**
     * @ORM\Column(type="integer")
     */
    private $visa;

    /**
     * @ORM\Column(type="float")
     */
    private $remisefour;

    /**
     * @ORM\Column(type="float")
     */
    private $remisetva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalremise;

    /**
     * @ORM\Column(type="float")
     */
    private $montantnet;

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

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMontantarabe(): ?string
    {
        return $this->montantarabe;
    }

    public function setMontantarabe(string $montantarabe): self
    {
        $this->montantarabe = $montantarabe;

        return $this;
    }

    public function getIdbancaire(): ?int
    {
        return $this->idbancaire;
    }

    public function setIdbancaire(int $idbancaire): self
    {
        $this->idbancaire = $idbancaire;

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

    public function getPreuve(): ?string
    {
        return $this->preuve;
    }

    public function setPreuve(string $preuve): self
    {
        $this->preuve = $preuve;

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

    public function getLetitre(): ?int
    {
        return $this->letitre;
    }

    public function setLetitre(int $letitre): self
    {
        $this->letitre = $letitre;

        return $this;
    }

    public function getClasse(): ?int
    {
        return $this->classe;
    }

    public function setClasse(int $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setSection(int $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getParagraph(): ?int
    {
        return $this->paragraph;
    }

    public function setParagraph(int $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getSubparagraph(): ?int
    {
        return $this->subparagraph;
    }

    public function setSubparagraph(int $subparagraph): self
    {
        $this->subparagraph = $subparagraph;

        return $this;
    }

    public function getVisa(): ?int
    {
        return $this->visa;
    }

    public function setVisa(int $visa): self
    {
        $this->visa = $visa;

        return $this;
    }

    public function getRemisefour(): ?float
    {
        return $this->remisefour;
    }

    public function setRemisefour(float $remisefour): self
    {
        $this->remisefour = $remisefour;

        return $this;
    }

    public function getRemisetva(): ?float
    {
        return $this->remisetva;
    }

    public function setRemisetva(float $remisetva): self
    {
        $this->remisetva = $remisetva;

        return $this;
    }

    public function getTotalremise(): ?float
    {
        return $this->totalremise;
    }

    public function setTotalremise(float $totalremise): self
    {
        $this->totalremise = $totalremise;

        return $this;
    }

    public function getMontantnet(): ?float
    {
        return $this->montantnet;
    }

    public function setMontantnet(float $montantnet): self
    {
        $this->montantnet = $montantnet;

        return $this;
    }
}
