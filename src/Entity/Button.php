<?php
// src/Entity/Button.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Button
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
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Banner", inversedBy="button")
     */
    private $banner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HomeBlock", inversedBy="button")
     */
    private $homeBlock;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getBanner(): ?Banner
    {
        return $this->banner;
    }

    public function setBanner(?Banner $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function getHomeBlock(): ?HomeBlock
    {
        return $this->homeBlock;
    }

    public function setHomeBlock(?HomeBlock $homeBlock): self
    {
        $this->homeBlock = $homeBlock;

        return $this;
    }

}
