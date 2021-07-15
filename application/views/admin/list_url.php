<div id="heading_title" class="text-center">
  <h1 id="heading">Cari Url</h1>
  <p id="title">Cari Url berdasarkan title</p>
</div>

<form>
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control form-input-cari" placeholder="Masukan Title" name="cari_title" id="cari_title">
    </div>
    <button type="submit" class="btn" id="btn_cari">Cari User</button>
  </div>
</form>

<hr />
<h4>Tabel Link</h4>
<div class="table-responsive">
  <table id="tabel_url" class="table table-bordered">
  </table>
</div>

<script type="text/javascript">
  function loadKonten(url) {
    $.ajax(url, {
      type: 'GET',
      success: function(data, status, xhr) {

        var objData = JSON.parse(data);
        $('#tabel_url').html(objData.konten);

      },
      error: function(jqXHR, textStatus, errorMsg) {
        alert('Error : ' + errorMsg);
      }
    })
  }
  loadKonten('<?php echo base_url(); ?>url/list_url');
  // cari_data
  $('#btn_cari').on('click', function(e) {
    e.preventDefault()
    var url = 'http://localhost/fp_pwl/url/cari_data';
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
        $('#tabel_url').html(objData.konten);

      },
      error: function(jqXHR, textStatus, errorMsg) {
        alert('Error : ' + errorMsg);
      }
    });
  });
</script>