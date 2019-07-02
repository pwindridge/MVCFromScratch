<?php require 'partials/head.php'; ?>

<h1>List of Modules</h1>
<ul>
    <?php foreach ($modules as $module): ?>

    <li><?= $module ?></li>

    <?php endforeach; ?>
</ul>

<?php require 'partials/foot.php'; ?>