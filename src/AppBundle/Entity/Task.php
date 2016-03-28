<?php

namespace AppBundle\Entity;

class Task
{
    /**
     * @var string
     */
    private $task;

    /**
     * @var \DateTime
     */
    private $dueDate;

    /**
     * @return string
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param string $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param DateTime $dueDate
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;
    }
}