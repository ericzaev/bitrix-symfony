<?php

namespace App\Entity\Iblock\Element;

use App\Entity\File;
use App\Entity\Iblock\Element;
use App\Entity\Iblock\Property as IblockProperty;
use App\Entity\Iblock\Property\Enum;
use App\Entity\Iblock\Section;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\Element\PropertyRepository;

/**
 * @ORM\Table(name="b_iblock_element_property", indexes={@ORM\Index(name="ix_iblock_element_property_1", columns={"IBLOCK_ELEMENT_ID", "IBLOCK_PROPERTY_ID"}), @ORM\Index(name="ix_iblock_element_property_2", columns={"IBLOCK_PROPERTY_ID"}), @ORM\Index(name="ix_iblock_element_prop_enum", columns={"VALUE_ENUM", "IBLOCK_PROPERTY_ID"}), @ORM\Index(name="ix_iblock_element_prop_num", columns={"VALUE_NUM", "IBLOCK_PROPERTY_ID"})})
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
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
     * @var int
     *
     * @ORM\Column(name="IBLOCK_PROPERTY_ID", type="integer", nullable=false)
     */
    private $iblockPropertyId;

    /**
     * @var int
     *
     * @ORM\Column(name="IBLOCK_ELEMENT_ID", type="integer", nullable=false)
     */
    private $iblockElementId;

    /**
     * @var string
     *
     * @ORM\Column(name="VALUE", type="text", length=65535, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="VALUE_TYPE", type="string", length=4, nullable=false, options={"default"="text","fixed"=true})
     */
    private $valueType = 'text';

    /**
     * @var string|null
     *
     * @ORM\Column(name="VALUE_NUM", type="decimal", precision=18, scale=4, nullable=true)
     */
    private $valueNum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="VALUE", referencedColumnName="ID")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="VALUE", referencedColumnName="ID")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Element::class, inversedBy="properties")
     * @ORM\JoinColumn(name="VALUE", referencedColumnName="ID")
     */
    private $element;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class)
     * @ORM\JoinColumn(name="VALUE", referencedColumnName="ID")
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity=Enum::class)
     * @ORM\JoinColumn(name="VALUE_ENUM", referencedColumnName="ID")
     */
    private $valueEnum;

    /**
     * @ORM\ManyToOne(targetEntity=Element::class, inversedBy="properties")
     * @ORM\JoinColumn(name="IBLOCK_ELEMENT_ID", referencedColumnName="ID")
     */
    private $iblockElement;

    /**
     * @ORM\ManyToOne(targetEntity=IblockProperty::class)
     * @ORM\JoinColumn(name="IBLOCK_PROPERTY_ID", referencedColumnName="ID")
     */
    private $iblockProperty;

    public function __construct()
    {
        $this->iblockProperty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        if ($property = $this->getIblockProperty()) {
            return $property->getPropertyType();
        }

        return null;
    }

    public function getUserType(): ?string
    {
        if ($property = $this->getIblockProperty()) {
            return $property->getUserType();
        }

        return null;
    }

    public function getIblockPropertyId(): ?int
    {
        return $this->iblockPropertyId;
    }

    public function setIblockPropertyId(int $iblockPropertyId): self
    {
        $this->iblockPropertyId = $iblockPropertyId;

        return $this;
    }

    public function getIblockElementId(): ?int
    {
        return $this->iblockElementId;
    }

    public function setIblockElementId(int $iblockElementId): self
    {
        $this->iblockElementId = $iblockElementId;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getValueType(): ?string
    {
        return $this->valueType;
    }

    public function setValueType(string $valueType): self
    {
        $this->valueType = $valueType;

        return $this;
    }

    public function getValueNum(): ?string
    {
        return $this->valueNum;
    }

    public function setValueNum(?string $valueNum): self
    {
        $this->valueNum = $valueNum;

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

    public function getUser(): ?User
    {
        if ($this->getUserType() === 'UserID') {
            return $this->user;
        }

        return null;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFile(): ?File
    {
        if ($this->getType() === 'F') {
            return $this->file;
        }

        return null;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getElement(): ?Element
    {
        if ($this->getType() === 'E') {
            return $this->element;
        }

        return null;
    }

    public function setElement(?Element $element): self
    {
        $this->element = $element;

        return $this;
    }

    public function getSection(): ?Section
    {
        if ($this->getType() === 'G') {
            return $this->section;
        }

        return null;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getValueEnum(): ?Enum
    {
        return $this->valueEnum;
    }

    public function setValueEnum(?Enum $valueEnum): self
    {
        $this->valueEnum = $valueEnum;

        return $this;
    }

    public function getIblockElement(): ?Element
    {
        return $this->iblockElement;
    }

    public function setIblockElement(?Element $element): self
    {
        $this->iblockElement = $element;

        return $this;
    }

    public function getIblockProperty(): ?IblockProperty
    {
        return $this->iblockProperty;
    }

    public function setIblockProperty(?IblockProperty $iblockProperty): self
    {
        $this->iblockProperty = $iblockProperty;

        return $this;
    }
}
