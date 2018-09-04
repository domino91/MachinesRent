<?php
namespace MachinesRent;

class Machine
{
    /**
     *
     * @var string
     */
    private $name;
    
    /**
     *
     * @var string
     */
    private $day;
    
    /**
     *
     * @var string
     */
    private $term;
    
    function getName() :string
    {
        return $this->name;
    }

    function getDay() :string
    {
        return $this->day;
    }

    function getTerm() :string
    {
        return $this->term;
    }

    function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * set shortcut day name
     * @param string $day
     * @throws \InvalidArgumentException
     */
    function setDay(string $day)
    {
        if (!in_array($day, ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])) {
            throw new \InvalidArgumentException('Incorrect name of day');
        }
        
        $this->day = $day;
    }

    function setTerm(string $term)
    {
        if (!preg_match_all("/\d{1,2}:\d{1,2}-\d{1,2}:\d{1,2}/", $term)) {
            throw new \InvalidArgumentException('Incorrect value of term'); 
        }
        $this->term = $term;
    }
}
