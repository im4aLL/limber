<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports name</title>
</head>
<body>
    <p>Here is sports name - </p>
    <ul>
        <?php foreach ($sports as $sport) : ?>
            <li><?= $sport ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>