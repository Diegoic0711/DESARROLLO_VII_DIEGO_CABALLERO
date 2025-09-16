<?php
require_once "Gerente.php";
require_once "Desarrollador.php";
require_once "Empresa.php";

// Crear empresa
$miEmpresa = new Empresa();

// Crear empleados
$gerente1 = new Gerente("Carlos López", 1, 3000, "Ventas");
$gerente1->asignarBono(1200);

$dev1 = new Desarrollador("Ana Torres", 2, 2000, "PHP", "junior");
$dev2 = new Desarrollador("Luis Pérez", 3, 2500, "Java", "senior");

// Agregar empleados
$miEmpresa->agregarEmpleado($gerente1);
$miEmpresa->agregarEmpleado($dev1);
$miEmpresa->agregarEmpleado($dev2);

// Obtener datos
$empleados = $miEmpresa->getEmpleados();
$nomina = $miEmpresa->calcularNominaTotal();
$evaluaciones = $miEmpresa->evaluarEmpleados();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }
        .card {
            background: #ffffff;
            margin: 15px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 800px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background: #ecf0f1;
        }
        .highlight {
            background: #27ae60;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #bdc3c7;
            margin: 6px 0;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>📊 Sistema de Gestión de Empresa</h1>

    <!-- Lista de empleados -->
    <div class="card">
        <h2>Lista de Empleados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Salario</th>
            </tr>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?= $empleado->getIdEmpleado() ?></td>
                    <td><?= $empleado->getNombre() ?></td>
                    <td><?= get_class($empleado) ?></td>
                    <td>
                        <?php 
                            if (method_exists($empleado, "getSalarioTotal")) {
                                echo "$" . $empleado->getSalarioTotal();
                            } else {
                                echo "$" . $empleado->getSalarioBase();
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Nómina -->
    <div class="card">
        <h2>Nómina Total</h2>
        <p class="highlight">Total: $<?= $nomina ?></p>
    </div>

    <!-- Evaluaciones -->
    <div class="card">
        <h2>Evaluaciones de Desempeño</h2>
        <ul>
            <?php foreach ($evaluaciones as $ev): ?>
                <li><?= $ev ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>