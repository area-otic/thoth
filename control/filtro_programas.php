<?php
include '../includes/db.php';
header('Content-Type: application/json');

try {
    $page = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
    $itemsPerPage = 9;
    $offset = ($page - 1) * $itemsPerPage;
    
    $sqlBase = "SELECT * FROM data_programas WHERE estado_programa = 'Publicado'";
    $queryParams = [];
    $conditions = [];
    
    // Procesar búsqueda por texto
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $conditions[] = "(titulo LIKE :search OR universidad LIKE :search)"; // Busca en ambos campos
        $queryParams[':search'] = '%' . $searchTerm . '%';
    }
    
    // Procesar filtros estándar (tipo, categoria, pais, modalidad)
    $standardFilters = ['tipo', 'categoria', 'pais', 'modalidad', 'universidad'];
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
    
    // Procesar filtro de duración
    if (isset($_GET['duracion'])) {
        $duracionValues = is_array($_GET['duracion']) ? $_GET['duracion'] : [$_GET['duracion']];
        $duracionConditions = [];
        
        foreach ($duracionValues as $value) {
            switch ($value) {
                case 'short':
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 6) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 1) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) <= 200)";
                    break;
                    
                case 'medium':
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 6 AND 12) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 1 AND 2) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 200 AND 500)";
                    break;
                    
                case 'long':
                    $duracionConditions[] = 
                        "(duracion LIKE '%mes%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 12 AND 24) OR " .
                        "(duracion LIKE '%trimestre%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 3 AND 4) OR " .
                        "(duracion LIKE '%hora%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 500 AND 1000) OR " .
                        "(duracion LIKE '%año%' AND CAST(SUBSTRING_INDEX(duracion, ' ', 1) AS UNSIGNED) BETWEEN 1 AND 2)";
                    break;
                    
                case 'extended':
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
    
    echo json_encode([
        'programas' => $programas,
        'total' => $totalResultados
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al buscar programas: ' . $e->getMessage()]);
}
?>