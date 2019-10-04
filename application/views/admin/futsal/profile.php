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
                        <?php foreach ($futsal as $u):?>
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">xxxx</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th><?php echo lang('team_name'); ?></th>
                                                <td><?php echo $u->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('date_regist'); ?></th>
                                                <td><?php $date = '%d-%m-%Y - %h:%i %a';echo mdate($date, $u->created_on);?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('university'); ?></th>
                                                <td><?php echo $u->university; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('faculty'); ?></th>
                                                <td><?php echo $u->faculty; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('departement'); ?></th>
                                                <td><?php echo $u->departement; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('official'); ?></th>
                                                <td><?php echo $u->official; ?></td>
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
                                                <th><?php echo lang('group'); ?></th>
                                                <td>
                                                    <?php echo strtoupper($u->group); /*foreach ($u->group as $g): echo strtoupper($g->name); endforeach;*/ ?>
                                                </td>
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
                                                    <?php else: foreach ($u->payment as $pay) {$image = $pay->file_name;}?>
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
                                                <th><?php echo lang('action'); ?></th>
                                                <td>
                                                    <?php echo anchor('admin/futsal/edit/'.$u->id, '<i class="fa fa-edit"></i> '.lang('edit'), array('class' => 'btn btn-primary btn-action')); ?>
                                                    <button type="button" class="btn btn-danger btn-action" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash-o"></i> <?php echo lang('delete');?></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php //print_r($player);?></h3>
                                </div>
                                <div class="box-body">
                                    <table id="dataTable" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th><?php echo lang('name');?></th>
                                                <th><?php echo lang('photo');?></th>
                                                <th><?php echo lang('card');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i = 1;foreach ($player as $u):
                                            ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $u->name;?></td>
                                                <?php foreach ($u->photo as $p):?>
                                                <td><img class="image-pa" src="<?php echo base_url('upload/futsal/data/'.$p->file_name);?>"></td>
                                                <?php endforeach;?>
                                                <?php foreach ($u->card as $p):?>
                                                <td><img class="image-pa" src="<?php echo base_url('upload/futsal/data/'.$p->file_name);?>"></td>
                                                <?php endforeach;?>
                                            </tr>
                                            <?php
                                               $i++;endforeach;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th><?php echo lang('name');?></th>
                                                <th><?php echo lang('photo');?></th>
                                                <th><?php echo lang('card');?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php echo modal_admin(lang('delete'), 'Apakah anda yakin ingin menghapus peserta ini?', anchor('admin/futsal/delete/'.$u->id, '<i class="fa fa-trash-o"></i> '.lang('delete'), array('class' => 'btn btn-outline')))?>
