<?php
use Gravel\Gravel;

if (Gravel::$formErrors): ?>
    <div class="alert alert-info">
        <h2>Whoops...</h2>

        <p>Please correct the following issues...</p>
        <ul>
            <?php foreach (Gravel::$formErrors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>