<?php
namespace MachinesRent;

interface MachineWarehouseInterface
{

    public function store(Machine $machine);

    public function fetchBusyMachinesByDays(): array;
}
