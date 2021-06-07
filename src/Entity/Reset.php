<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reset
 *
 * @ORM\Table(name="reset")
 * @ORM\Entity
 */
class Reset
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="reset_key", type="string", length=100, nullable=false)
     */
    private $resetKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expiration", type="datetime", nullable=false)
     */
    private $dateExpiration;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getResetKey(): ?string
    {
        return $this->resetKey;
    }

    public function setResetKey(string $resetKey): self
    {
        $this->resetKey = $resetKey;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }


}
