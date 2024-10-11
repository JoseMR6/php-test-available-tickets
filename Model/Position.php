<?php

declare(strict_types=1);

class Position
{
    //propiedades y constructor
    public function __construct(
        private int $idPosition,
        private string $section,
        private string $row,
        private int $ticketCount,
        private float $cost
    ) {}

    //metodos
    public function getData(): array
    {
        return get_object_vars($this);
    }

    public function sectorRowCompare(Position $position): int
    {
        $positionData = $position->getData();

        $output = strcmp($this->section, $positionData["section"]);

        if ($output == 0) {
            $output = strcmp($this->row, $positionData["row"]);
        }

        return $output;
    }
};
