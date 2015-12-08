<?php
use Gravel\Gravel;

if (Gravel::$formErrors): ?>
    <div class="alert alert-danger">
        <p class="lead">Whoops...</p>

        <p>Please correct the following issues...</p>
        <ol>
            <?php foreach (Gravel::$formErrors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>