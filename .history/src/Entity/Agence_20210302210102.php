<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * routePrefix = "/admin",
 * attributes={
 *          "security"="is_granted('ROLE_ADMIN_SYSTEM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      },
 *   collectionOperations={
 *      "get_admin_user" = {
 *          "method" = "GET",
 *          "path" = "/users",
 *          "normalization_context"={"groups":"user:read"}
 *          },
 *     "add_Agence" = {
 *          "method" = "POST",
 *          "path" = "/agences",
 *          "denormalization_context"={"groups"={"agence:write"}},
 *          "security"="is_granted('ROLE_ADMIN_SYSTEM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      }
 *     }
 * )
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"agence:write"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"agence:write"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="float")
     * @Groups({"agence:write"})
     */
    private $lattitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"agence:write"})
     */
    private $longitude;
 
    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="agence", cascade={"persist"})
     * @Groups({"agence:write"})
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLattitude(): ?float
    {
        return $this->lattitude;
    }

    public function setLattitude(float $lattitude): self
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAgence($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAgence() === $this) {
                $user->setAgence(null);
            }
        }

        return $this;
    }
}
