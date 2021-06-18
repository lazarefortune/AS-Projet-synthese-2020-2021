<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant", uniqueConstraints={@ORM\UniqueConstraint(name="id_user", columns={"id_user"})}, indexes={@ORM\Index(name="groupe_etudiant", columns={"id_groupe_etud"}), @ORM\Index(name="promo_etudiant", columns={"id_promo"})})
 * @ORM\Entity
 */
class Etudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_etud", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtud;

    /**
     * @var string|null
     *
     * @ORM\Column(name="demi_groupe", type="string", length=5, nullable=true)
     */
    private $demiGroupe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_tut_rapport", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=20, minMessage = "c'est pas hlel")
     */
    private $noteTutRapport;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_tut_trav", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=20)
     */
    private $noteTutTrav;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_tut_compet", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=20)
     */
    private $noteTutCompet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pourcent_travail", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=100)
     */
    private $pourcentTravail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_tut_5", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $noteTut5;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_tut_20", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=20)
     */
    private $noteTut20;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note_finale", type="decimal", precision=10, scale=0, nullable=true)
     * @Assert\Range(min=0, max=20)
     */
    private $noteFinale;

    /**
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_groupe_etud", referencedColumnName="id")
     * })
     */
    private $idGroupeEtud;

    /**
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id")
     * })
     */
    private $idPromo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdEtud(): ?int
    {
        return $this->idEtud;
    }

    public function getDemiGroupe(): ?string
    {
        return $this->demiGroupe;
    }

    public function setDemiGroupe(?string $demiGroupe): self
    {
        $this->demiGroupe = $demiGroupe;

        return $this;
    }

    public function getNoteTutRapport(): ?string
    {
        return $this->noteTutRapport;
    }

    public function setNoteTutRapport(?string $noteTutRapport): self
    {
        $this->noteTutRapport = $noteTutRapport;

        return $this;
    }

    public function getNoteTutTrav(): ?string
    {
        return $this->noteTutTrav;
    }

    public function setNoteTutTrav(?string $noteTutTrav): self
    {
        $this->noteTutTrav = $noteTutTrav;

        return $this;
    }

    public function getNoteTutCompet(): ?string
    {
        return $this->noteTutCompet;
    }

    public function setNoteTutCompet(?string $noteTutCompet): self
    {
        $this->noteTutCompet = $noteTutCompet;

        return $this;
    }

    public function getPourcentTravail(): ?string
    {
        return $this->pourcentTravail;
    }

    public function setPourcentTravail(?string $pourcentTravail): self
    {
        $this->pourcentTravail = $pourcentTravail;

        return $this;
    }

    public function getNoteTut5(): ?string
    {
        return $this->noteTut5;
    }

    public function setNoteTut5(?string $noteTut5): self
    {
        $this->noteTut5 = $noteTut5;

        return $this;
    }

    public function getNoteTut20(): ?string
    {
        return $this->noteTut20;
    }

    public function setNoteTut20(?string $noteTut20): self
    {
        $this->noteTut20 = $noteTut20;

        return $this;
    }

    public function getNoteFinale(): ?string
    {
        return $this->noteFinale;
    }

    public function setNoteFinale(?string $noteFinale): self
    {
        $this->noteFinale = $noteFinale;

        return $this;
    }

    public function getIdGroupeEtud()
    {
        return $this->idGroupeEtud;
    }

    public function setIdGroupeEtud(?Groupe $idGroupeEtud): self
    {
        $this->idGroupeEtud = $idGroupeEtud;

        return $this;
    }

    public function getIdPromo()
    {
        return $this->idPromo;
    }

    public function setIdPromo(?Promo $idPromo): self
    {
        $this->idPromo = $idPromo;

        return $this;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function idGroupeEtud()
    {
        return $this->idGroupeEtud;
    }


}
