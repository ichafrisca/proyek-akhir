<html>
	<head>
		<title>Kepegawaian ELFAST</title>
		<link href="<?php echo base_url(); ?>assets/foundation/css/foundation.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>assets/foundation/css/normalize.css" rel="stylesheet" type="text/css">
	</head>

<body>		   
 <!-- Header and Nav -->
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <!-- TITLE AREA -->
      <li class="name">
        <h1>
          <a href="#">
            ADMIN ELFAST
          </a>
        </h1>
      </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

    <!-- MENU DATA PEGAWAI -->
    <section class="top-bar-section">
        <!-- Left Nav Section -->
      
      <ul class="left">
          <li class="divider"></li>
              <li><a href="<?php echo base_url()?>c_dtpegawai/page">Data Pegawai</a></li>
          <li class="divider"></li>

          <!-- MENU JADWAL PEGAWAI -->
          <li class="has-dropdown">
            <a href="<?php echo base_url()?>c_jadwal/disp">Jadwal Pegawai</a>
            <ul class="dropdown">
              <li>
                <a href="<?php echo base_url()?>c_jadwal/grammar">Grammar</a>
              </li>

              <!-- SPEAKING PROGRAM -->
              <li>
                <a href="<?php echo base_url()?>c_jadwal/speaking">Speaking</a>
              </li>

              <!-- PRONUNCIATION PROGRAM -->
              <li>
                <a href="<?php echo base_url()?>c_jadwal/pronun">Pronunciation</a>
              </li>

              <!-- VOCABULARY PROGRAM -->
              <li>
                <a href="<?php echo base_url()?>c_jadwal/vocab">Vocabulary</a>
              </li>

              <!-- TOEFL PROGRAM-->
              <li>
                <a href="<?php echo base_url()?>c_jadwal/toefl">TOEFL</a>
              </li>

              <!-- PAKET PROGRAM-->
              <li>
                <a href="<?php echo base_url()?>c_jadwal/efast">E-fast & Scoring TOEFL</a>
              </li>

              <!-- PEGAWAI OFFICE SHIFT PAGI -->
              <li><a href="<?php echo base_url()?>c_jadwal/ofpagi">Office Shift Pagi</a></li>
              <li><a href="<?php echo base_url()?>c_jadwal/ofsiang">Office Shift Siang</a></li>
            </ul>
          </li>

          <!-- MENU PRESENSI-->
          <li class="divider"></li>
            <li>
              <a href="<?php echo base_url()?>c_absen/disp">Presensi Pegawai</a>
            </li>
      
          <!-- GAJI PEGAWAI -->
          <li class="divider"></li>
            <li>
              <a href="<?php echo base_url()?>c_gaji/disp">Gaji Pegawai</a>
            </li>
          <li class="divider"></li>
            <li>
              <a href="<?php echo base_url()?>c_sms/disp">SMS</a>
            </li>
          <li class="divider"></li>
           <!--  <li><a href="#">Detail Gaji</a></li> -->
      </ul>

      <!-- RIGHT POSITION -->
      <ul class="right">
        <li class="divider"></li>
        <li><a href="<?php echo base_url();?>c_login/logout">Logout</a></li>
      </ul>
    </section>
</nav>
<br><br><br>

  <!-- PEGAWAI -->
  <div class="row">
  <div class="large-12 panel">
  <?php
  foreach ($queryjadwal->result_array() as $row){
    echo form_open('c_jadwal/edit_office');
      echo '<center><h3>Form Tambah Office</h3></center>
        <div class="row">
          <div class="large-12 columns">
            <tr>
              <td>'.form_hidden('idjadwal',$row['idjadwal']).'</td>
            </tr>
          </div>
        </div>
        <div class="row">
          <div class="large-12 columns">
            <tr>
              <td>Tanggal</td>
              <td>:</td>
              <td>'.form_input('tanggal',$row['tanggal'], 'id="datepicker"').'</td>
            </tr>
          </div>
        </div>
        <div class="row">
          <div class="large-12 columns">
            <tr>
              <td>Shift</td>
              '.form_hidden('jam',$row['jam']);
                    $dropdown_shift = array(
                      "-"     => "- Pilih Shift -",
                      "Pagi"  => "Pagi",
                      "Siang" => "Siang"
                    );
                    echo '<td width="150" height="25">:'.form_dropdown('jam', $dropdown_shift, $row['jam']).'
                  </td>'.'
            </tr>
          </div>
        </div>
        <br>
      <label>
        <input type="submit" value="Save" class="button radius expand">
      </label>
      <label>
        <a href='. base_url() .'c_jadwal/disp class="button radius expand">Back</a>
      </label>';
      echo form_close();
    }
    ?>
    <?php if (isset($validation_errors)) echo $validation_errors;?>
    </div>
  </div>

		<!-- javascript foundation -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/foundation/js/vendor/modernizr.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/foundation/js/vendor/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/foundation/js/foundation.min.js"></script>  
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/foundation/js/foundation/foundation.abide.js"></script>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.4.custom/development-bundle/themes/smoothness/jquery-ui.css">
  <script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
  <script src="<?php echo base_url(); ?>assets/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
  <script src="<?php echo base_url(); ?>assets/jquery.ui.datepicker.validation.min.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">  

  <script type="text/javascript">
		$(document).foundation();
	</script>
  <script>
    $(function() {
      $( "#datepicker" ).datepicker(
        {
          changeMonth: 'true',
          changeYear: 'true',
          dateFormat:'yy-mm-dd', 
          showAnim: 'slideDown',
          minDate: 0
        }
      );
    });
  </script>
	</body>
</html>