<?php
include 'functions.php';
include 'connect.php';
siteHeader("Начало");
$sql = "SELECT
    categories.cat_id,
			categories.cat_name,
			categories.cat_description
        FROM
            categories";

$result = mysql_query($sql);
var_dump($result);
if(!$result)
{
    echo 'Категориите не могат да бъдат показани в момента, моля опитайте по-късно.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'Все още няма категории.';
    }
    else
    {
        // echo $_GET['cat_id'];
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Категория</th>
                <th>Последна тема</th>
              </tr>';
        var_dump($result);
        while($row = mysql_fetch_assoc($result))
        {
            echo '<tr>';
            echo '<td class="leftpart">';
            echo "<h3><a href='category.php?id=$row[cat_id]'>" . $row["cat_name"] . "</a></h3>" . $row["cat_description"];
            echo '</td>';
            echo '<td class="rightpart">';
            echo '<a href="topic.php?id=">Публикувана</a> на 10-10';
            echo '</td>';
            echo '</tr>';
        }
    }
}


?>
siteFooter();