<?php
include 'connect.php';
include 'functions.php';
siteHeader("Мнения");
//qery to the server
$sql = "SELECT
			topic_id,
			topic_subject,
			topic_seen
		FROM
			topics
		WHERE
			topics.topic_id = " . htmlentities(strip_tags(mysqli_real_escape_string($con, $_GET['id'])));

$result = mysqli_query($con, $sql);

if (!$result) {
    echo 'Грешка моля опитайте по-късно.';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'Няма мнения, може да си пръв :).';
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            //display post data
            echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
            $current_count = $row['topic_seen'];
            $new_count = $current_count + 1;
            $updateCount = mysqli_query($con, "UPDATE topics SET topic_seen=$new_count WHERE topics.topic_id =".mysqli_real_escape_string($con, $_GET['id'])."");
            //fetch the posts from the database
            //LEFT JOIN - users + posts => takes the user id and matches post id :)
            $comment_id = mysqli_real_escape_string($con, $_GET['id']);
            $allComments = mysqli_query($con, 'SELECT COUNT(*) as cnt FROM posts WHERE posts.post_topic='. $comment_id);
            $comments = mysqli_fetch_assoc($allComments);
            //mysqli_fet
            $max_count = $comments['cnt'];
            $limit = 5;
            $page = 0;
            if (isset($_GET['page'])) {
                if ((int)$_GET['page'] > 0) {
                    $page = (int)$_GET['page']-1;
                }else {
                    $page = 0;
                }
            }
            $max_page = ceil($max_count / $limit);

            $posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						posts.post_id,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysqli_real_escape_string($con, $_GET['id']). "
                    ORDER BY post_date ASC
                    LIMIT ".($limit*$page).", $limit";

            $posts_result = mysqli_query($con, $posts_sql);

            if (!$posts_result) {
                echo '<tr><td>Постовете не могат да се покажат. Моля опитайте онтново' . '</tr></td></table>';
            } else {

                while ($posts_row = mysqli_fetch_assoc($posts_result)) {
                    echo ' 
                    <form action = "editPost.php?id=' . $posts_row['post_id'].'&topic_id='.$_GET['id'].'" method = "post">
                    <tr class="topic-post">
							<td class="user-post">' . $posts_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
							</tr>';
							
							
						  if(($_SESSION['user_level']==1)||($posts_row['post_by'] == $_SESSION['user_id'])){
						  	echo "
						  	<tr><td collspan = '2'><input type = 'submit' value = 'Редактирай' ></td></tr>
							</form>";
						  }
                }
            }

            if (!isset($_SESSION['signed_in'])) {
                echo '<tr><td colspan=2>Трябва да си  <a href="signIn.php">Регистриран</a> за да можеш да постваш или да се <a href="signUp.php">логнеш</a>  :).';
            } else {
                //show reply box
                echo '<tr><td colspan="2"><h2>Отговор:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">

						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Изпрати" />
					</form></td></tr>';

               // echo"<p style='color: red'>". $row['post_content']."</p>";
            }

            //finish the table
            echo '</table>';

            if (isset($_SESSION['signed_in'])) {
                echo '<div id="paging-comments">';
                if ($page >= 1) {
                    echo '<a href="topic.php?id='.$comment_id.'&page='.($page  - 2).'">Previous </a>' . " | ";
                }
                for ($i = 0; $i < $max_page; $i++) {
                    if ($i == $page) {
                        echo '<a href="topic.php?id='.$comment_id.'&page='.($i +1).'" class="currentPage">'.($i +1).'</a>' . ' | ';
                        //текущата страница може да е с друг цвят за да се вижда къде сме в момента
                        // кода бачка само трябва да се приложи стил на class- currentPage
                    }else {
                        echo '<a href="topic.php?id='.$comment_id.'&page='.($i +1).'">'.($i +1).'</a>' . ' | ';
                    }
                }
                if ($page < $max_page-1) {
                    echo '<a href="topic.php?id='.$comment_id.'&page='.($page +2).'">Next page</a>';
                }

                echo '</div>';
            }
        }
        var_dump($new_count);
    }
}

//include 'footer.php';
