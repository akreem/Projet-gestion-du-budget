<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TabRecapRepository")
 */
class TabRecap
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Devis", inversedBy="tabRecaps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Devis;


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

    public function getDevis(): ?devis
    {
        return $this->Devis;
    }

    public function setDevis(?devis $devis): self
    {
        $this->Devis = $devis;

        return $this;
    }


}
