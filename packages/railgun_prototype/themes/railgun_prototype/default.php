<?php
	defined('C5_EXECUTE') or die("Access Denied.");
	$this->inc('elements/header.php');
	$u = new User(); ?>
	<main>
		<?php if ($u->isLoggedIn()) {?>
		<div class="container-fluid main edit no-gutter">
		<?php }else{ ?>
		<div class="container-fluid main no-gutter">
		<?php }?>
		<div class="row-fluid">
			<div class="col-lg-8 bg-white">
				<div class="row">
					<div class="col-lg-12">
							<?php
								$a = new Area('Section 1 1');
								$a->display($c);
							?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<?php
							$a = new Area('Section 1 2');
							$a->display($c);
						?>
					</div>
					<div class="col-lg-6">
						<?php
							$a = new Area('Section 1 3');
							$a->display($c);
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 no-gutter bg-orange">
				<div class="col-sm-12">
				<?php
				$a = new Area('Section 2 1');
				$a->display($c);
				?>
			</div>
			</div>
		</div>
	</div>

	</main>
	<?php  $this->inc('elements/footer.php'); ?>
