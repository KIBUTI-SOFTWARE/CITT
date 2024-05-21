

<?php $pager->setSurroundCount(2) ?>

<nav class="text-center" aria-label="Page navigation">
    <ul class="pagination pagination-md">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item prev">
            <a class="page-link" href="<?= $pager->getFirst() ?>">
                <i class="tf-icon bx bx-chevrons-left"></i>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <li <?= $link['active'] ? 'class="page-item active"' : '' ?>>
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item next">
            <a class="page-link" href="<?= $pager->getNext() ?>">
                <i class="tf-icon bx bx-chevrons-right"></i>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>