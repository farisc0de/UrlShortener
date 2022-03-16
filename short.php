<?php
include_once 'config/config.php';
include_once APP_PATH . 'loader.php';
include_once APP_PATH  . 'logic/shortLogic.php';
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
  <meta charset="UTF-8" />
  <?php include_once 'components/header.php'; ?>
  <title>
    <?= $st['website_name'] ?> - Url Shortener Service
  </title>
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
                <b>Short your url</b>
              </div>
              <div class="card-body">
                <div id="upload_alert">
                  <?php if (isset($err)) : ?>
                    <div class="alert alert-danger">
                      <span class="fa fa-time-circle"></span> <?= $err; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <p class="card-title lead font-weight-bold text-dark">
                  Your short url
                </p>
                <form role="form" method="POST" action="short.php">
                  <div class="form-group" id="dvFile">
                    <input type="text" class="form-control" placeholder="Short URL" name="link" value="<?= $shortURL; ?>" />
                  </div>
                  <a type="button" class="btn btn-primary" href="<?= $utils->siteUrl() ?>">
                    <span class="fa fa-home"></span> Go home
                  </a>
                </form>
              </div>
              <div class="card-footer">
                Developed By: <a href="https://github.com/FarisCode511/">fariscode</a>
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