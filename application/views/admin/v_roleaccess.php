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
            <h5><?= $role['role'] ?></h5>
            <div class="content mt-3">
                <?= $this->session->flashdata('message'); ?>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $m) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $m['menu'] ?></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                            <?= check_access($role['id_role'], $m['id_menu']) ?> 
                                                            data-role="<?= $role['id_role'] ?>" data-menu="<?= $m['id_menu'] ?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div> <!-- .content -->
                </div><!-- /#right-panel -->