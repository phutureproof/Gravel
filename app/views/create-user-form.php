<?php
use Gravel\Gravel;

?>
<form action="" method="post" accept-charset="utf-8">
    <?php if (Gravel::$formErrors): ?>
        <div class="alert alert-danger">
            <h2>Whoops...</h2>

            <p>Please correct the following issues...</p>
            <?php foreach (Gravel::$formErrors as $error) : ?>
                <p> - <?= $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Save</button>
    </div>
</form>