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
     * @var int
     *
     * @ORM\Column(name="player_id", type="integer")
     */
    private $playerId;

    /**
     * @var int
     *
     * @ORM\Column(name="champ_id", type="integer")
     */
    private $champId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * @return PlayerChamp
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
     * Set champId
     *
     * @param integer $champId
     *
     * @return PlayerChamp
     */
    public function setChampId($champId)
    {
        $this->champId = $champId;

        return $this;
    }

    /**
     * Get champId
     *
     * @return int
     */
    public function getChampId()
    {
        return $this->champId;
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

