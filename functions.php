<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("utf-8");
function siteHeader($title) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
</head>
<body>
    <header>
<!--       Тък може да вмъкнем лого ако някой има добри дизайнерски умения -->
        <nav class="mainNav">
            <ul>
                <li class="topMenu"><a href="index.php">Новини</a></li>
                <li class="topMenu"><a href="about.php">Контакти</a></li>
            </ul>
        </nav>
        <div>
            <span>Нов си тук?</span>
            <a href="register/register.php">Регистрация</a>
        </div>
        <div>
            <a href="login/login.php">Влез</a>
        </div>

    </header>
<?php
}

function siteFooter() {
    ?>
    <footer>
        <div class="statistic">
            <h3>Кой е онлайн? </h3>
            <p class="onlineNow">
                Общо онлайн: <?php /*Some php logic for online users*/ ?>
            </p>
            <p>
                <span id="legend">Легенда: </span>
                <span class="administrators">Administrators, </span>
                <span class="moderators">Moderators, </span>
                <span class="normalUsers">Normal users</span>
<!--                //Each group could be with different color-->
            </p>
            <h3>Статистика</h3>
            <p class="totalPosts">
                <p>
                    Общо теми : <?php /*PHP logic for total posts*/?>
                </p>
                <p>
                    Общо мнения : <?php /*PHP logic for total opinions*/?>
                </p>
                <p>
                    Общо членове : <?php /*PHP logic for total members*/?>
                </p>
                <p>
                    Най-нов - <?php /*PHP logic for newest member*/?>
                </p>
            </p>
        </div>
        <p id="copyrights">
            Powered by Chicago Nerds
        </p>
    </footer>
    </body>
    </html>
<?php
}


function mainContent() {
    ?>
    <div id="container">
        <section class="forumRules">
            <h2 class="articleMainHeader">Правила на форума</h2>
        </section>
        <section>
            <h2 class="articleMainHeader">Теми</h2>
        </section>
<!--        Additionally we can add more topics-->

    </div>
<?php
}