      <div class="container">
            <div class="row">
                <div class="col-12">
    <h1>Add Items</h1>
    <?=isset($error) ? $error: ''?>
    <?=validation_errors()?>
      <?=form_open_multipart()?>
 <div class="form-group">
    <label for="product_name">Product_name</label>
    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php set_value("product_name")?>">
  </div>
  <div class="form-group">
    <label for="product_price">Product_price</label>
    <input type="number" class="form-control" id="product_price" name="product_price"  value="<?php set_value("product_price")?>">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" value="<?php set_value("description")?>"></textarea>
  </div>
  <div class="form-group">
    <label for="image">Product_image</label>
    <input type="file" class="form-control-file" id="image" name="image">
  </div> 
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control-file" id="quantity" name="quantity">
  </div>
  <form method="" action="<?php echo base_url('product');?>"> 
  <button type="submit" class="btn btn-primary">Add new</button>
    </form>
  <?=form_close()?>
</div>
</div>
</div>
    

