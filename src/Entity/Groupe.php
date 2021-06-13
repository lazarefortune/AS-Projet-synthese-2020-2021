<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", indexes={@ORM\Index(name="id_date_excep", columns={"id_date_excep"}), @ORM\Index(name="proj_groupe", columns={"id_projet"})})
 * @ORM\Entity
 */
class Groupe
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
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=3, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_diff", type="string", length=0, nullable=false, options={"default"="n"})
     */
    private $dureeDiff = 'n';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_sout", type="time", nullable=true)
     */
    private $heureSout;

    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="sout_rapport", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $soutRapport = '0.00';
    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="sout_avancement", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $soutAvancement = '0.00';
    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="sout_competences", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $soutCompetences = '0.00';
    /**
     * @var string|null
     *
     * @ORM\Column(name="note_sout", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $noteSout = '0.00';

    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="poster_rapport", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $posterRapport = '0.00';
    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="poster_avancement", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $posterAvancement = '0.00';
    // /**
    //  * @var string|null
    //  *
    //  * @ORM\Column(name="poster_competences", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
    //  */
    // private $posterCompetences = '0.00';
    /**
     * @var string|null
     *
     * @ORM\Column(name="note_poster", type="decimal", precision=4, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $notePoster = '0.00';

    /**
     * @var \DateExcep
     *
     * @ORM\ManyToOne(targetEntity="DateExcep")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_date_excep", referencedColumnName="id_date_excep")
     * })
     */
    private $idDateExcep;

    /**
     * @var \Projet
     *
     * @ORM\ManyToOne(targetEntity="Projet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_projet", referencedColumnName="id")
     * })
     */
    private $idProjet;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HorairePoster", inversedBy="idGroupe")
     * @ORM\JoinTable(name="creneaux_poster",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_tranche_post", referencedColumnName="id")
     *   }
     * )
     */
    private $idTranchePost;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HoraireSoutenance", inversedBy="idGroupe")
     * @ORM\JoinTable(name="creneaux_soutenance",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_tranche_sout", referencedColumnName="id")
     *   }
     * )
     */
    private $idTrancheSout;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idGroupeEvalPost")
     * @ORM\JoinTable(name="eval_poster",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe_eval_post", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_eval_post", referencedColumnName="id_user")
     *   }
     * )
     */
    private $idEvalPost;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idGroupeEvalSout")
     * @ORM\JoinTable(name="eval_sout",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe_eval_sout", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_eval_sout", referencedColumnName="id_user")
     *   }
     * )
     */
    private $idEvalSout;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Projet", inversedBy="idGroupe")
     * @ORM\JoinTable(name="voeux",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_projet_voeux", referencedColumnName="id")
     *   }
     * )
     */
    private $idProjetVoeux;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTranchePost = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idTrancheSout = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idEvalPost = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idEvalSout = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idProjetVoeux = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDureeDiff(): ?string
    {
        return $this->dureeDiff;
    }

    public function setDureeDiff(string $dureeDiff): self
    {
        $this->dureeDiff = $dureeDiff;

        return $this;
    }

    public function getHeureSout(): ?\DateTimeInterface
    {
        return $this->heureSout;
    }

    public function setHeureSout(?\DateTimeInterface $heureSout): self
    {
        $this->heureSout = $heureSout;

        return $this;
    }

    // public function getSoutRapport(): ?string
    // {
    //     return $this->soutRapport;
    // }

    // public function setSoutRapport(?string $soutRapport): self
    // {
    //     $this->soutRapport = $soutRapport;

    //     return $this;
    // }

    // public function getSoutAvancement(): ?string
    // {
    //     return $this->soutAvancement;
    // }

    // public function setSoutAvancement(?string $soutAvancement): self
    // {
    //     $this->soutAvancement = $soutAvancement;

    //     return $this;
    // }

    // public function getSoutCompetences(): ?string
    // {
    //     return $this->soutCompetences;
    // }

    // public function setSoutCompetences(?string $soutCompetences): self
    // {
    //     $this->soutCompetences = $soutCompetences;

    //     return $this;
    // }

    // public function getposterRapport(): ?string
    // {
    //     return $this->posterRapport;
    // }

    // public function setposterRapport(?string $posterRapport): self
    // {
    //     $this->posterRapport = $posterRapport;

    //     return $this;
    // }

    // public function getPosterAvancement(): ?string
    // {
    //     return $this->posterAvancement;
    // }

    // public function setPosterAvancement(?string $posterAvancement): self
    // {
    //     $this->posterAvancement = $posterAvancement;

    //     return $this;
    // }

    // public function getPosterCompetences(): ?string
    // {
    //     return $this->posterCompetences;
    // }

    // public function setPosterCompetences(?string $posterCompetences): self
    // {
    //     $this->posterCompetences = $posterCompetences;

    //     return $this;
    // }

    public function getNoteSout(): ?string
    {
        return $this->noteSout;
    }

    public function setNoteSout(?string $noteSout): self
    {
        $this->noteSout = $noteSout;

        return $this;
    }

    public function getNotePoster(): ?string
    {
        return $this->notePoster;
    }

    public function setNotePoster(?string $notePoster): self
    {
        $this->notePoster = $notePoster;

        return $this;
    }

    // public function getIdDateExcep(): ?DateExcep
    // {
    //     return $this->idDateExcep;
    // }

    public function setIdDateExcep(?DateExcep $idDateExcep): self
    {
        $this->idDateExcep = $idDateExcep;

        return $this;
    }

    public function getIdProjet()
    {
        return $this->idProjet;
    }

    public function setIdProjet(?Projet $idProjet): self
    {
        $this->idProjet = $idProjet;

        return $this;
    }

    /**
     * @return Collection|HorairePoster[]
     */
    public function getIdTranchePost(): Collection
    {
        return $this->idTranchePost;
    }

    public function addIdTranchePost(HorairePoster $idTranchePost): self
    {
        if (!$this->idTranchePost->contains($idTranchePost)) {
            $this->idTranchePost[] = $idTranchePost;
        }

        return $this;
    }

    public function removeIdTranchePost(HorairePoster $idTranchePost): self
    {
        $this->idTranchePost->removeElement($idTranchePost);

        return $this;
    }

    /**
     * @return Collection|HoraireSoutenance[]
     */
    public function getIdTrancheSout(): Collection
    {
        return $this->idTrancheSout;
    }

    public function addIdTrancheSout(HoraireSoutenance $idTrancheSout): self
    {
        if (!$this->idTrancheSout->contains($idTrancheSout)) {
            $this->idTrancheSout[] = $idTrancheSout;
        }

        return $this;
    }

    public function removeIdTrancheSout(HoraireSoutenance $idTrancheSout): self
    {
        $this->idTrancheSout->removeElement($idTrancheSout);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdEvalPost(): Collection
    {
        return $this->idEvalPost;
    }

    public function addIdEvalPost(User $idEvalPost): self
    {
        if (!$this->idEvalPost->contains($idEvalPost)) {
            $this->idEvalPost[] = $idEvalPost;
        }

        return $this;
    }

    public function removeIdEvalPost(User $idEvalPost): self
    {
        $this->idEvalPost->removeElement($idEvalPost);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdEvalSout(): Collection
    {
        return $this->idEvalSout;
    }

    public function addIdEvalSout(User $idEvalSout): self
    {
        if (!$this->idEvalSout->contains($idEvalSout)) {
            $this->idEvalSout[] = $idEvalSout;
        }

        return $this;
    }

    public function removeIdEvalSout(User $idEvalSout): self
    {
        $this->idEvalSout->removeElement($idEvalSout);

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getIdProjetVoeux(): Collection
    {
        return $this->idProjetVoeux;
    }

    public function addIdProjetVoeux(Projet $idProjetVoeux): self
    {
        if (!$this->idProjetVoeux->contains($idProjetVoeux)) {
            $this->idProjetVoeux[] = $idProjetVoeux;
        }

        return $this;
    }

    public function removeIdProjetVoeux(Projet $idProjetVoeux): self
    {
        $this->idProjetVoeux->removeElement($idProjetVoeux);

        return $this;
    }

}
