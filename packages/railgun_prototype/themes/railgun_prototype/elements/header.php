<?php
defined('C5_EXECUTE') or die("Access Denied.");
include('packages/railgun_prototype/header_loader.php');
$uinfo = new User(); ?>
	<header class="">
		<div class="header-small">
			<div class="col-lg-12">
				<?php
			$a = new GlobalArea('Header Image Content');
			$a->display($c);
		?>
			</div>
			<div class="col-lg-12">
				<?php
			$a = new GlobalArea('Header Nav Content');
			$a->display($c);
		?>
			</div>
		</div>
		<div class="header-large">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-lg-5">
				<?php
			$a = new GlobalArea('Header Left Content');
			$a->display($c);
		?>
			</div>
			<div class="col-lg-2">
				<?php
			$a = new GlobalArea('Header Middle Content');
			$a->display($c);
		?>
			</div>
			<div class="col-lg-5">
				<?php
			$a = new GlobalArea('Header Right Content');
			$a->display($c);
		?>
			</div>
		</div>
	</div>
	</div>
	</header>
