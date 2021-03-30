<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ComptesRepository;
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
 *     "addComptes" = {
 *          "method" = "POST",
 *          "path" = "/comptes",
 *          "denormalization_context"={"groups"={"comptes:write"}},
 *          "security"="is_granted('ROLE_ADMIN_SYSTEM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      }
 *     }
 * )
 * @ORM\Entity(repositoryClass=ComptesRepository::class)
 */
class Comptes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"compt:read", "comptes:write"})
     */
    private $numComptes;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "comptes:write", "agence:write"})
     */
    private $solde;

    /**
     * @ORM\Column(type="date")
     * @Groups({"compt:read", "comptes:write"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut = 0;

    /**
     * @ORM\OneToMany(targetEntity=Transactions::class, mappedBy="comptes")
     * @Groups({"compt:read", "comptes:write"})
     */
    private $transactions;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comptes")
     * @Groups({"compt:read", "comptes:write"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Agence::class, cascade={"persist", "remove"})
     * @Groups({"compt:read", "comptes:write"})
     */
    private $agence;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumComptes(): ?string
    {
        return $this->numComptes;
    }

    public function setNumComptes(string $numComptes): self
    {
        $this->numComptes = $numComptes;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Transactions[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transactions $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setComptes($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getComptes() === $this) {
                $transaction->setComptes(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
}
