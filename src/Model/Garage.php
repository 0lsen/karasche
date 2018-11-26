<?php

namespace Model;


class Garage
{
    /**
     * @var FahrzeugWrapper[]
     */
    private $fahrzeuge = [];

    public function add(Fahrzeug $fahrzeug) {
        $this->fahrzeuge[] = new FahrzeugWrapper($fahrzeug);
    }

    /**
     * @param int $i
     * @return FahrzeugInterface
     */
    public function get(int $i)
    {
        return $this->fahrzeuge[$i-1]->get();
    }

    /**
     * @param int $i
     * @return FahrzeugWrapper
     */
    public function __invoke(int $i)
    {
        return $this->fahrzeuge[$i-1];
    }
}