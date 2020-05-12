<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"},message="Username que vous avez indique est deja utilise !")
 * @UniqueEntity(fields={"email"},message="L'Email que vous avez indique est deja utilise !")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="votre mots de passe doit depasser 8 caracteres")
     * @Assert\EqualTo(propertyPath="confirm_password",message="vous n'avez pas taper le meme mots de passe ")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password",message="vous n'avez pas taper le meme mots de passe")
     */

    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(message="L'Email que vous avez indique n'est pas valide !")
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
    public  function  getRoles()
    {
        return [
            'ROLE_USER'
        ];
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public  function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->email,
                $this->password
            ]
        );
    }
    public function unserialize($string)
    {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password
            )= unserialize($string,['allowed_classes'=> false]);

    }
}
