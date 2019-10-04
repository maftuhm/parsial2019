
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-sm-offset-2 col-md-6">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php// echo lang('users_create_user'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $message;?>
                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-register')); ?>
                                        <div class="form-group">
                                            <?php echo lang('fullname', 'fullname', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($name);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('birthplace', 'birthplace', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($birthplace);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('birthday', 'birthday', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($birthday);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('address', 'address', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($address);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('interest', 'interest', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($interest);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('school', 'school', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($school);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('major', 'major', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_dropdown($major);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('choice', 'choice', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_dropdown($choice);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('email', 'email', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($email);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('phone', 'phone', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($phone);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array(/*'type' => 'submit', */'id' => 'submitBtn', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'), 'data-toggle'=>'modal'/*, 'data-target'=>'#confirm-submit'*/)); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Confirm Submit
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to submit the following details?
                                                    <table class="table">
                                                        <tr>
                                                            <th><?php echo lang('fullname')?></th>
                                                            <td id="rname"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('birthplace')?></th>
                                                            <td id="rbirthplace"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('birthday')?></th>
                                                            <td id="rbirthday"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('address')?></th>
                                                            <td id="raddress"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('school')?></th>
                                                            <td id="rschool"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('major')?></th>
                                                            <td id="rmajor"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('choice')?></th>
                                                            <td id="rchoice"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('email')?></th>
                                                            <td id="remail"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('phone')?></th>
                                                            <td id="rphone"></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo lang('interest')?></th>
                                                            <td id="rinterest"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_cancel'), 'data-dismiss'=>'modal')); ?>
                                                    <a href="#" id="submit" class="btn btn-success success">Submit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>