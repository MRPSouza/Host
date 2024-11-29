<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin: 0;
        justify-content: start;
        align-items: left;
    }

    main {
        flex: 1 0 auto;
        display: flex;
        justify-content: start;
        align-items: left;
        width: 100%;
    }

    footer {
        margin-top: auto;
        padding: 1rem;
        background-color: #f8f9fa;
        text-align: center;
        width: 100%;
    }
</style>

<?php
$companyName = "Mister Cel";
$since = "2008";
$developer = "MT Mente & Máquina";
$slogan = "Solução Digital Potencializada por IA";
$currentYear = date('Y');
?>

<footer class="footer text-center">
    <div class="container">
        <p class="mb-0">
            Direitos reservados &copy; <?php echo $companyName; ?> (<?php echo $since; ?>-<?php echo $currentYear; ?>)
            <br>
            <small>Desenvolvido por <?php echo $developer; ?> | <?php echo $slogan; ?></small>
        </p>
    </div>
</footer>
