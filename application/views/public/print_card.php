<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        <h1><?php echo $title;?></h1>
        <div class="box-wrap">
            <div class="main">
                <?php echo form_open(uri_string(), array('id' => 'form-register', 'class' => 'validate-form')); ?>
                    <div class="main-header">
                        <?php 
                            /*if(!empty($error) || !empty($message)){
                                echo '<div class="error">';
                                echo '<p>'.$message.'</p>'.$error;
                                echo '</div>';
                            };*/
                            /*foreach ($tryout as $key) {
                                echo '<div class="error">';
                                echo '<p>'.$key->number.'</p>';
                                echo '<p>'.$key->birthday.'</p>';
                                echo '</div>';
                            }*/
                        ?>
                    </div>
                    <div class="main-wrap">
                        <div class="form-group validate-input <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): lang('email').$required;?>">
                            <?php echo lang('email', 'email').form_input($email);?>
                        </div>
                        <div class="form-group">
                            <?php echo lang('birthdate', 'birthday');?>
                            <div class="select-block validate-input" data-validate="<?php echo lang('birthday').$required;?>">
                                <?php echo form_dropdown($date).form_dropdown($month).form_dropdown($year);?>
                            </div>
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
                <?php echo $message;
                    /*if (!empty($message)){
                        echo modal_error(text_filter($title), $message);
                    }*/
                ?>
            </div>
        </div>