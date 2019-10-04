<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        <h1><?php echo $header;?></h1>
        <div class="box-wrap">
            <!-- <h2>Register Here</h2> -->
            <div class="main">
                <?php echo form_open_multipart(uri_string(), array('id' => 'form-register', 'class' => 'validate-form number-form')); ?>
                    <div class="main-header">
                        <?php 
                            /*if(!empty($error) || !empty($message)){
                                echo '<div class="error">';
                                echo '<p>'.$message.'</p>'.$error;
                                echo '</div>';
                            };*/
                            echo '<pre>';
                            print_r($all_file);
                            echo '</pre>';
                        ?>
                    </div>
                    <div class="main-wrap">
                        <div class="form-group validate-input number-group <?php if(!empty(form_error('email'))){echo 'alert-validate';}?>" data-validate="<?php echo form_error('email') ? form_error('email'): 'Email wajib diisi';?>">
                            <?php echo lang('email', 'email');?>
                            <?php echo form_input($email);?>
                        </div>
                        <?php for ($i=0; $i < 12; $i++): $j = $i + 1; if($i >= 6){$validate = '';$addition = 'addition';}else{$addition = '';$validate = 'validate-input';} ?>
                        <div class="futsal-form-group <?php echo $addition;?>">
                            <div class="form-group number-group name <?php echo $validate;?>" data-validate="Name is required">
                                <?php
                                    echo '<label for="name" class="label-number">' . $j . '. ' . lang('player_name') . '</label>';
                                    $value = '';
                                    if (empty($modal_success)) {
                                        $value = set_value('name['.$i.']');
                                    }
                                    echo form_input($name, $value);
                                ?>
                            </div>
                            <div class="file-upload photo">
                                <?php echo lang('player_photo', 'photo');?>
                                <div class="input-group number-group <?php echo $validate;?>" data-validate="Photo is required">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <?php echo form_upload($photo);?>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control input100" readonly>
                                </div>
                            </div>
                            <div class="file-upload ktm">
                                <?php echo lang('player_card', 'ktm');?>
                                <div class="input-group number-group <?php echo $validate;?>" data-validate="Photo is required">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <?php echo form_upload($ktm);?>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control input100" readonly>
                                </div>
                            </div>
                        </div>
                        <?php endfor;?>
                        <div class="futsal-form-group-addition"></div>
                        <div class="btn-group"><a type="button" id="add-more" class="btn btn-default" title="Tambah Pemain"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="action">
                        <div class="form-group accept validate-input" data-validate="Checkbox is required">
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
                echo modal_error('Upload Data Pemain', $message.$error);
            }
        ?>