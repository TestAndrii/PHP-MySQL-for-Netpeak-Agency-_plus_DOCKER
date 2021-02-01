<?php include '../app/src/db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL Test Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<?php

$sqlTable = "DROP TABLE IF EXISTS PRODUCT";
if ($mysqli->query($sqlTable)) {
    echo "Table dropped successfully! <br>";
} else {
    echo "Cannot drop table. "  . mysqli_error($mysqli);
}


echo "Executing CREATE TABLE PRODUCT Query...<br>";
$sqlTable = "
CREATE TABLE `PRODUCT` (
    `ID` bigint NOT NULL AUTO_INCREMENT,
    `NAME` varchar(255) DEFAULT NULL,
    `IMG` varchar(255) DEFAULT NULL,
    `TIME_ADD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `USER_ADD` varchar(255) DEFAULT NULL,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

if ($mysqli->query($sqlTable)) {
    echo "Table created successfully!<br>";
} else {
    echo "ERROR: Cannot create table. "  . mysqli_error($mysqli);
    die();
}

echo "Executing INSERT INTO PRODUCT Query...<br>";
$sqlTable = "
INSERT INTO `PRODUCT` (`ID`, `NAME`, `IMG`, `TIME_ADD`, `USER_ADD`) VALUES
(1, 'Product 1', 'https://www.sb.by/upload/iblock/3af/3af88bfff5d24428be33f463543e2810.jpg', '2021-01-31 16:52:46', 'User 1'),
(2, 'Product 2', 'https://sun1-21.userapi.com/avFtZE482R6RbExOOcjy3scYlqfpCLlxfBf3PA/OTpOAuSxUks.jpg', '2021-01-31 16:52:47', 'User 2');
";

if ($mysqli->query($sqlTable)) {
    echo "Data insert successfully!<br>";
} else {
    echo "ERROR: Cannot insert table. "  . mysqli_error($mysqli);
    die();
}



echo "Executing CREATE TABLE MESSAGES Query...<br>";
$sqlTable = "
CREATE TABLE `MESSAGES` (
    `ID` bigint NOT NULL AUTO_INCREMENT,
    `ID_PRODUCT` bigint,
    `USER_ADD` varchar(255) DEFAULT NULL,
    `RATING` int(2) DEFAULT '0',
    `MESSAGES` varchar(255) DEFAULT NULL,
    `TIME_ADD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

if ($mysqli->query($sqlTable)) {
    echo "Table created successfully!<br>";
} else {
    echo "ERROR: Cannot create table. "  . mysqli_error($mysqli);
    die();
}

echo "Executing INSERT INTO MESSAGES Query...<br>";
$sqlTable = "
INSERT INTO `MESSAGES` (`ID`, `ID_PRODUCT`, `USER_ADD`, `RATING`, `MESSAGES`, `TIME_ADD`) VALUES (NULL, '1', 'User 1', '0', 'Mesage 1', CURRENT_TIMESTAMP),
(NULL, '1', 'User 1', '1', 'Mesage 2', CURRENT_TIMESTAMP);
";

if ($mysqli->query($sqlTable)) {
    echo "Data insert successfully!<br>";
} else {
    echo "ERROR: Cannot insert table. "  . mysqli_error($mysqli);
    die();
}

?>


<button class="btn btn-info" onclick="window.location = 'index.php';">Вернуться назад</button>

</html>