<?php
/**
 * VK Pixel
 */
$vk_id = isset($_GET['vk'])? $_GET['vk']: null;
?>
<?php if ($vk_id) : ?>
    <script type="text/javascript">
        ! function() {
            var t = document.createElement("script");
            t.type = "text/javascript", t.async = !0, t.src = 'https://vk.com/js/api/openapi.js?169', t.onload = function() {
                VK.Retargeting.Init("<?= $vk_id; ?>"), VK.Retargeting.Hit()
            }, document.head.appendChild(t)
        }();
    </script>
    <noscript>
        <img src="https://vk.com/rtrg?p=<?= $vk_id; ?>" style="position:fixed; left:-999px;" alt="" />
    </noscript>
<?php endif; ?>