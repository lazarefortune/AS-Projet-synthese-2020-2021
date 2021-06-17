<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coeff
 *
 * @ORM\Table(name="coeff")
 * @ORM\Entity
 */
class Coeff
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_coeff", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCoeff;

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_tut_rapport", type="smallint", nullable=false, options={"default"="1"})
     */
    private $coeffTutRapport = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_tut_trav", type="smallint", nullable=false, options={"default"="2"})
     */
    private $coeffTutTrav = '2';

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_tut_compet", type="smallint", nullable=false, options={"default"="2"})
     */
    private $coeffTutCompet = '2';

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_sout_qual", type="smallint", nullable=false, options={"default"="1"})
     */
    private $coeffSoutQual = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_sout_trav", type="smallint", nullable=false, options={"default"="1"})
     */
    private $coeffSoutTrav = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="coeff_sout_compet", type="smallint", nullable=false, options={"default"="1"})
     */
    private $coeffSoutCompet = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="coeff_poster_qual", type="smallint", nullable=true, options={"default"="1"})
     */
    private $coeffPosterQual = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="coeff_poster_trav", type="smallint", nullable=true, options={"default"="1"})
     */
    private $coeffPosterTrav = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="coeff_poster_compet", type="smallint", nullable=true, options={"default"="1"})
     */
    private $coeffPosterCompet = '1';

    public function getIdCoeff(): ?int
    {
        return $this->idCoeff;
    }

    public function getCoeffTutRapport(): ?int
    {
        return $this->coeffTutRapport;
    }

    public function setCoeffTutRapport(int $coeffTutRapport): self
    {
        $this->coeffTutRapport = $coeffTutRapport;

        return $this;
    }

    public function getCoeffTutTrav(): ?int
    {
        return $this->coeffTutTrav;
    }

    public function setCoeffTutTrav(int $coeffTutTrav): self
    {
        $this->coeffTutTrav = $coeffTutTrav;

        return $this;
    }

    public function getCoeffTutCompet(): ?int
    {
        return $this->coeffTutCompet;
    }

    public function setCoeffTutCompet(int $coeffTutCompet): self
    {
        $this->coeffTutCompet = $coeffTutCompet;

        return $this;
    }

    public function getCoeffSoutQual(): ?int
    {
        return $this->coeffSoutQual;
    }

    public function setCoeffSoutQual(int $coeffSoutQual): self
    {
        $this->coeffSoutQual = $coeffSoutQual;

        return $this;
    }

    public function getCoeffSoutTrav(): ?int
    {
        return $this->coeffSoutTrav;
    }

    public function setCoeffSoutTrav(int $coeffSoutTrav): self
    {
        $this->coeffSoutTrav = $coeffSoutTrav;

        return $this;
    }

    public function getCoeffSoutCompet(): ?int
    {
        return $this->coeffSoutCompet;
    }

    public function setCoeffSoutCompet(int $coeffSoutCompet): self
    {
        $this->coeffSoutCompet = $coeffSoutCompet;

        return $this;
    }

    public function getCoeffPosterQual(): ?int
    {
        return $this->coeffPosterQual;
    }

    public function setCoeffPosterQual(?int $coeffPosterQual): self
    {
        $this->coeffPosterQual = $coeffPosterQual;

        return $this;
    }

    public function getCoeffPosterTrav(): ?int
    {
        return $this->coeffPosterTrav;
    }

    public function setCoeffPosterTrav(?int $coeffPosterTrav): self
    {
        $this->coeffPosterTrav = $coeffPosterTrav;

        return $this;
    }

    public function getCoeffPosterCompet(): ?int
    {
        return $this->coeffPosterCompet;
    }

    public function setCoeffPosterCompet(?int $coeffPosterCompet): self
    {
        $this->coeffPosterCompet = $coeffPosterCompet;

        return $this;
    }


}
