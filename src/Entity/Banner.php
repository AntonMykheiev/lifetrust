<?php
// src/Entity/Banner.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Banner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Button", mappedBy="banner")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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
            $button->setBanner($this);
        }

        return $this;
    }

    public function removeButton(Button $button): self
    {
        if ($this->button->contains($button)) {
            $this->button->removeElement($button);
            // set the owning side to null (unless already changed)
            if ($button->getBanner() === $this) {
                $button->setBanner(null);
            }
        }

        return $this;
    }

}
