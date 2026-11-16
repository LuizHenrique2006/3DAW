<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $dados = json_decode(file_get_contents('php://input'), true);

    $num1 = $dados['numero1'] ?? 0;
    $num2 = $dados['numero2'] ?? 0;
    $operacao = $dados['operacao'] ?? 'soma';

    $resultado = 0;

    switch ($operacao) {
        case 'soma':
            $resultado = $num1 + $num2;
            break;
        case 'subtracao':
            $resultado = $num1 - $num2;
            break;
        case 'multiplicacao':
            $resultado = $num1 * $num2;
            break;
        case 'divisao':
            if ($num2 != 0) {
                $resultado = $num1 / $num2;
            } else {
                echo json_encode(['erro' => 'Divisão por zero não permitida']);
                exit;
            }
            break;
    }

    echo json_encode(['resultado' => $resultado]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Calculadora PHP + JS</title>
</head>
<body>

  <h1>Calculadora</h1>

  <form id="formCalculadora">
    <label for="numero1">Número 1:</label>
    <input type="number" id="numero1" name="numero1" step="any" required>
    <br><br>

    <label for="operacao">Operação:</label>
    <select id="operacao" name="operacao" required>
      <option value="soma">+</option>
      <option value="subtracao">-</option>
      <option value="multiplicacao">*</option>
      <option value="divisao">/</option>
    </select>
    <br><br>

    <label for="numero2">Número 2:</label>
    <input type="number" id="numero2" name="numero2" step="any" required>
    <br><br>

    <button type="submit">Calcular</button>
  </form>

  <h2 id="resultado"></h2>

  <script>
    const form = document.getElementById('formCalculadora');
    const campoResultado = document.getElementById('resultado');

    form.addEventListener('submit', async function (evento) {
      evento.preventDefault();

      const num1 = parseFloat(document.getElementById('numero1').value);
      const num2 = parseFloat(document.getElementById('numero2').value);
      const op = document.getElementById('operacao').value;

      try {
        const resposta = await fetch('index.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            numero1: num1,
            numero2: num2,
            operacao: op
          })
        });

        const dados = await resposta.json();

        if (dados.erro) {
          campoResultado.textContent = 'Erro: ' + dados.erro;
        } else {
          campoResultado.textContent = 'Resultado: ' + dados.resultado;
        }
      } catch (erro) {
        campoResultado.textContent = 'Erro na requisição ao servidor.';
      }
    });
  </script>

</body>
</html>