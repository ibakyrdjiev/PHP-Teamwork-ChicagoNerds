<?php
//create_cat.php
include 'connect.php';

//qery to the server
$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . htmlentities(strip_tags(mysql_real_escape_string($_GET['id'])));

$result = mysql_query($sql);

if (!$result) {
    echo 'Грешка моля опитайте по-късно.';
} else {
    if (mysql_num_rows($result) == 0) {
        echo 'Няма мнения, може да си пръв :).';
    } else {
        while ($row = mysql_fetch_assoc($result)) {
            //display post data
            echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';

            //fetch the posts from the database
            //LEFT JOIN - users + posts => takes the user id and matches post id :)
            $posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);

            $posts_result = mysql_query($posts_sql);

            if (!$posts_result) {
                echo '<tr><td>Постовете не могат да се покажат. Моля опитайте онтново' . '</tr></td></table>';
            } else {

                while ($posts_row = mysql_fetch_assoc($posts_result)) {
                    echo '<tr class="topic-post">
							<td class="user-post">' . $posts_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
						  </tr>';
                }
            }

            if (!$_SESSION['signed_in']) {
                echo '<tr><td colspan=2>Трябва да си  <a href="signin.php">Регистриран</a> за да можеш да постваш или да се <a href="signup.php">логнеш</a>  :).';
            } else {
                //show reply box
                echo '<tr><td colspan="2"><h2>Отговор:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Изпрати" />
					</form></td></tr>';
            }

            //finish the table
            echo '</table>';
        }
    }
}

//include 'footer.php';
?>