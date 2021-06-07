<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HorairePoster
 *
 * @ORM\Table(name="horaire_poster")
 * @ORM\Entity
 */
class HorairePoster
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
     * @ORM\Column(name="heure_debut", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     */
    private $heureFin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idTranchePost")
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

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

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
            $idGroupe->addIdTranchePost($this);
        }

        return $this;
    }

    public function removeIdGroupe(Groupe $idGroupe): self
    {
        if ($this->idGroupe->removeElement($idGroupe)) {
            $idGroupe->removeIdTranchePost($this);
        }

        return $this;
    }

}
