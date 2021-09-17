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
            <div class="content mt-3">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenu">Add Menu</a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $m) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $m['menu'] ?></td>
                                                    <td>
                                                        
                                                        <a href="<?= base_url('menu/deleteMenu/') . $m['id_menu'] ?>" class="badge badge-danger">Delete</a>
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

                <!-- Modal -->
                <div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenu" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMenu">Add Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('menu') ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>