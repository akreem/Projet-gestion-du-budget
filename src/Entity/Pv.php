<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PvRepository")
 */
class Pv
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
    private $commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $date;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lignepv", mappedBy="pv",cascade={"persist"})
     */
    private $lignepvs;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cad1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cad2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cad3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cad4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cad5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade5;

    public function __construct()
    {
        $this->lignepvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    /**
     * @return Collection|Lignepv[]
     */
    public function getLignepvs(): Collection
    {
        return $this->lignepvs;
    }

    public function addLignepv(Lignepv $lignepv): self
    {
        if (!$this->lignepvs->contains($lignepv)) {
            $this->lignepvs[] = $lignepv;
            $lignepv->setPv($this);
        }

        return $this;
    }

    public function removeLignepv(Lignepv $lignepv): self
    {
        if ($this->lignepvs->contains($lignepv)) {
            $this->lignepvs->removeElement($lignepv);
            // set the owning side to null (unless already changed)
            if ($lignepv->getPv() === $this) {
                $lignepv->setPv(null);
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

    public function getCad1(): ?string
    {
        return $this->cad1;
    }

    public function setCad1(string $cad1): self
    {
        $this->cad1 = $cad1;

        return $this;
    }

    public function getGrade1(): ?string
    {
        return $this->grade1;
    }

    public function setGrade1(string $grade1): self
    {
        $this->grade1 = $grade1;

        return $this;
    }

    public function getCad2(): ?string
    {
        return $this->cad2;
    }

    public function setCad2(string $cad2): self
    {
        $this->cad2 = $cad2;

        return $this;
    }

    public function getGrade2(): ?string
    {
        return $this->grade2;
    }

    public function setGrade2(string $grade2): self
    {
        $this->grade2 = $grade2;

        return $this;
    }

    public function getCad3(): ?string
    {
        return $this->cad3;
    }

    public function setCad3(string $cad3): self
    {
        $this->cad3 = $cad3;

        return $this;
    }

    public function getGrade3(): ?string
    {
        return $this->grade3;
    }

    public function setGrade3(string $grade3): self
    {
        $this->grade3 = $grade3;

        return $this;
    }

    public function getCad4(): ?string
    {
        return $this->cad4;
    }

    public function setCad4(string $cad4): self
    {
        $this->cad4 = $cad4;

        return $this;
    }

    public function getGrade4(): ?string
    {
        return $this->grade4;
    }

    public function setGrade4(string $grade4): self
    {
        $this->grade4 = $grade4;

        return $this;
    }

    public function getCad5(): ?string
    {
        return $this->cad5;
    }

    public function setCad5(string $cad5): self
    {
        $this->cad5 = $cad5;

        return $this;
    }

    public function getGrade5(): ?string
    {
        return $this->grade5;
    }

    public function setGrade5(string $grade5): self
    {
        $this->grade5 = $grade5;

        return $this;
    }
}
