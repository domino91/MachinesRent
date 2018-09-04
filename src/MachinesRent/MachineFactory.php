<?php

namespace MachinesRent;

class MachineFactory
{
    public function create(string $name, string $day, string $term) : Machine {
        $machine = new Machine();
        
        $machine->setName($name);
        $machine->setDay($day);
        $machine->setTerm($term);
        
        return $machine;
    }
}
