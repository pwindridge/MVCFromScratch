<?php require 'partials/head.php'; ?>

    <h1>Edit Module Detail</h1>

    <form method="post" action="/edit">

        <div>
            <input  type="hidden" name="original_module_code" value="<?= $record->module_code ?>">
            <input type="text" name="module_code" value="<?= $record->module_code ?>">
            <input type="text" name="module_name" value="<?= $record->module_name ?>">
        </div>

        <div>
            <button type="submit">Edit Record</button>
        </div>

    </form>

<?php require 'partials/foot.php'; ?>