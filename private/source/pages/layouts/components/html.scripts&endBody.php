<script>
    // Função para carregar CSS dinamicamente
    function loadCSS(url) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = url;
        document.head.appendChild(link);
    }

    // Array com todos os URLs dos arquivos CSS
    const cssFiles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-popover-x@2.0.0/dist/bootstrap-popover-x.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-tooltip-x@2.0.0/dist/bootstrap-tooltip-x.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-toastify@1.0.0/dist/bootstrap-toastify.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.4/dist/bootstrap-table.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/dist/bootstrap-toggle.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-datetimepicker@4.17.47/css/bootstrap-datetimepicker.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@2.5.3/dist/css/bootstrap-colorpicker.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.5.0/dist/bootstrap-maxlength.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@1.1.0/dist/bootstrap-input-spinner.min.css'
    ];

    // Carrega cada arquivo CSS
    cssFiles.forEach(url => loadCSS(url));

    // Função para carregar JavaScript dinamicamente
    function loadScript(url) {
        const script = document.createElement('script');
        script.src = url;
        script.defer = true;
        document.body.appendChild(script);
    }

    // Array com todos os URLs dos arquivos JavaScript
    const jsFiles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.4/dist/bootstrap-table.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/dist/js/bootstrap-toggle.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-datetimepicker@4.17.47/js/bootstrap-datetimepicker.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@2.5.3/dist/js/bootstrap-colorpicker.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.5.0/dist/bootstrap-maxlength.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@1.1.0/dist/bootstrap-input-spinner.min.js'
    ];

    // Carrega cada arquivo JavaScript
    jsFiles.forEach(url => loadScript(url));

    <?php

        require_once('html.scripts&endBody/js/content_dynamic.js');
        require_once('html.scripts&endBody/js/resize_body_bootstrap.js');
        require_once('html.scripts&endBody/js/restriction_against_iframe.js');
        require_once('html.scripts&endBody/js/tooltip_popover.js');
?>
</script>
</body>
</html>