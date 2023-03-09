<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Tesla Property C-PANEL</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <link rel="stylesheet" href="<?= base_url("backend/css/bootstrap.min.css") ?>">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url("backend/css/ready.css") ?>">
    <link rel="stylesheet" href="<?= base_url("backend/css/demo.css") ?>">
</head>
<style>
    .footer {
        position: absolute;
        bottom: 5px;
        width: 100%
    }
</style>
<body style="background:url('https://unicoderbd.com/theme/html/uniland/fullwidth/assets/images/slider/6.png');filter: drop-shadow(10px 12px 17px brown);">
<div class="wrapper">

        <div class="content ">
        <div class="container-fluid row d-flex justify-content-center align-items-center">
            <!--start main content-->
            <div class="col-md-6 mt-4">
                <div class="card bg-light" style="border-radius: 20px">
                    <div class="card-header" >
                        <div class="card-title d-flex justify-content-center align-items-center text-warning"><i class="la la-user-secret la-2x"></i> CPanel Login</div>
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
                        <form action="<?= base_url(route_to("admin/login")) ?>" method="post">
                            <?=csrf_field()?>
                            <div class="form-group">
                                <label for="squareInput" class="text-warning"> <i class="la la-user"></i> Email Address </label>
                                <input type="text" name="email" class="form-control input-square" placeholder="Enter registered email" required>
                            </div>
                            <div class="form-group">
                                <label for="squareInput" class="text-warning"> <i class="la la-lock"></i> Password </label>
                                <input type="password" minlength="6" name="password" class="form-control input-square" placeholder="Enter your password" required>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-warning btn-block"><strong>  Log In</strong></button>
                            </div>
                        </form>
                </div>

            </div>
            <!--end main content-->
        </div>

        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <img src="https://unicoderbd.com/theme/html/uniland/fullwidth/assets/images/logo/logo1.png" width="150" class="img-fluid">
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2023, made with <i class="la la-heart heart text-danger"></i> by <a href="https://www.globalheight.com" class="text-warning"><strong>Global Height</strong></a>
                </div>
            </div>
        </footer>
    </div>

</div>

</body>
</body>
<script src="<?= base_url("backend/js/core/jquery.3.2.1.min.js") ?>"></script>
<script>
    /*$(document).ready(function(){
        $("#searchInput").on("keyup", function(){
            let text = $(this).val();
            let tableName = $("#tableName").val();
            let url = "<?php echo base_url()."/admin/search-engine/"?>"+tableName+"/"+text;
            if (text !== "") {
                $.ajax({
                    url: url,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        $("#countrylist").html(data);
                        $("#countrylist").fadeIn();
                    },
                    error: function () {
                        console.warn("frontend ajax errors");
                    }
                });
            }else {
                $("#countrylist").fadeOut();
            }


        });
    })*/
</script>
<script src="<?= base_url("backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>"></script>

<script src="<?= base_url("backend/js/core/popper.min.js") ?>"></script>
<script src="<?= base_url("backend/js/core/bootstrap.min.js") ?>"></script>

<script src="<?= base_url("backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js") ?>"> </script>
<script src="<?= base_url("backend/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js") ?>"></script>
<script src="<?= base_url("backend/js/plugin/jquery-mapael/jquery.mapael.min.js") ?>"></script>
<script src="<?= base_url("backend/js/plugin/jquery-mapael/maps/world_countries.min.js") ?>"></script>


<script src="<?= base_url("backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") ?>"> </script>
<script src="<?= base_url("backend/js/ready.min.js") ?>"></script>
<script src="<?= base_url("backend/js/demo.js") ?>"</script>
</html>
