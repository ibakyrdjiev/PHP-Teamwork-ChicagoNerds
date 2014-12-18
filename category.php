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
//        $query = 'SELECT * FROM categories';
//        $find_counts = mysqli_query($con, $query);
//        while($row = mysqli_fetch_assoc($find_counts))
//        {
//            $current_count = $row['cat_seen'];
//            $new_count = $current_count + 1;
//            $updateCount = mysqli_query($con, "UPDATE categories SET cat_seen=$new_count WHERE=".$GLOBALS['testID']."");
//        }
//        //var_dump($_GET['id']);
//        var_dump($updateCount);
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
					topic_cat,
					topic_seen
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
                echo '<table class="table" border="1">
					  <tr>
						<th>Мнение</th>
						<th>Създаено на</th>
						<th>Брой посещения</th>
					  </tr>';

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo '<td class="leftpart">';
                    echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                    echo '</td>';
                    echo '<td class="center">';
                    echo date('d-m-Y', strtotime($row['topic_date']));
                    echo '</td>';
                    echo '<td class="seen">';
                    echo  $row['topic_seen'];
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<div class="pagination">';
                if ($page >= 1) {
                    echo '<a class ="page" href="category.php?id='.$cat.'&page='.($page  - 2).'">Предишна страница </a>' . " | ";
                }
                for ($i = 0; $i < $max_page; $i++) {
                    if ($i == $page) {
                        echo '<a class = "page" href="category.php?id='.$cat.'&page='.($i +1).'" class="Текуща страница">'.($i +1).'</a>' . ' | ';
                        //текущата страница може да е с друг цвят за да се вижда къде сме в момента
                        // кода бачка само трябва да се приложи стил на class- currentPage
                    }else {
                        echo '<a class = "page" href="category.php?id='.$cat.'&page='.($i +1).'">'.($i +1).'</a>' . ' | ';
                    }
                }
                if ($page < $max_page-1) {
                    echo '<a class="page" href="category.php?id='.$cat.'&page='.($page +2).'">Следваща страница</a>';
                }

                echo '</div>';
            }
        }
    }
    $_SESSION['backToCat'] = $_GET['id'];
   // var_dump($_SESSION['backToCat']);
}

siteFooter($con);
