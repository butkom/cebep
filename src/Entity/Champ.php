<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Champ
 *
 * @ORM\Table(name="champ")
 * @ORM\Entity(repositoryClass="App\Repository\ChampRepository")
 */
class Champ extends Editable
{
    const TYPES = [
        'all' => 'all',
        'intelligence-agility' => 'intelligence-agility',
        'intelligence-strength' => 'intelligence-strength',
        'agility-strength' => 'agility-strength',
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="GuildChamp", mappedBy="champ")
     */
    private $guildChamps;

    /**
     * @ORM\OneToMany(targetEntity="PlayerChamp", mappedBy="champ")
     */
    private $playerChamps;


    public function __construct()
    {
        $this->guildChamps = new ArrayCollection();
        $this->playerChamps = new ArrayCollection();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Champ
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Champ
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set type
     *
     * @param string $ype
     *
     * @return Champ
     */
    public function setType($ype)
    {
        if (!in_array($ype, static::TYPES)) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = $ype;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
