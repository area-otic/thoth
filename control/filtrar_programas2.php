<?php
include '../includes/db.php';
header('Content-Type: application/json');

try {
    // Obtener parámetros de la solicitud
    $page = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
    $itemsPerPage = 9;
    $offset = ($page - 1) * $itemsPerPage;
    
    $sqlBase = "SELECT * FROM data_maestrias WHERE estado_programa = 'Publicado'";
    $queryParams = [];
    $conditions = [];
    
    // Procesar filtros estándar (tipo, categoria, pais, modalidad)
    $standardFilters = ['tipo', 'categoria', 'pais', 'modalidad'];
    foreach ($standardFilters as $filterType) {
        if (isset($_GET[$filterType])) {
            $filterValues = is_array($_GET[$filterType]) ? $_GET[$filterType] : [$_GET[$filterType]];
            
            if (!empty($filterValues)) {
                $placeholders = [];
                foreach ($filterValues as $index => $value) {
                    $paramName = ":" . $filterType . $index;
                    $placeholders[] = $paramName;
                    $queryParams[$paramName] = $value;
                }
                $conditions[] = $filterType . " IN (" . implode(", ", $placeholders) . ")";
            }
        }
    }
    
    // Procesar filtro de duración (nuevo enfoque)
    if (isset($_GET['duracion'])) {
        $duracionValues = is_array($_GET['duracion']) ? $_GET['duracion'] : [$_GET['duracion']];
        $duracionConditions = [];
        
        foreach ($duracionValues as $value) {
            switch ($value) {
                case 'short':
                    // Hasta 6 meses o 1 trimestre o hasta 200 horas
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 6) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 1) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 200)";
                    break;
                    
                case 'medium':
                    // 6-12 meses o 1-2 trimestres o 200-500 horas
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 6 AND 12) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 1 AND 2) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 200 AND 500)";
                    break;
                    
                case 'long':
                    // 1-2 años (12-24 meses) o 3-4 trimestres o 500-1000 horas
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 12 AND 24) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 3 AND 4) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 500 AND 1000) OR " .
                        "(duracion LIKE '%año%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 1 AND 2)";
                    break;
                    
                case 'extended':
                    // Más de 2 años (24+ meses) o 4+ trimestres o 1000+ horas
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) > 24) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) > 4) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) > 1000) OR " .
                        "(duracion LIKE '%año%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) > 2)";
                    break;
            }
        }
        
        if (!empty($duracionConditions)) {
            $conditions[] = "(" . implode(" OR ", $duracionConditions) . ")";
        }
    }
    
    // Aplicar todas las condiciones
    if (!empty($conditions)) {
        $sqlBase .= " AND " . implode(" AND ", $conditions);
    }
    
    // Consulta para contar el total de resultados
    $sqlCount = "SELECT COUNT(*) as total FROM ($sqlBase) AS subquery";
    $stmtCount = $conn->prepare($sqlCount);
    foreach ($queryParams as $key => $value) {
        $stmtCount->bindValue($key, $value);
    }
    $stmtCount->execute();
    $totalResultados = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Consulta para obtener los resultados paginados
    $sql = $sqlBase . " ORDER BY titulo ASC LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    foreach ($queryParams as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear duración para mostrarla consistentemente
    foreach ($programas as &$programa) {
        $programa['duracion_formateada'] = formatearDuracion($programa['duracion']);
    }
    
    echo json_encode([
        'programas' => $programas,
        'total' => $totalResultados
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al buscar programas: ' . $e->getMessage()]);
}

// Función auxiliar para formatear la duración
function formatearDuracion($duracion) {
    if (strpos($duracion, 'mes') !== false) {
        $num = intval($duracion);
        return $num > 1 ? "$num meses" : "$num mes";
    } elseif (strpos($duracion, 'trimestre') !== false) {
        $num = intval($duracion);
        return $num > 1 ? "$num trimestres" : "$num trimestre";
    } elseif (strpos($duracion, 'hora') !== false) {
        $num = intval($duracion);
        return "$num horas";
    } elseif (strpos($duracion, 'año') !== false) {
        $num = intval($duracion);
        return $num > 1 ? "$num años" : "$num año";
    }
    return $duracion;
}
?>