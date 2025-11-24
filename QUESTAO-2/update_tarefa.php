<?php
require 'database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("UPDATE tarefas SET concluida = NOT concluida WHERE id = ?");
    $stmt->execute([$id]);
}
header('Location: index.php');
exit;
?>