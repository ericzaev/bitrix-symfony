<?php

namespace App\Entity\Iblock;

use App\Entity\File;
use App\Entity\Iblock\Element\Property;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\ElementRepository;

/**
 * @ORM\Table(name="b_iblock_element", indexes={@ORM\Index(name="ix_iblock_element_4", columns={"IBLOCK_ID", "XML_ID", "WF_PARENT_ELEMENT_ID"}), @ORM\Index(name="ix_iblock_element_code", columns={"IBLOCK_ID", "CODE"}), @ORM\Index(name="ix_iblock_element_1", columns={"IBLOCK_ID", "IBLOCK_SECTION_ID"}), @ORM\Index(name="ix_iblock_element_3", columns={"WF_PARENT_ELEMENT_ID"})})
 * @ORM\Entity(repositoryClass=ElementRepository::class)
 */
class Element
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
    private $iblockId = '0';

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="ACTIVE_FROM", type="datetime", nullable=true)
     */
    private $activeFrom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ACTIVE_TO", type="datetime", nullable=true)
     */
    private $activeTo;

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
     * @var string|null
     *
     * @ORM\Column(name="PREVIEW_TEXT", type="text", length=65535, nullable=true)
     */
    private $previewText;

    /**
     * @var string
     *
     * @ORM\Column(name="PREVIEW_TEXT_TYPE", type="string", length=4, nullable=false, options={"default"="text"})
     */
    private $previewTextType = 'text';

    /**
     * @var string|null
     *
     * @ORM\Column(name="DETAIL_TEXT", type="text", length=0, nullable=true)
     */
    private $detailText;

    /**
     * @var string
     *
     * @ORM\Column(name="DETAIL_TEXT_TYPE", type="string", length=4, nullable=false, options={"default"="text"})
     */
    private $detailTextType = 'text';

    /**
     * @var string|null
     *
     * @ORM\Column(name="SEARCHABLE_CONTENT", type="text", length=65535, nullable=true)
     */
    private $searchableContent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="WF_STATUS_ID", type="integer", nullable=true, options={"default"="1"})
     */
    private $wfStatusId = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="WF_PARENT_ELEMENT_ID", type="integer", nullable=true)
     */
    private $wfParentElementId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WF_NEW", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $wfNew;

    /**
     * @var int|null
     *
     * @ORM\Column(name="WF_LOCKED_BY", type="integer", nullable=true)
     */
    private $wfLockedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="WF_DATE_LOCK", type="datetime", nullable=true)
     */
    private $wfDateLock;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WF_COMMENTS", type="text", length=65535, nullable=true)
     */
    private $wfComments;

    /**
     * @var string
     *
     * @ORM\Column(name="IN_SECTIONS", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $inSections = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="XML_ID", type="string", length=255, nullable=true)
     */
    private $xmlId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODE", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TAGS", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TMP_ID", type="string", length=40, nullable=true)
     */
    private $tmpId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="WF_LAST_HISTORY_ID", type="integer", nullable=true)
     */
    private $wfLastHistoryId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SHOW_COUNTER", type="integer", nullable=true)
     */
    private $showCounter;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="SHOW_COUNTER_START", type="datetime", nullable=true)
     */
    private $showCounterStart;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="iblockElement", orphanRemoval=true)
     */
    private $properties;

    /**
     * @ORM\ManyToOne(targetEntity=Block::class, inversedBy="elements")
     * @ORM\JoinColumn(name="IBLOCK_ID", referencedColumnName="ID")
     */
    private $block;

    /**
     * @ORM\ManyToMany(targetEntity=Section::class, inversedBy="elements")
     * @ORM\JoinTable(name="b_iblock_section_element",
     *   joinColumns={@ORM\JoinColumn(name="IBLOCK_ELEMENT_ID", referencedColumnName="ID")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="IBLOCK_SECTION_ID", referencedColumnName="ID", unique=true)}
     * )
     */
    private $sections;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="DETAIL_PICTURE", referencedColumnName="ID")
     */
    private $detailPicture;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="PREVIEW_PICTURE", referencedColumnName="ID")
     */
    private $previewPicture;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->sections = new ArrayCollection();
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

    public function getActiveFrom(): ?\DateTimeInterface
    {
        return $this->activeFrom;
    }

    public function setActiveFrom(?\DateTimeInterface $activeFrom): self
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    public function getActiveTo(): ?\DateTimeInterface
    {
        return $this->activeTo;
    }

    public function setActiveTo(?\DateTimeInterface $activeTo): self
    {
        $this->activeTo = $activeTo;

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

    public function getPreviewText(): ?string
    {
        return $this->previewText;
    }

    public function setPreviewText(?string $previewText): self
    {
        $this->previewText = $previewText;

        return $this;
    }

    public function getPreviewTextType(): ?string
    {
        return $this->previewTextType;
    }

    public function setPreviewTextType(string $previewTextType): self
    {
        $this->previewTextType = $previewTextType;

        return $this;
    }

    public function getDetailText(): ?string
    {
        return $this->detailText;
    }

    public function setDetailText(?string $detailText): self
    {
        $this->detailText = $detailText;

        return $this;
    }

    public function getDetailTextType(): ?string
    {
        return $this->detailTextType;
    }

    public function setDetailTextType(string $detailTextType): self
    {
        $this->detailTextType = $detailTextType;

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

    public function getWfStatusId(): ?int
    {
        return $this->wfStatusId;
    }

    public function setWfStatusId(?int $wfStatusId): self
    {
        $this->wfStatusId = $wfStatusId;

        return $this;
    }

    public function getWfParentElementId(): ?int
    {
        return $this->wfParentElementId;
    }

    public function setWfParentElementId(?int $wfParentElementId): self
    {
        $this->wfParentElementId = $wfParentElementId;

        return $this;
    }

    public function getWfNew(): ?string
    {
        return $this->wfNew;
    }

    public function setWfNew(?string $wfNew): self
    {
        $this->wfNew = $wfNew;

        return $this;
    }

    public function getWfLockedBy(): ?int
    {
        return $this->wfLockedBy;
    }

    public function setWfLockedBy(?int $wfLockedBy): self
    {
        $this->wfLockedBy = $wfLockedBy;

        return $this;
    }

    public function getWfDateLock(): ?\DateTimeInterface
    {
        return $this->wfDateLock;
    }

    public function setWfDateLock(?\DateTimeInterface $wfDateLock): self
    {
        $this->wfDateLock = $wfDateLock;

        return $this;
    }

    public function getWfComments(): ?string
    {
        return $this->wfComments;
    }

    public function setWfComments(?string $wfComments): self
    {
        $this->wfComments = $wfComments;

        return $this;
    }

    public function getInSections(): ?string
    {
        return $this->inSections;
    }

    public function setInSections(string $inSections): self
    {
        $this->inSections = $inSections;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

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

    public function getWfLastHistoryId(): ?int
    {
        return $this->wfLastHistoryId;
    }

    public function setWfLastHistoryId(?int $wfLastHistoryId): self
    {
        $this->wfLastHistoryId = $wfLastHistoryId;

        return $this;
    }

    public function getShowCounter(): ?int
    {
        return $this->showCounter;
    }

    public function setShowCounter(?int $showCounter): self
    {
        $this->showCounter = $showCounter;

        return $this;
    }

    public function getShowCounterStart(): ?\DateTimeInterface
    {
        return $this->showCounterStart;
    }

    public function setShowCounterStart(?\DateTimeInterface $showCounterStart): self
    {
        $this->showCounterStart = $showCounterStart;

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setElement($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getElement() === $this) {
                $property->setElement(null);
            }
        }

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
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
        }

        return $this;
    }

    public function getDetailPicture(): ?File
    {
        return $this->detailPicture;
    }

    public function setDetailPicture(?File $detailPicture): self
    {
        $this->detailPicture = $detailPicture;

        return $this;
    }

    public function getPreviewPicture(): ?File
    {
        return $this->previewPicture;
    }

    public function setPreviewPicture(?File $previewPicture): self
    {
        $this->previewPicture = $previewPicture;

        return $this;
    }


}
