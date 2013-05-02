<ul class="latest-list large-block-grid-4">
<?php foreach( $sexies as $sexy ) : ?>
	<?php $imageUrl = '/images/' . $sexy->fileName ?>
	<li>
		<a href="/<?= $sexy->_id ?>" style="background-image:url(<?= $imageUrl ?>)">
			<img src="<?= $imageUrl ?>" />
			<div class="row">
				<div class="large-6 columns">
					<p><?= $sexy->commentCount ?> comments</p>
				</div>
				<div class="large-6 columns">
					<abbr class="date timeago" title="<?= date('c',$sexy->createdAt->sec) ?>"><?= date('F m, o',$sexy->createdAt->sec) ?></abbr>
				</div>
			</div>
		</a>
	</li>
<?php endforeach ?>
</ul>

<?php if ($this->pagination->create($sexies, $options + array('start' => false))->count() > 1) : ?>
<?= $this->pagination->pre(); ?>
<?= $this->pagination->pages(); ?>
<?= $this->pagination->post(); ?>
<?= $this->pagination->end(); ?>
<?php endif; ?>