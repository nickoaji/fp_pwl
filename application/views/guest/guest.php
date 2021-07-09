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
            <a href="<?php echo base_url(); ?>login"><button class="btn" id="our_dashboard_btn">Login</button></a>

          </a>
        </li>
      </ul>
    </div>
  </nav>
  <section id="main">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div id="kontenTemplate" class="container">

          <div id="heading_title" class="text-center">
            <h1 id="heading">Search your URL</h1>
            <p id="title">Search your URL by title or short url which you have remember.</p>
          </div>

          <form>
            <div class="form-row">
              <div class="col">
                <input type="text" class="form-control form-input-cari" placeholder="Enter Title" name="cari_title">
              </div>
              <div class="col">
                <input type="text" class="form-control form-input-cari" placeholder="Enter Original Url" name="cari_url">
              </div>
              <button class="btn" id="btn_cari">Cari Link</button>
            </div>
          </form>
          <br />
          <a href="<?php echo base_url(); ?>guest/form_create"><button class="btn" id="btn_create">Create Short Link</button></a>
          <hr />
          <h4>Dibawah Ini Adalah Data Guest URL</h4>
          <table id="guest_url" class="table">
          </table>
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function loadKonten(url) {
      $.ajax(url, {
        type: 'GET',
        success: function(data, status, xhr) {
          // parse object menjadi json
          var objData = JSON.parse(data);
          $('#guest_url').html(objData.konten);
          reload_event();
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
    loadKonten('<?php echo base_url(); ?>guest/list_guest');

    function reload_event() {
      $('#btn_cari').on('click', function() {
        cariData();
      });
    }

    function cariData() {
      var url = 'http://localhost/fp_pwl/guest/cari_guest';
      var dataForm = {};
      var allInput = $('.form-input-cari');
      $.each(allInput, function(i, val) {
        dataForm[val['name']] = val['value'];
      });
      $.ajax(url, {
        type: 'POST',
        data: dataForm,
        success: function(data, status, xhr) {
          var objData = JSON.parse(data);
          $('#guest_url').html(objData.konten);
          reload_event();
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
  </script>

</body>

</html>