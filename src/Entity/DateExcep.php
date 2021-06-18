<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateExcep
 *
 * @ORM\Table(name="date_excep")
 * @ORM\Entity
 */
class DateExcep
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_date_excep", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDateExcep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb_excep", type="date", nullable=false)
     */
    private $dateDebExcep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_excep", type="date", nullable=false)
     */
    private $dateFinExcep;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_sout_excep", type="date", nullable=true)
     */
    private $dateSoutExcep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarque", type="string", length=30, nullable=true)
     */
    private $remarque;

    public function getIdDateExcep(): ?int
    {
        return $this->idDateExcep;
    }

    public function getDateDebExcep(): ?\DateTimeInterface
    {
        return $this->dateDebExcep;
    }

    public function setDateDebExcep(\DateTimeInterface $dateDebExcep): self
    {
        $this->dateDebExcep = $dateDebExcep;

        return $this;
    }

    public function getDateFinExcep(): ?\DateTimeInterface
    {
        return $this->dateFinExcep;
    }

    public function setDateFinExcep(\DateTimeInterface $dateFinExcep): self
    {
        $this->dateFinExcep = $dateFinExcep;

        return $this;
    }

    public function getDateSoutExcep(): ?\DateTimeInterface
    {
        return $this->dateSoutExcep;
    }

    public function setDateSoutExcep(?\DateTimeInterface $dateSoutExcep): self
    {
        $this->dateSoutExcep = $dateSoutExcep;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }


}
