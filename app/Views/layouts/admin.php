<!-- app/Views/layouts/admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css'); ?>">
    <title>Admin Dashboard</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?= $this->include('partials/admin/navbar'); ?>
    <?= $this->include('partials/admin/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <?= $this->renderSection('content'); ?>
        </section>
    </div>
    <?= $this->include('partials/admin/footer'); ?>
</div>
<script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<script src="<?= base_url('adminlte/dist/js/adminlte.js'); ?>"></script>
</body>
</html>
