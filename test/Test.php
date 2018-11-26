<?php

namespace Karasche;

include "../vendor/autoload.php";


use Model\Fahrrad;
use Model\Garage;
use Model\Motorrad;
use PHPUnit\Framework\TestCase;

class Test extends TestCase {

    /**
     * Wir haben eine Garage. Da kann man Fahrzeuge reinstellen (Fahrraeder und Motorraeder).
     * Durch Operationen kann sich die Implementierung eines Fahrzeugs aendern (Motor dranschrauben, anderes Fahrzeug "addieren").
     * Nach einer solchen soll sich am Stellplatz die geaenderte Implementierung befinden, ohne ihn neu zuweisen zu muessen.
     *
     * Das soll der FahrzeugWrapper tun, indem er alle Operationen an "sein Fahrzeug" delegiert und es bei Bedarf ersetzt
     * und aus übergebenen Argumenten Fahrzeuge aus FahrzeugWrappern extrahiert.
     */
    function testStuff()
    {
        $garage = new Garage();

        // neues Motorrad mit 1 PS
        $garage->add(new Motorrad());
        $this->assertEquals(1, $garage(1)->getPS());
        $fahrzeugVorher = $garage(1)->get();
        $refVorher = &$fahrzeugVorher;

        // Motorrad PS++, es bleibt dasselbe
        $garage(1)->motorUpgrade();
        $this->assertEquals(2, $garage(1)->getPS());
        $fahrzeugNachher = $garage(1)->get();
        $refNachher = &$fahrzeugNachher;
        $this->assertEquals($refVorher, $refNachher);

        // neues Fahrrad (0 PS)
        $garage->add(new Fahrrad());
        $this->assertEquals(0, $garage(2)->getPS());
        $fahrzeugVorher = $garage(2)->get();
        $refVorher = &$fahrzeugVorher;

        // Fahrrad PS++ mutiert zum Motorrad
        $garage(2)->motorUpgrade();
        $this->assertEquals(1, $garage(2)->getPS());
        $fahrzeugNachher = $garage(2)->get();
        $refNachher = &$fahrzeugNachher;
        $this->assertNotEquals($refVorher, $refNachher);
        $this->assertTrue($garage(1)->get() instanceof Motorrad);

        // neues Fahrrad (0 PS)
        $garage->add(new Fahrrad());
        $this->assertEquals(0, $garage(3)->getPS());
        $fahrzeugVorher = $garage(3)->get();
        $refVorher = &$fahrzeugVorher;

        // addiere Fahrrad zu Fahrrad, es bleibt dasselbe
        $garage(3)->addiereFahrzeug(new Fahrrad());
        $this->assertEquals(0, $garage(3)->getPS());
        $this->assertTrue($garage(3)->get() instanceof Fahrrad);
        $fahrzeugNachher = $garage(3)->get();
        $refNachher = &$fahrzeugNachher;
        $this->assertEquals($refVorher, $refNachher);

        // addiere Motorrad aus Garage zu Fahrrad, es mutiert zum Motorrad
        $garage(3)->addiereFahrzeug($garage(1));
        $this->assertEquals(2, $garage(3)->getPS());
        $this->assertTrue($garage(3)->get() instanceof Motorrad);
        $fahrzeugNachher = $garage(3)->get();
        $refNachher = &$fahrzeugNachher;
        $this->assertNotEquals($refVorher, $refNachher);
    }
}