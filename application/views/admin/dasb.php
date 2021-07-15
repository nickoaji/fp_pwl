<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">DASHBOARD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="loadMenu('<?= base_url('users') ?>')">USERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="loadMenu('<?= base_url('url') ?>')">URL</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="<?php echo base_url(); ?>logout" class="nav-link"><span class="fas fa-sign-out-alt"></span> Logout</a></li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
    <h3 class="page-title">Selamat Datang di Dashboard Admin</h3>
  </div>

  <div class="container" id="kontenTemplate">
    Ini Adalah Dashboard Admin
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function loadMenu(url) {
      $.ajax(url, {
        type: 'GET',
        success: function(data, status, xhr) {
          var objData = JSON.parse(data);
          $('#kontenTemplate').html(objData.konten);
          $('.page-title').html(objData.titel);
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
  </script>
</body>

</html>