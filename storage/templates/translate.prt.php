<script src="https://translate.google.com/translate_a/element.js?cb=TranslateInit"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script type="text/javascript">
    const googleTranslateConfig = {
        lang: "<?= $GLOBALS['template_lang'][1]; ?>",
        langFirstVisit: "<?= isset($_GET['lang']) ? $_GET['lang'] : $GLOBALS['template_lang'][0]; ?>",
        domain: "<?= $_SERVER['HTTP_HOST']; ?>"
    };
</script>
<script src="<?= $GLOBALS['SITE_URL']; ?>storage/templates/js/google-translate.js?ver=<?= getOptions('version'); ?>"></script>
<style>
    body {
        top: 0 !important;
    }

    .goog-text-highlight {
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .skiptranslate {
        display: none !important;
        height: 0 !important;
    }
</style>
