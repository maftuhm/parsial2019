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
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">xxxx</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
<?php foreach ($mathcomp as $u):?>
                                            <tr>
                                                <th class="min-width-150"><?php echo lang('number_participant'); ?></th>
                                                <td>
                                                    <?php 
                                                        // if ($u->number != 0) {
                                                        //     echo set_digit(3, $u->number);
                                                        //     foreach ($u->format as $n) {
                                                        //         echo $n->number;
                                                        //     }
                                                        // }
                                                    ?>
                                                            
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('fullname'); ?></th>
                                                <td><?php echo $u->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('ttl'); ?></th>
                                                <td><?php echo $u->birthplace .', '. $u->birthday; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('date_regist'); ?></th>
                                                <td><?php $date = '%d-%m-%Y - %h:%i %a';echo mdate($date, $u->created_on);?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('address'); ?></th>
                                                <td><?php echo $u->address; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('email'); ?></th>
                                                <td><?php echo $u->email; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('phone'); ?></th>
                                                <td><?php echo $u->phone; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('school'); ?></th>
                                                <td><?php echo $u->school; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('tutor_name'); ?></th>
                                                <td><?php echo $u->tutor_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('tutor_phone'); ?></th>
                                                <td><?php echo $u->tutor_phone; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>

                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">xxxx</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th><?php echo lang('payment'); ?></th>
<?php if ($u->payment == FALSE): $image_dir = 'upload/';?>
                                                <td><?php echo lang('not_paid'); ?></td>
<?php else: 

    foreach ($u->payment as $pay) {$image = $pay->file_name;}
?>
                                                <td><?php echo lang('paid'); ?></td>
<?php endif;?>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('pof'); ?></th>
                                                <td>
                                                    <img style="width: auto; max-width: 100%; max-height: 250px;" src="<?php echo base_url($image_dir.$image);?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('set_num'); ?></th>
                                                <td>
                                                    <?php echo anchor('admin/mathcomp/generate/'.$u->id, '<i class="fa fa-refresh"></i> '.lang('actions_generate'), array('class' => 'btn btn-warning btn-action')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('action'); ?></th>
                                                <td>
                                                    <?php echo anchor('admin/mathcomp/edit/'.$u->id, '<i class="fa fa-edit"></i> '.lang('edit'), array('class' => 'btn btn-primary btn-action')); ?>
                                                    <?php echo anchor('admin/mathcomp/delete/'.$u->id, '<i class="fa fa-trash-o"></i> '.lang('delete'), array('class' => 'btn btn-danger btn-action')); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
