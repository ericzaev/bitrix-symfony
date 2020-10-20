<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="b_group")
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 */
class Group
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="TIMESTAMP_X", type="datetime", nullable=true)
     */
    private $timestampX;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $active = 'Y';

    /**
     * @var int
     *
     * @ORM\Column(name="C_SORT", type="integer", nullable=false, options={"default"="100"})
     */
    private $cSort = '100';

    /**
     * @var string
     *
     * @ORM\Column(name="ANONYMOUS", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $anonymous = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="IS_SYSTEM", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $isSystem = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECURITY_POLICY", type="text", length=65535, nullable=true)
     */
    private $securityPolicy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="STRING_ID", type="string", length=255, nullable=true)
     */
    private $stringId;

    /**
     * @ORM\OneToMany(targetEntity=User\Group::class, cascade={"persist"}, mappedBy="group", orphanRemoval=true)
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

    public function getTimestampX(): ?\DateTimeInterface
    {
        return $this->timestampX;
    }

    public function setTimestampX(?\DateTimeInterface $timestampX): self
    {
        $this->timestampX = $timestampX;

        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCSort(): ?int
    {
        return $this->cSort;
    }

    public function setCSort(int $cSort): self
    {
        $this->cSort = $cSort;

        return $this;
    }

    public function getAnonymous(): ?string
    {
        return $this->anonymous;
    }

    public function setAnonymous(string $anonymous): self
    {
        $this->anonymous = $anonymous;

        return $this;
    }

    public function getIsSystem(): ?string
    {
        return $this->isSystem;
    }

    public function setIsSystem(string $isSystem): self
    {
        $this->isSystem = $isSystem;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSecurityPolicy(): ?array
    {
        return unserialize($this->securityPolicy);
    }

    public function setSecurityPolicy(array $securityPolicy): self
    {
        $this->securityPolicy = serialize($securityPolicy);

        return $this;
    }

    public function getStringId(): ?string
    {
        return $this->stringId;
    }

    public function setStringId(?string $stringId): self
    {
        $this->stringId = $stringId;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}
