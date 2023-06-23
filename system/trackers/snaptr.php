<?php
/**
 * Snap Pixel Template
 */
$snap_id = isset($_GET['snaptr'])? $_GET['snaptr'] : null;
?>
<?php if($snap_id):?>
    <script type='text/javascript'>
        (function(e, t, n) {
            if (e.snaptr) return;
            var a = e.snaptr = function() {
                a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments)
            };
            a.queue = [];
            var s = 'script';
            r = t.createElement(s);
            r.async = !0;
            r.src = n;
            var u = t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r, u);
        })(window, document, 'https://sc-static.net/scevent.min.js');
        snaptr('init', '<?=$snap_id;?>', {
            'user_email': 'INSERT_USER_EMAIL'
        });
        snaptr('track', 'PAGE_VIEW');
    </script>
<?php endif; ?>