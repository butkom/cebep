<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Guild
 *
 * @ORM\Table(name="guild")
 * @ORM\Entity(repositoryClass="App\Repository\GuildRepository")
 */
class Guild extends Editable
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
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=3)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=5)
     */
    private $server = 'S032';

    /**
     * @ORM\OneToMany(targetEntity="GuildChamp", mappedBy="guild")
     */
    private $guildChamps;




    /**
     * @ORM\ManyToMany(targetEntity="Player", mappedBy="guilds")
     */
    private $players;


    public function __construct()
    {
        $this->guildChamps = new ArrayCollection();
        $this->players = new ArrayCollection();
    }


    public function getGuildChamp()
    {
        return $this->guildChamps;
    }

    public function addGuildChamp(GuildChamp $guildChamp): self
    {
        if (!$this->guildChamps->contains($guildChamp)) {
            $this->guildChamps[] = $guildChamp;
            $guildChamp->setGuild($this);
        }

        return $this;
    }

    public function removeGuildChamp(GuildChamp $guildChamp): self
    {
        if ($this->guildChamps->contains($guildChamp)) {
            $this->guildChamps->removeElement($guildChamp);

            if ($guildChamp->getGuild() === $this) {
                $guildChamp->setGuild(null);
            }
        }

        return $this;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
        if ($this->players->contains($player)) {
            return;
        }
        $this->players->add($player);
        $player->addGuild($this);
    }
    /**
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        if (!$this->players->contains($player)) {
            return;
        }
        $this->players->removeElement($player);
        $player->removeGuild($this);
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
     * Set name
     *
     * @param string $name
     *
     * @return Guild
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

    /**
     * Set shortName
     *
     * @param string $shortName
     *
     * @return Guild
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set server
     *
     * @param string $server
     *
     * @return Guild
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }
}

