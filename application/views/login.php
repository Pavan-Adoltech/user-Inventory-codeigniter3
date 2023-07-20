<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
<style>
body {
  background: url('https://img.freepik.com/free-vector/illustration-social-media-concept_53876-37691.jpg?size=626&ext=jpg&ga=GA1.2.1135989869.1687179487&semt=ais') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
h2{
  background-color: violet;
}
</style>
<body>
    <div class="text-center">
    <h2>Wecome To My Page</h2>
</div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors(); ?>
                        <?php if (isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <?php echo form_open(base_url('main')); ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="card-footer text-center">
                        Don't have an account? <a href="<?= base_url('main/register') ?>">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    