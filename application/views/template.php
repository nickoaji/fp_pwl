<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PWL</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light">
    <a href="#" class="navbar-brand ml-5">
      <i class="fas fa-link"></i>URL Shortener
    </a>
    <div class="ml-auto mr-5">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="index.php/dashboard" class="nav-link">
            <button class="btn" id="our_dashboard_btn">Our Dashboard</button>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <section id="main">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div id="kontenTemplate" class="container">
          <a href="#" href="#" onclick="loadMenu('<?= base_url('guest') ?>')">Guest</a>
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function loadMenu(url) {
      $.ajax(url, {
        type: 'GET',
        success: function(data, status, xhr) {
          // parse object menjadi json
          var objData = JSON.parse(data);
          $('#kontenTemplate').html(objData.konten);
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
  </script>

</body>

</html>