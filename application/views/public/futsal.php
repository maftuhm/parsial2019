<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
		<h1><?php echo text_filter($title);?></h1>
		<div class="box-wrap">
			<!-- <h2>Register Here</h2> -->
			<div class="main">
				<?php echo form_open(uri_string(), array('id' => 'form-register', 'class' => 'validate-form')); ?>
					<div class="main-header"></div>
					<div class="main-wrap">
						<div class="form-group validate-input" data-validate="<?php echo lang('team_name').$required;?>">
							<?php echo lang('team_name', 'name').form_input($name);?>
						</div>
						<div class="form-group single-select validate-input" data-validate="<?php echo lang('group').$required;?>">
							<?php echo lang('group', 'group').form_dropdown($group);?>
						</div>
						<div class="form-group validate-input university" data-validate="<?php echo lang('university').$required;?>">
							<?php echo lang('university', 'university').form_input($university);?>
						</div>
						<div id="ikahimatika">
							<div class="form-group validate-input" data-validate="<?php echo lang('faculty').$required;?>">
								<?php echo lang('faculty', 'faculty').form_input($faculty);?>
							</div>
							<div class="form-group validate-input" data-validate="<?php echo lang('departement').$required;?>">
								<?php echo lang('departement', 'departement').form_input($departement);?>
							</div>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('phone').$required;?>">
							<?php echo lang('official', 'official').form_input($official);?>
						</div>
						<div class="form-group validate-input <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): lang('email').$required;?>">
							<?php echo lang('email', 'email').form_input($email);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('phone').$required;?>">
							<?php echo lang('phone', 'phone').form_input($phone);?>
						</div>
						<!-- <div class="form-group single-select validate-input" data-validate="<?php echo lang('group').$required;?>">
							<?php //echo lang('group', 'group').form_dropdown($group);?>
						</div> -->
						<div class="clear"></div>
					</div>
					<div class="action">
						<div class="form-group accept validate-input" data-validate="<?php echo lang('check_required');?>">
							<?php 
								echo form_checkbox($accept);
								echo '<span>' . lang('accept_text'). '</span> ';
								echo anchor($sk_url, lang('terms'), array('title' => lang('terms'), 'target' => '_blank'));
							?>
						</div>
						<div class="form-group submit">
							<input type="submit" id="btn-submit" name="submit" value="Submit">
						</div>  
						<div class="clear"> </div>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
		<?php 
		// echo $id;
		echo $modal_success;
		if (!empty($message)) {
			echo modal_error('Pendaftaran', $message);
		}
		?>