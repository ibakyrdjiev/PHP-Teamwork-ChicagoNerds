<?php

//fixed
//category.php
include 'connect.php';
include 'functions.php';
siteHeader("Мнения");
//ne bachkat
//first select the category based on $_GET['cat_id']
$cat =  mysqli_real_escape_string($con, $_GET['id']);
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = '".$cat."'";

$result = mysqli_query($con, $sql);
//var_dump($result);
//echo $sql;
//echo $_GET['id'];
//$result = mysql_query($sql);

if(!$result)
{
    echo 'Категориите не могат да бъдат показани, моля опитайте по-късно.' ;
    // echo  mysql_error();
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'Категорията не съществува.';
    }
    else
    {
        //do a query for the topics

        $allPosts = mysqli_query($con, 'SELECT COUNT(*) as cnt FROM topics WHERE topic_cat='.$cat);
        $posts = mysqli_fetch_assoc($allPosts);
        $max_count = $posts['cnt'];
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

        $sql = "SELECT
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = " . mysqli_real_escape_string($con, $_GET['id']) . "
                ORDER BY topic_date DESC
                LIMIT ".($limit*$page).", $limit";

        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            echo 'Грешка, моля опитайте по-късно.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'Няма мнения.';
            }
            else
            {
                //prepare the table
                echo '<table border="1">
					  <tr>
						<th>Мнение</th>
						<th>Създаено на</th>
					  </tr>';

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo '<td class="leftpart">';
                    echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
                    echo '</td>';
                    echo '<td class="rightpart">';
                    echo date('d-m-Y', strtotime($row['topic_date']));
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<div class="pagination">';
                if ($page >= 1) {
                    echo '<a href="category.php?id='.$cat.'&page='.($page  - 2).'">Previous </a>' . " | ";
                }
                for ($i = 0; $i < $max_page; $i++) {
                    if ($i == $page) {
                        echo '<a href="category.php?id='.$cat.'&page='.($i +1).'" class="currentPage">'.($i +1).'</a>' . ' | ';
                        //текущата страница може да е с друг цвят за да се вижда къде сме в момента
                        // кода бачка само трябва да се приложи стил на class- currentPage
                    }else {
                        echo '<a href="category.php?id='.$cat.'&page='.($i +1).'">'.($i +1).'</a>' . ' | ';
                    }
                }
                if ($page < $max_page-1) {
                    echo '<a href="category.php?id='.$cat.'&page='.($page +2).'">Next page</a>';
                }

                echo '</div>';
            }
        }
    }

}

siteFooter($con);
