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
                                    <ul class="box-title nav nav-tabs">
                                        <li class="<?php if($group == 'solo-vocal'){echo 'active';}?>"><a href="<?php echo base_url('admin/singcomp/index/solo-vocal');?>"><h5><b>SOLO VOCAL</b></h5></a></li>
                                        <li class="<?php if($group == 'group-vocal'){echo 'active';}?>"><a href="<?php echo base_url('admin/singcomp/index/group-vocal');?>"><h5><b>GROUP VOCAL</b></h5></a></li>
                                        <li class="<?php if($group == 'payment'){echo 'active';}?>"><a href="<?php echo base_url('admin/singcomp/index/payment');?>"><h5><b><?php echo lang('payment');?></b></h5></a></li>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    <?php if($group != 'payment'):?>
                                    <div class="tab-pane">
                                        <table id="dataTable" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="min-width-150"><?php echo lang('team_name');?></th>
                                                    <th class="min-width-90"><?php echo lang('date_regist');?></th>
                                                    <th class="min-width-200"><?php echo lang('university');?></th>
                                                    <th><?php echo lang('official');?></th>
                                                    <th><?php echo lang('email');?></th>
                                                    <th><?php echo lang('phone');?></th>
                                                    <th class="min-width-90"><?php echo lang('genre');?></th>
                                                    <th class="min-width-90"><?php echo lang('song');?></th>
                                                    <th class="min-width-90"><?php echo lang('required_song');?></th>
                                                    <th><?php echo lang('payment');?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; foreach ($singcomp as $u): if ($u->group == str_replace('-', ' ', $group) OR $group == ''):?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td class="name">
                                                        <?php 
                                                            $atts = array('class' => 'url_action','title' => lang('see').' '.$u->name);
                                                            echo anchor('admin/singcomp/profile/'.$u->id, $u->name, $atts); 
                                                        ?>
                                                        <div class="actions show-actions">
                                                            <?php 
                                                                echo anchor('admin/singcomp/profile/'.$u->id, '<i class="fa fa-user" aria-hidden="true"></i> <span>'.lang('see').'</span>', $atts);
                                                                echo anchor('admin/singcomp/edit/'.$u->id, '<i class="fa fa-edit" aria-hidden="true"></i> <span>'.lang('edit').'</span>', 'class="url_action"');
                                                                echo anchor('admin/singcomp/delete/'.$u->id, '<i class="fa fa-trash" aria-hidden="true"></i> <span>'.lang('delete').'</span>', 'class="url_action"');
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo date('d-m-Y', $u->created_on); ?></td>
                                                    <td><?php echo $u->university; ?></td>
                                                    <td><?php echo $u->official; ?></td>
                                                    <td><?php echo $u->email; ?></td>
                                                    <td><?php echo $u->phone; ?></td>
                                                    <td>
                                                        <?php foreach($u->groups as $g) {
                                                            echo strtoupper($g->name);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $u->song; ?></td>
                                                    <td><?php echo $u->required_song; ?></td>
                                                    <?php 
                                                    if($u->payment == FALSE):
                                                        $get_payment = lang('not_paid');
                                                    else:
                                                        foreach($u->payment as $pay):
                                                            $atts_pay = 'title="'.lang('see').' '. lang('payment'). '" style="color:#2b542c;background:#dff0d8;"';
                                                            $get_payment = anchor($image_dir.$pay->file_name, '<i class="fa fa-check-square-o" aria-hidden="true"></i> <span>'.lang('paid').'</span>', $atts_pay);
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                    <td><?php echo $get_payment;?></td>
                                                </tr>
                                                <?php $i++; endif; endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th><?php echo lang('team_name');?></th>
                                                    <th><?php echo lang('date_regist');?></th>
                                                    <th><?php echo lang('university');?></th>
                                                    <th><?php echo lang('official');?></th>
                                                    <th><?php echo lang('email');?></th>
                                                    <th><?php echo lang('phone');?></th>
                                                    <th><?php echo lang('genre');?></th>
                                                    <th><?php echo lang('song');?></th>
                                                    <th><?php echo lang('required_song');?></th>
                                                    <th><?php echo lang('payment');?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php else:?>
                                    <div class="tab-pane" id="payment">
                                        <table id="dataTable" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="min-width-150"><?php echo lang('fullname');?></th>
                                                    <th class="min-width-90"><?php echo lang('date_paid');?></th>
                                                    <th><?php echo lang('email');?></th>
                                                    <th><?php echo lang('group');?></th>
                                                    <th class="min-width-150"><?php echo lang('account_owner');?></th>
                                                    <th><?php echo lang('pof');?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; foreach ($singcomp as $u):if ($u->payment != FALSE):?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td class="name">
                                                        <?php 
                                                            $atts = array('class' => 'url_action','title' => lang('see').' '.$u->name);
                                                            echo anchor('admin/singcomp/profile/'.$u->id, $u->name, $atts); 
                                                        ?>
                                                        <div class="actions show-actions">
                                                            <?php 
                                                                echo anchor('admin/singcomp/profile/'.$u->id, '<i class="fa fa-user" aria-hidden="true"></i> <span>'.lang('see').'</span>', $atts);
                                                                echo anchor('admin/singcomp/edit/'.$u->id, '<i class="fa fa-edit" aria-hidden="true"></i> <span>'.lang('edit').'</span>', 'class="url_action"');
                                                                echo anchor('admin/singcomp/delete/'.$u->id, '<i class="fa fa-trash" aria-hidden="true"></i> <span>'.lang('delete').'</span>', 'class="url_action"');
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <?php 
                                                        foreach($u->payment as $pay):
                                                            $atts_pay = 'title="'.lang('see').' '. lang('payment'). '" target="_blank"';
                                                            $image = '<img src="'.base_url($image_dir.$pay->file_name).'" style="width: auto; max-width: 100%; max-height: 100px;">';
                                                            $get_payment = anchor($image_dir.$pay->file_name, $image, $atts_pay);
                                                            $account_owner = $pay->account_owner;
                                                            $date_paid = $pay->time;
                                                        endforeach;
                                                    ?>
                                                    <td><?php echo date('d-m-Y', $date_paid); ?></td>
                                                    <td><?php echo $u->email; ?></td>
                                                    <td><?php echo $u->group;?></td>
                                                    <td><?php echo $account_owner;?></td>
                                                    <td><?php echo $get_payment;?></td>
                                                </tr>
                                                <?php $i++; endif;endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="min-width-150"><?php echo lang('fullname');?></th>
                                                    <th class="min-width-90"><?php echo lang('date_paid');?></th>
                                                    <th><?php echo lang('email');?></th>
                                                    <th><?php echo lang('group');?></th>
                                                    <th class="min-width-150"><?php echo lang('account_owner');?></th>
                                                    <th><?php echo lang('pof');?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
