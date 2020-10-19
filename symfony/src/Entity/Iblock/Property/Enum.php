<?php

namespace App\Entity\Iblock\Property;

use App\Entity\Iblock\Property;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\Property\EnumRepository;

/**
 * @ORM\Table(name="b_iblock_property_enum", uniqueConstraints={@ORM\UniqueConstraint(name="ux_iblock_property_enum", columns={"PROPERTY_ID", "XML_ID"})})
 * @ORM\Entity(repositoryClass=EnumRepository::class)
 */
class Enum
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
     * @ORM\Column(name="PROPERTY_ID", type="integer", nullable=false)
     */
    private $propertyId;

    /**
     * @var string
     *
     * @ORM\Column(name="VALUE", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="DEF", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $def = 'N';

    /**
     * @var int
     *
     * @ORM\Column(name="SORT", type="integer", nullable=false, options={"default"="500"})
     */
    private $sort = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="XML_ID", type="string", length=200, nullable=false)
     */
    private $xmlId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TMP_ID", type="string", length=40, nullable=true)
     */
    private $tmpId;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="enum")
     * @ORM\JoinColumn(name="PROPERTY_ID", referencedColumnName="ID")
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): self
    {
        $this->propertyId = $propertyId;

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

    public function getDef(): ?string
    {
        return $this->def;
    }

    public function setDef(string $def): self
    {
        $this->def = $def;

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

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setXmlId(string $xmlId): self
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

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }


}
