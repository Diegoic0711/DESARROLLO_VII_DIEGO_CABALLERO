<?php
/**
 * Clase Empresa
 * Permite agregar empleados, listarlos,
 * calcular la nómina total y evaluar desempeño.
 */
class Empresa {
    private $empleados = [];

    // Agregar un empleado a la lista
    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
    }

    // Listar empleados (devuelve un arreglo para procesar en index.php)
    public function getEmpleados() {
        return $this->empleados;
    }

    // Calcular la nómina total
    public function calcularNominaTotal() {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            if (method_exists($empleado, "getSalarioTotal")) {
                $total += $empleado->getSalarioTotal();
            } else {
                $total += $empleado->getSalarioBase();
            }
        }
        return $total;
    }

    // Evaluar desempeño de todos los empleados evaluables
    public function evaluarEmpleados() {
        $resultados = [];
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                $resultados[] = $empleado->evaluarDesempenio();
            }
        }
        return $resultados;
    }
}