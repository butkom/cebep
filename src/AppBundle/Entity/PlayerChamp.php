<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerChamp
 *
 * @ORM\Table(name="player_champ")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerChampRepository")
 */
class PlayerChamp extends Editable
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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="playerChamps")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;


    /**
     * @ORM\ManyToOne(targetEntity="Champ", inversedBy="playerChamps")
     * @ORM\JoinColumn(name="champ_id", referencedColumnName="id")
     */
    private $champ;


    /**
     * @param Champ $champ
     *
     * @return PlayerChamp
     */
    public function setChamp($champ)
    {
        $this->champ = $champ;

        return $this;
    }

    /**
     * @return Champ
     */
    public function getChamp()
    {
        return $this->champ;
    }

    /**
     * @param Player $player
     *
     * @return PlayerChamp
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Player
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
     * @return PlayerChamp
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
