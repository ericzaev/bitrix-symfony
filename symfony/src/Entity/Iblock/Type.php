<?php

namespace App\Entity\Iblock;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Iblock\TypeRepository;

/**
 * @ORM\Table(name="b_iblock_type")
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SECTIONS", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $sections = 'Y';

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
     * @var string
     *
     * @ORM\Column(name="IN_RSS", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $inRss = 'N';

    /**
     * @var int
     *
     * @ORM\Column(name="SORT", type="integer", nullable=false, options={"default"="500"})
     */
    private $sort = '500';

    /**
     * @ORM\OneToMany(targetEntity=Block::class, mappedBy="type", orphanRemoval=true)
     */
    private $blocks;

    public function __construct()
    {
        $this->blocks = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSections(): ?string
    {
        return $this->sections;
    }

    public function setSections(string $sections): self
    {
        $this->sections = $sections;

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

    public function getInRss(): ?string
    {
        return $this->inRss;
    }

    public function setInRss(string $inRss): self
    {
        $this->inRss = $inRss;

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

    /**
     * @return Collection|Block[]
     */
    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function addBlock(Block $block): self
    {
        if (!$this->blocks->contains($block)) {
            $this->blocks[] = $block;
            $block->setType($this);
        }

        return $this;
    }

    public function removeBlock(Block $block): self
    {
        if ($this->blocks->contains($block)) {
            $this->blocks->removeElement($block);
            // set the owning side to null (unless already changed)
            if ($block->getType() === $this) {
                $block->setType(null);
            }
        }

        return $this;
    }


}
