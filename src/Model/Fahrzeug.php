<?php

namespace Model;


abstract class Fahrzeug implements FahrzeugInterface
{
    protected $ps = 0;

    public function getPS() {
        return $this->ps;
    }
}