    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">

                </div>
                <div class="login-form">
                    <div class="text-center">
                        <h>Change Password</h>
                        <h class="mb-4"><?= $this->session->userdata('reset_email'); ?></h>
                    </div>
                    <?= $this->session->flashdata('message'); ?>

                    <form method="post" action="<?= base_url('register/changepassword'); ?>">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter new password" ">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Change Password</button>
                        <div class="social-login-content">
                            <div class="social-button">
                                
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>