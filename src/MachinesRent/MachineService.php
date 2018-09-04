<?php
namespace MachinesRent;

use DateInterval;
use DateTime;
use InvalidArgumentException;

class MachineService
{

    /**
     *
     * @var MachineFactory
     */
    private $factory;

    /**
     *
     * @var MachineWarehouseInterface 
     */
    private $warehouse;

    function __construct(MachineFactory $factory, MachineWarehouseInterface $warehouse)
    {
        $this->factory = $factory;
        $this->warehouse = $warehouse;
    }

    public function createNewMachine(CreateMachineRequest $request): CreateMachineResponse
    {
        $name = $request->name;
        $day = $request->day;
        $term = $request->term;

        $machine = $this->factory->create($name, $day, $term);

        $this->warehouse->store($machine);

        return new CreateMachineResponse('success');
    }

    public function getAllBusyMachines(string $date, int $offset)
    {
        //1 stworz tablice dat na podstawie offset
        $dateArray = $this->getDateArrayByOffset($date, $offset);

        // Pobierz zajętość maszyn per dzień jako dzień tygodnia => [ maszyna obiekt]
        $busyMachinesMap = $this->warehouse->fetchBusyMachinesByDays();
        // Pętla foreach (iteruj po tablicy dat) dla każdej daty sprawdź numer tygodnia
        foreach ($dateArray as $date) {
            $day = (new DateTime($date))->format('D');
            
            // pobierz wszystkie maszyny dla takiego numeru tygodnia
            if (!array_key_exists($day, $busyMachinesMap)) {
                continue;
            }
            $busyMachinesArray = $busyMachinesMap[$day];
            // Wykonaj Unie na datach term
            foreach ($busyMachinesArray as $machine) {
                $hours[] = $machine->getTerm();
            }
            // dopisz dla podanej daty, odpowiadające term'y
        }
    }

    public static function getDateArrayByOffset(string $date, int $offset)
    {
        if ($offset <= 0) {
            throw new InvalidArgumentException('offset must be value bigger than 0!');
        }

        $dateArray = [];
        $dateTime = new DateTime($date);
        for ($i = 1; $i <= $offset; $i++) {
            $dateArray[] = $dateTime->add(new DateInterval('P1D'))->format('Y-m-d');
        }

        return $dateArray;
    }
}
