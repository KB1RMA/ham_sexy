<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<?php echo $this->html->charset();?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo $this->title(); ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=600, initial-scale=1, maximum-scale=1">


		<?php echo $this->html->style(array('debug', 'normalize')); ?>
		<?php $this->styles($this->html->style(array('app'))); ?>
		<?= $this->optimize->styles() ?>

		<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,900italic' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Vollkorn:400,400italic' rel='stylesheet' type='text/css'>

		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>

	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<?= $this->_render('element', 'header') ?>

		<section id="main-content" class="row">
		<?php echo $this->content(); ?>
		</section>

		<div id="progress-shade">
			<div class="row">
				<div class="progress secondary large-8"><span id="progress-bar" class="meter"></span></div>
			</div>
		</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script type="text/javascript" src="//www.google.com/jsapi"></script>
		<?= $this->html->script("/js/foundation/foundation.js") ?>

		<?= $this->html->script("/js/foundation/foundation.reveal.js") ?>


		<?php $this->scripts($this->html->script('plugins.js') ) ?>
		<?php $this->scripts($this->html->script('main.js') ) ?>

		<?= $this->optimize->scripts() ?>

		<?= $this->_render('element', 'analytics') ?>

	</body>
</html>