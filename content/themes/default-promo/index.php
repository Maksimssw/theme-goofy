<!DOCTYPE html>
<html lang="" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game | Download now!</title>
    <meta property="og:title" content="Game | Download now!">
    <meta name="description" content="Download now!">
    <meta property="og:description" content="Download now!">
    <meta property="og:type" content="website">

    <!-- Icons -->
    <link rel="icon" type="image/png" href="<?= get_template_dir(); ?>/assets/images/pinoman.png?ver=<?= md5(time()); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;800;900&display=swap" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="<?= get_template_dir(); ?>/assets/css/style.css?ver=1.0.0">
    <!-- Translate -->
    <?php translateModule(); ?>
    <!-- Trackers -->
    <?php getTrackers(); ?>
</head>

<body>
    <div id="wrapper" data-bg="<?= get_template_dir(); ?>/assets/images/bg.jpg">
        <div class="container">
            <a href="https://google.com" class="logo target-link">
                <img src="<?= get_template_dir(); ?>/assets/images/pinoman.png?ver=<?= md5(time()); ?>">
            </a>
            <div class="content">
                <h1 class="title">
                    100% up <span>to 200£</span> + <span>200 extra</span> spins
                </h1>
                <p class="subtitle">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio vitae nemo necessitatibus fugiat quasi nam hic sunt quisquam
                </p>
                <a href="https://google.com" id="install" class="button target-link">Download now!</a>
                <div class="text">
                    <p>Register now and get bonus. Until the end of the promotion:</p>
                    <div id="timer">
                        <span class="hours"></span> Hours : <span class="minutes"></span> Min : <span class="sec"></span> Sec

                    </div>
                </div>
                <div class="cookies">We do not collect or store your cookies</div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <p class="copyright">Copyright © <?= date('Y'); ?> All Rights Reserved.</p>
            <div class="icons">

            </div>
        </div>
    </div>
    <?php jQuery(); ?>
    <script src="<?= get_template_dir(); ?>/assets/js/onelink.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-bg]').css('background-image', `url(${$('[data-bg]').attr('data-bg')})`)
            // Tracker events
            $(".target-link").on('click', function(e) {
                e.preventDefault();
                <?= isset($_GET['fbq']) ? "fbq('track', 'Lead');\n" : ''; ?>
                <?= isset($_GET['snaptr']) ? "snaptr('track', 'PURCHASE');\n" : ''; ?>
                <?= isset($_GET['ttq']) ? "ttq.track('Download');\n" : ''; ?>
                <?= isset($_GET['gtag']) ? "gtag('event','purchase');" : ''; ?>
                let href = $(this).attr('href');
                window.open(href);
            });
        });
    </script>
    <script type="text/javascript">
        // Timer
        $(() => {
            let time = Math.floor(Math.random() * (18000 - 14400) + 14400);
            let hours, minutes, sec;
            function setTime() {
                hours = Math.floor(time / 3600);
                minutes = Math.floor((time / 60) % 60);
                sec = time - (hours * 3600 + minutes * 60);
                $("#timer .hours").text(hours);
                $("#timer .minutes").text(minutes);
                $("#timer .sec").text(sec);
                time--;
            }
            setTime();
            let timerInt = setInterval(setTime, 1000);
        });
    </script>
</body>

</html>