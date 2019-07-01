<?php

$modules = [
    "COMP50016" => "Server-Side Programming",
    "COSE50582" => "Object-Oriented Application Engineering",
    "COSE50586" => "Web and Mobile Application Development",
    "COSE50637" => "Engineering Software Applications"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modules List</title>
</head>
<body>

<h1>List of Modules</h1>
<ul>
    <?php foreach ($modules as $module): ?>

    <li><?= $module ?></li>

    <?php endforeach; ?>
</ul>

</body>
</html>