<?php

namespace Model;

/**
 * Class FahrzeugWrapper
 * @package Model
 * @method Fahrzeug motorUpgrade()
 * @method Fahrzeug addiereFahrzeug(FahrzeugInterface|FahrzeugWrapper $fahrzeug)
 * @method int getPS()
 */
class FahrzeugWrapper
{
    private $fahrzeug;

    public function __construct(FahrzeugInterface $fahrzeug)
    {
        $this->fahrzeug = $fahrzeug;
    }

    /**
     * @return FahrzeugInterface
     */
    public function get() {
        return $this->fahrzeug;
    }

    public function __call($name, $arguments)
    {
        if (is_callable([$this->fahrzeug, $name])) {
            foreach ($arguments as &$argument) {
                if ($argument instanceof FahrzeugWrapper) {
                    $argument = $argument->get();
                }
            }
            $result = call_user_func([$this->fahrzeug, $name], ...$arguments);

            if (
                $result instanceof FahrzeugInterface &&
                $result !== $this->fahrzeug
            ) {
                $this->fahrzeug = $result;
            }

            return $result;
        } else {
            throw new \Exception("unbekannte Funktion");
        }
    }
}