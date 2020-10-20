<?php

namespace App\Entity\User;

use App\Entity\User;
use App\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="b_user_group")
 * @ORM\Entity
 */
class Group
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="USER_ID", type="integer")
     */
    private $userId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="GROUP_ID", type="integer")
     */
    private $groupId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_ACTIVE_FROM", type="datetime", nullable=true)
     */
    private $dateActiveFrom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_ACTIVE_TO", type="datetime", nullable=true)
     */
    private $dateActiveTo;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groups")
     * @ORM\JoinColumn(name="USER_ID", referencedColumnName="ID", nullable=false)
     */
    private $user;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=BaseGroup::class, inversedBy="users")
     * @ORM\JoinColumn(name="GROUP_ID", referencedColumnName="ID", nullable=false)
     */
    private $group;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGroup(): ?BaseGroup
    {
        return $this->group;
    }

    public function setGroup(?BaseGroup $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getDateActiveFrom(): ?\DateTimeInterface
    {
        return $this->dateActiveFrom;
    }

    public function setDateActiveFrom(?\DateTimeInterface $dateActiveFrom): self
    {
        $this->dateActiveFrom = $dateActiveFrom;

        return $this;
    }

    public function getDateActiveTo(): ?\DateTimeInterface
    {
        return $this->dateActiveTo;
    }

    public function setDateActiveTo(?\DateTimeInterface $dateActiveTo): self
    {
        $this->dateActiveTo = $dateActiveTo;

        return $this;
    }

    public function isActive(): bool
    {
        return (is_null($this->getDateActiveFrom()) || $this->getDateActiveFrom() <= new \DateTime()) &&
            (is_null($this->getDateActiveTo()) || $this->getDateActiveTo() >= new \DateTime());
    }
}