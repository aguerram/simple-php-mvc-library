<?php if (isset($success)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <?php foreach ($success as $msg) : ?>
                <li><?= $msg ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>