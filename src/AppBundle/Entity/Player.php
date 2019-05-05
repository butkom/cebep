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
     *
     * @ORM\ManyToMany(targetEntity="Guild", inversedBy="players")
     * @ORM\JoinTable(
     *  name="player_guild",
     *  joinColumns={
     *      @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="guild_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $guilds;


    /**
     * @ORM\OneToMany(targetEntity="PlayerChamp", mappedBy="player")
     */
    private $playerChamps;

    public function __construct()
    {
        $this->playerLvls = new ArrayCollection();
        $this->playerNames = new ArrayCollection();
        $this->guilds = new ArrayCollection();
        $this->playerChamps = new ArrayCollection();
    }

    public function getPlayerChamps()
    {
        return $this->playerChamps;
    }

    public function addPlayerChamp(PlayerChamp $playerChamp): self
    {
        if (!$this->playerChamps->contains($playerChamp)) {
            $this->playerChamps[] = $playerChamp;
            $playerChamp->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerChamp(PlayerChamp $playerChamp): self
    {
        if ($this->playerChamps->contains($playerChamp)) {
            $this->playerChamps->removeElement($playerChamp);

            if ($playerChamp->getPlayer() === $this) {
                $playerChamp->setPlayer(null);
            }
        }

        return $this;
    }


    public function getGuilds()
    {
        return $this->guilds;
    }

    /**
     * @param Guild $guild
     */
    public function addGuild(Guild $guild)
    {
        if ($this->guilds->contains($guild)) {
            return;
        }
        $this->guilds->add($guild);
        $guild->addPlayer($this);
    }
    /**
     * @param Guild $guild
     */
    public function removeGuild(Guild $guild)
    {
        if (!$this->guilds->contains($guild)) {
            return;
        }
        $this->guilds->removeElement($guild);
        $guild->removePlayer($this);
    }

    public function getPlayerNames()
    {
        return $this->playerNames;
    }

    public function addPlayerName(PlayerName $playerName): self
    {
        if (!$this->playerNames->contains($playerName)) {
            $this->playerNames[] = $playerName;
            $playerName->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerName(PlayerName $playerName): self
    {
        if ($this->playerNames->contains($playerName)) {
            $this->playerNames->removeElement($playerName);

            if ($playerName->getPlayer() === $this) {
                $playerName->setPlayer(null);
            }
        }

        return $this;
    }

    public function getPlayerLvls()
    {
        return $this->playerLvls;
    }

    public function addPlayerLvl(PlayerLvl $playerLvl): self
    {
        if (!$this->playerLvls->contains($playerLvl)) {
            $this->playerLvls[] = $playerLvl;
            $playerLvl->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerLvl(PlayerLvl $playerLvl): self
    {
        if ($this->playerLvls->contains($playerLvl)) {
            $this->playerLvls->removeElement($playerLvl);

            if ($playerLvl->getPlayer() === $this) {
                $playerLvl->setPlayer(null);
            }
        }

        return $this;
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
