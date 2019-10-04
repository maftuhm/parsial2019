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
                                    <h3 class="box-title">xxxx<?php// echo $tes;?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
<?php foreach ($tryout as $u):?>
                                            <tr>
                                                <th class="min-width-150"><?php echo lang('number_participant');?></th>
                                                <td><?php echo $u->number?></td>
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
                                                <th><?php echo lang('departement'); ?></th>
                                                <td>
                                                    <?php foreach ($u->majors as $major): echo strtoupper($major->name); endforeach; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('choice'); ?></th>
                                                <td>
                                                    <?php foreach ($u->choices as $choice): echo strtoupper($choice->name); endforeach; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('interest'); ?></th>
                                                <td><?php echo $u->interest; ?></td>
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
<?php if ($u->payment == FALSE): $image_dir = 'upload/images/';?>
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
                                                    <?php echo anchor('admin/tryout/generate/'.$u->id, '<i class="fa fa-refresh"></i> '.lang('actions_generate'), array('class' => 'btn btn-warning btn-action')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('action'); ?></th>
                                                <td>
                                                    <?php echo anchor('admin/tryout/edit/'.$u->id, '<i class="fa fa-edit"></i> '.lang('edit'), array('class' => 'btn btn-primary btn-action')); ?>
                                                    <button type="button" class="btn btn-danger btn-action" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash-o"></i> <?php echo lang('delete');?></button>
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
            <div class="modal modal-danger fade" id="modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Danger Modal</h4>
                        </div>
                        <div class="modal-body">
                            <p>One fine body&hellip;</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            <?php echo anchor('admin/tryout/delete/'.$u->id, '<i class="fa fa-trash-o"></i> '.lang('delete'), array('class' => 'btn btn-outline')); ?>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>