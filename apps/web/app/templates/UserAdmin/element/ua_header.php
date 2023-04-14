<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?= $this->Url->build(['_name' => 'userTop']); ?>" class="nav-link"><?= @$user_site_list[@$current_site_id] ?></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<span class="link_logout nav-link">権限：<?= $this->Common->getUserRoleName(); ?></span>
		</li>

		<?php if (true) : ?>
			<li class="nav-item">
				<a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>" class="nav-link" target="_blank">
					<i class="fas fa-desktop"></i>
					<span class="show_pc">サイト表示</span>
				</a>
			</li>
		<?php endif; ?>

		<li class="nav-item">
			<a href="<?= $this->Url->build(['_name' => 'logout']); ?>" class="nav-link">
				<i class="glyphs-logout"></i><span class="link_logout"><i class="fas fa-sign-out-alt"></i> <span class="show_pc">ログアウト</span></span>
			</a>
		</li>

		<!-- フルスクリーン -->
		<li class="nav-item show_pc">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>

	</ul>
</nav>
<!-- /.navbar -->