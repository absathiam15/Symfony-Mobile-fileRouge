<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/** 
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"trans:read", "trans:write"})
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trans:read", "trans:write"})
     */
    public $nomComplet;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trans:read", "trans:write"})
     */
    public $telephone;

    /**
     * @ORM\Column(type="integer", length=)
     * @Groups({"trans:read", "trans:write"})
     */
    public $numCni;

    /**
     * @ORM\OneToMany(targetEntity=Transactions::class, mappedBy="clients")
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=Transactions::class, mappedBy="clientDepot")
     */
    private $transactionDepot;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->transactionDepot = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
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

    public function getNumCni(): ?string
    {
        return $this->numCni;
    }

    public function setNumCni(string $numCni): self
    {
        $this->numCni = $numCni;

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
            $transaction->setClients($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getClients() === $this) {
                $transaction->setClients(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transactions[]
     */
    public function getTransactionDepot(): Collection
    {
        return $this->transactionDepot;
    }

    public function addTransactionDepot(Transactions $transactionDepot): self
    {
        if (!$this->transactionDepot->contains($transactionDepot)) {
            $this->transactionDepot[] = $transactionDepot;
            $transactionDepot->setClientDepot($this);
        }

        return $this;
    }

    public function removeTransactionDepot(Transactions $transactionDepot): self
    {
        if ($this->transactionDepot->removeElement($transactionDepot)) {
            // set the owning side to null (unless already changed)
            if ($transactionDepot->getClientDepot() === $this) {
                $transactionDepot->setClientDepot(null);
            }
        }

        return $this;
    }
}
