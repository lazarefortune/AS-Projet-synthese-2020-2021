<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeConnexion
 *
 * @ORM\Table(name="type_connexion")
 * @ORM\Entity
 */
class TypeConnexion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_typeco", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeco;

    /**
     * @var string
     *
     * @ORM\Column(name="type_co", type="string", length=30, nullable=false)
     */
    private $typeCo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    public function getIdTypeco(): ?int
    {
        return $this->idTypeco;
    }

    public function getTypeCo(): ?string
    {
        return $this->typeCo;
    }

    public function setTypeCo(string $typeCo): self
    {
        $this->typeCo = $typeCo;

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


}
