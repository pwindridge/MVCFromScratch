<?php require 'partials/head.php'; ?>

    <h1>Delete Module</h1>

    <form method="post" action="/delete">

        <input  type="hidden" name="module_code" value="<?= $record->module_code ?>">
        <dl>
            <dt>Module Code</dt>
            <dd><?= $record->module_code ?></dd>
            <dt>Module Title</dt>
            <dd><?= $record->module_name ?></dd>
        </dl>

        <p>Are you sure that you wish to delete this record?</p>

        <div>
            <button type="submit">Delete Record</button>
        </div>

    </form>

<?php require 'partials/foot.php'; ?>