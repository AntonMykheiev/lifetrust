<?php
// src/Entity/FaqCategories.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class FaqCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $order;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FaqQuestionAnswer", mappedBy="category")
     */
    private $questionAnswer;

    public function __construct()
    {
        $this->questionAnswer = new ArrayCollection();
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

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(int $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Collection|FaqQuestionAnswer[]
     */
    public function getQuestionAnswer(): Collection
    {
        return $this->questionAnswer;
    }

    public function addQuestionAnswer(FaqQuestionAnswer $questionAnswer): self
    {
        if (!$this->questionAnswer->contains($questionAnswer)) {
            $this->questionAnswer[] = $questionAnswer;
            $questionAnswer->setCategory($this);
        }

        return $this;
    }

    public function removeQuestionAnswer(FaqQuestionAnswer $questionAnswer): self
    {
        if ($this->questionAnswer->contains($questionAnswer)) {
            $this->questionAnswer->removeElement($questionAnswer);
            // set the owning side to null (unless already changed)
            if ($questionAnswer->getCategory() === $this) {
                $questionAnswer->setCategory(null);
            }
        }

        return $this;
    }
    
}
