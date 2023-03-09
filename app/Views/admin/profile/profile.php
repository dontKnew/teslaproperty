<?= $this->extend('include/admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Admin Profile Information</div>
                </div>
                <form action="<?= base_url().route_to("admin/profile") ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php if (session()->has('msg')) : ?>
                            <div class="alert alert-success text-center" role="alert">
                                <?= session()->getFlashdata("msg") ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('err')) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= session()->getFlashdata("err") ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group text-center">
                            <img src="<?= base_url() . "/backend/img/admin_profile/" . esc($data['profile']) ?>"
                                 alt="<?= esc($data['name']) ?>" width="120" height="120" class="mb-1 rounded-circle border-danger">
                            <div class="text-center w-100 d-flex justify-content-center ">
                                <input type="file" name="profile" class="form-control-file input-solid" style="width: 190px;">
                            </div>
                        </div>
                        <div class="form-group -mt-2">
                            <label>Admin Id</label>
                            <input type="text" name="name" value="<?= $data['id'] ?>" class="form-control input-solid" required readonly>
                        </div>

                        <div class="form-group"> <!--has-success-->
                            <label>Name</label>
                            <input type="text" name="name" value="<?= $data['name'] ?>" class="form-control input-solid" required>
                        </div>
                        <div class="form-group"> <!--has-success-->
                            <label>Email</label>
                            <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control input-solid" required>
                        </div>
                    </div>
                    <div class="card-action text-center">
                        <button type="submit" class="btn btn-primary">Update</button
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--end main content-->
<?= $this->endSection('main-contents') ?>
