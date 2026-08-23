<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $curso = $_POST["curso"];

    if (!file_exists("alunos.txt")) {

        $arquivo = fopen("alunos.txt", "w");

        fwrite($arquivo, "nome;matricula;curso\n");

        fclose($arquivo);
    }

    $arquivo = fopen("alunos.txt", "a");

    $dados = $nome . ";" . $matricula . ";" . $curso . "\n";

    fwrite($arquivo, $dados);

    fclose($arquivo);

    $mensagem = "Aluno cadastrado com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Aluno</title>

    <link rel="stylesheet" href="estilo.css">

</head>

<body>

    <div class="container">

        <h1>Cadastro de Aluno</h1>

        <p>Digite os dados do aluno:</p>

        <form method="POST">

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Matrícula:</label>
            <input type="text" name="matricula" required>

            <label>Curso:</label>
            <input type="text" name="curso" required>

            <button type="submit">Cadastrar</button>

        </form>

        <?php

        if (isset($mensagem)) {
            echo "<p class='mensagem'>$mensagem</p>";
        }

        ?>

    </div>

</body>

</html>