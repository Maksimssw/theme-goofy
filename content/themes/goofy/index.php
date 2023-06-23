<?php get_template_parts('header'); ?>

<section class="hero container grid-row">
    <div class="hero__banner">
        <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-promo.jpg" class="hero__promo" alt="">
        <h1 class="hero__headline">
            <span>waiting for you</span>
            Las Vegas
        </h1>
        <a href="#" class="button">Participate</a>
    </div>

    <div class="hero__content">
        <div class="hero__info grid-row">
            <span class="hero__description">Name the game</span>
            <span class="hero__description">Winner's login</span>
            <span class="hero__description">Amount</span>
        </div>

        <ul class="hero__list"> 
            <li class="hero__item grid-row">
                <div class="grid-row">
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>

            <li class="hero__item grid-row">
                <div class="grid-row">
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>

            <li class="hero__item grid-row">
                <div class="grid-row">
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>

            <li class="hero__item grid-row">
                <div class="grid-row"> 
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>

            <li class="hero__item grid-row">
                <div class="grid-row">
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>

            <li class="hero__item grid-row">
                <div class="grid-row">
                    <img src="<?= get_template_dir(); ?>/assets/images/hero/hero-game.jpg" class="hero__image" alt="">
                    <span class="hero__game hero__text">Crazy Monkey</span>
                </div>
                <span class="hero__number hero__text">09321****3</span>
                <span class="hero__price hero__text">2.80 COINS</span>
            </li>
        </ul>
    </div>
</section>
<section class="popular container">
    <div class="popular__content swiper-popular">
        <div class="popular__header grid-row justify-content-between">
            <h2 class="popular__headline headline">Popular</h2>

            <div class="popular__nav grid-row">
                <button class="swiper__button swiper__button_left">
                    <img src="<?= get_template_dir(); ?>/assets/icons/arrow.svg" alt="">
                </button>
                <button class="swiper__button swiper__button_next">
                    <img src="<?= get_template_dir(); ?>/assets/icons/arrow.svg" alt="">
                </button>
            </div>
        </div>

        <div class="swiper-wrapper popular__list">
            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/1.webp" class="popular__image" alt="Book of Ra">
                <h3>
                    <a href="./money-train" class="popular__link">
                        Money Train
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/2.webp" class="popular__image" alt="Spacewalk II: Zer…">
                <h3>
                    <a href="./fat-panda" class="popular__link">
                        Fat Panda
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/3.webp" class="popular__image" alt="Take Your Down…">
                <h3>
                    <a href="./gemhalla" class="popular__link">
                        Gemhalla
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/4.webp" class="popular__image" alt="Arms">
                <h3>
                    <a href="./alice" class="popular__link">
                        Alice in Vegasland
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/5.webp" class="popular__image" alt="Dark Skies">
                <h3>
                    <a href="./pixel" class="popular__link">
                        Pixel Invaders
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/6.webp" class="popular__image" alt="Living Out Loud...">
                <h3>
                    <a href="./mighty" class="popular__link">
                        Mighty Masks 
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>

            <div class="swiper-slide popular__item">
                <img src="<?= get_template_dir(); ?>/assets/images/popular/7.webp" class="popular__image" alt="Stardust - EP">
                <h3>
                    <a href="./floating" class="popular__link">
                        Floating Dragon
                    </a>
                </h3>
                <span class="popular__text">New game</span>
                <div class="popular__game popular__hidden">Game</div>
            </div>
        </div>
    </div>
</section>
<section class="games container">
    <h2 class="games__headline headline">New games</h2>
    <ul class="games__list">
        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/1.webp" class="games__image" alt="">
            <h3>
                <a href="./coins" class="games__link">Coins</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>

        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/2.webp" class="games__image" alt="">
            <h3>
                <a href="./sweet" class="games__link">Sweet Alchemy 2</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>

        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/3.webp" class="games__image" alt="">
            <h3>
                <a href="./ragna" class="games__link">Ragna Wolves</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>

        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/4.webp" class="games__image" alt="">
            <h3>
                <a href="./mayan" class="games__link">Mayan Stackways</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>

        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/5.webp" class="games__image" alt="">
            <h3>
                <a href="./fly-cats" class="games__link">Fly Cats Dream Drop</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>

        <li class="games__item">
            <img src="<?= get_template_dir(); ?>/assets/images/games/6.webp" class="games__image" alt="">
            <h3>
                <a href="./diamonds" class="games__link">Diamonds Of Egypt</a>
            </h3>
            <p class="games__text">Recommended</p>
        </li>
    </ul>
</section>

<?php get_template_parts('footer'); ?>