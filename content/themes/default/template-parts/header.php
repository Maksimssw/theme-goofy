<!DOCTYPE html>
<html lang="" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Default</title>
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit." />

    <meta property="og:title" content="Default" />
    <meta property="og:description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit." />
    <meta property="og:type" content="website">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= get_template_dir(); ?>/assets/css/style.css?ver=<?= md5(time()); ?>">
    <!-- Translate -->
    <?php translateModule(); ?>
    <!-- Trackers -->
    <?php getTrackers(); ?>
</head>

<body class="<?="theme-" . $GLOBALS['active_template'];?>">
    <div id="wrapper">
        <header id="header">
            <div class="container">
                <a href="/" class="logo">2NGeeks<span>.pro</span></a>
                <nav id="site-nav">
                    <a href="/about">About</a>
                    <a href="/privacy">Privacy policy</a>
                </nav>
            </div>
        </header>
        <main id="content">