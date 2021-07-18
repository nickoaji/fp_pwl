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
            <h1 id="heading">Form Login</h1>
          </div>
          <form class="form-horizontal form-material" id="formLogin">

            <div class="form-group">
              <label for="username" class="col-md-12">Username</label>
              <div class="col-md-12">
                <input type="text" placeholder="Enter Your Username" class="form-user-input form-control form-control-line" name="username" id="username" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                <input type="password" placeholder="Enter Your Password" class="form-user-input form-control form-control-line" name="password" required min="8" max="12">
              </div>
            </div>



            <div class="form-group">
              <div class="col-sm-12">
                <button class="btn btn-success">LOGIN</button>
              </div>
            </div>
            Belum Punya Akun ? <a href="<?php echo base_url(); ?>register">Register</a>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $("#formLogin").on('submit', function(e) {
      e.preventDefault();
      checkLogin();
    });

    function checkLogin() {
      var link = "<?php echo base_url(); ?>login/cek_login";
      var dataForm = {};
      var allInput = $('.form-user-input');

      $.each(allInput, function(i, val) {
        dataForm[val['name']] = val['value'];
      });
      $.ajax(link, {
        type: 'POST',
        data: dataForm,
        success: function(data, status, xhr) {
          console.log(data);
          var data_str = JSON.parse(data);
          console.log(data_str);
          alert(data_str['pesan']);
          if (data_str['sukses'] == 'Ya') {
            setSession(data_str['user']);
          }
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error: ' + errorMsg);
        }
      });
    }

    function setSession(user) {
      var link = "<?php echo base_url(); ?>login/setSession";
      var dataForm = {};
      dataForm['id_user'] = user['id'];
      dataForm['uname_user'] = user['username'];
      dataForm['role_id'] = user['role_id'];

      $.ajax(link, {
        type: 'POST',
        data: dataForm,
        success: function(data, status, xhr) {
          location.replace('<?php echo base_url(); ?>');
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error: ' + errorMsg);
        }
      });
    }
  </script>
</body>

</html>