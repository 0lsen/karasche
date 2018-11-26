<?php

namespace Model;


interface FahrzeugInterface
{
    /**
     * @return int
     */
    public function getPS();

    /**
     * @return FahrzeugInterface
     */
    public function motorUpgrade();

    // akademisches Beispiel, wie anderes Fahrzeug als Argument funktioniert
    public function addiereFahrzeug(FahrzeugInterface $fahrzeug);
}