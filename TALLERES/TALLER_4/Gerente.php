<?php
require_once "Empleado.php";
require_once "Evaluable.php";

/**
 * Clase Gerente
 * Hereda de Empleado e implementa la interfaz Evaluable
 */
class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono = 0;

    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function asignarBono($bono) {
        $this->bono = $bono;
    }

    public function getSalarioTotal() {
        return $this->salarioBase + $this->bono;
    }

    /**
     * Evaluación del gerente:
     * Si recibe un bono alto, se asume un gran desempeño
     */
    public function evaluarDesempenio() {
        if ($this->bono > 1000) {
            return "Excelente desempeño del Gerente {$this->nombre}";
        } else {
            return "Buen desempeño del Gerente {$this->nombre}, con posibilidad de mejorar.";
        }
    }
}