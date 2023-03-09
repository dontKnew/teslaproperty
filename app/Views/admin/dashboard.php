<?= $this->extend('include/admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">Dashboard</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-stats card-warning">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="la la-bullhorn"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category"> ADMIN</p>
                                <h4 class="card-title"><?= "1" ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>

</div>
<!--end main content-->
<?= $this->endSection('main-contents') ?>
