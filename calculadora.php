<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

    <div class="calculadora">

        <h1>Minha Calculadora</h1>

        <form action="" method="POST">

            <label>Digite o primeiro número:</label>
            <input type="number" name="num1" step="any" required>

            <label>Digite o segundo número:</label>
            <input type="number" name="num2" step="any" required>

            <label>Operação:</label>
            <select name="op" required>
                <option value="">Escolha uma operação</option>
                <option value="+">Somar</option>
                <option value="-">Subtrair</option>
                <option value="*">Multiplicar</option>
                <option value="/">Dividir</option>
            </select>

            <button type="submit">Resultado</button>

        </form>

        <?php

        if (isset($_POST["num1"]) && isset($_POST["num2"])) {

            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $op = $_POST["op"];

            switch ($op) {

                case "+":
                    $resultado = $num1 + $num2;
                    break;

                case "-":
                    $resultado = $num1 - $num2;
                    break;

                case "*":
                    $resultado = $num1 * $num2;
                    break;

                case "/":
                    if ($num2 != 0) {
                        $resultado = $num1 / $num2;
                    } else {
                        $resultado = "Erro: divisão por zero.";
                    }
                    break;

                default:
                    $resultado = "Escolha uma operação válida.";
            }

            echo "<div class='resultado'>";
            echo "<h2>Resultado:</h2>";
            echo "<p>" . $resultado . "</p>";
            echo "</div>";
        }

        ?>

    </div>

</body>

</html>