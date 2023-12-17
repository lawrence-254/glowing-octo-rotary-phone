<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php test</title>
</head>
<body>
<?php echo $_SERVER['HTTP_USER_AGENT']; ?>
<form action="action.php" method="post">
    <label for="name">name</label>
    <input type="text" name="name" id="name">
    <label for="age">age</label>
    <input type="number" name="age" id="age">
    <button type="submit">submit</button>
</form>
</body>
</html>