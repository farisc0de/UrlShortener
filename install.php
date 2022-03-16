<?php
include_once './config/config.php';
include_once  APP_PATH . 'logic/installLogic.php';
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8" />
    <?php include_once 'components/header.php'; ?>
    <title><?= $st['website_name'] ?> - Url Shortener Service</title>
    <?php include_once 'components/css.php'; ?>
</head>

<body>
    <?php include_once 'components/navbar.php'; ?>

    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container pb-5 pt-5">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-12 col-md-8 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <b>UrlShortner</b>
                            </div>
                            <div class="card-body">
                                <div id="upload_alert">
                                    <?php if (isset($msg)) : ?>
                                        <div class="alert alert-success">
                                            <span class="fa fa-check-circle"></span>
                                            <?= $msg; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="card-title lead font-weight-bold text-dark">
                                    UrlShortner Installer
                                </p>
                                <form role="form" method="POST">
                                    <div class="p-4">
                                        <button name="submit" type="submit" class="btn btn-primary btn-lg">
                                            Run Installer
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                Developed By:
                                <a href="https://github.com/FarisCode511/">fariscode</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'components/footer.php'; ?>

    <?php include_once 'components/js.php'; ?>
</body>

</html>

</html>