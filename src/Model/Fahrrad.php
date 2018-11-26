<?php

namespace Model;


class Fahrrad extends Fahrzeug
{
    public function motorUpgrade()
    {
        return new Motorrad();
    }

    public function addiereFahrzeug(FahrzeugInterface $fahrzeug)
    {
        $this->ps += $fahrzeug->getPS();
        if ($this->ps > 0) {
            return new Motorrad($this->ps);
        } else {
            return $this;
        }
    }
}