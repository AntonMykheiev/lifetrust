<?php
// src/Entity/HomeBlock.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HomeBlock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $content;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Button", mappedBy="homeBlock")
     */
    private $button;

    public function __construct()
    {
        $this->button = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Button[]
     */
    public function getButton(): Collection
    {
        return $this->button;
    }

    public function addButton(Button $button): self
    {
        if (!$this->button->contains($button)) {
            $this->button[] = $button;
            $button->setHomeBlock($this);
        }

        return $this;
    }

    public function removeButton(Button $button): self
    {
        if ($this->button->contains($button)) {
            $this->button->removeElement($button);
            // set the owning side to null (unless already changed)
            if ($button->getHomeBlock() === $this) {
                $button->setHomeBlock(null);
            }
        }

        return $this;
    }

}
