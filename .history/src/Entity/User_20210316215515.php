<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({ "user" = "User", "adminSystem" = "AdminSystem", "adminAgence" = "AdminAgence", "caissier" = "Caissier", "userAgence" = "UserAgence"})
 *
 *
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_ADMIN_SYSTEM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      },
 *   collectionOperations={
 *      "get_admin_user" = {
 *          "method" = "GET",
 *          "path" = "admin/users",
 *          "normalization_context"={"groups":"user:read"}
 *          },
 *     "addUser" = {
 *          "method" = "POST",
 *          "path" = "admin/users",
 *          "denormalization_context"={"groups"={"user:write"}},
 *          "security"="is_granted('ROLE_ADMIN_SYSTEM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      }
 *     },
 *     itemOperations={
 *      "delete",
 *      "get_userById" = {
 *          "method" = "GET",
 *          "path" = "admin/users/{id}",
 *          "normalization_context"={"groups":"users:read"}
 *        },
 *      "delete_user" = {
 *            "method" = "Delete",
 *            "path" = "admin/users/{id}"
 *        }
 *    }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"trans:read", "trans:write", "agence:write", "agence:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:write", "agence:write", "agence:read"})
     */
    protected $username;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:write", "agence:write", "agence:read"})
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trans:read", "trans:write", "user:write", "agence:write", "agence:read"})
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trans:read", "trans:write", "user:write", "agence:write", "agence:read"})
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"trans:read", "trans:write", "user:write", "agence:write", "agence:read"})
     * @Assert\NotBlank (message="Le ")
     * @Assert\Length(
     *   min=9,
     *   max=9,
     *   minMessage="Saisissez au minimum 9 cacactères",
     *   maxMessage="Saisissez au maximum 9 caractères"
     * )
     */
    protected $telephone;

    /**
     * @ORM\Column(type="boolean")
     */ 
    protected $statut = 0;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:write", "agence:write", "agence:read"})
     */
    protected $email;


    /**
     * @ORM\OneToMany(targetEntity=Comptes::class, mappedBy="user", cascade={"persist"})
     * @Groups({"user:write"})
     */
    private $comptes;


    /** 
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="users")*
     * @Groups({"user:write"})
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups({"user:write", "agence:write", "agence:read"})
     */
    private $profil;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted = 0;

    /**
     * @ORM\OneToMany(targetEntity=Transactions::class, mappedBy="user")
     */
    private $transactions;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_';
       $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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
     * @return Collection|Comptes[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Comptes $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setUser($this);
        }

        return $this;
    }

    public function removeCompte(Comptes $compte): self
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getUser() === $this) {
                $compte->setUser(null);
            }
        }

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

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

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
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }
}
