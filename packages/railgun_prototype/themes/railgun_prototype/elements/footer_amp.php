<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<footer class="">
<!-- Stuff for footer content -->
<div class="row">
<div class="container-super-fluid bg-black">
	<div class="container-fluid">
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 1');
			$a-> display($c);
			?>
		</div>
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 2');
			$a-> display($c);
			?>
		</div>
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 3');
			$a-> display($c);
			?>
		</div>
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 4');
			$a-> display($c);
			?>
		</div>
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 5');
			$a-> display($c);
			?>
		</div>
		<div class="col-lg-2">
			<?php
			$a = new GlobalArea('Footer 6');
			$a-> display($c);
			?>
		</div>
	</div>
</div>
</div>

<!-- might need to add more to this -->

</footer>

<?php
$u = new User();
if ($u->isLoggedIn()){
include('packages/railgun_prototype/footer_loader.php');
}else {
	include('packages/railgun_prototype/footer_loader_amp.php');
}?>
