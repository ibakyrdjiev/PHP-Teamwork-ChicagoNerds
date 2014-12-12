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
if(isset($_POST['userName'])){
	$userName = $_POST['userName'];
	$connect = mysqli_connect('localhost', 'sportsmenteam', '123456', 'sportsmen', 'sportsmen');
	mysqli_set_charset($connect, 'utf8');
	$q = mysqli_query($connect, "SELECT * FROM sportsmen WHERE username=$userName");
	include 'userdata.php'

}
siteFooter();

?>