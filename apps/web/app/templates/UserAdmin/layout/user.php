<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOMEPAGE MANAGER｜<?= @$user_site_list[@$current_site_id] ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="/user/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/user/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="/user/common/css/cms_theme.css">
	<link rel="stylesheet" href="/user/common/css/jquery-ui-1.12.1/smoothness/jquery-ui.min.css">
	<link rel="stylesheet" href="/user/common/css/colorbox.css">
	<link rel="stylesheet" href="/user/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<?= $this->fetch('beforeHeadClose'); ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
	<div class="wrapper">

		<?= $this->element('ua_header'); ?>

		<?= $this->element('side'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?= $this->fetch('content'); ?>
		</div>

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- Default to the left -->
			<strong><?= COPYRIGHT; ?></strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<div id="kakunin_dialog" title="確認">
		<p></p>
	</div>

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="/user/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="/user/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/user/dist/js/adminlte.min.js"></script>

	<script src="/user/common/js/jquery-ui-1.12.1.min.js"></script>
	<script type="text/javascript">
		$.widget.bridge('uibutton', $.ui.button);
		$.widget.bridge('uitooltip', $.ui.tooltip);
	</script>
	<script src="/user/common/js/jquery.colorbox-min.js"></script>
	<script src="/user/common/js/colorbox.js"></script>
	<script src="/user/common/js/cms.js"></script>
	<script src="/user/common/js/jquery.ui.datepicker-ja.js"></script>

	<?= $this->fetch('beforeBodyClose'); ?>
</body>

</html>