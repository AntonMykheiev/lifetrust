<?php
// src/Entity/DynamicPage.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class DynamicPage
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
    private $title;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $quote;

    /**
     * @ORM\Column(type="text")
     */
    private $content;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FaqCategories", inversedBy="questionAnswer")
     */
    private $category;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): self
    {
        $this->quote = $quote;

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
