<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        <h1><?php echo $page_title . ' ' . $header;?></h1>
        <div class="box-wrap">
            <!-- <h2>Register Here</h2> -->
            <div class="main">
                <?php echo form_open_multipart(uri_string(), array('id' => 'form-register', 'class' => 'validate-form')); ?>
                    <div class="main-header">
                        <?php 
                            /*if(!empty($error) || !empty($message)){
                                echo '<div class="error">';
                                echo '<p>'.$message.'</p>'.$error;
                                echo '</div>';
                            };*/
                        ?>
                    </div>
                    <div class="main-wrap">
                        <div class="form-group validate-input" data-validate="<?php echo lang('account_owner').$required;?>">
                            <?php echo lang('account_owner', 'name').form_input($name);?>
                        </div>
                        <div class="form-group validate-input <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): lang('email').$required;?>">
                            <?php echo lang('email', 'email').form_input($email);?>
                        </div>
                        <div class="form-group">
                            <div id="messages"></div>
                            <?php echo form_upload($file);?>
                            <div id="filedrag"><?php echo lang('drag_and_drop');?></div>
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
                            <input type="submit" id="btn-submit" name="submit" value="Register">
                        </div>  
                        <div class="clear"> </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
        <?php 
            echo $modal_success;
            if (!empty($message) OR !empty($error)) {
                echo modal_error('Konfirmasi Pembayaran', $message.$error);
            }
        ?>