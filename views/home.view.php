<?php require 'partials/head.php'; ?>

<h1>List of Modules</h1>
<ul>
    <?php foreach ($modules as $module): ?>

        <li><?= $module->module_name ?>
            <a href="/detail?mode=edit&code=<?= $module->module_code ?>">Edit</a>
            <a href="/detail?mode=delete&code=<?= $module->module_code ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php require 'partials/foot.php'; ?>