<?php if ( ! empty($sexies) ) : ?>
	<?php $imageUrl = '/images/' . $sexies->file_name ?>
	<div class="large-7 columns">
		<a class="image-link" href="<?= $imageUrl ?>" style="background-image:url(<?= $imageUrl ?>)">
			<img src="<?= $imageUrl ?>" />
		</a>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row collapse">
				<div class="small-9 columns">
					<input type="text" placeholder="comment">
				</div>
				<div class="small-3 columns">
					<input type="submit" class="button prefix" value="Post" />
				</div>
			</div>
		</form>
	</div>
<?php else : ?>
	<p class="text-center"><em>No image found</em></p>
<?php endif ?>

<?php $this->scripts($this->html->script('dragndrop.js') ) ?>
<?php $this->scripts($this->html->script('jquery.filedrop.js') ) ?>