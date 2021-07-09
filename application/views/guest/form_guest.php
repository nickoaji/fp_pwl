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
          <div id="heading_title" class="text-center">
            <h1 id="heading">Shorten Any Links</h1>
            <p id="title">Build and protect your brands using powerful and <br> recognizable short links.</p>
          </div>

          <form class="form-horizontal form-material" id="formGuest">

            <div class="form-group">
              <label class="col-md-12">Title</label>
              <div class="col-md-12">
                <input type="text" placeholder="Enter Link Title" class="form-user-input form-control form-control-line" name="title" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">URL</label>
              <div class="col-md-12">
                <input type="url" placeholder="Enter Or Paste Your Link" class="form-user-input form-control form-control-line" name="url" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">

                <button class="btn" id="btn_shortener">Shorten Link</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#formGuest').on('submit', function(e) {
      e.preventDefault();
      sendDataPost();
    });

    function sendDataPost() {

      var link = '<?php echo base_url(); ?>guest/create_action';
      var dataForm = {};
      var allInput = $('.form-user-input');
      $.each(allInput, function(i, val) {
        dataForm[val['name']] = val['value'];
      });

      $.ajax(link, {
        type: 'POST',
        data: dataForm,
        success: function(data, status, xhr) {
          var data_str = JSON.parse(data);

          location.replace('<?php echo base_url(); ?>guest');
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    }
  </script>

</body>

</html>