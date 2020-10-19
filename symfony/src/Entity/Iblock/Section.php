<?php

namespace App\Entity\Iblock;

use App\Entity\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\SectionRepository;

/**
 * @ORM\Table(name="b_iblock_section", indexes={@ORM\Index(name="ix_iblock_section_left_margin", columns={"IBLOCK_ID", "LEFT_MARGIN", "RIGHT_MARGIN"}), @ORM\Index(name="ix_iblock_section_code", columns={"IBLOCK_ID", "CODE"}), @ORM\Index(name="ix_iblock_section_1", columns={"IBLOCK_ID", "IBLOCK_SECTION_ID"}), @ORM\Index(name="ix_iblock_section_depth_level", columns={"IBLOCK_ID", "DEPTH_LEVEL"}), @ORM\Index(name="ix_iblock_section_right_margin", columns={"IBLOCK_ID", "RIGHT_MARGIN", "LEFT_MARGIN"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
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
     * @var int|null
     *
     * @ORM\Column(name="MODIFIED_BY", type="integer", nullable=true)
     */
    private $modifiedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_CREATE", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CREATED_BY", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var int
     *
     * @ORM\Column(name="IBLOCK_ID", type="integer", nullable=false)
     */
    private $iblockId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IBLOCK_SECTION_ID", type="integer", nullable=true)
     */
    private $iblockSectionId;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $active = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="GLOBAL_ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $globalActive = 'Y';

    /**
     * @var int
     *
     * @ORM\Column(name="SORT", type="integer", nullable=false, options={"default"="500"})
     */
    private $sort = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LEFT_MARGIN", type="integer", nullable=true)
     */
    private $leftMargin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RIGHT_MARGIN", type="integer", nullable=true)
     */
    private $rightMargin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DEPTH_LEVEL", type="integer", nullable=true)
     */
    private $depthLevel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_TYPE", type="string", length=4, nullable=false, options={"default"="text","fixed"=true})
     */
    private $descriptionType = 'text';

    /**
     * @var string|null
     *
     * @ORM\Column(name="SEARCHABLE_CONTENT", type="text", length=65535, nullable=true)
     */
    private $searchableContent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODE", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="XML_ID", type="string", length=255, nullable=true)
     */
    private $xmlId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TMP_ID", type="string", length=40, nullable=true)
     */
    private $tmpId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DETAIL_PICTURE", type="integer", nullable=true)
     */
    private $detailPicture;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SOCNET_GROUP_ID", type="integer", nullable=true)
     */
    private $socnetGroupId;

    /**
     * @ORM\ManyToMany(targetEntity=Element::class, mappedBy="sections")
     */
    private $elements;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="PICTURE", referencedColumnName="ID")
     */
    private $picture;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
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

    public function getModifiedBy(): ?int
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(?int $modifiedBy): self
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function getIblockSectionId(): ?int
    {
        return $this->iblockSectionId;
    }

    public function setIblockSectionId(?int $iblockSectionId): self
    {
        $this->iblockSectionId = $iblockSectionId;

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

    public function getGlobalActive(): ?string
    {
        return $this->globalActive;
    }

    public function setGlobalActive(string $globalActive): self
    {
        $this->globalActive = $globalActive;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLeftMargin(): ?int
    {
        return $this->leftMargin;
    }

    public function setLeftMargin(?int $leftMargin): self
    {
        $this->leftMargin = $leftMargin;

        return $this;
    }

    public function getRightMargin(): ?int
    {
        return $this->rightMargin;
    }

    public function setRightMargin(?int $rightMargin): self
    {
        $this->rightMargin = $rightMargin;

        return $this;
    }

    public function getDepthLevel(): ?int
    {
        return $this->depthLevel;
    }

    public function setDepthLevel(?int $depthLevel): self
    {
        $this->depthLevel = $depthLevel;

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

    public function getDescriptionType(): ?string
    {
        return $this->descriptionType;
    }

    public function setDescriptionType(string $descriptionType): self
    {
        $this->descriptionType = $descriptionType;

        return $this;
    }

    public function getSearchableContent(): ?string
    {
        return $this->searchableContent;
    }

    public function setSearchableContent(?string $searchableContent): self
    {
        $this->searchableContent = $searchableContent;

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

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setXmlId(?string $xmlId): self
    {
        $this->xmlId = $xmlId;

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

    public function getDetailPicture(): ?int
    {
        return $this->detailPicture;
    }

    public function setDetailPicture(?int $detailPicture): self
    {
        $this->detailPicture = $detailPicture;

        return $this;
    }

    public function getSocnetGroupId(): ?int
    {
        return $this->socnetGroupId;
    }

    public function setSocnetGroupId(?int $socnetGroupId): self
    {
        $this->socnetGroupId = $socnetGroupId;

        return $this;
    }

    /**
     * @return Collection|Element[]
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(Element $element): self
    {
        if (!$this->elements->contains($element)) {
            $this->elements[] = $element;
            $element->addSection($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->elements->contains($element)) {
            $this->elements->removeElement($element);
            $element->removeSection($this);
        }

        return $this;
    }

    public function getPicture(): ?File
    {
        return $this->picture;
    }

    public function setPicture(?File $picture): self
    {
        $this->picture = $picture;

        return $this;
    }


}
