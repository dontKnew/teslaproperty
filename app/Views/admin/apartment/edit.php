<?= $this->extend('include/admin') ?>
<?= $this->section('main-contents') ?>

<!--start main content-->
<div class="container-fluid">

    <h4 class="page-title">
        <a href="<?= base_url().route_to("admin/apartment") ?>" class="btn btn-warning">
            <i class="la la-arrow-left"></i> Back
        </a>
    </h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Apartment</div>
                </div>
                <form action="<?= base_url().route_to("admin/apartment/update", $data['id']) ?>" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group col-md-4">
                                <label>Apartment Name</label>
                                <input type="text" name="title" value="<?=$data['title']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Apartment City</label>
                                <select  name="city" class="form-control input-solid" required>
                                    <option value="">Select City</option>
                                    <?php foreach($city_list as $c): ?>
                                        <option value="<?=$c['id']?>" <?=($c['id']==$data['city'])?'selected':'' ?> ><?=$c['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Address</label>
                                <input type="text" name="address" value="<?=$data['address']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Apartment Price</label>
                                <input type="number" name="price" value="<?=$data['price']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Price Type</label>
                                <select  name="price_type" class="form-control input-solid" required>
                                    <option value="">Select Type</option>
                                    <option value="daily" <?=("daily"==$data['price_type'])?'selected':'' ?> >Daily</option>
                                    <option value="weekly" <?=("weekly"==$data['price_type'])?'selected':'' ?> >Weekly</option>
                                    <option value="monthly" <?=("monthly"==$data['price_type'])?'selected':'' ?>  >Monthly</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Video </label>
                                <input type="file" name="video" accept="video/*" class="form-control input-solid" >
                                <video width="150" height="100" controls>
                                    <source src="<?=base_url()."/backend/img/apartment/video/".$data['video']?>" type="video/mp4">
                                    <source src="<?=base_url()."/backend/img/apartment/video/".$data['video']?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Status</label>
                                <select  name="status" class="form-control input-solid" required>
                                    <option value="">Select Status</option>
                                    <option value="available" <?=("available"==$data['status'])?'selected':'' ?>   >Available</option>
                                    <option value="not available" <?=("not_available"==$data['status'])?'selected':'' ?> >Not, Available</option>
                                    <option value="booked" <?=("booked"==$data['status'])?'selected':'' ?>>Booked</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Page Title</label>
                                <input type="text" name="page_title" value="<?=$data['page_title']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Gallery</label>
                                <input type="file" name="gallery[]" accept="image/*" aria-describedby="galleryHelp" class="form-control input-solid" multiple>
                                <small id="galleryHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can select multiple images at once.</strong>
                                </small>
                                <?php if(isset($data['gallery']) && !empty($data['gallery'])): ?>
                                    <div class="row">
                                        <?php foreach(json_decode($data['gallery'], true) as $key => $value): ?>
                                            <div class="col-md-3 gallery-item mt-4">
                                                <a class="remove-image badge-pill badge-warning badge " href="#" data-image="<?=$value?>">X</i></a>
                                                <img src="<?=base_url()."/backend/img/apartment/image/".$value?>" class="with-3d-shadow" width="150" style="object-fit: cover" height="100" alt="" class="img-fluid">
                                                <input type="hidden" name="old_gallery[]" value="<?=$value?>" >
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-input" type="button"><i class="la la-plus"></i></button> Apartment Specification </label>
                                <?php
                                    $specification = json_decode($data['specification'], true);
                                    if(isset($specification) && !empty($specification)):
                                        foreach($specification as $key => $value):
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" value="<?=$value['title']?>" name="specification[<?=$key?>][title]"  >
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['sub_title']?>" placeholder="sub title" name="specification[<?=$key?>][sub_title]" >
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-information" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                                <?php  endforeach; endif;?>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-information" type="button"><i class="la la-plus"></i></button> More Information </label>
                                <?php $more_information = json_decode($data['more_information'], true);
                                    if(isset($more_information) && !empty($more_information)):
                                        foreach($more_information as $key => $value):
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" value="<?=$value['title']?>" name="more_information[<?=$key?>][title]">
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['sub_title']?>" name="more_information[<?=$key?>][sub_title]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-information" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                                <?php endforeach; endif;?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-property-summary" type="button"><i class="la la-plus"></i></button> Property Summary </label>
                            <?php $property_summary = json_decode($data['property_summary'], true);
                                    if(isset($property_summary) && !empty($property_summary)):
                                        foreach($property_summary as $key => $value): ?>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" value="<?=$value['title']?>" name="property_summary[<?=$key?>][title]">
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['title']?>" name="property_summary[<?=$key?>][sub_title]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-property-summary" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                                <?php endforeach; endif;?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-nearby-place" type="button"><i class="la la-plus"></i></button> NearBy Places </label>
                                <?php $nearby_place = json_decode($data['nearby_place'], true);
                                    if(isset($nearby_place) && !empty($nearby_place)):
                                        foreach($nearby_place as $key => $value): ?>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" value="<?=$value['heading']?>" name="nearby_place[<?=$key?>][heading]">
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['name']?>" name="nearby_place[<?=$key?>][name]">
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['distance']?>" name="nearby_place[<?=$key?>][distance]">
                                    <input type="text" class="form-control input-solid mx-1" value="<?=$value['type']?>" name="nearby_place[<?=$key?>][type]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-nearby-place" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                                <?php endforeach; endif;?>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="description" class="form-control input-solid" rows="8" required><?=$data['description']?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Property Features</label>
                                <textarea name="property_features"rows="5" class="form-control input-solid" aria-describedby="propertyFeaturesHelp" ><?=$data['property_features']?></textarea>
                                <small id="propertyFeaturesHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can add multiple Property features by separating them with comma(,).</strong>
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tags</label>
                                <textarea name="tags" rows="5" class="form-control input-solid" aria-describedby="tagsHelp" ><?=$data['tags']?></textarea>
                                <small id="tagsHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can add multiple tags by separating them with comma(,).</strong>
                                </small>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Page Title</label>
                                <input type="text" name="page_title" value="<?=$data['page_title']?>" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Meta Keywords</label>
                                <textarea name="meta_keywords" rows="5" class="form-control input-solid"><?=$data['meta_keywords']?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Meta Description</label>
                                <textarea name="meta_description" rows="5" class="form-control input-solid"><?=$data['meta_description']?></textarea>
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
<!--end main content-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        let i = <?=intval(count($specification))?>;
        $(".add-input").click(function() {
            var inputField = '<div class="input-group">\
            <input type="text" class="form-control input-solid" placeholder="title" name="specification['+i+'][title]" >\
            <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="specification['+i+'][sub_title]"  >\
            <div class="input-group-append">\
                <button class="btn btn-sm btn-warning remove-input btn-block" type="button"><i class="la la-remove"></i></button>\
            </div>\
        </div>';
            $(this).parent().parent().after(inputField);
            i++;
        });
        $(document).on("click", ".remove-input", function() {
            $(this).parent().parent().remove();
        });

        let k = <?=intval(count($more_information))?>;;
        $(".add-information").click(function() {
            var inputField = '<div class="input-group">\
            <input type="text" class="form-control input-solid" placeholder="title" name="more_information['+k+'][title]">\
            <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="more_information['+k+'][sub_title]" >\
            <div class="input-group-append">\
                <button class="btn btn-sm btn-warning remove-information btn-block" type="button"><i class="la la-remove"></i></button>\
            </div>\
        </div>';
            $(this).parent().parent().after(inputField);
            k++;
        });
        $(document).on("click", ".remove-information", function() {
            $(this).parent().parent().remove();
        });

        let j = <?=intval(count($property_summary))?>;;
        $(".add-property-summary").click(function() {
            var inputField = '<div class="input-group">\
            <input type="text" class="form-control input-solid" placeholder="title" name="property_summary['+j+'][title]">\
            <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="property_summary['+j+'][sub_title]" >\
            <div class="input-group-append">\
                <button class="btn btn-sm btn-warning remove-property-summary btn-block" type="button"><i class="la la-remove"></i></button>\
            </div>\
        </div>';
            $(this).parent().parent().after(inputField);
            j++;
        });
        $(document).on("click", ".remove-property-summary", function() {
            $(this).parent().parent().remove();
        });

        let p = <?=intval(count($nearby_place))?>;;
        $(".add-nearby-place").click(function() {
            var inputField = '<div class="input-group ">\
                <input type="text" class="form-control input-solid" placeholder="heading" name="nearby_place['+p+'][heading]">\
                <input type="text" class="form-control input-solid mx-1" placeholder="name" name="nearby_place['+p+'][name]">\
                <input type="text" class="form-control input-solid mx-1" placeholder="distance" name="nearby_place['+p+'][distance]">\
                <input type="text" class="form-control input-solid mx-1" placeholder="type" name="nearby_place['+p+'][type]">\
                <div class="input-group-append">\
                <button class="btn btn-sm btn-warning remove-nearby-place" type="button"><i class="la la-remove"></i></button>\
            </div>\
        </div>';
            $(this).parent().parent().after(inputField);
            p++;
        });
        $(document).on("click", ".remove-nearby-place", function() {
            $(this).parent().parent().remove();
        });


        $(document).ready(function() {
            $('.remove-image').on('click', function(e) {
                e.preventDefault();
                $(this).closest('.gallery-item').remove();
            });
        });


    });

</script>
<?= $this->endSection() ?>

<?= $this->section('style') ?>
<style>
    .remove-image {
        position: relative;
        left: 24px;
        top: 44px;
    }
</style>
<?= $this->endSection() ?>
