<?php
// src/Entity/FaqQuestionAnswer.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class FaqQuestionAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $question;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $answer;

    /**
     * @ORM\Column(type="integer")
     */
    private $isActive;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FaqCategories", inversedBy="questionAnswer")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

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

    public function getCategory(): ?FaqCategories
    {
        return $this->category;
    }

    public function setCategory(?FaqCategories $category): self
    {
        $this->category = $category;

        return $this;
    }
    
}
