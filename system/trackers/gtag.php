<?php
/**
 * Google Analytics
 */
$gtag_id = isset($_GET['gtag'])? $_GET['gtag']: null;
?>
<?php if ($gtag_id) : ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$gtag_id;?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?=$gtag_id;?>');
    </script>
<?php endif; ?>