<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
<style>
body {
  background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSO4z4-iqEsak4vVZ5lfMgIpyHyqo2h8LS3Nw&usqp=CAU') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
</style>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Register</h2>
                </div>
                <div class="card-body">
                    <?php echo validation_errors(); ?>
                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php } ?>
                    <?php echo form_open(base_url('main/register')); ?>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>">
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?= set_value('age') ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" <?= set_select('gender', 'male') ?>>Male</option>
                                <option value="female" <?= set_select('gender', 'female') ?>>Female</option>
                                <option value="other" <?= set_select('gender', 'other') ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="card-footer text-center">
                    Already have an account? <a href="<?= base_url('main') ?>">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>