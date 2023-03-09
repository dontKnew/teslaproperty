<?= $this->extend('include/admin') ?>
<?= $this->section('main-contents') ?>

<div class="row d-flex justify-content-center" style="margin-top:-20px">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">States Table</div>
                <a href="<?= base_url().route_to("admin/state/add") ?>" class="btn btn-info">
                    <i class="la la-plus-circle"></i> Add State
                </a>
            </div>

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
                <?php if ($data): ?>
                    <?php if($pager['pagination']['hasMore']): ?>
                        <form action="<?= base_url().route_to("admin/state") ?>" method="post" >
                            <div class="form-group form-inline">
                                <label for="smallSelect" class="form-label mx-1 text-dark">Show Results : </label>
                                <select  onchange='this.form.submit()' class="form-control form-control-sm text-dark" name="result_number"  >
                                    <option  <?php if($pager['pagination']['perPage']==5){echo "selected";}?> >5</option>
                                    <option  <?php if($pager['pagination']['perPage']==10){echo "selected";}?>>10</option>
                                    <option  <?php if($pager['pagination']['perPage']==15){echo "selected";}?>>15</option>
                                    <option  <?php if($pager['pagination']['perPage']==20){echo "selected";}?>>20</option>
                                    <option  <?php if($pager['pagination']['perPage']==25){echo "selected";}?>>25</option>
                                    <option  <?php if($pager['pagination']['perPage']==30){echo "selected";}?>>30</option>
                                </select>
                            </div>
                        </form>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-head-bg-primary table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th> # </th>    
                                <th> State Name </th>
                                <th> Page Title </th>    
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($data as $value): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= esc($value['name']) ?></td>
                                    <td><?= esc($value['page_title']) ?></td>
                                    <td>
                                        <a onclick="return confirm('Are you sure want to remove state ?')" href="<?= base_url(). route_to("admin/state/delete", $value['id']) ?>"
                                           class="btn btn-sm btn btn-rounded btn-danger my-1">
                                            <i class="la la-trash"></i> Delete
                                        </a>
                                        <a href="<?= base_url() . route_to("admin/state/update" , $value['id']) ?>"
                                           class="btn btn-sm btn btn-rounded btn-success my-1">
                                            <i class="la la-pencil"></i> Edit
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php if($pager['pagination']['hasMore']): ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item"><a class="page-link red" href="<?=$pager['pagination']['previous']?>">Previous</a></li>

                            <?php $k=0; for($i=$pager['pagination']['currentPage']; $i < $pager['pagination']['pageCount']; $i++) { ?>
                                <li class="page-item <?=($pager['pagination']['currentPage']==$i)?'':''?> ">
                                    <a class="page-link red" href="<?=$pager['pagination']['path']?>?page=<?=$i?>">
                                        <?=$i?>
                                    </a>
                                </li>
                                <?php if($k==5){ break;} ?>
                                <?php $k++; } ?>
                            <li class="page-item"><a class="page-link red" href="<?=$pager['pagination']['path']?>?page=<?=$pager['pagination']['get_last_page']?>">Last..</a></li>
                        </ul>
                    </nav>
                <?php endif; ?>
                <?php else: ?>
                    <h6>
                        <div class="alert alert-warning text-center"><i class="la la-warning"></i> No Record found
                            yet
                        </div>
                    </h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--end main content-->
<?= $this->endSection('main-contents') ?>
