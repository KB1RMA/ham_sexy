<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->html->charset();?>
	<title>Unhandled exception</title>
	<?php echo $this->html->style(array('debug', 'normalize', 'lithium', 'app')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>

	<?= $this->_render('element', 'header'); ?>

	<section id="main-content" class="row error">
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
	</section>

</body>
</html>