<?php
//category.php
include 'connect.php';
include 'functions.php';
siteHeader("Мнения");
//ne bachkat
//first select the category based on $_GET['cat_id']
$cat =  mysql_real_escape_string($_GET['id']);
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = '".$cat."'";

$result = mysql_query($sql);
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
    if(mysql_num_rows($result) == 0)
    {
        echo 'Категорията не съществува.';
    }
    else
    {


        //do a query for the topics
        $sql = "SELECT
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = " . mysql_real_escape_string($_GET['id']);

        $result = mysql_query($sql);

        if(!$result)
        {
            echo 'Грешка, моля опитайте по-късно.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'Няма мнения.';
            }
            else
            {
                //prepare the table
                echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';

                while($row = mysql_fetch_assoc($result))
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
            }
        }
    }
}

//siteFooter();
?>
