<?php
namespace MachinesRent;

class CreateMachineResponse
{
    private $status;
    
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    
}
