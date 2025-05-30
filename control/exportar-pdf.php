<?php
require 'vendor/autoload.php';
include '../includes/db.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Obtener IDs de programas
$programIds = isset($_GET['ids']) ? explode(',', $_GET['ids']) : [];

if (empty($programIds)) {
    die("No hay programas para exportar");
}

// Obtener datos de los programas
$placeholders = implode(',', array_fill(0, count($programIds), '?'));
$stmt = $conn->prepare("SELECT * FROM data_programas WHERE id IN ($placeholders)");
$stmt->execute($programIds);
$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

// HTML para el PDF (similar a tu tabla de comparación pero optimizado para PDF)
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comparación de Programas Académicos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #003366; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f8f9fa; text-align: left; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .program-title { font-weight: bold; color: #00509e; }
        .feature-icon { width: 20px; margin-right: 5px; }
    </style>
</head>
<body>
    <h1>Comparación de Programas Académicos</h1>
    <p style="text-align: center; color: #666;">Generado el '.date('d/m/Y').'</p>';

// Tabla de comparación
$html .= '<table>
    <thead>
        <tr>
            <th>Característica</th>';

foreach ($programs as $program) {
    $html .= '<th class="program-title">'.$program['titulo'].'<br><small>'.$program['universidad'].'</small></th>';
}

$html .= '</tr></thead><tbody>';

// Agrega aquí las filas de comparación como en tu tabla HTML
$html .= '
<tr>
    <td><img src="assets/img/university-icon.png" class="feature-icon">Universidad</td>';
foreach ($programs as $program) {
    $html .= '<td>'.$program['universidad'].'</td>';
}
$html .= '</tr>';

// Repite para cada característica que quieras incluir
$html .= '
<tr>
    <td><img src="assets/img/type-icon.png" class="feature-icon">Tipo</td>';
foreach ($programs as $program) {
    $html .= '<td>'.$program['tipo'].'</td>';
}
$html .= '</tr>';

// Continúa con las demás características...

$html .= '</tbody></table></body></html>';

// Cargar el HTML en Dompdf
$dompdf->loadHtml($html);

// (Opcional) Tamaño y orientación del papel
$dompdf->setPaper('A4', 'landscape');

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream("comparacion-programas-".date('Y-m-d').".pdf", [
    "Attachment" => true
]);