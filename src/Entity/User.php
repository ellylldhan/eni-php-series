<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column (type="string", length=50)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private $password;

    /**
     * @var \DateTime
     * @ORM\Column (type="datetime")
     */
    private $dateCreated;

    // On va pas la stocker. Pas d'annotation = pas de colone en bdd
    private $roles;

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoles() {
        return ["ROLE_USER"];
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated): void {
        $this->dateCreated = $dateCreated;
    }

    // on s'en sert pas donc return null
    public function getSalt() {
        return null;
    }

    // Pareil, pas utile
    public function eraseCredentials() {
    }


}
