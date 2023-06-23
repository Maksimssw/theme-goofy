<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_dir(); ?>/assets/icons/favicons/android-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_dir(); ?>/assets/icons/favicons/android-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_dir(); ?>/assets/icons/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= get_template_dir(); ?>/assets/icons/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_dir(); ?>/assets/icons/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_dir(); ?>/assets/icons/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_dir(); ?>/assets/icons/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?= get_template_dir(); ?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?= get_template_dir(); ?>/assets/styles/style.css">
    <link rel="stylesheet" href="<?= get_template_dir(); ?>/assets/styles/swiper.css">
    <title>Goofy Game</title>
    <?php translateModule(); ?>
    <!-- Trackers -->
    <?php getTrackers(); ?>
</head>
<body>
    <div class="preloader">
		<div class="preloader__row">
			<div class="preloader__item"></div>
			<div class="preloader__item"></div>
		</div>
	</div>
    <header class="header container grid-row">
        <a href="/index" class="header__logo">
            <img src="<?= get_template_dir(); ?>/assets/icons/logo.png" alt="">
        </a>

        <ul data-menu class="menu grid-row">
            <li class="menu__item">
                <a class="menu__link menu__link_active" href="#">Games</a>
            </li>
            <li class="menu__item">
                <a class="menu__link" href="#">Support</a>
            </li>
            <li class="menu__item">
                <a class="menu__link" href="#">FAQ</a>
            </li>
            <li class="menu__item">
                <a class="menu__link" href="#">Tournaments</a>
            </li>
            <li class="menu__item">
                <a class="menu__link" href="#">Jackpot</a>
            </li>
        </ul>

        <form action="" class="search grid-row">
            <input type="text" placeholder="Search" class="search__input input">
            <button class="search__button">
                <img src="<?= get_template_dir(); ?>/assets/icons/search.svg" alt="">
            </button>
        </form>

        <button data-hamburger class="hamburger">
			<span class="hamburger__item"></span>
		</button>
    </header>
    <main>
    <img class="background" src="<?= get_template_dir(); ?>/assets/images/main/bg-casino.jpg" alt="">