<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor  = trim($_POST['autor']);
    $ano    = trim($_POST['ano']);

    if ($titulo && $autor && $ano && is_numeric($ano)) {
        $stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (?, ?, ?)");
        $stmt->execute([$titulo, $autor, $ano]);
    }
}
header('Location: index.php');
exit;
?>