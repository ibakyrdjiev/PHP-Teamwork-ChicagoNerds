<?php
include '../functions.php';
siteHeader("Влез");
?>
    <form action="login.php" method="post">
        <div>
            <input type="text" name="userName" placeholder="Потребителско име" id="user"/>
            <input type="password" name="userPass" placeholder="Парола" id="userPass"/>
            <input type="submit" value="Login"/>
        </div>
    </form>

<?php
siteFooter();