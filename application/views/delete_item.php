<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Delete Item</h1>
            <?php echo isset($error) ? $error : ''; ?>
            <?php echo validation_errors(); ?>
            <?php echo form_open('main/delete_item'); ?>
                <div class="form-group">
                    <label for="product_id">Product ID</label>
                    <input type="number" class="form-control" id="product_id" name="product_id" value="<?= set_value('product_id') ?>">
                </div>
                <button type="submit" class="btn btn-danger">Delete Item</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>