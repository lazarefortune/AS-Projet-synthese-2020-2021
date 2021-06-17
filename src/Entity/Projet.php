<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet", indexes={@ORM\Index(name="id_promo", columns={"id_promo_proj"})})
 * @ORM\Entity
 */
class Projet
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
     * @var int
     *
     * @ORM\Column(name="num_projet", type="smallint", nullable=false)
     */
    private $numProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=150, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo_proj", referencedColumnName="id")
     * })
     */
    private $idPromoProj;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idProjet")
     * @ORM\JoinTable(name="encadre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_projet", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_eval", referencedColumnName="id_user")
     *   }
     * )
     */
    private $idEval;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idProjetVoeux")
     */
    private $idGroupe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idEval = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGroupe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumProjet(): ?int
    {
        return $this->numProjet;
    }

    public function setNumProjet(int $numProjet): self
    {
        $this->numProjet = $numProjet;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdPromoProj()
    {
        return $this->idPromoProj;
    }

    public function setIdPromoProj(?Promo $idPromoProj): self
    {
        $this->idPromoProj = $idPromoProj;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdEval(): Collection
    {
        return $this->idEval;
    }

    public function addIdEval(User $idEval): self
    {
        if (!$this->idEval->contains($idEval)) {
            $this->idEval[] = $idEval;
        }

        return $this;
    }

    public function removeIdEval(User $idEval): self
    {
        $this->idEval->removeElement($idEval);

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
            $idGroupe->addIdProjetVoeux($this);
        }

        return $this;
    }

    public function removeIdGroupe(Groupe $idGroupe): self
    {
        if ($this->idGroupe->removeElement($idGroupe)) {
            $idGroupe->removeIdProjetVoeux($this);
        }

        return $this;
    }

}
