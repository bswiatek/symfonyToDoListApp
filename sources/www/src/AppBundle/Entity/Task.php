<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $time;

    /**
     * @ORM\Column(type="boolean")
     */
    private $done = false;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime(\DateTime $time = null)
    {
        $this->time = $time;
    }

    public function getId()
    {
        return $this->id;
    }

    public function markDone($done)
    {
        $this->done = $done;
    }

    public function isDone()
    {
        return $this->done;
    }
}