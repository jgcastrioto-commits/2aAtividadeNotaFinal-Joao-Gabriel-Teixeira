<?php require 'database.php'; 
$livros = $db->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livraria - João Gabriel</title>
    <style>
        body {font-family: Arial; margin:40px; background:#f4f4f4;}
        .box {background:white; padding:20px; border-radius:10px; box-shadow:0 0 10px #ddd; max-width:800px; margin:auto;}
        input, button {padding:8px; margin:5px 0; width:100%; border-radius:5px; border:1px solid #ccc;}
        button {background:#0066cc; color:white; cursor:pointer;}
        table {width:100%; border-collapse:collapse; margin-top:20px;}
        th, td {padding:10px; text-align:left; border-bottom:1px solid #ddd;}
        th {background:#0066cc; color:white;}
        a {color:red; text-decoration:none;}
        a:hover {text-decoration:underline;}
    </style>
</head>
<body>
<div class="box">
    <h1>Livraria</h1>

    <h2>Adicionar Livro</h2>
    <form action="add_book.php" method="post">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="number" name="ano" placeholder="Ano" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Livros Cadastrados</h2>
    <?php if (empty($livros)): ?>
        <p>Nenhum livro ainda.</p>
    <?php else: ?>
        <table>
            <tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano</th><th>Ação</th></tr>
            <?php foreach ($livros as $l): ?>
                <tr>
                    <td><?= $l['id'] ?></td>
                    <td><?= htmlspecialchars($l['titulo']) ?></td>
                    <td><?= htmlspecialchars($l['autor']) ?></td>
                    <td><?= $l['ano'] ?></td>
                    <td><a href="delete_book.php?id=<?= $l['id'] ?>" 
                          onclick="return confirm('Excluir este livro?')">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>