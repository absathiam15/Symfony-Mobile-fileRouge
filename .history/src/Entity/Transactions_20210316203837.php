<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"trans:read"}},
 *     denormalizationContext={"groups"={"trans:write"}},
 *     collectionOperations={
 *
 *      "get_user_frais_montant" = {
 *          "method" = "GET",
 *          "path" = "/users/frais/montant",
 *          "normalization_context"={"groups":"TransMontant:read"}
 *         },
 *      "depotTransaction" = {
 *          "method" = "POST",
 *          "path" = "/users/comptes/depots",
 *          }
 *     },
 *     itemOperations={
 *"get_admin_user" = {
 *          "method" = "GET",
 *          "path" = "/users/transactions/code/{id}",
 *          "normalization_context"={"groups":"trans:read"}
 *          },
 *    }
 * )
 * @ORM\Entity(repositoryClass=TransactionsRepository::class)
 */
class Transactions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    public $id;
 
    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     * @Assert\NotBlank(message = "Le montant est obligatoire")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     * @Assert\NotBlank (message="La date de depot est obligatoire")
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="date")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $codeTransaction;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $frais;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $fraisDepot;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $fraisRetrait;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $fraisEtat;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    private $fraisSystem;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="transactions", cascade={"persist"})
     * @Groups({"compt:read", "TransMontant:read", "trans:write"})
     *
     */
    public $clients;

    /**
     * @ORM\ManyToOne(targetEntity=Comptes::class, inversedBy="transactions")
     *  @Groups({"compt:read", "TransMontant:read", "trans:write"})
     */
    public $comptes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="transactions")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getCodeTransaction(): ?string
    {
        return $this->codeTransaction;
    }

    public function setCodeTransaction(string $codeTransaction): self
    {
        $this->codeTransaction = $codeTransaction;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getFraisDepot(): ?int
    {
        return $this->fraisDepot;
    }

    public function setFraisDepot(int $fraisDepot): self
    {
        $this->fraisDepot = $fraisDepot;

        return $this;
    }

    public function getFraisRetrait(): ?int
    {
        return $this->fraisRetrait;
    }

    public function setFraisRetrait(int $fraisRetrait): self
    {
        $this->fraisRetrait = $fraisRetrait;

        return $this;
    }

    public function getFraisEtat(): ?int
    {
        return $this->fraisEtat;
    }

    public function setFraisEtat(int $fraisEtat): self
    {
        $this->fraisEtat = $fraisEtat;

        return $this;
    }

    public function getFraisSystem(): ?int
    {
        return $this->fraisSystem;
    }

    public function setFraisSystem(int $fraisSystem): self
    {
        $this->fraisSystem = $fraisSystem;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getComptes(): ?Comptes
    {
        return $this->comptes;
    }

    public function setComptes(?Comptes $comptes): self
    {
        $this->comptes = $comptes;

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
}
