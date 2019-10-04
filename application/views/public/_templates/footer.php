<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="footer">
			<p> &copy; PARSIAL 2019. All Rights Reserved | Developed by  <a href="#"> Maftuh Mashuri</a></p>
		</div>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery-3.3.1.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- <script src="<?php //echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script> -->
        <!-- <script src="<?php //echo base_url($plugins_dir . '/dialog/jquery-confirm.min.js'); ?>"></script> -->
<?php if ($mobile == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
<?php endif; ?>
        <script src="<?php echo base_url($plugins_dir . '/clipboard/clipboard.min.js'); ?>"></script>
<?php if ($show_filedrag) : ?>
        <script src="<?php echo base_url($plugins_dir . '/filedrag/filedrag.js'); ?>"></script>
        <script type="text/javascript">$("#fileselect").mouseover(function(){$("#filedrag").attr("class", "hover");;});$("#fileselect").mouseout(function(){$("#filedrag").removeAttr("class");;});</script>
<?php endif;?>
<?php if($futsal_js == TRUE):?>
    <script type="text/javascript">
        var ikahimatika = $('#ikahimatika');
        $('#ikahimatika').remove();
        $('select').on('change', function(){
            var group = $('select option:selected').attr('value');
            var url = 'http://himatika.fst.uinjkt.ac.id/parsial2019/futsal-competition/sk/';
            var new_url = url + group.replace(' ', '-');
            if (group == 'ikahimatika') {
                $('.university').after(ikahimatika);
            }else{
                $('#ikahimatika').remove();
            }
            $('.accept a').attr('href', new_url);
        });
        var no = 6;
        var i = -1;
        $('.addition').hide();
        $('.addition input').attr('name', '');
        $('#add-more').on('click', function(){
            no++;i++;
            var addition = '.addition:eq(' + i + ')';
            $(addition).show();
            $(addition + ' input[type=text]:eq(0)').attr('name', 'name[]');
            $(addition + ' input[type=file]:eq(0)').attr('name', 'photo[]');
            $(addition + ' input[type=file]:eq(1)').attr('name', 'ktm[]');
            if (no == 12) {
                $('#add-more').remove();
            }
        });
    </script>
<?php endif;if($singcomp_js == TRUE):?>
    <script type="text/javascript">
        function addition_show(index = 0, show = true) {
            var addition = '.addition';
            if (index >= 0) {
               var add = addition + ':eq(' + index + ')';
            }else{
                var add = addition;
            }

            if (show) {
                $(add).show();
                $(add + ' input[type=text]:eq(0)').attr('name', 'name[]');
                $(add + ' input[type=text]:eq(1)').attr('name', 'position[]');
                $(add + ' input[type=file]:eq(0)').attr('name', 'photo[]');
                $(add + ' input[type=file]:eq(1)').attr('name', 'ktm[]');
            }else{
                $(add).hide();
                $(add + ' input').attr('name', '');
            }
        }

        addition_show(-1, false);
        var i = -1;
        var no = 1;
        var max = 3;

        $('select').on('change', function(){
            var group = $('select option:selected').attr('value');
            if (group == 'group vocal') {
                max = 6;

            }else{
                if (max == 6) {
                    addition_show(-1, false);
                    i = -1;
                    no = 1;
                    max = 3;
                }
            }
            if (no < max-1) {
                $('#add-more').show();
            }
        });

        $('#add-more').on('click', function(){
            no++;i++;
            addition_show(i);
            if (no == max) {
                $('#add-more').hide();
            }
        });
    </script>
<?php endif;?>
        <script src="<?php echo base_url('assets/public/main.js'); ?>"></script>
    </body>
</html>