<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('users_edit_user');//print_r($futsal);?></h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $message;?>

                                    <?php echo form_open(uri_string(), array('class' => 'form-horizontal', 'id' => 'form-edit_user')); ?>
                                        <div class="form-group">
                                            <?php echo lang('fullname', 'fullname', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($name);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('university', 'university', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($university);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('address', 'address', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($address);?>
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
                                            <?php echo lang('official', 'official', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($official);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('group', 'group', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_dropdown($group);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('song', 'song', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($song);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('required_song', 'required_song', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_dropdown($required_song);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat btn-action', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo anchor('admin/mathcomp', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat btn-action')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
