<div id="heading_title" class="text-center">
  <h1 id="heading">Cari User</h1>
  <p id="title">Cari User berdasarkan username</p>
</div>

<form>
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control form-input-cari" placeholder="Masukan Username" name="cari_username" id="cari_username">
    </div>
    <button type="submit" class="btn" id="btn_cari">Cari User</button>
  </div>
</form>

<hr />
<h4>Tabel Link</h4>
<div class="table-responsive">
  <table id="tabel_user" class="table table-bordered">
  </table>
</div>

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Hapus User</h4>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="id_user" id="id_user" value="">
          <div class="alert alert-danger">
            <p>Apakah Anda yakin ingin menghapus User ini?</p>
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


<script type="text/javascript">
  function loadKonten(url) {
    $.ajax(url, {
      type: 'GET',
      success: function(data, status, xhr) {
        var objData = JSON.parse(data);
        $('#tabel_user').html(objData.konten);

      },
      error: function(jqXHR, textStatus, errorMsg) {
        alert('Error : ' + errorMsg);
      }
    })
  }
  loadKonten('http://localhost/fp_pwl/users/list_user');
  // cari_data
  $('#btn_cari').on('click', function(e) {
    e.preventDefault()
    var url = 'http://localhost/fp_pwl/users/cari_data';
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
        $('#tabel_user').html(objData.konten);

      },
      error: function(jqXHR, textStatus, errorMsg) {
        alert('Error : ' + errorMsg);
      }
    });
  });
  //GET delete
  $('#tabel_user').on('click', '.linkHapusUser', function() {
    var id_user = $(this).attr('data');
    $('#ModalHapus').modal('show');
    $('[name="id_user"]').val(id_user);
  });
  //Hapus
  $('#btn_hapus').on('click', function(e) {
    e.preventDefault();
    var id_user = $('#id_user').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>users/delete",
      data: {
        id_user: id_user
      },
      success: function(data) {
        $('#ModalHapus').modal('hide');
        loadKonten('<?php echo base_url(); ?>users/list_user');
      }
    });
  });
</script>