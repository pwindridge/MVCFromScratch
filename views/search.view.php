<?php require 'partials/head.php'; ?>

<h1>Search for Module Code</h1>

<form>

    <fieldset>
        <legend>Search for Module</legend>

        <div>
            <label for="title">Module Title:</label>
            <input type="text" style="width: 180px" id="title" placeholder="Module Title" name="title" <?= $moduleTitle; ?>>
        </div>
        <div>
            <button type="submit">Search Modules</button>
        </div>
    </fieldset>
</form>

<?php if ($code): ?>

<p>The code for your module is: <?= $code ?></p>

<?php endif; ?>

<?php require 'partials/foot.php'; ?>
