<?php
require_once "Empleado.php";
require_once "Evaluable.php";

/**
 * Clase Desarrollador
 * Hereda de Empleado e implementa la interfaz Evaluable
 */
class Desarrollador extends Empleado implements Evaluable {
    private $lenguajePrincipal;
    private $nivelExperiencia; // junior, semi-senior, senior

    public function __construct($nombre, $idEmpleado, $salarioBase, $lenguajePrincipal, $nivelExperiencia) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->lenguajePrincipal = $lenguajePrincipal;
        $this->nivelExperiencia = $nivelExperiencia;
    }

    public function getLenguajePrincipal() {
        return $this->lenguajePrincipal;
    }

    public function setLenguajePrincipal($lenguaje) {
        $this->lenguajePrincipal = $lenguaje;
    }

    public function getNivelExperiencia() {
        return $this->nivelExperiencia;
    }

    public function setNivelExperiencia($nivel) {
        $this->nivelExperiencia = $nivel;
    }

    /**
     * Evaluación del desarrollador según su nivel
     */
    public function evaluarDesempenio() {
        switch ($this->nivelExperiencia) {
            case "junior":
                return "El Desarrollador {$this->nombre} necesita más capacitación.";
            case "semi-senior":
                return "El Desarrollador {$this->nombre} tiene un buen desempeño.";
            case "senior":
                return "El Desarrollador {$this->nombre} es altamente eficiente.";
            default:
                return "Nivel de experiencia no definido para {$this->nombre}.";
        }
    }
}