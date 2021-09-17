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

                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif ?>

                <?= $this->session->flashdata('message'); ?>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSubMenu">Add Submenu</a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Menul</th>
                                                <th scope="col">Url</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Active</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($subMenu as $sm) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $sm['title'] ?></td>
                                                    <td><?= $sm['menu'] ?></td>
                                                    <td><?= $sm['url'] ?></td>
                                                    <td><?= $sm['icon'] ?></td>
                                                    <td><?= $sm['is_active'] ?></td>
                                                    <td>
                                                        
                                                        <a href="<?= base_url('submenu/deleteSub/') . $sm['id_sub'] ?>" class="badge badge-danger">Delete</a>
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
                <div class="modal fade" id="addSubMenu" tabindex="-1" aria-labelledby="addSubMenu" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSubMenu">Add Submenu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('submenu') ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <select name="id_menu" id="id_menu" class="form-control">
                                            <option value="">Select Menu</option>
                                            <?php foreach ($menu as $m) : ?>
                                                <option value="<?= $m['id_menu'] ?>"><?= $m['menu'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="url" name="url" placeholder="URL">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                            <label class="form-check-label" for="is_active">
                                                Active
                                            </label>
                                        </div>
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