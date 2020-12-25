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
                <b>Unlock Url</b>
              </div>
              <div class="card-body">
                <div id="upload_alert">
                  <?php if (isset($msg)) : ?>
                    <div class="alert alert-danger">
                      <span class="fa fa-times-circle"></span> <?= $msg; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <p class="card-title lead font-weight-bold text-dark">
                  Write password to unlock url
                </p>
                <form role="form" method="POST">
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" />
                  </div>
                  <button name="submit" type="submit" class="btn btn-primary">
                    <span class="fa fa-lock"></span> Unlock Url
                  </button>
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