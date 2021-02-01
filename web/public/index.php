<?php

// include '../app/vendor/autoload.php';
include '../app/src/clean.php';
include '../app/src/db.php';

// Данные для сортировки (по умолчанию)
$sort = "DESC";
$key = "ID";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // new NAME added

    // remove invalid chars from input.
    $cleaned_name = Clean::str($_POST["NAME"]);
    $cleaned_img = Clean::str($_POST["IMG"]);
    $cleaned_user = Clean::str($_POST["USER_ADD"]);

    //query to insert new message
    $strsq0 = "INSERT INTO 
        PRODUCT ( NAME, IMG, USER_ADD ) 
        VALUES ('" . $cleaned_name . "','" . $cleaned_img . "','" . $cleaned_user . "');";

    if ($mysqli->query($strsq0)) {
        echo "Insert success!";
    } else {
        echo "Cannot insert into the data table; check whether the table is created, or the database is active. "  . mysqli_error($mysqli);
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "GET") { // update info

    if (isset($_GET['del'])) { // delete data
        $strsq0 = "DELETE FROM PRODUCT WHERE ID = ". $_GET['del'];
        if ($mysqli->query($strsq0)) {
            echo "Delete success!";
        } else {
            echo "Cannot delete the data in table. "  . mysqli_error($mysqli);
        }
    } elseif (isset($_GET['sort'])) { // sort data
        $sort = ($_GET['sort'] == 'DESC') ? 'ASC' : 'DESC';
    }
}

//Query the DB for messages
// $strsql = "select * from PRODUCT ORDER BY ".$key." ".$sort." limit 100";
$strsql = "select PRODUCT.*, COUNT(MESSAGES.ID) as MESSAGES from PRODUCT left join MESSAGES on PRODUCT.ID = MESSAGES.ID_PRODUCT group by ID order by ".$key." ".$sort;
if ($result = $mysqli->query($strsql)) {
    // printf("<br>Select returned %d rows.\n", $result->num_rows);
} else {
    echo "<b>Can't query the database, did you <a type='button' class='btn btn-success' href = init.php>Create the table</a> yet?</b>";
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL test for Netpeak Agency</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <div class="text-center">
        <h1>
            <a href="index.php">PHP MySQL for Netpeak Agency!</a>
        </h1>
        <h4>Агрегатор отзывов о товаре</h4>
        <br>
        <p class="description">Список товаров</p>

        <table class='table table-bordered'>
            <tbody>

                <?php
                echo "<tr>\n";
                while ($property = mysqli_fetch_field($result)) {
                    echo '<th>';
                    echo "<a href='index.php?name=".$property->name."&sort=".$sort."'>".$property->name."</a>";
                    echo "</th>\n";
                }
                echo "<th colspan=2 class='text-center'>Действия</th>\n";
                echo "</tr>\n";

                mysqli_data_seek($result, 0);
                if ($result->num_rows == 0) { //nothing in the table
                    echo '<td>Empty!</td>';
                }

                while ($row = mysqli_fetch_row($result)) {
                    echo "<tr>\n";
                    for ($i = 0; $i < mysqli_num_fields($result); $i++) {
                        if ($i == 1) echo "<td><a href='review.php?id=".$row[0]."'>".$row[$i]."</a></td>";
                        elseif ($i == 2) echo '<td><img src=' . $row[$i] . ' class="icon" /></td>';
                        else echo '<td>' . $row[$i] . '</td>';
                    }
                    echo "<td class='text-center'>";
                    echo "<a class='btn btn-danger' href='index.php?del=" . $row[0] . "'>Удалить</a>";
                    echo "</td>";

                    echo "</tr>\n";
                }

                $result->close();
                mysqli_close($mysqli);
                ?>

                <tr>
                    <td colspan="8">
                        <a class="btn btn-success" href="add.php">Добавить Товар</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>