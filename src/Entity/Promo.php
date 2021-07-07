<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table(name="promo", indexes={@ORM\Index(name="id_coeff", columns={"id_coeff"})})
 * @ORM\Entity
 */
class Promo
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
     * @ORM\Column(name="annee_univ", type="string", nullable=false)
     */
    private $anneeUniv;

    /**
     * @var string
     *
     * @ORM\Column(name="type_promo", type="string", length=0, nullable=false)
     */
    private $typePromo;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_promo", type="string", length=30, nullable=false)
     */
    private $nomPromo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_deb", type="date", nullable=true)
     */
    private $dateDeb;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_sout", type="date", nullable=true)
     */
    private $dateSout;

    /**
     * @var \Coeff
     *
     * @ORM\ManyToOne(targetEntity="Coeff")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_coeff", referencedColumnName="id_coeff")
     * })
     */
    private $idCoeff;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeUniv(): ?string
    {
        return $this->anneeUniv;
    }

    public function setAnneeUniv(\DateTimeInterface $anneeUniv): self
    {
        $this->anneeUniv = $anneeUniv;

        return $this;
    }

    public function getTypePromo(): ?string
    {
        return $this->typePromo;
    }

    public function setTypePromo(array $typePromo): self
    {
        $this->typePromo = $typePromo;

        return $this;
    }

    public function getNomPromo(): ?string
    {
        return $this->nomPromo;
    }

    public function setNomPromo(string $nomPromo): self
    {
        $this->nomPromo = $nomPromo;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateSout(): ?\DateTimeInterface
    {
        return $this->dateSout;
    }

    public function setDateSout(?\DateTimeInterface $dateSout): self
    {
        $this->dateSout = $dateSout;

        return $this;
    }

    // public function getIdCoeff(): ?Coeff
    // {
    //     return $this->idCoeff;
    // }

    public function setIdCoeff(?Coeff $idCoeff): self
    {
        $this->idCoeff = $idCoeff;

        return $this;
    }


}
