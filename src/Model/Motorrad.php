<?php

namespace Model;


class Motorrad extends Fahrzeug
{
    public function __construct(int $ps = 1)
    {
        $this->ps = $ps;
    }

    public function motorUpgrade()
    {
        $this->ps++;
        return $this;
    }

    public function addiereFahrzeug(FahrzeugInterface $fahrzeug)
    {
        $this->ps += $fahrzeug->getPS();
        return $this;
    }
}