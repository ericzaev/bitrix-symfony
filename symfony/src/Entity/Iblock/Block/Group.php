<?php

namespace App\Entity\Iblock\Block;

use App\Entity\Iblock\Block;
use App\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="b_iblock_group")
 * @ORM\Entity
 */
class Group
{
    /**
     * @var int
     *
     * @ORM\Column(name="IBLOCK_ID", type="integer")
     */
    private $iblockId;

    /**
     * @var int
     *
     * @ORM\Column(name="GROUP_ID", type="integer")
     */
    private $groupId;

    /**
     * @var string
     *
     * @ORM\Column(name="PERMISSION", type="string")
     */
    private $permission;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Block::class, inversedBy="groups")
     * @ORM\JoinColumn(name="IBLOCK_ID", referencedColumnName="ID", nullable=false)
     */
    private $block;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=BaseGroup::class, inversedBy="users")
     * @ORM\JoinColumn(name="GROUP_ID", referencedColumnName="ID", nullable=false)
     */
    private $group;

    public function getIblockId(): ?int
    {
        return $this->iblockId;
    }

    public function setIblockId(int $iblockId): self
    {
        $this->iblockId = $iblockId;

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

    public function getPermission(): ?string
    {
        return $this->permission;
    }

    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    public function getBlock(): ?Block
    {
        return $this->block;
    }

    public function setBlock(?Block $block): self
    {
        $this->block = $block;

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
}