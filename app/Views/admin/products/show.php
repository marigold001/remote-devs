<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
</head>
<body>
<h1>Product Details</h1>
<?php if ($product): ?>
    <p>Name: <?= $product['name'] ?></p>
    <p>Category: <?= $product['category_name'] ?></p>
    <p>Price: $<?= $product['price'] ?></p>
    <p>Description: <?= $product['description'] ?></p>
    <?php if (!empty($product['attributes'])): ?>
        <h2>Attributes</h2>
        <ul>
            <?php foreach ($product['attributes'] as $attr): ?>
                <li><?= $attr['attribute_name'] ?>: <?= $attr['attribute_value'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php else: ?>
    <p>Product not found.</p>
<?php endif; ?>
<a href="/products">Back to Products</a>
</body>
</html>
