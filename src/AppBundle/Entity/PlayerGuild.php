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
     * @param Guild $guild
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
     * @param Player $player
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

