<?php
include 'functions.php';
//include 'connect.php';
//echo "<div id=\"container\">";

siteHeader("SportsMen | Chicago Team");
echo "<main>";
$sql = "SELECT
    categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			categories.cat_date
        FROM
            categories";

$result = mysqli_query($con, $sql);
//var_dump($result);

if (!$result) {
    echo 'Категориите не могат да бъдат показани в момента, моля опитайте по-късно.';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'Все още няма категории.';
    } else {
        // echo $_GET['cat_id'];
        //prepare the table
        echo '<table class="table" border="1">
              <tr>
                <th>Категория</th>
                <th>публикувана на </th>
              </tr>';
        // var_dump($result);
        while ($row = mysqli_fetch_assoc($result)) {
            // echo($row['cat_date']);
            echo '<tr>';
            echo '<td class="leftpart">';
            echo '<p class="paragraph"><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></p>' . $row['cat_description'];
            echo '</td>';
            echo '<td class="rightpart">';
            echo '<strong>Публикувана на ' . $row['cat_date'] . '</strong>';
            echo '</td>';
            echo '</tr>';
        }
        echo "</table>";
    }

}
echo "</main>";
siteFooter($con);





