<?php require 'database.php';
$pendentes = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY vencimento")->fetchAll();
$concluidas = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY vencimento")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tarefas - João Gabriel</title>
    <style>
        body {font-family: Arial; margin:40px; background:#f9f9f9;}
        .box {background:white; padding:25px; border-radius:10px; box-shadow:0 0 10px #908b8bff; max-width:800px; margin:auto;}
        input, button {padding:10px; margin:5px 0; width:100%; border-radius:5px; border:1px solid #aaa;}
        button {background:#28a745; color:white; cursor:pointer;}
        .btn-small {width:auto; display:inline-block; padding:6px 12px; font-size:14px;}
        .concluida {text-decoration:line-through; color:#888;}
        ul {list-style:none; padding:0;}
        li {padding:10px; border-bottom:1px solid #7e7e7eff; display:flex; justify-content:space-between; align-items:center;}
        a {color:#dc3545; text-decoration:none;}
        a:hover {text-decoration:underline;}
    </style>
</head>
<body>
<div class="box">
    <h1>Minhas Tarefas</h1>

    <h2>Nova Tarefa</h2>
    <form action="add_tarefa.php" method="post">
        <input type="text" name="descricao" placeholder="O que precisa fazer?" required>
        <input type="date" name="vencimento">
        <button type="submit">Adicionar Tarefa</button>
    </form>

    <h2>Pendentes (<?= count($pendentes) ?>)</h2>
    <?php if (empty($pendentes)): ?>
        <p>Nenhuma tarefa pendente.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($pendentes as $t): ?>
                <li>
                    <span><strong><?= htmlspecialchars($t['descricao']) ?></strong>
                        <?php if($t['vencimento']) echo " - Vence: ".date('d/m/Y', strtotime($t['vencimento'])); ?>
                    </span>
                    <span>
                        <a href="update_tarefa.php?id=<?= $t['id'] ?>" class="btn-small" style="background:#007bff; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">Concluir</a>
                        <a href="delete_tarefa.php?id=<?= $t['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Concluídas (<?= count($concluidas) ?>)</h2>
    <?php if (empty($concluidas)): ?>
        <p>Nenhuma tarefa concluída.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($concluidas as $t): ?>
                <li class="concluida">
                    <span><?= htmlspecialchars($t['descricao']) ?>
                        <?php if($t['vencimento']) echo " - Venceu: ".date('d/m/Y', strtotime($t['vencimento'])); ?>
                    </span>
                    <span>
                        <a href="update_tarefa.php?id=<?= $t['id'] ?>" class="btn-small" style="background:#6c757d; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">Desmarcar</a>
                        <a href="delete_tarefa.php?id=<?= $t['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>