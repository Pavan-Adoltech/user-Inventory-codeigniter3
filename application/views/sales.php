<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Sales items</h1>
        </div>
    </div>
    <div class="row">
        <form id="cartForm">
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Net Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="salesTable">
                    <?php foreach ($sale_items as $item): ?>
                        <tr>
                            
                            <td><?= $item->product_id ?></td>
                            <td><?= $item->quantity ?></td>
                            <td><?= $item->price ?></td>
                            <td><?= $item->net_amount ?></td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $item->sale_item_id ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" onclick="window.location.replace('sale_list');">Submit</button>
        </form>
    </div>
</div>


