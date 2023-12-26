<div id="pagination">
	<?php if ($current_page > 3) : ?>
		<?php $first_page = 1; ?>
		<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
	<?php endif; ?>

	<?php if ($current_page > 1) : ?>
		<?php $prev_page = $current_page - 1; ?>
		<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
	<?php endif; ?>

	<?php for ($num = max(1, $current_page - 2); $num <= min($totalPages, $current_page + 2); $num++) : ?>
		<?php if ($num != $current_page) : ?>
			<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
		<?php else : ?>
			<strong class="current-page page-item"><?= $num ?></strong>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if ($current_page < $totalPages) : ?>
		<?php $next_page = $current_page + 1; ?>
		<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
	<?php endif; ?>

	<?php if ($current_page < $totalPages - 2) : ?>
		<?php $end_page = $totalPages; ?>
		<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
	<?php endif; ?>
</div>