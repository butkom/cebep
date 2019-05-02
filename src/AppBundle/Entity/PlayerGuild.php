<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerGuild
 *
 * @ORM\Table(name="player_guild")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerGuildRepository")
 */
class PlayerGuild extends Editable
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
     * @var int
     *
     * @ORM\Column(name="player_id", type="integer")
     */
    private $playerId;

    /**
     * @var int
     *
     * @ORM\Column(name="guild_id", type="integer")
     */
    private $guildId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="playerGuilds")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Guild", inversedBy="playerGuilds")
     * @ORM\JoinColumn(name="guild_id", referencedColumnName="id")
     */
    private $guild;


    /**
     * Set guild
     *
     * @param integer $guild
     *
     * @return PlayerGuild
     */
    public function setGuild($guild)
    {
        $this->guild = $guild;

        return $this;
    }

    /**
     * Get guild
     *
     * @return int
     */
    public function getGuild()
    {
        return $this->guild;
    }

    /**
     * @param integer $player
     *
     * @return PlayerGuild
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return int
     */
    public function getPlayer()
    {
        return $this->player;
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
     * Set playerId
     *
     * @param integer $playerId
     *
     * @return PlayerGuild
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return int
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set guildId
     *
     * @param integer $guildId
     *
     * @return PlayerGuild
     */
    public function setGuildId($guildId)
    {
        $this->guildId = $guildId;

        return $this;
    }

    /**
     * Get guildId
     *
     * @return int
     */
    public function getGuildId()
    {
        return $this->guildId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return PlayerGuild
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
}

