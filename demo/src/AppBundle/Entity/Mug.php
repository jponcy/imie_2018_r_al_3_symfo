<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MugRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity({"name"})
 */
class Mug
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="name")
     *
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="integer", name="stock")
     *
     * @Assert\NotNull()
     * @Assert\Range(min=0)
     *
     * @var int
     */
    private $stock;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     *
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean", name="enabled", options={"default": TRUE})
     *
     * @Assert\NotNull()
     *
     * @var bool
     */
    private $enabled = true;

    /**
     * Constructor.
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function persistAndUpdate() {
        if (!$this->id) {
            $this->createdAt = new \DateTime();
        }

        $this->updatedAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the stock.
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the stock.
     *
     * @param int $stock
     *
     * @return Mug
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Mug
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Mug
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the enabled.
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the enabled.
     *
     * @param bool $enabled
     *
     * @return Mug
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
