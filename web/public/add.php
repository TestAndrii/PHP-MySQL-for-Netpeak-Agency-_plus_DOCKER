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
        <br>
        <h4>Добавить новый Товар</h4>
        <br>

        <form method="POST" action="index.php" class="center">
            <p><input name="NAME" type="text" placeholder="Название товара"></p>
            <p><input name="IMG" type="text" placeholder="Ссылка на картинку"></p>
            <p><input name="PRICE" type="number" placeholder="Средняя цена"></p>
            <p>Дата добавления = <?php echo date_format(date_create(), 'Y-m-d'); ?></p>
            <p><input name="USER_ADD" type="text" placeholder="Кто довил"></p>

            <label>
                <input name="consent" type="checkbox">
                Я даю согласие на обработку моих персональных данных
            </label>

            <br>
            <button class="btn btn-success" type="submit">Добавить</button>
            <button class="btn btn-danger" type="reset">Очистить форму</button>
        </form>
    </div>

    <body