<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manajemen Laporan Survei</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Hasil Laporan Survei</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <!-- Content Title -->
          <div class="box-header">
            <button class="btn btn-flat btn-default" onclick="reload_table_Survei()"><i class="glyphicon glyphicon-refresh"></i> Muat Ulang</button>
            <!-- <button type="button" onclick="add_survei()" class="btn btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Laporan Survei</button> -->
          </div>

          <div class="box-body">
            <!-- Content  -->
            <div class="row">
              <div class="col-md-12 table-responsive">
                <table id="surveiTable" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Survei</th>
                      <th>Lokasi Survei</th>
                      <th>Nomor Surat Tugas</th>
                      <th>Detail Survei</th>
                      <th>Tanggal Melaporkan</th>
                      <th>Pelaku Survei</th>
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
    <div class="modal fade" id="modal_AddSurvei" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Form Survei </h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Lokasi Kegiatan Survei </label>
                    <select name="survei_pos" class="form-control">
                        <option>-- Pilih Lokasi --</option>
                        <?php foreach($poss as $pos): ?>
                          <option value="<?= $pos->KODE_DATA ?>"><?= $pos->KODE_VALUE ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Nomor Surat Tugas</label>
                    <input type="text" name="survei_lampiran" placeholder="Lampiran Surat Tugas" class="form-control">
                    <span class="help-block"></span>
                  </div>

            
                  <div class="form-group">
                    <label class="control-label">Tanggal pelaksanaan Survei</label>
                    <input type="text" name="survei_tanggal" id="survei_tanggal" value="2019/12/01" class="form-control "/>
                    <span class="help-block"></span>
                  </div>

                  <div class="form-group" hidden="true">
                    <label class="control-label">id</label>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id') ?>" />
                    <input type="text" name="survei_id" placeholder="Lampiran Surat Tugas" class="form-control">
                    <span class="help-block"></span>
                  </div>
                </div>

                <div class="col-md-6">
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_survei()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

  </section>
</div>

<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
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
          tableSurvei = $('#surveiTable').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "responsive": true,
            "autoWidth" : true,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
              "url": "<?= site_url('report/ajax_list')?>",
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
$(function() {
  $('#survei_tanggal').datepicker({
    dateFormat: 'yy-mm-dd'
    
  });
});
</script>


<script>

function reload_table_Survei(){
        tableSurvei.ajax.reload(null,false); //reload datatable ajax 
}

function add_survei(){
  save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_AddSurvei').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Laporan Survei'); // Set Title to Bootstrap modal title
}

function delete_survei(id){
      if(confirm('Yakin ingin menghapus laporan ini ??')){
          // ajax delete data to database
          $.ajax({
            url : "<?= site_url('survei/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
            //if success -> reload ajax table
            $('#modal_form').modal('hide');
            reload_table_Survei();
          }, error: function (jqXHR, textStatus, errorThrown){
            alert('Error deleting data');
          }
        });
        }
}

function report_survei(id){
      if(confirm('Yakin ingin mengajukan laporan ini ??')){
          // ajax delete data to database
          $.ajax({
            url : "<?= site_url('survei/ajax_report')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
            //if success -> reload ajax table
            $('#modal_form').modal('hide');
            reload_table_Survei();
          }, error: function (jqXHR, textStatus, errorThrown){
            alert('Error reporting data');
          }
        });
        }
}

function save_survei(){
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        //$('#form').append('<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id') ?>" />');
        var url;

        if(save_method == 'add') {
          url = "<?php echo site_url('survei/ajax_add')?>";
        } else {
          url = "<?php echo site_url('survei/ajax_update')?>";
        }

        // ajax adding data to database
        $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data){
            if(data.status){ //if success close modal and reload ajax table
              $('#modal_AddSurvei').modal('hide');
              reload_table_Survei();
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



function edit_survei(id){
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
          url : "<?php echo site_url('survei/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            $('[name="survei_id"]').val(data.survey_id);
            $('[name="survei_pos"]').val(data.survey_pos);
            $('[name="survei_lampiran"]').val(data.survey_attachment);
            $('[name="survei_tanggal"]').val(data.survey_tgl);
            $('#modal_AddSurvei').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Laporan Survei'); // Set title to Bootstrap modal title
          },error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
          }
        });
      }



</script>