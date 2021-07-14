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
          <a href="<?php echo base_url(); ?>login" class="nav-link">
            <button class="btn" id="our_dashboard_btn">Login</button>

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
            <p id="title">Search your URL by title.</p>
          </div>

          <form>
            <div class="form-row">
              <div class="col">
                <input type="text" class="form-control form-input-cari" placeholder="Enter Title" name="cari_title" id="cari_title">
              </div>
              <button type="submit" class="btn" id="btn_cari">Cari Link</button>
            </div>
          </form>
          <hr />
          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">Add Short Link</button>
          <hr />
          <h4>Dibawah Ini Adalah Data Guest URL</h4>
          <div class="table-responsive">
            <table id="guest_url" class="table table-bordered">
            </table>
          </div>

          <!-- insert data -->
          <div class="modal fade save" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h3>Masukkan Data Url</h3>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="ttl">Title</label>
                      <input type="text" class="form-control" name="ttl" id="ttl" placeholder="Masukkan title" required autofocus>

                    </div>
                    <div class="form-group">
                      <label for="url">Url</label>
                      <input type="url" class="form-control" id="url" placeholder="Masukkan URL" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary" id="save">Tambah</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end insert data -->
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

          var objData = JSON.parse(data);
          $('#guest_url').html(objData.konten);

        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
    loadKonten('<?php echo base_url(); ?>guest/list_guest');
    //insert data
    $('#save').on('click', function(e) {
      e.preventDefault()
      var ttl = $('#ttl').val();
      var url = $('#url').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>guest/save",
        data: {
          ttl: ttl,
          url: url
        },
        success: function(data) {
          $('#ttl').val('');
          $('#url').val('');
          $('.modal').modal('hide');
          loadKonten('<?php echo base_url(); ?>guest/list_guest');
        }
      });
    });

    // cari_data
    $('#btn_cari').on('click', function(e) {
      e.preventDefault()
      var url = 'http://localhost/fp_pwl/guest/cari_data';
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

        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    });
  </script>

</body>

</html>