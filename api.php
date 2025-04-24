<?php
header('Content-Type: application/json');

// Função para buscar dados da API do IBGE , faz com ao digitar qualquer nome as informações do IBGE sejam retornadas
//  de forma que voce possa ver as informações do nome buscado


function fetchData($nome) {
    $url = "https://servicodados.ibge.gov.br/api/v2/censos/nomes/" . urlencode($nome);
    $response = file_get_contents($url);

    if ($response === FALSE) {
        return ['erro' => 'Erro ao consultar a API do IBGE.'];
    }

    $data = json_decode($response, true);
    return $data;
}

$nome = isset($_GET['nome']) ? trim($_GET['nome']) : null;
$minFreq = isset($_GET['minFreq']) ? (int) $_GET['minFreq'] : null;
$maxFreq = isset($_GET['maxFreq']) ? (int) $_GET['maxFreq'] : null;

if (!$nome) {
    echo json_encode(['erro' => 'Parâmetro "nome" é obrigatório.']);
    exit;
}

// Buscar os dados da API
$data = fetchData($nome);

if (isset($data['erro'])) {
    echo json_encode($data);
    exit;
}


file_put_contents('debug.txt', json_encode($data, JSON_PRETTY_PRINT));


$filteredResults = [];
if (!empty($data)) {
    foreach ($data[0]['res'] as $item) {
        $freq = $item['frequencia'];
        if (($minFreq === null || $freq >= $minFreq) && ($maxFreq === null || $freq <= $maxFreq)) {
            $filteredResults[] = $item;
        }
    }
}

if (empty($filteredResults)) {
    echo json_encode(['mensagem' => 'Nenhum dado encontrado para os filtros aplicados.']);
} else {
    echo json_encode($filteredResults);
}
?>
