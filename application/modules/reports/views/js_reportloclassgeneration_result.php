<!-- START: Template JS-->
<script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="<?php echo base_url();?>assets/dist/js/app.js"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>assets/dist/vendors/select2/js/select2.full.min.js"></script>
<!-- END: Page Vendor JS-->


<!-- Sweet Alert & Form Validation JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url()?>assets/dist/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url()?>assets/dist/vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/vendors/morris/morris.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- Script bs-custom-file-input -->
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<!-- Script dataTables -->
<script type="text/javascript">
  $(function () {
    $("#data").DataTable({
		 "language": {
            "lengthMenu": "<?php echo lang('display');?> _MENU_ <?php echo lang('records_per_page');?>",
            "zeroRecords": "<?php echo lang('zeroRecords');?>",
            "info": "<?php echo lang('showing_page');?> _PAGE_ <?php echo lang('showing_page_of');?> _PAGES_",
            "infoEmpty": "<?php echo lang('infoEmpty');?>",
            "infoFiltered": "(<?php echo lang('infoFiltered_form');?> _MAX_ <?php echo lang('infoFiltered_record');?>)",
			"search": "<?php echo lang('search');?>:",
			"paginate": {
				  "previous": "<?php echo lang('previous');?>",
				  "next": "<?php echo lang('next');?>",
				}
		 }	
	});
  });
</script>

<!--Initialize Select2 Elements -->
<script type="text/javascript">
(function ($) {
    "use strict";
   $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
})(jQuery);
</script>

<!-- Script Chart Bar -->
<script type="text/javascript">
(function ($) {
    "use strict";
	var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
	
	if ($('#lo-bar').length > 0)
    {
        Morris.Bar({
            element: 'lo-bar',
            data: [
              <?php
              $i=1;
              foreach($datalo as $d)
              {
                // Tampilkan Total Mahasiswa Perangkatan
                $queryjmlhmhs = $this->db->query("SELECT COUNT(*) AS jmltotalhmhs FROM ".$this->db->dbprefix('student')." WHERE 	class_generation='".$class_generation."'");
                $rowjmlhmhs = $queryjmlhmhs->row();
                $jmltotalhmhs = $rowjmlhmhs->jmltotalhmhs;

                // Tampilkan Total Mapping LO ke Nilai Matkul
                $queryjmlhnilailomatkul = $this->db->query("SELECT SUM(a.quality) AS jmlhnilailomatkul FROM ".$this->db->dbprefix('contract')." a, ".$this->db->dbprefix('mappingplo')." b WHERE a.idcourses=b.idcourses AND b.idlo='".$d['idlo']."' AND b.idcurriculum='".$idcurriculum."' AND a.idprograme='".$idprograme."'");
                $rowjmlhnilailomatkul = $queryjmlhnilailomatkul->row();
                $jmlhnilailomatkul = $rowjmlhnilailomatkul->jmlhnilailomatkul;

                $percenttotalplo = $jmlhnilailomatkul/$jmltotalhmhs;
              ?>
                {lo: '<?php echo $d["idlo"]; ?>', percent: <?php echo number_format($percenttotalplo, 2, '.', ''); ?>}<?php if($i==$totallo){ echo "";}else{echo ",";}?>
              <?php
                $i++;
              }
              ?>
            ],
            xkey: 'lo',
            ykeys: ['percent'],
            labels: ['Persentase Ketercapaian Learning Outcome'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto'
        });
    }

})(jQuery);
</script>