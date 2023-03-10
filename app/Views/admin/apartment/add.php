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
                    <div class="card-title">Add Apartment</div>
                </div>
                <form action="<?= base_url().route_to("admin/apartment/add") ?>" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="title" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Apartment City</label>
                                <select  name="city" class="form-control input-solid" required>
                                    <option value="">Select City</option>
                                    <?php foreach($city_list as $c): ?>
                                        <option value="<?=$c['id']?>"><?=$c['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Address</label>
                                <input type="text" name="address" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Price</label>
                                <input type="number" name="price" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Price Type</label>
                                <select  name="price_type" class="form-control input-solid" required>
                                    <option value="">Select Type</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Video </label>
                                <input type="file" name="video" accept="video/*" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Apartment Status</label>
                                <select  name="status" class="form-control input-solid" required>
                                    <option value="">Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="not available">Not, Available</option>
                                    <option value="booked">Booked</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Page Title</label>
                                <input type="text" name="page_title" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Gallery</label>
                                <input type="file" name="gallery[]" accept="image/*" aria-describedby="galleryHelp" class="form-control input-solid" required multiple>
                                <small id="galleryHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can select multiple images at once.</strong>
                                </small>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-input" type="button"><i class="la la-plus"></i></button> Apartment Specification </label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" placeholder="title" name="specification[0][title]"  >
                                    <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="specification[0][sub_title]" >
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-information" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-information" type="button"><i class="la la-plus"></i></button> More Information </label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" placeholder="title" name="more_information[0][title]">
                                    <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="more_information[0][sub_title]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-information" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-property-summary" type="button"><i class="la la-plus"></i></button> Property Summary </label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" placeholder="title" name="property_summary[0][title]">
                                    <input type="text" class="form-control input-solid mx-1" placeholder="sub title" name="property_summary[0][sub_title]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-property-summary" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input-field"> <button class="btn btn-sm btn-outline-primary add-nearby-place" type="button"><i class="la la-plus"></i></button> NearBy Places </label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-solid" placeholder="heading" name="nearby_place[0][heading]">
                                    <input type="text" class="form-control input-solid mx-1" placeholder="name" name="nearby_place[0][name]">
                                    <input type="text" class="form-control input-solid mx-1" placeholder="distance" name="nearby_place[0][distance]">
                                    <input type="text" class="form-control input-solid mx-1" placeholder="type" name="nearby_place[0][type]">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-warning remove-nearby-place" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="description" class="form-control input-solid" required></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Property Features</label>
                                <textarea name="property_features" class="form-control input-solid" aria-describedby="propertyFeaturesHelp" ></textarea>
                                <small id="propertyFeaturesHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can add multiple Property features by separating them with comma(,).</strong>
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tags</label>
                                <textarea name="tags" class="form-control input-solid" aria-describedby="tagsHelp" ></textarea>
                                <small id="tagsHelp" class="form-text text-muted text-dark">
                                    <strong>Note : You can add multiple tags by separating them with comma(,).</strong>
                                </small>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Page Title</label>
                                <input type="text" name="page_title" class="form-control input-solid" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Meta Keywords</label>
                                <textarea name="meta_keywords" class="form-control input-solid"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control input-solid"></textarea>
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
        let i = 1;
        $(".add-input").click(function() {
            var inputField = '<div class="input-group mb-3">\
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

        let k = 1;
        $(".add-information").click(function() {
            var inputField = '<div class="input-group mb-3">\
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

        let j = 1;
        $(".add-property-summary").click(function() {
            var inputField = '<div class="input-group mb-3">\
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

        let p = 1;
        $(".add-nearby-place").click(function() {
            var inputField = '<div class="input-group mb-3">\
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

    });

</script>
<?= $this->endSection() ?>
