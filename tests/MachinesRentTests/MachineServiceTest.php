<?php
namespace MachinesRentTests;

use MachinesRent\CreateMachineRequest;
use MachinesRent\CreateMachineResponse;
use MachinesRent\MachineFactory;
use MachinesRent\MachineService;
use MachinesRent\MachineWarehouseInterface;
use PHPUnit_Framework_TestCase;

class MachineServiceTest extends PHPUnit_Framework_TestCase
{

    private $machineFactory;
    private $machineService;
    private $machineRepository;

    public function setUp()
    {
        $this->machineFactory = new MachineFactory();
        $this->machineRepository = $this->getMockBuilder(MachineWarehouseInterface::class)->getMock();
        $this->machineService = new MachineService($this->machineFactory, $this->machineRepository);

        parent::setUp();
    }

    public function testCreateNewMachine()
    {
        $createMachineRequest = new CreateMachineRequest([
            'name' => 'Excavator 011',
            'day' => 'Tue',
            'term' => '9:00-11:00'
        ]);

        $this->machineRepository->expects($this->once())
            ->method('store')
            ->willReturn(true);

        $expectedResponse = new CreateMachineResponse('success');

        $this->assertEquals($expectedResponse, $this->machineService->createNewMachine($createMachineRequest));
    }

    public function testGetAllBusyMachines()
    {
        $expected = [
            [
                "date" => "2018-07-03",
                "hours" => [
                    ["09:00", "11:00"],
                    ["12:00", "13:00"]
                ]
            ],
            [
                "date" => "2018-07-04",
                "hours" => [
                    ["06:00", "14:00"]
                ]
            ],
            [
                "date" => "2018-07-05",
                "hours" => [
                    ["06:00", "12:00"]
                ]
            ]
        ];

        $this->machineRepository->expects($this->once())
            ->method('store')
            ->willReturn(true);

        $result = $this->machineService->getAllBusyMachines('2018-06-29', 3);
        $this->assertEquals($expected, $result);
    }
    
   
    public function testGetDateArrayByOffset()
    {
        $expected = ['2018-06-30', '2018-07-01', '2018-07-02'];
        $result = $this->machineService->getDateArrayByOffset('2018-06-29', 3);
        
        $this->assertEquals($expected, $result);
    }
    
}
