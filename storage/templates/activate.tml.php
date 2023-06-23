<?php if (!defined('ABSPATH')) :
    define('ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once ABSPATH . 'index.php';
else : ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activate - GeekPress | <?= getOptions('version'); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&family=Material+Icons+Outlined&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= $GLOBALS['SITE_URL']; ?>storage/templates/css/activate.css?ver=<?= getOptions('version'); ?>">
        <link href="https://cdn.jsdelivr.net/npm/vue@2.7.8" rel="preload" as="script" />
    </head>

    <body>
        <div id="app">
            <header id="header">
                <div class="container">
                    <a href="https://2ngeeks.pro" class="logo" target="_blank">
                        2NGeeks<span>.pro</span>
                    </a>
                    <div class="right">
                        <div class="theme-switcher">
                            <button @click="changeTheme"></button>
                        </div>
                        <div class="links">
                            <a href="https://github.com/2NGeeks/GeekPress" target="_blank" title="Github" class="link">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                    <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <main id="content">
                <div class="wrap" id="activate">
                    <div class="app-block">
                        <div class="row">
                            <h5 class="title">Активация GeekPress</h5>
                            <p class="about">Вы только что установили систему. Для доступа к API вам необходим ключ доступа.</p>
                            <div class="line">
                                <div class="input w100">
                                    <input type="text" v-model.trim="api_key" placeholder="API Key">
                                    <div class="border"></div>
                                </div>
                                <button @click="generateUUID" class="button border-only"><i class="material-icons-outlined">refresh</i></button>
                            </div>
                        </div>
                        <div class="row">
                            <button class="button" @click="activate" :class="{disabled: !api_key}">Сохранить</button>
                        </div>
                    </div>
                </div>
            </main>
            <footer id="footer">
                <div class="container">
                    <p>Copyright © <?= date('Y'); ?> 2NGeeks.pro. All Rights Reserved</p>
                    <p>Version: <?= getOptions('version'); ?></p>
                </div>
            </footer>
            <transition name="fade">
                <div id="preloader" v-if="!dataLoaded">
                    <div class="loader">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <defs>
                                <filter id="ldio-qpo52fe34hq-filter" x="-100%" y="-100%" width="300%" height="300%" color-interpolation-filters="sRGB">
                                    <feGaussianBlur in="SourceGraphic" stdDeviation="2.4000000000000004"></feGaussianBlur>
                                    <feComponentTransfer result="cutoff">
                                        <feFuncA type="table" tableValues="0 0 0 0 0 0 1 1 1 1 1"></feFuncA>
                                    </feComponentTransfer>
                                </filter>
                            </defs>
                            <g filter="url(#ldio-qpo52fe34hq-filter)">
                                <g transform="translate(50 50)">
                                    <g>
                                        <circle cx="17" cy="0" r="5" fill="#8573f5">
                                            <animate attributeName="r" keyTimes="0;0.5;1" values="3.5999999999999996;8.399999999999999;3.5999999999999996" dur="4s" repeatCount="indefinite" begin="-0.25s"></animate>
                                        </circle>
                                        <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360" dur="4s" repeatCount="indefinite" begin="0s"></animateTransform>
                                    </g>
                                </g>
                                <g transform="translate(50 50)">
                                    <g>
                                        <circle cx="17" cy="0" r="5" fill="#e76aca">
                                            <animate attributeName="r" keyTimes="0;0.5;1" values="3.5999999999999996;8.399999999999999;3.5999999999999996" dur="2s" repeatCount="indefinite" begin="-0.2s"></animate>
                                        </circle>
                                        <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360" dur="2s" repeatCount="indefinite" begin="-0.05s"></animateTransform>
                                    </g>
                                </g>
                                <g transform="translate(50 50)">
                                    <g>
                                        <circle cx="17" cy="0" r="5" fill="#79e3b9">
                                            <animate attributeName="r" keyTimes="0;0.5;1" values="3.5999999999999996;8.399999999999999;3.5999999999999996" dur="1.3333333333333333s" repeatCount="indefinite" begin="-0.15s"></animate>
                                        </circle>
                                        <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360" dur="1.3333333333333333s" repeatCount="indefinite" begin="-0.1s"></animateTransform>
                                    </g>
                                </g>
                                <g transform="translate(50 50)">
                                    <g>
                                        <circle cx="17" cy="0" r="5" fill="#8573f5">
                                            <animate attributeName="r" keyTimes="0;0.5;1" values="3.5999999999999996;8.399999999999999;3.5999999999999996" dur="1s" repeatCount="indefinite" begin="-0.1s"></animate>
                                        </circle>
                                        <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360" dur="1s" repeatCount="indefinite" begin="-0.15s"></animateTransform>
                                    </g>
                                </g>
                                <g transform="translate(50 50)">
                                    <g>
                                        <circle cx="17" cy="0" r="5" fill="#e76aca">
                                            <animate attributeName="r" keyTimes="0;0.5;1" values="3.5999999999999996;8.399999999999999;3.5999999999999996" dur="0.8s" repeatCount="indefinite" begin="-0.05s"></animate>
                                        </circle>
                                        <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360" dur="0.8s" repeatCount="indefinite" begin="-0.2s"></animateTransform>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </transition>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
        <script type="text/javascript">
            new Vue({
                el: "#app",
                data() {
                    return {
                        api_key: "",
                        dataLoaded: false,
                        success: false
                    }
                },
                mounted() {
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && (!localStorage.getItem('theme') || localStorage.getItem('theme') == 'dark')) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                    setTimeout(() => this.dataLoaded = true, 500);
                },
                methods: {
                    changeTheme() {
                        if (localStorage.getItem('theme') == 'light') {
                            localStorage.setItem('theme', 'dark')
                        } else {
                            localStorage.setItem('theme', 'light')
                        }
                        document.documentElement.classList.toggle('dark');
                    },
                    generateUUID() {
                        var d = new Date().getTime();
                        if (window.performance && typeof window.performance.now === "function") {
                            d += performance.now();
                        }
                        var uuid = 'xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                            var r = (d + Math.random() * 16) % 16 | 0;
                            d = Math.floor(d / 16);
                            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                        });

                        this.api_key = uuid;
                    },
                    async activate() {
                        fetch('/api/activate', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8'
                            },
                            body: JSON.stringify({
                                api_key: this.api_key
                            })
                        }).then(response => {
                            alert('Ключ доступа к API был успешно cохранен! Вы будете перенаправлены в Админ-панель.');
                            location.replace('<?= $GLOBALS['SITE_URL']; ?>admin?api_key=' + this.api_key);
                        }).catch(error => {
                            alert('Не удалось сохранить ключ доступа. Возможно у вас проблемы с сетью, либо включен режим "Test Mode".')
                        });
                    }
                },
            })
        </script>
    </body>

    </html>
<?php endif;
