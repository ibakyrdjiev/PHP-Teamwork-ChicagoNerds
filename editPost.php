<?php
include 'connect.php';
include 'functions.php';
siteHeader("Отговор");

$id = intval($_GET['id']);

$posts_result = current(mysqli_fetch_row(mysqli_query($con, "SELECT post_content FROM posts WHERE post_id = $id ")));
//We take the content of the current post from the database.
if(isset($_POST["postContent"])){	
	mysqli_query($con, "UPDATE posts SET post_content = '".mysqli_real_escape_string($con, $_POST['postContent'])."' WHERE post_id = $id");
	header("Location: topic.php?id=" . intval($_GET['topic_id']));
	exit;
}
?>
<form method = "post" action="?id=<?=$id;?>&topic_id=<?=$_GET['topic_id'];?>">
<textarea class="edTopic" name = "postContent" >
	<?php echo $posts_result ?>
</textarea>
<input class="editTopic" type = "submit" value = "Промени"/>
</form>

