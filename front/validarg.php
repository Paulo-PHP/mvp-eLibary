<?php
    require_once '../back/classes/Locacao.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="pt/br" dir="ltr">
<head>
    <link rel="icon" href="https://image.flaticon.com/icons/png/512/73/73705.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style/estilo.css">
    <meta charset="utf-8">
    <title>Locação de livros</title>
</head>

<body>
    <section>
        <a href="index.html"><i class="material-icons">arrow_back</i></a>
        <form method="POST">
        <h2>Locação de Livros</h2>
            <br>
            <input type="text" name="rg" placeholder="Digite seu RG" required>
            <?php 
                if (isset($_POST['rg']) && isset($_POST['acao'])){
                    $rg = $_POST['rg'];
                    $l = new Locacao;
                    if ($l->validaRg($_POST['rg']) == false) {
                        echo "<br><p style='text-align:center; color:red; font-size:1.3em;'>RG não cadastrado</p>";
                    } else {
                        $idAluno = $l->validaRg($rg );
                        if ($_POST['acao'] == "alugar") {
                            if($l->verificaLocacoesAluno($rg) >= 3){
                                echo "<br><p style='text-align:center; color:red; font-size:1.3em;'>Aluno já possui 3 livros alugados</p>";
                            } else{
                                $locacoesAluno = $l->verificaLocacoesAluno($rg);
                                header("location: locacao.php?idAluno=$idAluno&rg=$rg&locacoes=$locacoesAluno");
                            }
                        }
                        else {
                            header("location: devolverLivro.php?idAluno=$idAluno");
                        }
                    }
                }
            ?>
            <br>
            <button name="acao" value="alugar">Realizar Locação</button>
            <button name="acao" value="devolver">Devolver</button>
        </form>
    </section>
</body>

</html>