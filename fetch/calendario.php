<?php
if (isset($_GET['anio']) && isset($_GET['mes'])) {
    $mes = intval($_GET['mes']);
    $anio = intval($_GET['anio']);

    // Arrays con los nombres de los meses y días en español
    $nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $nomdia = array("Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb");

    // Calcular el número de días del mes y el primer día del mes
    $days = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    $primerDiaSemana = jddayofweek(GregorianToJD($mes, 1, $anio), 0);

    // Imprimir el encabezado con el nombre del mes y el año
    echo "<table cellpadding='0' cellspacing='2' width='200' border='0'>";
    echo "<tr><th colspan='7'>{$nommes[$mes - 1]} $anio</th></tr>";
    echo "<tr>";
    foreach ($nomdia as $dia) {
        echo "<th>$dia</th>";
    }
    echo "</tr>";

    // Variables para controlar las celdas impresas
    $diaActual = 1;

    // Imprimir las filas del calendario
    for ($fila = 0; $fila < 6; $fila++) {
        echo "<tr>";
        for ($columna = 0; $columna < 7; $columna++) {
            if ($fila == 0 && $columna < $primerDiaSemana) {
                // Celdas vacías antes del primer día
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

        if ($diaActual > $days) break;
    }
    echo "</table>";
} else {
    echo "Faltan los parámetros anio y mes.";
}
?>
