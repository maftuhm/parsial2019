<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
		<h1><?php echo text_filter($title);?></h1>
		<div class="box-wrap">
			<div class="main">
				<?php echo form_open(uri_string(), array('id' => 'form-register', 'class' => 'validate-form')); ?>
					<div class="main-header"></div>
					<div class="main-wrap">
						<div class="form-group validate-input" data-validate="<?php echo lang('team_name').$required;?>">
							<?php echo lang('team_name', 'name').form_input($name);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('collage_or_school').$required;?>">
							<?php echo lang('collage_or_school', 'university').form_input($university);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('address').$required;?>">
							<?php echo lang('address', 'address').form_textarea($address);?>
						</div>
						<div class="form-group validate-input <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): lang('email').$required;?>">
							<?php echo lang('email', 'email').form_input($email);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('phone').$required;?>">
							<?php echo lang('phone', 'phone').form_input($phone);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('official').$required;?>">
							<?php echo lang('official', 'official').form_input($official);?>
						</div>
						<div class="form-group single-select validate-input" data-validate="<?php echo lang('genre').$required;?>">
							<?php echo lang('genre', 'group').form_dropdown($group);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('song').$required;?>">
							<?php echo lang('song', 'song').form_input($song);?>
						</div>
						<div class="form-group validate-input" data-validate="<?php echo lang('required_song').$required;?>">
							<?php echo lang('required_song', 'required_song').form_dropdown($required_song);?>
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
		<?php 
		echo $modal_success;
		if (!empty($message)) {
			echo modal_error('Pendaftaran', $message);
		}
		?>