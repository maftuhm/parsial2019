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
						<div class="form-group validate-input" data-validate="<?php echo lang('fullname').$required;?>">
							<?php echo lang('fullname', 'name').form_input($name);?>
						</div>
						<div class="form-group">
							<?php echo lang('birthday', 'birthplace');;?>
							<div class="select-block validate-input" data-validate="<?php echo lang('birthday').$required;?>">
								<?php echo form_input($birthplace).form_dropdown($date).form_dropdown($month).form_dropdown($year);?>
							</div>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('address').$required;?>">
							<?php echo lang('address', 'address').form_textarea($address);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('school').$required;?>">
							<?php echo lang('school', 'school').form_input($school);?>
						</div>
						<div class="form-group validate-input <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): lang('email').$required;?>">
							<?php echo lang('email', 'email').form_input($email);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('phone').$required;?>">
							<?php echo lang('phone', 'phone').form_input($phone);?>
						</div>
						<div class="form-group">
							<?php echo lang('tutor_name', 'tutor_name').form_input($tutor_name);?>
						</div>
						<div class="form-group">
							<?php echo lang('tutor_phone', 'tutor_phone').form_input($tutor_phone);?>
						</div>
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
		<?php echo $modal_success;
		if (!empty($message)) {
			echo modal_error('Pendaftaran', $message);
		}
		?>