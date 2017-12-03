<?php

namespace AppBundle\Entity;


class Task
{
    private $title;
    private $time;

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
}