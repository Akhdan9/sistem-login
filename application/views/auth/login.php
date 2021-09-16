    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    
                </div>
                <div class="login-form">
                <div class="text-center">
                        <h>Login Page</h>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    
                    <form method="post" action="<?= base_url('auth'); ?>">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password"> 
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                                <div class="checkbox">
                                    
                                    <label class="pull-center">
                                <a href="#">Forgotten Password?</a>
                            </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                    <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="<?php echo base_url(); ?>register"> Sign Up Here</a></p>
                                </div>
                                    </div>
                                </div>
                                
                    </form>
                </div>
            </div>
        </div>
    </div>


    
