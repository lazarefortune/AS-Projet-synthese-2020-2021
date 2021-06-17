<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HoraireSoutenance
 *
 * @ORM\Table(name="horaire_soutenance")
 * @ORM\Entity
 */
class HoraireSoutenance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaire", type="time", nullable=false)
     */
    private $horaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idTrancheSout")
     */
    private $idGroupe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idGroupe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(\DateTimeInterface $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getIdGroupe(): Collection
    {
        return $this->idGroupe;
    }

    public function addIdGroupe(Groupe $idGroupe): self
    {
        if (!$this->idGroupe->contains($idGroupe)) {
            $this->idGroupe[] = $idGroupe;
            $idGroupe->addIdTrancheSout($this);
        }

        return $this;
    }

    public function removeIdGroupe(Groupe $idGroupe): self
    {
        if ($this->idGroupe->removeElement($idGroupe)) {
            $idGroupe->removeIdTrancheSout($this);
        }

        return $this;
    }

}
