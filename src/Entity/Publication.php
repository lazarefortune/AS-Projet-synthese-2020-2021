<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication", indexes={@ORM\Index(name="id_promo", columns={"id_promo"})})
 * @ORM\Entity
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_publication", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idPublication;

    /**
     * @var int
     *
     * @ORM\Column(name="visibilite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $visibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_publication", type="string", length=150, nullable=false)
     */
    private $titrePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=false)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="url_publication", type="string", length=255, nullable=false)
     */
    private $urlPublication;

    /**
     * @var \Promo
     *
     * @ORM\ManyToOne(targetEntity="Promo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promo", referencedColumnName="id")
     * })
     */
    private $idPromo;

    public function getIdPublication(): ?int
    {
        return $this->idPublication;
    }

    public function getVisibilite(): ?int
    {
        return $this->visibilite;
    }

    public function getTitrePublication(): ?string
    {
        return $this->titrePublication;
    }

    public function setTitrePublication(string $titrePublication): self
    {
        $this->titrePublication = $titrePublication;

        return $this;
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

    public function getUrlPublication(): ?string
    {
        return $this->urlPublication;
    }

    public function setUrlPublication(string $urlPublication): self
    {
        $this->urlPublication = $urlPublication;

        return $this;
    }

    // public function getIdPromo(): ?Promo
    // {
    //     return $this->idPromo;
    // }

    public function setIdPromo(?Promo $idPromo): self
    {
        $this->idPromo = $idPromo;

        return $this;
    }


}
