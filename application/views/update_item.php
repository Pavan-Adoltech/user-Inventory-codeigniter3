<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Update Item</h1>
            <?php echo isset($error) ? $error : ''; ?>
            <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('main/update_item'); ?>
                <div class="form-group">
                    <label for="product_id">Product ID</label>
                    <input type="number" class="form-control" id="product_id" name="product_id" value="<?= set_value('product_id') ?>">
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?= set_value('product_name') ?>">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" value="<?= set_value('product_price') ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"><?= set_value('description') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?= set_value('quantity') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update Item</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>