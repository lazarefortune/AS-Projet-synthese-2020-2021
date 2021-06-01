<?php

namespace App\Entity;

use App\Repository\EvaluateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=EvaluateurRepository::class)
 */
class Evaluateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_eval;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3,max=10, minMessage="minErrorMessage",maxMessage="Votre nom est trop long")
     */
    private $nom_eval;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_eval;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $login;



    public function getIdEval(): ?int
    {
        return $this->id_eval;
    }

    public function getNomEval(): ?string
    {
        return $this->nom_eval;
    }

    public function setNomEval(string $nom_eval): self
    {
        $this->nom_eval = $nom_eval;

        return $this;
    }

    public function getPrenomEval(): ?string
    {
        return $this->prenom_eval;
    }

    public function setPrenomEval(string $prenom_eval): self
    {
        $this->prenom_eval = $prenom_eval;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    
}
