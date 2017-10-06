<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Packages
 *
 * @ORM\Table(name="packages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PackagesRepository")
 */
class Packages
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="imageurl", type="string", length=255)
     */
    private $imageurl;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Destination",inversedBy="packages")
     * @Assert\NotBlank()
     */
    protected $destination;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Packages
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Packages
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set imageurl
     *
     * @param string $imageurl
     *
     * @return Packages
     */
    public function setImageurl($imageurl)
    {
        $this->imageurl = $imageurl;
        return $this;
    }
    /**
     * Get imageurl
     *
     * @return string
     */
    public function getImageurl()
    {
        return $this->imageurl;
    }
    /**
     * @var date $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;
    /**
     * @var date $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $modified;
    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Pages
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Pages
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }
    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }
    /**
     * Triggered on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }
    /**
     * Triggered on update
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->modified = new \DateTime("now");
    }

    /**
     * Add Destination
     *
     * @param \AppBundle\Entity\Destination $destination
     * @return Packages
     */
    public function addDestination(Destination $destination)
    {
        $this->destination[] = $destination;
        return $this;
    }
    /**
     * Remove Destination
     *
     * @param \AppBundle\Entity\Destination $destination
     */
    public function removeDestination(Destination $destination)
    {
        $this->destination->removeElement($destination);
    }
    /**
     * Get destination
     *
     * @return \AppBundle\Entity\Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }
    /**
     * Set destination
     *
     * @param \AppBundle\Entity\Destination $destination
     *
     * @return Packages
     */
    public function setDestination(\AppBundle\Entity\Destination $destination = null)
    {
        $this->destination = $destination;
        return $this;
    }
}
