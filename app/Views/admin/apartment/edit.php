<?= $this->extend('include/admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">
        <a href="<?= base_url().route_to("admin/state") ?>" class="btn btn-warning">
            <i class="la la-arrow-left"></i> Back
        </a>
    </h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit City</div>
                </div>
                <form action="<?= base_url().route_to("admin/city/update", $data['id']) ?>" method="POST">
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

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> State Name</label>
                                <select  name="state" class="form-control input-solid" required>
                                    <option value="">Select State</option>
                                    <?php foreach($state_list as $c): ?>
                                        <option value="<?=$c['id']?>" <?=($c['id']==$data['state'])?'selected':''?> ><?=$c['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City Name</label>
                                <input type="text" name="name" value="<?=$data['name']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Page Title</label>
                                <input type="text" name="page_title" value="<?=$data['page_title']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Meta Keywords</label>
                                <textarea name="meta_keywords" class="form-control input-solid"><?=$data['meta_keywords']?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Meta Description</label>
                                <textarea name="meta_description"  class="form-control input-solid"><?=$data['meta_description']?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-action text-center">
                        <button type="submit" class="btn btn-outline-primary">Submit</button
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
