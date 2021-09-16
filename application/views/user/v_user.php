        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?= $title; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>

        </div>

        <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="<?= base_url(). 'assets/images/profile/'. $user['image']; ?>" >
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
                <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_create']); ?></small></p>
            </div>
            </div>
        </div>
        </div>
            
</div> <!-- .content -->
    </div><!-- /#right-panel -->

  