<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Guild
 *
 * @ORM\Table(name="guild")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuildRepository")
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
    private $server;

    /**
     * @ORM\OneToMany(targetEntity="GuildChamp", mappedBy="guild")
     */
    private $guildChamps;

    /**
     * @ORM\OneToMany(targetEntity="PlayerGuild", mappedBy="guild")
     */
    private $playerGuilds;


    public function __construct()
    {
        $this->guildChamps = new ArrayCollection();
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

