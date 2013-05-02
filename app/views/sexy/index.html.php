<?php if ( ! empty($sexies) ) : ?>
	<?php $imageUrl = '/images/' . $sexies->file_name ?>
	<div class="large-7 columns">
		<a class="image-link" href="<?= $imageUrl ?>" style="background-image:url(<?= $imageUrl ?>)">
			<img src="<?= $imageUrl ?>" />
		</a>
	</div>
	<div class="large-5 columns">
		<form action="/comment" method="POST" id="comment-form">
			<div class="row collapse">
				<textarea name="content" placeholder="comment"></textarea>
				<input type="submit" class="button right" value="Post" />
			</div>
			<input type="hidden" name="id" value="<?= $sexies->_id ?>" />
		</form>
		<ul class="comments">
		<?php if ( !empty($sexies->comments) ) : ?>
			<?php foreach ( $sexies->comments as $key=>$comment ) : ?>
			<li>
				<?= $comment->content ?>
				<abbr class="date timeago" title="<?= date('c',$comment->createdAt) ?>"><?= date('F m, o',$comment->createdAt) ?></abbr>
			</li>
			<?php endforeach ?>
		<?php else : ?>
			<li><em>No comments yet.</em></li>
		<?php endif ?>
		</ul>
	</div>
<?php else : ?>
	<p class="text-center"><em>No image found</em></p>
<?php endif ?>

<?php $this->scripts($this->html->script('dragndrop.js')) ?>
<?php $this->scripts($this->html->script('jquery.filedrop.js') ) ?>