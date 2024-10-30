<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="ISO-8859-1">
    <title>Calendario</title>
    <style>
        th, td {
            font-family: Tahoma, Verdana;
            font-size: 10px;
            color: #666666;
            text-align: center;
        }
        .current {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
<?php
// Arrays con los nombres de los meses y días en español
$nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$nomdia = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

// Obtener los parámetros de mes y año desde GET
$mes = isset($_GET['mes']) ? intval($_GET['mes']) : date('n');
$anio = isset($_GET['anio']) ? intval($_GET['anio']) : date('Y');

// Calcular el número de días del mes y el primer día del mes
$days = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
$primerDiaSemana = jddayofweek(GregorianToJD($mes, 1, $anio), 0); // 0 = Domingo, 6 = Sábado

// Imprimir el encabezado con el nombre del mes y el año
echo "<table cellpadding='0' cellspacing='2' width='200' border='0'>";
echo "<tr><th colspan='7'>{$nommes[$mes - 1]} $anio</th></tr>";
echo "</table>";

// Imprimir los días de la semana como encabezados de la tabla
echo "<table cellpadding='0' cellspacing='2' width='200' border='0'>";
echo "<tr>";
foreach (array("Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb") as $dia) {
    echo "<th>$dia</th>";
}
echo "</tr>";

// Variables para llevar el control de las celdas impresas
$diaActual = 1;
$imprimirVacio = true;

// Imprimir las celdas del calendario
for ($fila = 0; $fila < 6; $fila++) { // Hasta 6 filas máximo
    echo "<tr>";
    for ($columna = 0; $columna < 7; $columna++) {
        if ($fila == 0 && $columna < $primerDiaSemana) {
            // Celdas vacías antes del primer día del mes
            echo "<td>&nbsp;</td>";
        } elseif ($diaActual <= $days) {
            // Imprimir el día del mes
            $clase = ($diaActual == date('j') && $mes == date('n') && $anio == date('Y')) ? "current" : "";
            echo "<td class='$clase'>$diaActual</td>";
            $diaActual++;
        } else {
            // Celdas vacías al final del mes
            echo "<td>&nbsp;</td>";
        }
    }
    echo "</tr>";

    // Salimos del ciclo si ya imprimimos todos los días
    if ($diaActual > $days) {
        break;
    }
}
echo "</table>";
?>
</body>
</html>
