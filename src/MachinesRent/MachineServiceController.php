<?php
namespace MachinesRent;

class MachineServiceController
{

    public function createNewMachine(Request $request)
    {
        $dataFromRequest = ''; //Todo

        /** @var MachineService $machineService * */
        $machineService = $this->container->get('machine_service');

        $request = new CreateMachineRequest($dataFromRequest);

        $machineService->createNewMachine($request);
    }
}
