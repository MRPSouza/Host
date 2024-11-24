<?php
foreach ($local_scripts as $key => $script) {
    echo "<script nonce='{$script['nonce']}'>/* código do {$key} aqui */</script>";
}
?>

