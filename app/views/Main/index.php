<?php

use amp\Controller;

/* @var string $test */
/* @var array $names */
/* @var \amp\View $this */

?>

<h1>Hello from my first view for main page</h1>
<p><?= $test ?></p>

<?php
    if (!empty($names)) {
        foreach ($names as $id => $name) { ?>
            <p>
                <b><?= $id ?></b> | <em><?= $name->name ?></em>
            </p>
        <?php }
    }
?>

