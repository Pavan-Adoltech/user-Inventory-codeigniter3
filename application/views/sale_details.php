<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Sale Details</h1>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Net Amount</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($sale as $item): ?>
                    <tr>
                        <td><?= $item->product_id ?></td>
                        <td><?= $item->quantity ?></td>
                        <td><?= $item->price ?></td>
                        <td><?= $item->net_amount ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


