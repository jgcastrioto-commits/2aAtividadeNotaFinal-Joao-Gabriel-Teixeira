<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $desc = trim($_POST['descricao']);
    $data = $_POST['vencimento'] ?? null;

    if ($desc != '') {
        $stmt = $db->prepare("INSERT INTO tarefas (descricao, vencimento) VALUES (?, ?)");
        $stmt->execute([$desc, $data]);
    }
}
header('Location: index.php');
exit;
?>