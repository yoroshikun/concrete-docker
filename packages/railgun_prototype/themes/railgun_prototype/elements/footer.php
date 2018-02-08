<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<footer class="">
<!-- Stuff for footer content -->
	<div class="container-super-fluid footer-theme bg-black">
		<div class="container max-width-1320">
			<div class="row-fluid">
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 1');
				$a-> display($c);
				?>
			</div>
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 2');
				$a-> display($c);
				?>
			</div>
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 3');
				$a-> display($c);
				?>
			</div>
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 4');
				$a-> display($c);
				?>
			</div>
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 5');
				$a-> display($c);
				?>
			</div>
			<div class="col-lg-2 clearfix">
				<?php
				$a = new GlobalArea('Footer 6');
				$a-> display($c);
				?>
			</div>
		</div>
			<div class="row-fluid">
				<div class="col-lg-12 copyright">
					<?php
					$a = new GlobalArea('copyright');
					$a-> display($c);
					?>
				</div>
			</div>
		</div>
	</div>

<!-- might need to add more to this -->

</footer>

<?php include('packages/railgun_prototype/footer_loader.php');?>
