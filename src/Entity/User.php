<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="text", length=65535, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="login", type="text", length=65535, nullable=true)
     */
    private $login;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="text", length=65535, nullable=true)
     */
    private $password;
    
    /**
     // * @var json
     *
     * @ORM\Column(name="roles", type="json", nullable=false)
     */
    private $roles = [];

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Projet", mappedBy="idEval")
     */
    private $idProjet;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idEvalPost")
     */
    private $idGroupeEvalPost;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idEvalSout")
     */
    private $idGroupeEvalSout;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProjet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGroupeEvalPost = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGroupeEvalSout = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $id): self
    {
        $this->idUser = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    // public function getRoles(): ?array
    // {
    //     return $this->roles;
    // }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    

    /**
     * @return Collection|Projet[]
     */
    public function getIdProjet(): Collection
    {
        return $this->idProjet;
    }

    public function addIdProjet(Projet $idProjet): self
    {
        if (!$this->idProjet->contains($idProjet)) {
            $this->idProjet[] = $idProjet;
            $idProjet->addIdEval($this);
        }

        return $this;
    }

    public function removeIdProjet(Projet $idProjet): self
    {
        if ($this->idProjet->removeElement($idProjet)) {
            $idProjet->removeIdEval($this);
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getIdGroupeEvalPost(): Collection
    {
        return $this->idGroupeEvalPost;
    }

    public function addIdGroupeEvalPost(Groupe $idGroupeEvalPost): self
    {
        if (!$this->idGroupeEvalPost->contains($idGroupeEvalPost)) {
            $this->idGroupeEvalPost[] = $idGroupeEvalPost;
            $idGroupeEvalPost->addIdEvalPost($this);
        }

        return $this;
    }

    public function removeIdGroupeEvalPost(Groupe $idGroupeEvalPost): self
    {
        if ($this->idGroupeEvalPost->removeElement($idGroupeEvalPost)) {
            $idGroupeEvalPost->removeIdEvalPost($this);
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getIdGroupeEvalSout(): Collection
    {
        return $this->idGroupeEvalSout;
    }

    public function addIdGroupeEvalSout(Groupe $idGroupeEvalSout): self
    {
        if (!$this->idGroupeEvalSout->contains($idGroupeEvalSout)) {
            $this->idGroupeEvalSout[] = $idGroupeEvalSout;
            $idGroupeEvalSout->addIdEvalSout($this);
        }

        return $this;
    }

    public function removeIdGroupeEvalSout(Groupe $idGroupeEvalSout): self
    {
        if ($this->idGroupeEvalSout->removeElement($idGroupeEvalSout)) {
            $idGroupeEvalSout->removeIdEvalSout($this);
        }

        return $this;
    }

    public function leadProject(): bool
    {
        return !$this->getIdProjet()->isEmpty();
    }
}
