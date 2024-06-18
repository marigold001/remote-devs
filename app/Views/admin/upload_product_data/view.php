<!DOCTYPE html>
<html>
<head>
    <title>Upload Product Data</title>
</head>
<body>
<h1>Upload Product Data</h1>

<?php if (session()->has('success')): ?>
    <div style="color: green;">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div style="color: red;">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('import/upload') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <label for="file">Choose a CSV or Excel file to upload:</label>
    <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx">
    <button type="submit">Upload</button>
</form>
</body>
</html>
