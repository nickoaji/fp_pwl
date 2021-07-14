<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendek.in</title>
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
          <a href="<?php echo base_url(); ?>logout" class="nav-link">
            <button class="btn" id="our_dashboard_btn">Logout</button>

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
                <input type="text" class="form-control form-input-cari" placeholder="Enter Title" name="cari_title" id="cari_title">
              </div>
              <div class="col">
                <input type="text" class="form-control form-input-cari" placeholder="Enter Short Url" name="cari_url" id="cari_url">
              </div>
              <button type="submit" class="btn" id="btn_cari">Cari Link</button>
            </div>
          </form>
          <br />
          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">Add Short Link</button>

          <hr />
          <h4>Tabel Link</h4>
          <div class="table-responsive">
            <table id="user_url" class="table table-bordered">
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
        <!--MODAL Update-->
        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Url</h4>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="hash">Short Url</label>
                    <label for="hash">http://localhost/fp_web/</label>
                    <input type="text" class="form-control" name="hash" id="hash" placeholder="Masukkan short url" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan title" required autofocus>
                    <input type="hidden" id="original_link" name="original_link">
                  </div>
                  <button type="submit" class="btn btn-primary" id="update">Edit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal Update -->
        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Hapus Link</h4>
              </div>
              <form class="form-horizontal">
                <div class="modal-body">
                  <input type="hidden" name="hash" id="hash" value="">
                  <div class="alert alert-danger">
                    <p>Apakah Anda yakin ingin menghapus link ini?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end modal hapus -->
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
          $('#user_url').html(objData.konten);

        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      })
    }
    loadKonten('<?php echo base_url(); ?>user/list_url');



    function hapusData(hash) {

      var url = 'http://localhost/fp_pwl/user/delete?hash=' + hash;


      $.ajax(url, {
        type: 'GET',
        success: function(data, status, xhr) {
          location.replace('<?php echo base_url(); ?>');
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    }
    //GET update
    $('#user_url').on('click', '.linkEditUrl', function() {
      var hash = $(this).attr('data');
      $.ajax({
        type: "GET",
        url: "<?php echo base_url() ?>/user/get_update",
        dataType: "JSON",
        data: {
          hash: hash
        },
        success: function(data) {
          $.each(data, function(hash, title) {
            $('#modal_update').modal('show');
            $('[name="hash"]').val(data.hash);
            $('[name="title"]').val(data.title);
            $('#original_link').val(data.original_link);
          });
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    });
    //update data
    $(document).on('click', '#update', function(e) {
      e.preventDefault()
      var hash = $('[name="hash"]').val();
      var title = $('[name="title"]').val();
      var original_link = $('[name="original_link"]').val();

      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>user/update",
        data: {
          hash: hash,
          title: title,
          original_link: original_link
        },
        success: function(data) {
          $('.modal').modal('hide');
          loadKonten('<?php echo base_url(); ?>user/list_url');
        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    });
    //insert data
    $('#save').on('click', function(e) {
      e.preventDefault()
      var ttl = $('#ttl').val();
      var url = $('#url').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>user/save",
        data: {
          ttl: ttl,
          url: url
        },
        success: function(data) {
          $('#ttl').val('');
          $('#url').val('');
          $('.modal').modal('hide');
          loadKonten('<?php echo base_url(); ?>user/list_url');
        }
      });
    });
    // cari_data
    $('#btn_cari').on('click', function(e) {
      e.preventDefault()
      var url = 'http://localhost/fp_pwl/user/cari_data';
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
          $('#user_url').html(objData.konten);

        },
        error: function(jqXHR, textStatus, errorMsg) {
          alert('Error : ' + errorMsg);
        }
      });
    });
    //GET delete
    $('#user_url').on('click', '.linkHapusUrl', function() {
      var hash = $(this).attr('data');
      $('#ModalHapus').modal('show');
      $('[name="hash"]').val(hash);
    });
    //Hapus
    $('#btn_hapus').on('click', function(e) {
      e.preventDefault();
      var hash = $('#hash').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>user/delete",
        data: {
          hash: hash
        },
        success: function(data) {
          $('#ModalHapus').modal('hide');
          loadKonten('<?php echo base_url(); ?>user/list_url');
        }
      });
    });
  </script>

</body>

</html>