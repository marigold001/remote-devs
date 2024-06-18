<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
<h1>Products</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?= $product['name'] ?> - <?= $product['category_name'] ?> - $<?= $product['price'] ?>
            <a href="/products/<?= $product['id'] ?>">View Details</a>
            <?php if (!empty($product['attributes'])): ?>
                <ul>
                    <?php foreach ($product['attributes'] as $attr): ?>
                        <li><?= $attr['attribute_name'] ?>: <?= $attr['attribute_value'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
