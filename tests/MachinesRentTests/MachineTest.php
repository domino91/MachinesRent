<?php
namespace MachinesRentTests;

use InvalidArgumentException;
use MachinesRent\Machine;
use PHPUnit_Framework_TestCase;

class MachineTest extends PHPUnit_Framework_TestCase
{

    public function testSetDayCorrect()
    {
        $day = 'Mon';
        
        $machine = new Machine();
        $machine->setDay($day);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetDayIncorrect()
    {
        $day = 'Pon';
        
        $machine = new Machine();
        $machine->setDay($day);
    }
    
    /**
     * @dataProvider setTermDataProvider
     */
    public function testSetTerm($term, $expectedCorrect)
    {
        $machine = new Machine();
        $resultCorrect = true;
        
        try {
            $machine->setTerm($term);
        } catch (\InvalidArgumentException $ex) {
            $resultCorrect = false;
        }
        
        $this->assertEquals($expectedCorrect, $resultCorrect);
    }
    
    public function setTermDataProvider()
    {
        return [
          ['9:00-11:00', true],  
          ['06:00-14:00', true],  
          ['06:00', false],  
          ['-06:00', false],  
          ['', false],  
          ['-', false],  
          ['0-0', false],  
          [':0-:0', false],  
        ];
    }
    
}
