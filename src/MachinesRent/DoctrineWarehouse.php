<?php
namespace MachinesRent;

use Doctrine\ORM\EntityManager;

class DoctrineWarehouse implements MachineWarehouseInterface
{

    private $entityManager;

    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function store(Machine $machine)
    {
        $this->entityManager->persist($machine);
        $this->entityManager->flush();
    }

    public function fetchBusyMachinesByDays(): array
    {
        $query = $this->entityManager->createQuery('SELECT m FROM MachinesRent\Machine m');
        $machines = $query->getResult();
        
        $busyMachines = [];
        /* @var $machine \MachinesRent\Machine */
        foreach ($machines as $machine) {
            $busyMachines[$machine->getDay()][] = $machine;
        }
        
        return $busyMachines;
    }
}
