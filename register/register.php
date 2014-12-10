<?php
include '../functions.php';

if (!$_SESSION['is_logged'] === true) {
    ?>
    <form action="register.php" method="post">
        <div>
            <label>Username: </label>
            <input type="text" name="uName" placeholder="Username"/>
        </div>
        <div>
            <label>Password: </label>
            <input type="password" name="pass" placeholder="Password"/>
        </div>
        <div>
            <label>Re-type password: </label>
            <input type="password" name="pass2" placeholder="Password"/>
        </div>
        <div>
            <label>Email: </label>
            <input type="email" name="email" placeholder="Email"/>
        </div>
        <input type="submit" value="Register"/>
    </form>
<?php
    //PHP logic for register a new user...
}else {
    header('Location: ../index.php');
    exit;
}
