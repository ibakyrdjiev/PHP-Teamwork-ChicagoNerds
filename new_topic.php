<?php
//create_cat.php
error_reporting(0);
include 'functions.php';
siteHeader("Нова Тема");
include 'connect.php';

echo '<h2>Съсздавене на тема</h2>';
if(!isset ($_SESSION['signed_in']))
{
    //the user is not signed in
    echo 'Трябва да сте  <a href="signIn.php">регистрирани</a> за да създадете тема.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        //the form hasn't posted yet, display it
        //getting the categories
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";

        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            //when we have problem with the server
            echo 'Има проблем със сървара. Моля опитайте по-късно.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'Нямате създадени категории .';
                }
                else
                {
                    echo 'Преди да поснете тема трябва аминистратор да създаде категория.';
                }
            }


            else
            {
//                $row = mysql_fetch_assoc($result);
//                var_dump($row);
                echo '<form method="post" action="">
                    Относно: <input type="text" name="topic_subject" />
                    Категория:';

                echo '<select name="topic_cat">';
                //geting all the categories

                while($row = mysqli_fetch_assoc($result))
                {

                    //prints the option valiue
                    echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';

                }
                echo '</select>';

                echo 'Коментар: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Създай тема" />
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction

        $query  = "BEGIN WORK;";
        $result = mysqli_query($con, $query);

        if(!$result)
        {
            //problem with server
            echo 'Грешка, Моля опитайте по-късно.';
        }
        else
        {
            $topicSubject = trim($_POST['topic_subject']);
            //var_dump($topicSubject);
            $topicContent = trim($_POST['topic_cat']);
            if (($topicSubject != '' && $topicContent != '')) {
                if ((strlen($topicSubject) > 3 && strlen($topicSubject) < 100) && (strlen($topicContent) > 5 && strlen($topicContent) < 255)) {
                    //saving the data
                    //saving the data into the topic  - > only the topic info
                    $sql = "INSERT INTO
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . htmlentities(strip_tags(mysqli_real_escape_string($con , $topicSubject))) . "',
                               NOW(),
                               " . htmlentities(strip_tags(mysqli_real_escape_string($con, $topicContent))) . ",
                               " . $_SESSION['user_id'] . "
                               )";

                    $result = mysqli_query($con, $sql);
                    if(!$result)
                    {
                        //something went wrong, display the error
                        echo 'Грешка, моля опитайте отново ' ;
                        //za mahane
                        //    echo mysql_error();
                        //revert the changes
                        $sql = "ROLLBACK;";
                        $result = mysqli_query($con, $sql);
                    }
                    else
                    {
                        //the first query worked, now start the second, posts query
                        //current topic id
                        $topicId = mysqli_insert_id($con);
                        //echo $topicid;

                        //adding info into the topic table in database who created the topic and its posts
                        $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . htmlentities(strip_tags(mysqli_real_escape_string($con , $topicContent))) . "',
                                  NOW(),
                                  " . $topicId . ",
                                  " . $_SESSION['user_id'] . "

                            )";
                        //sesiion id = koi e slojil temata
                        $result = mysqli_query($con, $sql);

                        if(!$result)
                        {
                            //something went wrong, display the error
                            echo "Грешка, моля опитайте по-късно";
                            //revert the changes
                            $sql = "ROLLBACK;";
                            $result = mysqli_query($con, $sql);
                        }
                        else
                        {
                            //saving changes !!! YEA
                            $sql = "COMMIT;";
                            $result = mysqli_query($con, $sql);

                            //5h work, the query succeeded! yes m*faka :D
                            echo 'Създадохте <a href="topic.php?id='. $topicId . '">вашата нова тема</a>.';
                        }
                    }
                }else {
                    echo "<div>";
                    echo "<h3>Темата трябва да бъде с дължина между [3..100]</h3>";
                    echo "<h3>Коментара трябва да бъде с дължина между [5..255]</h3>";
                    echo "</div>";
                }

            }else if($topicContent === '' || $topicSubject == '') {
                echo "<div>";
                echo "<h3>Моля попълнете всички задължителни полета!</h3>";
                echo "</div>";
            }

        }
    }
}

siteFooter($con);
