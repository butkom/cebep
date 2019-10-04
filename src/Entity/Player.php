<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="players")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

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
        $this->guilds = new ArrayCollection();
        $this->playerChamps = new ArrayCollection();
    }

    /**
     * @return Guild|null
     */
    public function getGuild(): ?Guild
    {
        return $this->getGuilds()->first();
    }

    /**
     * @param Guild $guild
     * @return Player
     */
    public function setGuild(Guild $guild): self
    {
        $this->addGuild($guild);

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Player
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
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
