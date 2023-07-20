
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Product</h1>
        </div>
    </div>
    <div class="row">
            <?php foreach($products as $item): ?>
                <div class="col-4">
                    <div class="card">
                        <img src="<?php echo base_url('uploads/'.$item->image)?>" class="card-img-top" alt="<?=$item->product_name?>">
                        <div class="card-body">
                            <h5 class="card-title"><?=$item->product_id.')'.$item->product_name?></h5>
                            <p class="card-text"><?= $item->product_price?>$</p>
                            <div class="row">
                                <div class="input-group mb-3" style="width:130px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-quantity bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                    <button class="btn btn-primary" value="<?=$item->product_id?>">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</div>

