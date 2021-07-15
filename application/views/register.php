<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Pendek.in</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
  <section id="main">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div id="kontenTemplate" class="container">
          <div id="heading_title" class="text-center">
            <h1 id="heading">Form Register</h1>
          </div>
          <form class="form-horizontal form-material" id="formRegister">
            <div class="form-group">
              <label for="email" class="col-md-12">Email</label>
              <div class="col-md-12">
                <input type="email" placeholder="Enter Your Email" class="form-user-input form-control form-control-line" name="email" id="email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="username" class="col-md-12">Username</label>
              <div class="col-md-12">
                <input type="text" placeholder="Enter Your Username" class="form-user-input form-control form-control-line" name="username" id="username" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                <input type="password" placeholder="Enter Your Password" class="form-user-input form-control form-control-line" name="password" id="password" required min="8" max="12">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button class="btn btn-success" id="reg">REGISTER</button>
              </div>
            </div>
            Sudah Punya Akun ? <a href="<?php echo base_url(); ?>login">Login</a>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    //insert data
    $('#reg').on('click', function(e) {
      e.preventDefault()
      var email = $('[name="email"]').val();
      var username = $('[name="username"]').val();
      var password = $('[name="password"]').val();

      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>login/cek_register",
        data: {
          email: email,
          username: username,
          password: password
        },
        success: function(data) {
          location.replace('login');
        }
      });
    });
  </script>
</body>

</html>