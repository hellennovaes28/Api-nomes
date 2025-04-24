<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API de Nomes</title>
  <link rel="stylesheet" href="api.css">
</head>
<body>
  <div class="container">
    <h1 class="title">Buscar Frequência de Nomes</h1>

    <form method="GET" class="form">
      <input type="text" name="nome" class="input" placeholder="Digite o nome (ex.: hellen)" required>
      <input type="number" name="minFreq" class="input" placeholder="Frequência mínima acima de 100">
      <input type="number" name="maxFreq" class="input" placeholder="Frequência máxima">
      <button type="submit" class="button">Buscar</button>
    </form>

    <?php
    if (isset($_GET['nome'])) {
        $nome = $_GET['nome'];
        $minFreq = isset($_GET['minFreq']) ? (int) $_GET['minFreq'] : null;
        $maxFreq = isset($_GET['maxFreq']) ? (int) $_GET['maxFreq'] : null;

        $url = "https://servicodados.ibge.gov.br/api/v2/censos/nomes/" . urlencode($nome);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (empty($data)) {
            echo "<div class='results'><p>Nenhum dado encontrado para o nome '$nome'.</p></div>";
        } else {
           
            $filteredResults = [];
            foreach ($data[0]['res'] as $item) {
                $freq = $item['frequencia'];
                if (($minFreq === null || $freq >= $minFreq) && ($maxFreq === null || $freq <= $maxFreq)) {
                    $filteredResults[] = $item;
                }
            }

            echo "<div class='results'>";
            if (empty($filteredResults)) {
                echo "<p>Nenhum resultado encontrado para os filtros aplicados.</p>";
            } else {
                echo "<h2>Resultados para o nome '$nome':</h2>";
                foreach ($filteredResults as $item) {
                    echo "<div class='result-item'>";
                    echo "<p><strong>Período:</strong> {$item['periodo']}</p>";
                    echo "<p><strong>Frequência:</strong> {$item['frequencia']}</p>";
                    echo "</div>";
                }
            }
            echo "</div>";
        }
    }
    ?>
  </div>
</body>
</html>
