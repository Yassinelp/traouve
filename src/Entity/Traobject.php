<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Traobject
 *
 * @ORM\Table(name="traobject", indexes={@ORM\Index(name="fk_traobject_category_idx", columns={"category_id"}), @ORM\Index(name="fk_traobject_state1_idx", columns={"state_id"}), @ORM\Index(name="fk_traobject_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_traobject_county1_idx", columns={"county_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\TraobjectRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Vich\Uploadable()
 */
class Traobject
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;


    /**
     * @Vich\UploadableField(mapping="traobject_images", fileNameProperty="picture")
     * @var File
     */
    private $pictureFile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_at", type="datetime", nullable=false)
     */
    private $eventAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    # Association des traobjects à chaque Catégorie : Database first : ManyToOne
    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="traobjects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    # Association des traobjects à chaque Statut (perdu ou trouvé) : Database first : ManyToOne
    /**
     * @var State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     * })
     */
    private $state;

    # Association des traobjects à chaque Département : Database first : ManyToOne
    /**
     * @var County
     *
     * @ORM\ManyToOne(targetEntity="County", inversedBy="traobjects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="county_id", referencedColumnName="id")
     * })
     */
    private $county;

    # Association des traobjects à chaque utilisateur : Database first : ManyToOne
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    # Association des Commentaires à chaque traobject : Database first : OneToMany
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="traobject")
     */
    private $comments;

    /**
     * Traobject constructor.
     */
    public function __construct() {
        $this->comments = new ArrayCollection();
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


    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     * @return Traobject
     */
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function getEventAt(): ?\DateTimeInterface
    {
        return $this->eventAt;
    }

    public function setEventAt(\DateTimeInterface $eventAt): self
    {
        $this->eventAt = $eventAt;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCounty(): ?County
    {
        return $this->county;
    }

    public function setCounty(?County $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @return Null|File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param Null|File $pictureFile
     * @throws \Exception
     */
    public function setPictureFile(File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;

        if ($pictureFile){
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @param Collection $comments
     */
    public function setComments(Collection $comments): void
    {
        $this->comments = $comments;
    }

    public function __toString()
    {
        return $this->getTitle();
    }


}
