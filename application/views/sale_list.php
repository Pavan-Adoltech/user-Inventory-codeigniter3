

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Sales List</h1>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>View Details</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($salesList as $sale): ?>
                    <tr>
                        <td><?= $sale->sale_id ?></td>
                        <td><?= $sale->totalAmount ?></td>
                        <td>
                            <a href="<?= base_url('main/view_details/' . $sale->sale_id) ?>" class="btn btn-outline-success">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
