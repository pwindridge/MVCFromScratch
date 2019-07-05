<?php require 'partials/head.php'; ?>

<h1>Add a Module to your List</h1>

<form action="/store" method="post">

    <fieldset>
        <legend>Module Details</legend>

        <div>
            <label for="code">Module Code:</label>
            <input type="text" id="code" name="code" placeholder="module code" maxlength="9">
        </div>

        <div>
            <label for="module">Module Title:</label>
            <input type="text" id="module" name="module" placeholder="module title" maxlength="50">
        </div>

        <div>
            <button type="submit">Add Module</button>
        </div>
    </fieldset>
</form>

<?php require 'partials/foot.php'; ?>
