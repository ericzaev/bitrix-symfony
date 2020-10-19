<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FileRepository;

/**
 * @ORM\Table(name="b_file", indexes={@ORM\Index(name="IX_B_FILE_EXTERNAL_ID", columns={"EXTERNAL_ID"})})
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
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
     * @var string|null
     *
     * @ORM\Column(name="MODULE_ID", type="string", length=50, nullable=true)
     */
    private $moduleId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="HEIGHT", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var int|null
     *
     * @ORM\Column(name="WIDTH", type="integer", nullable=true)
     */
    private $width;

    /**
     * @var int|null
     *
     * @ORM\Column(name="FILE_SIZE", type="bigint", nullable=true)
     */
    private $fileSize;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CONTENT_TYPE", type="string", length=255, nullable=true, options={"default"="IMAGE"})
     */
    private $contentType = 'IMAGE';

    /**
     * @var string|null
     *
     * @ORM\Column(name="SUBDIR", type="string", length=255, nullable=true)
     */
    private $subdir;

    /**
     * @var string
     *
     * @ORM\Column(name="FILE_NAME", type="string", length=255, nullable=false)
     */
    private $fileName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ORIGINAL_NAME", type="string", length=255, nullable=true)
     */
    private $originalName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HANDLER_ID", type="string", length=50, nullable=true)
     */
    private $handlerId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXTERNAL_ID", type="string", length=50, nullable=true)
     */
    private $externalId;

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

    public function getModuleId(): ?string
    {
        return $this->moduleId;
    }

    public function setModuleId(?string $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getFileSize(): ?string
    {
        return $this->fileSize;
    }

    public function setFileSize(?string $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(?string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getSubdir(): ?string
    {
        return $this->subdir;
    }

    public function setSubdir(?string $subdir): self
    {
        $this->subdir = $subdir;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

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

    public function getHandlerId(): ?string
    {
        return $this->handlerId;
    }

    public function setHandlerId(?string $handlerId): self
    {
        $this->handlerId = $handlerId;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }


}
