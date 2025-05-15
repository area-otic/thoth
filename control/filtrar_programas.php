<?php
include '../includes/db.php';
header('Content-Type: application/json');

try {
    // Obtener parámetros de la solicitud
    $page = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
    $itemsPerPage = 9;
    $offset = ($page - 1) * $itemsPerPage;
    
    // Construir consulta base
    $sqlBase = "SELECT * FROM data_maestrias WHERE estado_programa = 'Publicado'";
    $queryParams = [];
    
    // Procesar filtros
    $filterTypes = ['tipo', 'categoria', 'pais', 'modalidad', 'duracion'];
    
    foreach ($filterTypes as $filterType) {
        if (isset($_GET[$filterType])) {
            $filterValues = is_array($_GET[$filterType]) ? $_GET[$filterType] : [$_GET[$filterType]];
            
            if (!empty($filterValues)) {
                $placeholders = [];
                foreach ($filterValues as $index => $value) {
                    $paramName = ":" . $filterType . $index;
                    $placeholders[] = $paramName;
                    $queryParams[$paramName] = $value;
                }
                
                // Manejo especial para duración (rangos)
                if ($filterType === 'duracion') {
                    $conditions = [];
                    foreach ($filterValues as $value) {
                        $value = intval($value);
                        if ($value === 6) {
                            $conditions[] = "duracion_meses < 6";
                        } elseif ($value === 12) {
                            $conditions[] = "(duracion_meses >= 6 AND duracion_meses <= 12)";
                        } elseif ($value === 24) {
                            $conditions[] = "(duracion_meses > 12 AND duracion_meses <= 24)";
                        } elseif ($value === 25) {
                            $conditions[] = "duracion_meses > 24";
                        }
                    }
                    if (!empty($conditions)) {
                        $sqlBase .= " AND (" . implode(" OR ", $conditions) . ")";
                    }
                } else {
                    $sqlBase .= " AND " . $filterType . " IN (" . implode(", ", $placeholders) . ")";
                }
            }
        }
    }
    
    // Consulta para contar el total de resultados
    $sqlCount = "SELECT COUNT(*) as total FROM ($sqlBase) AS subquery";
    $stmtCount = $conn->prepare($sqlCount);
    $stmtCount->execute($queryParams);
    $totalResultados = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Consulta para obtener los resultados paginados
    $sql = $sqlBase . " ORDER BY titulo ASC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    foreach ($queryParams as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Devolver resultados
    echo json_encode([
        'programas' => $programas,
        'total' => $totalResultados
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al buscar programas: ' . $e->getMessage()]);
}
?>