<?php
include '../includes/db.php';

header('Content-Type: application/json');

try {
    // Consulta para universidades con convenio
    $stmt = $conn->query("SELECT * FROM data_instituciones
                         WHERE convenio = 'Si' AND estado = 'Activo'
                         ORDER BY nombre ASC");
    
    $universidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'universidades' => $universidades,
        'count' => count($universidades)
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar las instituciones: ' . $e->getMessage()
    ]);
}
?>