

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Detail Laporan Survei</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Detail Laporan Survei</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <!-- Content Title -->
          <div class="box-header">
            <h4>Wilayah Survei : <?php echo $wilayah_survey ?></h4>
            <h4>Tanggal Survei : <?php echo $tanggal_survey ?></h4>
            <h4>Nomor Surat Tugas : <?php echo $lampiran_survey ?></h4>
            <h4>Terupdate Terakhir kali : <?php echo $last_edit_survey ?></h4>
          </div>
          <div class="box-header">
            <button class="btn btn-flat btn-default" onclick="reload_table_SurveiData()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
            <?php if($status_survey != "1") : ?>
            <button type="button" onclick="add_surveiData()" class="btn btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data Survei</button>
            <?php endif; ?>
          </div>

          <div class="box-body">
            <!-- Content  -->
            <div class="row">
              <div class="col-md-12 table-responsive">
                <table id="surveiDataTable" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode NJKB</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Type</th>
                      <th>Tahun</th>
                      <th>Harga</th>
                      <th>Lokasi</th>
                      <th>Lampiran</th>
                      <th class="actions"></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </div>

    <!-- Modal for Mapel -->
    <div class="modal fade" id="modal_AddSurveiData" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Survei Data Form</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form">
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <label class="form-group" for="Jenis Kelamin">Jenis</label>
                    <select name="survey_data_jenis" class="form-control" id="jenis_kendaraan">
                      <option disabled>-- Pilih Jenis Kendaraan --</option>
                      <?php foreach($jenis as $j): ?>
                        <option value="<?= $j->KODE_DATA ?>"><?= $j->KODE_VALUE ?></option>
                      <?php endforeach ?>
                    </select>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group">
                    <label class="form-group">Merek</label>
                    <select name="survey_data_merek" class="form-control" id="merek_kendaraan">
                      <option disabled>-- Pilih Merek --</option>
                      <?php foreach($merek as $m): ?>
                        <option value="<?= $m->KODE_VALUE ?>"><?= $m->KODE_VALUE ?></option>
                      <?php endforeach ?>
                    </select>
                    <span class="help-block"></span>
                  </div>


                  <div class="form-group">
                    <label class="form-group">Tipe</label>
                    <input id="type-autocomplete" name="survey_data_type"  class="form-control" type="text" autofocus>
                    <span class="help-block"></span>
                  </div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label class="control-label">Kode NJKB</label>
                    <input name="survey_data_kode_kendaraan" placeholder="Kode NJKB" class="form-control" type="text" id="kode_njkb_kendaraan" autofocus>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tahun Kendaraan</label>
                    <input name="survey_data_tahun" placeholder="Tahun Kendaraan" class="form-control" type="text" id="tahun_kendaraan" autofocus>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Harga Kendaraan (Rp)</label>
                    <input name="survey_data_harga" placeholder="Harga Kendaraan (dalam Rupiah)" class="form-control" type="text" id="harga_kendaraan" autofocus>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Lampiran</label>
                    <input name="survey_data_lampiran" placeholder="Lampiran" class="form-control" type="text" autofocus>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group" hidden="true">
                    <input type="hidden" name="survey_data_id">
                    <input type="hidden" name="survey_id" value = <?= $data_id ?>>
                    <span class="help-block"></span>
                  </div>

                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_surveiData()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

  </section>
</div>
    
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets/plugins/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?= base_url() ?>assets/js/sweetalert.min.js"></script>

    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/app.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pace/pace.min.js"></script>



<script type="text/javascript">
let tableSurveiData;
$(document).ready(function() {
  $(function(){
            tableSurveiData = $('#surveiDataTable').DataTable({
              "processing": true, //Feature control the processing indicator.
              "serverSide": true, //Feature control DataTables' server-side processing mode.
              "responsive": true,
              "autoWidth" : true,
              "order": [], //Initial no order.

              // Load data for the table's content from an Ajax source
              "ajax": {
                "url": "<?= site_url('surveidata/ajax_list/'.$data_id)?>",
                "type": "POST"
              },

              //Set column definition initialisation properties.
              "columnDefs": [{ 
                  "targets": [ -1 ], //last column
                  "orderable": false //set not orderable
                },
                ],
              });

            //set input/textarea/select event when change value, remove class error and remove text help block 
            $("input").change(function(){
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
            });
          }); 
  });
</script>



<script>
function reload_table_SurveiData(){
        tableSurveiData.ajax.reload(null,false); //reload datatable ajax 
}

function add_surveiData(){
  save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_AddSurveiData').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Data Survei'); // Set Title to Bootstrap modal title
}


function save_surveiData(){
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        if(save_method == 'add') {
          url = "<?php echo site_url('surveiData/ajax_add')?>";
        } else {
          url = "<?php echo site_url('surveiData/ajax_update')?>";
        }

        // ajax adding data to database
        $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data){
            if(data.status){ //if success close modal and reload ajax table
              $('#modal_AddSurveiData').modal('hide');
              reload_table_SurveiData();
            }
            else{
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
                }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
          }
        });
}


function delete_surveidata(id){
      if(confirm('Yakin ingin menghapus data ini ??')){
          // ajax delete data to database
          $.ajax({
            url : "<?= site_url('surveidata/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
            //if success -> reload ajax table
            $('#modal_form').modal('hide');
            reload_table_SurveiData();
          }, error: function (jqXHR, textStatus, errorThrown){
            alert('Error deleting data');
          }
        });
        }
}


function edit_surveidata(id){
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
          url : "<?php echo site_url('surveidata/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            $('[name="survey_data_id"]').val(data.SURVEY_DATA_ID);
            $('[name="survey_data_jenis"]').val(data.KODE_DATA);
            $('[name="survey_data_merek"]').val(data.SURVEY_DATA_MEREK);
            $('[name="survey_data_type"]').val(data.SURVEY_DATA_TYPE);
            $('#kode_njkb_kendaraan').val(data.SURVEY_DATA_KODE_KENDARAAN);
            $('[name="survey_data_harga"]').val(data.SURVEY_DATA_HARGA.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            $('[name="survey_data_tahun"]').val(data.SURVEY_DATA_TAHUN);
            $('[name="survey_data_lampiran"]').val(data.SURVEY_DATA_LAMPIRAN);
            $('#modal_AddSurveiData').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Survei'); // Set title to Bootstrap modal title
          },error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
          }
        });
      }
</script>


<script type="text/javascript">

$(document).ready(function() {
  // $( "#type-autocomplete" ).autocomplete({
  //     source: availableTags
  //   });

  $( '#harga_kendaraan' ).mask('0.000.000.000', {reverse: true});

  $( "#type-autocomplete" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>surveidata/njkb_list",
            type: 'post',
            dataType: "json",
            data: {
              "jenis":  $("#jenis_kendaraan").val(),
              "merek": $("#merek_kendaraan").val(),
              "key": $("#type-autocomplete").val()
            },
            success: function( datas ) {
              response( datas );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#type-autocomplete').val(ui.item.label); // display the selected text
          $('#kode_njkb_kendaraan').val(ui.item.value); // save selected id to input
          return false;
        }
      });
});





</script>

<style type="text/css">
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item a.ui-state-focus {
  position: absolute;
  background-color: #faa;
}
</style>