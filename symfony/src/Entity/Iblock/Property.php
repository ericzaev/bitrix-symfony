<?php

namespace App\Entity\Iblock;

use App\Entity\Iblock\Property\Enum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\PropertyRepository;

/**
 * @ORM\Table(name="b_iblock_property", indexes={@ORM\Index(name="ix_iblock_property_1", columns={"IBLOCK_ID"}), @ORM\Index(name="ix_iblock_property_2", columns={"CODE"}), @ORM\Index(name="ix_iblock_property_3", columns={"LINK_IBLOCK_ID"})})
 * @ORM\Entity
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
     * @var \DateTime
     *
     * @ORM\Column(name="TIMESTAMP_X", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $timestampX = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="IBLOCK_ID", type="integer", nullable=false)
     */
    private $iblockId;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $active = 'Y';

    /**
     * @var int
     *
     * @ORM\Column(name="SORT", type="integer", nullable=false, options={"default"="500"})
     */
    private $sort = '500';

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODE", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DEFAULT_VALUE", type="text", length=65535, nullable=true)
     */
    private $defaultValue;

    /**
     * @var string
     *
     * @ORM\Column(name="PROPERTY_TYPE", type="string", length=1, nullable=false, options={"default"="S","fixed"=true})
     */
    private $propertyType = 'S';

    /**
     * @var int
     *
     * @ORM\Column(name="ROW_COUNT", type="integer", nullable=false, options={"default"="1"})
     */
    private $rowCount = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="COL_COUNT", type="integer", nullable=false, options={"default"="30"})
     */
    private $colCount = '30';

    /**
     * @var string
     *
     * @ORM\Column(name="LIST_TYPE", type="string", length=1, nullable=false, options={"default"="L","fixed"=true})
     */
    private $listType = 'L';

    /**
     * @var string
     *
     * @ORM\Column(name="MULTIPLE", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $multiple = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="XML_ID", type="string", length=100, nullable=true)
     */
    private $xmlId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FILE_TYPE", type="string", length=200, nullable=true)
     */
    private $fileType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MULTIPLE_CNT", type="integer", nullable=true)
     */
    private $multipleCnt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TMP_ID", type="string", length=40, nullable=true)
     */
    private $tmpId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LINK_IBLOCK_ID", type="integer", nullable=true)
     */
    private $linkIblockId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WITH_DESCRIPTION", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $withDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="SEARCHABLE", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $searchable = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="FILTRABLE", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $filtrable = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="IS_REQUIRED", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $isRequired;

    /**
     * @var int
     *
     * @ORM\Column(name="VERSION", type="integer", nullable=false, options={"default"="1"})
     */
    private $version = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="USER_TYPE", type="string", length=255, nullable=true)
     */
    private $userType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USER_TYPE_SETTINGS", type="text", length=65535, nullable=true)
     */
    private $userTypeSettings;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HINT", type="string", length=255, nullable=true)
     */
    private $hint;

    /**
     * @ORM\ManyToOne(targetEntity=Block::class, inversedBy="properties")
     * @ORM\JoinColumn(name="IBLOCK_ID", referencedColumnName="ID")
     */
    private $block;

    /**
     * @ORM\OneToMany(targetEntity=Enum::class, mappedBy="property", orphanRemoval=true)
     */
    private $enum;

    public function __construct()
    {
        $this->enum = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestampX(): ?\DateTimeInterface
    {
        return $this->timestampX;
    }

    public function setTimestampX(\DateTimeInterface $timestampX): self
    {
        $this->timestampX = $timestampX;

        return $this;
    }

    public function getIblockId(): ?int
    {
        return $this->iblockId;
    }

    public function setIblockId(int $iblockId): self
    {
        $this->iblockId = $iblockId;

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

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getPropertyType(): ?string
    {
        return $this->propertyType;
    }

    public function setPropertyType(string $propertyType): self
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    public function getRowCount(): ?int
    {
        return $this->rowCount;
    }

    public function setRowCount(int $rowCount): self
    {
        $this->rowCount = $rowCount;

        return $this;
    }

    public function getColCount(): ?int
    {
        return $this->colCount;
    }

    public function setColCount(int $colCount): self
    {
        $this->colCount = $colCount;

        return $this;
    }

    public function getListType(): ?string
    {
        return $this->listType;
    }

    public function setListType(string $listType): self
    {
        $this->listType = $listType;

        return $this;
    }

    public function getMultiple(): ?string
    {
        return $this->multiple;
    }

    public function setMultiple(string $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setXmlId(?string $xmlId): self
    {
        $this->xmlId = $xmlId;

        return $this;
    }

    public function getFileType(): ?string
    {
        return $this->fileType;
    }

    public function setFileType(?string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    public function getMultipleCnt(): ?int
    {
        return $this->multipleCnt;
    }

    public function setMultipleCnt(?int $multipleCnt): self
    {
        $this->multipleCnt = $multipleCnt;

        return $this;
    }

    public function getTmpId(): ?string
    {
        return $this->tmpId;
    }

    public function setTmpId(?string $tmpId): self
    {
        $this->tmpId = $tmpId;

        return $this;
    }

    public function getLinkIblockId(): ?int
    {
        return $this->linkIblockId;
    }

    public function setLinkIblockId(?int $linkIblockId): self
    {
        $this->linkIblockId = $linkIblockId;

        return $this;
    }

    public function getWithDescription(): ?string
    {
        return $this->withDescription;
    }

    public function setWithDescription(?string $withDescription): self
    {
        $this->withDescription = $withDescription;

        return $this;
    }

    public function getSearchable(): ?string
    {
        return $this->searchable;
    }

    public function setSearchable(string $searchable): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function getFiltrable(): ?string
    {
        return $this->filtrable;
    }

    public function setFiltrable(string $filtrable): self
    {
        $this->filtrable = $filtrable;

        return $this;
    }

    public function getIsRequired(): ?string
    {
        return $this->isRequired;
    }

    public function setIsRequired(?string $isRequired): self
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(?string $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getUserTypeSettings(): ?string
    {
        return $this->userTypeSettings;
    }

    public function setUserTypeSettings(?string $userTypeSettings): self
    {
        $this->userTypeSettings = $userTypeSettings;

        return $this;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(?string $hint): self
    {
        $this->hint = $hint;

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

    /**
     * @return Collection|Enum[]
     */
    public function getEnum(): Collection
    {
        return $this->enum;
    }

    public function addEnum(Enum $enum): self
    {
        if (!$this->enum->contains($enum)) {
            $this->enum[] = $enum;
            $enum->setProperty($this);
        }

        return $this;
    }

    public function removeEnum(Enum $enum): self
    {
        if ($this->enum->contains($enum)) {
            $this->enum->removeElement($enum);
            // set the owning side to null (unless already changed)
            if ($enum->getProperty() === $this) {
                $enum->setProperty(null);
            }
        }

        return $this;
    }


}
