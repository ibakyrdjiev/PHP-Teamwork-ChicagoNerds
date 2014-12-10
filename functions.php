<?php
session_start();

function siteHeader($title) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title?></title>
</head>
<body>
    <header>
        <nav class="mainNav">
            <ul>
                <li class="topMenu"><a href="news.php">News</a></li>
                <li class="topMenu"><a href="about.php">About us</a></li>
                <li class="topMenu"><a href="rules.php">Forum rules</a></li>
            </ul>
        </nav>
        <div>
            <span>Are you new?</span>
            <a href="register/register.php">Register</a>
        </div>
        <form action="login/login.php" method="post">
            <div>
                <input type="text" name="userName" placeholder="Username" id="user"/>
                <input type="password" name="userPass" placeholder="Password" id="userPass"/>
                <input type="submit" value="Login"/>
            </div>
        </form>

    </header>
<?php
}

function siteFooter() {
    ?>
    <footer>
        <div class="statistic">
            <h3>Who is online?</h3>
            <p class="onlineNow">
                Total online: <?php /*Some php logic for online users*/ ?>
            </p>
            <p>
                <span id="legend">Legend: </span>
                <span class="administrators">Administrators, </span>
                <span class="moderators">Moderators, </span>
                <span class="normalUsers">Normal users</span>
                //Each group could be with different color
            </p>
            <h3>Statistic</h3>
            <p class="totalPosts">
                <p>
                    Total posts : <?php /*PHP logic for total posts*/?>
                </p>
                <p>
                    Total opinions : <?php /*PHP logic for total opinions*/?>
                </p>
                <p>
                    Total members : <?php /*PHP logic for total members*/?>
                </p>
                <p>
                    Newest member - <?php /*PHP logic for newest member*/?>
                </p>
            </p>
        </div>
        <p id="copytights">
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
            <h2 class="articleMainHeader">Forum Rules</h2>
        </section>
        <section>
            <h2 class="articleMainHeader">Topics</h2>
        </section>
<!--        Additionally we can add more topics-->

    </div>
<?php
}