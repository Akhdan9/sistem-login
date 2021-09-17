    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">

                </div>
                <div class="login-form">
                    <div class="text-center">
                        <h>Did you forget the password ?</h>
                    </div>
                    <?= $this->session->flashdata('message'); ?>

                    <form method="post" action="<?= base_url('register/forgotpassword'); ?>">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Reset Password</button>
                        <div class="social-login-content">
                            <div class="social-button">
                                <div class="register-link m-t-15 text-center">
                                    <a href="<?php echo base_url(); ?>register">Back to login</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>