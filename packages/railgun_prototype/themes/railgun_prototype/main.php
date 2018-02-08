<?php
	defined('C5_EXECUTE') or die("Access Denied.");
	$this->inc('elements/main_header.php');
	$u = new User(); ?>
	<main>
		<?php if ($u->isLoggedIn()) {?>
		<div class="container-fluid main edit no-gutter">
		<?php }else{ ?>
		<div class="container-fluid main no-gutter">
		<?php }?>
		<div class="row-fluid">
			<div class="col-lg-12 no-gutter">
				<?php
				$a = new Area('Image');
				$a->display($c);
			?>
			</div>
			<div class="col-lg-12 no-gutter bg-black">
				<div class="row">
				<div class="col-lg-7">
					<?php
					$a = new Area('Section 1 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-5">
					<?php
					$a = new Area('Section 1 2');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
			<div class="col-lg-12 no-gutter bg-white">
				<div class="row">
				<div class="col-lg-7 push-lg-5">
					<?php
					$a = new Area('Section 2 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-5 pull-lg-7">
					<?php
					$a = new Area('Section 2 2');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
			<div class="col-lg-12 no-gutter bg-black">
				<div class="row">
				<div class="col-lg-7">
					<?php
					$a = new Area('Section 3 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-5">
					<?php
					$a = new Area('Section 3 2');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
			<div class="col-lg-12 no-gutter bg-white">
				<div class="row">
				<div class="col-lg-7 push-lg-5">
					<?php
					$a = new Area('Section 4 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-5 pull-lg-7">
					<?php
					$a = new Area('Section 4 2');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
			<div class="col-lg-12 no-gutter bg-black">
				<div class="row">
				<div class="col-lg-7">
					<?php
					$a = new Area('Section 5 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-5">
					<?php
					$a = new Area('Section 5 2');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
			<div class="col-lg-12 no-gutter bg-white">
				<div class="row">
				<div class="col-lg-6 push-lg-6">
					<?php
					$a = new Area('Section 6 1');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-3 pull-lg-6">
					<?php
					$a = new Area('Section 6 2');
					$a->display($c);
					?>
				</div>
				<div class="col-lg-3 pull-lg-6">
					<?php
					$a = new Area('Section 6 3');
					$a->display($c);
					?>
				</div>
			</div>
			</div>
		</div>
	</div>

	</main>
	<?php  $this->inc('elements/footer.php'); ?>
