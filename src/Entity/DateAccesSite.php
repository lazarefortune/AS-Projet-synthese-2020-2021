<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateAccesSite
 *
 * @ORM\Table(name="date_acces_site")
 * @ORM\Entity
 */
class DateAccesSite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_d_site", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDSite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="id_co", type="integer", nullable=false)
     */
    private $idCo;

    public function getIdDSite(): ?int
    {
        return $this->idDSite;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getIdCo(): ?int
    {
        return $this->idCo;
    }

    public function setIdCo(int $idCo): self
    {
        $this->idCo = $idCo;

        return $this;
    }


}
