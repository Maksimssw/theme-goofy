<?php

const excludePages = ['index.php', '404.php', 'functions.php'];
$pages = [
    [
        "path" => "",
        "priority" => 1,
    ]
];
$formated = [];
$directory = array_slice(scandir(THEMES . DIRECTORY_SEPARATOR . getOptions('template')), 2);
foreach ($directory as $key => $value) {
    if(strpos($value, '.php') && !in_array($value, excludePages)){
        array_push($formated, stristr($value, '.php', true));
    }
}
unset($directory);
for($i = 0; $i<count($formated);$i++){
    $a = explode("-", $formated[$i]);
    array_push($pages, array(
        "path" => implode("/", $a),
        "priority" => round(1 / count($a),1)
    ));
}
unset($formated);

// Add 404 page if it is available
if(file_exists(THEMES . DIRECTORY_SEPARATOR . getOptions('template') . '/404.php'))
    array_push($pages, array(
        "path" => "404",
        "priority" => 0
    ));

/**
 * Create XML Dom Element
 */
$dom = new DOMDocument('1.0', 'utf-8');
$urlset = $dom->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

foreach ($pages as $page) {

    $url = $dom->createElement('url');

    $loc = $dom->createElement('loc');
    $text = $dom->createTextNode(
        htmlentities($GLOBALS['SITE_URL'] . $page['path'], ENT_QUOTES)
    );
    $loc->appendChild($text);
    $url->appendChild($loc);

    $lastmod = $dom->createElement('lastmod');
    $text = $dom->createTextNode(date('Y-m-d', time() - 256000));
    $lastmod->appendChild($text);
    $url->appendChild($lastmod);

    $priority = $dom->createElement('priority');
    $text = $dom->createTextNode($page['priority']);
    $priority->appendChild($text);
    $url->appendChild($priority);

    $urlset->appendChild($url);
}

$dom->appendChild($urlset);
header('Content-Type: text/xml');
echo $dom->saveXML();