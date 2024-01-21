
<form class="d-flex me-auto" method="GET" action="">
            <!-- Category Dropdown -->
            <select class="form-control me-2" name="category">
                <option value="" selected>Select Category</option>
                <?php foreach ($categories as $categoryItem) : ?>
                    <option value="<?= $categoryItem['categoryID'] ?>" <?= ($category == $categoryItem['categoryID']) ? 'selected' : '' ?>>
                        <?= $categoryItem['categoryName'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Price Range -->
            <input class="form-control me-2" type="number" placeholder="Min Price" name="min_price">
            <input class="form-control me-2" type="number" placeholder="Max Price" name="max_price">
            <button class="btn btn-outline-primary ms-1" type="submit">Search</button>
</form>