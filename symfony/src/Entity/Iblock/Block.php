<?php

namespace App\Entity\Iblock;

use App\Entity\Group;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\BlockRepository;

/**
 * @ORM\Table(name="b_iblock", uniqueConstraints={@ORM\UniqueConstraint(name="ix_iblock_api_code", columns={"API_CODE"})}, indexes={@ORM\Index(name="ix_iblock", columns={"IBLOCK_TYPE_ID", "LID", "ACTIVE"})})
 * @ORM\Entity(repositoryClass=BlockRepository::class)
 */
class Block
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
     * @var string
     *
     * @ORM\Column(name="IBLOCK_TYPE_ID", type="string", length=50, nullable=false)
     */
    private $iblockTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="LID", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $lid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODE", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="API_CODE", type="string", length=50, nullable=true)
     */
    private $apiCode;

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
     * @ORM\Column(name="LIST_PAGE_URL", type="string", length=255, nullable=true)
     */
    private $listPageUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DETAIL_PAGE_URL", type="string", length=255, nullable=true)
     */
    private $detailPageUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECTION_PAGE_URL", type="string", length=255, nullable=true)
     */
    private $sectionPageUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CANONICAL_PAGE_URL", type="string", length=255, nullable=true)
     */
    private $canonicalPageUrl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PICTURE", type="integer", nullable=true)
     */
    private $picture;

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
     * @var int
     *
     * @ORM\Column(name="RSS_TTL", type="integer", nullable=false, options={"default"="24"})
     */
    private $rssTtl = '24';

    /**
     * @var string
     *
     * @ORM\Column(name="RSS_ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $rssActive = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="RSS_FILE_ACTIVE", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $rssFileActive = 'N';

    /**
     * @var int|null
     *
     * @ORM\Column(name="RSS_FILE_LIMIT", type="integer", nullable=true)
     */
    private $rssFileLimit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RSS_FILE_DAYS", type="integer", nullable=true)
     */
    private $rssFileDays;

    /**
     * @var string
     *
     * @ORM\Column(name="RSS_YANDEX_ACTIVE", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $rssYandexActive = 'N';

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
     * @var string
     *
     * @ORM\Column(name="INDEX_ELEMENT", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $indexElement = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="INDEX_SECTION", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $indexSection = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="WORKFLOW", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $workflow = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="BIZPROC", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $bizproc = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECTION_CHOOSER", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $sectionChooser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LIST_MODE", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $listMode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RIGHTS_MODE", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $rightsMode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECTION_PROPERTY", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $sectionProperty;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PROPERTY_INDEX", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $propertyIndex;

    /**
     * @var int
     *
     * @ORM\Column(name="VERSION", type="integer", nullable=false, options={"default"="1"})
     */
    private $version = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="LAST_CONV_ELEMENT", type="integer", nullable=false)
     */
    private $lastConvElement = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="SOCNET_GROUP_ID", type="integer", nullable=true)
     */
    private $socnetGroupId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EDIT_FILE_BEFORE", type="string", length=255, nullable=true)
     */
    private $editFileBefore;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EDIT_FILE_AFTER", type="string", length=255, nullable=true)
     */
    private $editFileAfter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECTIONS_NAME", type="string", length=100, nullable=true)
     */
    private $sectionsName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECTION_NAME", type="string", length=100, nullable=true)
     */
    private $sectionName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ELEMENTS_NAME", type="string", length=100, nullable=true)
     */
    private $elementsName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ELEMENT_NAME", type="string", length=100, nullable=true)
     */
    private $elementName;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="block", orphanRemoval=true)
     */
    private $properties;

    /**
     * @ORM\OneToMany(targetEntity=Element::class, mappedBy="block", orphanRemoval=true)
     */
    private $elements;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="blocks")
     * @ORM\JoinColumn(name="IBLOCK_TYPE_ID", referencedColumnName="ID")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class)
     * @ORM\JoinTable(name="b_iblock_group",
     *   joinColumns={@ORM\JoinColumn(name="IBLOCK_ID", referencedColumnName="ID")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="GROUP_ID", referencedColumnName="ID", unique=true)}
     * )
     */
    private $groups;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->elements = new ArrayCollection();
        $this->groups = new ArrayCollection();
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

    public function getIblockTypeId(): ?string
    {
        return $this->iblockTypeId;
    }

    public function setIblockTypeId(string $iblockTypeId): self
    {
        $this->iblockTypeId = $iblockTypeId;

        return $this;
    }

    public function getLid(): ?string
    {
        return $this->lid;
    }

    public function setLid(string $lid): self
    {
        $this->lid = $lid;

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

    public function getApiCode(): ?string
    {
        return $this->apiCode;
    }

    public function setApiCode(?string $apiCode): self
    {
        $this->apiCode = $apiCode;

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

    public function getListPageUrl(): ?string
    {
        return $this->listPageUrl;
    }

    public function setListPageUrl(?string $listPageUrl): self
    {
        $this->listPageUrl = $listPageUrl;

        return $this;
    }

    public function getDetailPageUrl(): ?string
    {
        return $this->detailPageUrl;
    }

    public function setDetailPageUrl(?string $detailPageUrl): self
    {
        $this->detailPageUrl = $detailPageUrl;

        return $this;
    }

    public function getSectionPageUrl(): ?string
    {
        return $this->sectionPageUrl;
    }

    public function setSectionPageUrl(?string $sectionPageUrl): self
    {
        $this->sectionPageUrl = $sectionPageUrl;

        return $this;
    }

    public function getCanonicalPageUrl(): ?string
    {
        return $this->canonicalPageUrl;
    }

    public function setCanonicalPageUrl(?string $canonicalPageUrl): self
    {
        $this->canonicalPageUrl = $canonicalPageUrl;

        return $this;
    }

    public function getPicture(): ?int
    {
        return $this->picture;
    }

    public function setPicture(?int $picture): self
    {
        $this->picture = $picture;

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

    public function getRssTtl(): ?int
    {
        return $this->rssTtl;
    }

    public function setRssTtl(int $rssTtl): self
    {
        $this->rssTtl = $rssTtl;

        return $this;
    }

    public function getRssActive(): ?string
    {
        return $this->rssActive;
    }

    public function setRssActive(string $rssActive): self
    {
        $this->rssActive = $rssActive;

        return $this;
    }

    public function getRssFileActive(): ?string
    {
        return $this->rssFileActive;
    }

    public function setRssFileActive(string $rssFileActive): self
    {
        $this->rssFileActive = $rssFileActive;

        return $this;
    }

    public function getRssFileLimit(): ?int
    {
        return $this->rssFileLimit;
    }

    public function setRssFileLimit(?int $rssFileLimit): self
    {
        $this->rssFileLimit = $rssFileLimit;

        return $this;
    }

    public function getRssFileDays(): ?int
    {
        return $this->rssFileDays;
    }

    public function setRssFileDays(?int $rssFileDays): self
    {
        $this->rssFileDays = $rssFileDays;

        return $this;
    }

    public function getRssYandexActive(): ?string
    {
        return $this->rssYandexActive;
    }

    public function setRssYandexActive(string $rssYandexActive): self
    {
        $this->rssYandexActive = $rssYandexActive;

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

    public function getIndexElement(): ?string
    {
        return $this->indexElement;
    }

    public function setIndexElement(string $indexElement): self
    {
        $this->indexElement = $indexElement;

        return $this;
    }

    public function getIndexSection(): ?string
    {
        return $this->indexSection;
    }

    public function setIndexSection(string $indexSection): self
    {
        $this->indexSection = $indexSection;

        return $this;
    }

    public function getWorkflow(): ?string
    {
        return $this->workflow;
    }

    public function setWorkflow(string $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }

    public function getBizproc(): ?string
    {
        return $this->bizproc;
    }

    public function setBizproc(string $bizproc): self
    {
        $this->bizproc = $bizproc;

        return $this;
    }

    public function getSectionChooser(): ?string
    {
        return $this->sectionChooser;
    }

    public function setSectionChooser(?string $sectionChooser): self
    {
        $this->sectionChooser = $sectionChooser;

        return $this;
    }

    public function getListMode(): ?string
    {
        return $this->listMode;
    }

    public function setListMode(?string $listMode): self
    {
        $this->listMode = $listMode;

        return $this;
    }

    public function getRightsMode(): ?string
    {
        return $this->rightsMode;
    }

    public function setRightsMode(?string $rightsMode): self
    {
        $this->rightsMode = $rightsMode;

        return $this;
    }

    public function getSectionProperty(): ?string
    {
        return $this->sectionProperty;
    }

    public function setSectionProperty(?string $sectionProperty): self
    {
        $this->sectionProperty = $sectionProperty;

        return $this;
    }

    public function getPropertyIndex(): ?string
    {
        return $this->propertyIndex;
    }

    public function setPropertyIndex(?string $propertyIndex): self
    {
        $this->propertyIndex = $propertyIndex;

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

    public function getLastConvElement(): ?int
    {
        return $this->lastConvElement;
    }

    public function setLastConvElement(int $lastConvElement): self
    {
        $this->lastConvElement = $lastConvElement;

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

    public function getEditFileBefore(): ?string
    {
        return $this->editFileBefore;
    }

    public function setEditFileBefore(?string $editFileBefore): self
    {
        $this->editFileBefore = $editFileBefore;

        return $this;
    }

    public function getEditFileAfter(): ?string
    {
        return $this->editFileAfter;
    }

    public function setEditFileAfter(?string $editFileAfter): self
    {
        $this->editFileAfter = $editFileAfter;

        return $this;
    }

    public function getSectionsName(): ?string
    {
        return $this->sectionsName;
    }

    public function setSectionsName(?string $sectionsName): self
    {
        $this->sectionsName = $sectionsName;

        return $this;
    }

    public function getSectionName(): ?string
    {
        return $this->sectionName;
    }

    public function setSectionName(?string $sectionName): self
    {
        $this->sectionName = $sectionName;

        return $this;
    }

    public function getElementsName(): ?string
    {
        return $this->elementsName;
    }

    public function setElementsName(?string $elementsName): self
    {
        $this->elementsName = $elementsName;

        return $this;
    }

    public function getElementName(): ?string
    {
        return $this->elementName;
    }

    public function setElementName(?string $elementName): self
    {
        $this->elementName = $elementName;

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
            $property->setBlock($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getBlock() === $this) {
                $property->setBlock(null);
            }
        }

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
            $element->setBlock($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->elements->contains($element)) {
            $this->elements->removeElement($element);
            // set the owning side to null (unless already changed)
            if ($element->getBlock() === $this) {
                $element->setBlock(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
        }

        return $this;
    }
}
