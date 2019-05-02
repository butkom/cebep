<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 */
class Player extends Editable
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
     * @ORM\Column(name="in_game_id", type="string", length=255, nullable=true, unique=true)
     */
    private $inGameId;

    /**
     * @var string
     *
     * @ORM\Column(name="characteristic", type="text", nullable=true)
     */
    private $characteristic;

    /**
     * @var int
     *
     * @ORM\Column(name="absent_days", type="integer", nullable=true)
     */
    private $absentDays;

    /**
     * @ORM\OneToMany(targetEntity="PlayerLvl", mappedBy="player")
     */
    private $playerLvls;

    /**
     * @ORM\OneToMany(targetEntity="PlayerName", mappedBy="player")
     */
    private $playerNames;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="players")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="PlayerGuild", mappedBy="player")
     */
    private $playerGuilds;


    public function __construct()
    {
        $this->playerLvls = new ArrayCollection();
        $this->playerNames = new ArrayCollection();
        $this->playerGuilds = new ArrayCollection();
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
     * Set inGameId
     *
     * @param string $inGameId
     *
     * @return Player
     */
    public function setInGameId($inGameId)
    {
        $this->inGameId = $inGameId;

        return $this;
    }

    /**
     * Get inGameId
     *
     * @return string
     */
    public function getInGameId()
    {
        return $this->inGameId;
    }

    /**
     * Set characteristic
     *
     * @param string $characteristic
     *
     * @return Player
     */
    public function setCharacteristic($characteristic)
    {
        $this->characteristic = $characteristic;

        return $this;
    }

    /**
     * Get characteristic
     *
     * @return string
     */
    public function getCharacteristic()
    {
        return $this->characteristic;
    }

    /**
     * Set absentDays
     *
     * @param integer $absentDays
     *
     * @return Player
     */
    public function setAbsentDays($absentDays)
    {
        $this->absentDays = $absentDays;

        return $this;
    }

    /**
     * Get absentDays
     *
     * @return int
     */
    public function getAbsentDays()
    {
        return $this->absentDays;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
