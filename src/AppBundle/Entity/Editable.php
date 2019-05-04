<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editable
 */
class Editable
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="editions")
     * @ORM\JoinColumn(name="editor_id", referencedColumnName="id")
     */
    protected $editor;


    /**
     * @param User $editor
     *
     * @return Editable
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * @return int
     */
    public function getEditor()
    {
        return $this->editor;
    }
}

