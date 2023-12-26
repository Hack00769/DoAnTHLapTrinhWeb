<div id="pagination" class="pagination-container" align="center">
    <?php if ($current_page > 3) : ?>
        <a class="page-item" href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=1">Đầu</a>
    <?php endif; ?>

    <?php if ($current_page > 1) : ?>
        <a class="page-item" href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $current_page - 1 ?>">Trước đó</a>
    <?php endif; ?>

    <?php for ($num = 1; $num <= $totalPages; $num++) : ?>
        <?php if ($num != $current_page) : ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) : ?>
                <a class="page-item" href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
            <?php endif; ?>
        <?php else : ?>
            <strong class="current-page page-item"><?= $num ?></strong>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($current_page < $totalPages) : ?>
        <a class="page-item" href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $current_page + 1 ?>">Kế tiếp</a>
    <?php endif; ?>

    <?php if ($current_page < $totalPages - 3) : ?>
        <a class="page-item" href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $totalPages ?>">Cuối</a>
    <?php endif; ?>
</div>