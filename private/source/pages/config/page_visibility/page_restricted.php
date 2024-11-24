<?php
// Verifica se a constante foi definida
if (!defined('ACCESS_GRANTED')) {
    header('Location: /403.php');
    exit();
}
?>