<?php
include '../functions.php';

if (!$_SESSION['is_logged'] === true) {
    ?>
    <form action="register.php" method="post">
        <div>
            <label>Username: </label>
            <input type="text" name="uName" placeholder="Потребителско име"/>
        </div>
        <div>
            <label>Password: </label>
            <input type="password" name="pass" placeholder="Парола"/>
        </div>
        <div>
            <label>Re-type password: </label>
            <input type="password" name="pass2" placeholder="Парола"/>
        </div>
        <div>
            <label>Email: </label>
            <input type="email" name="email" placeholder="Електронна поща"/>
        </div>
        <input type="submit" value="Регистрирай се"/>
    </form>
<?php
    //PHP logic for register a new user...
}else {
    header('Location: ../index.php');
    exit;
}
