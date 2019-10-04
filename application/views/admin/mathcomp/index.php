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
                                    <h3 class="box-title"><?php /*print_r($set)*//*;*///echo $set;?></h3>
                                </div>
                                <div class="box-body">
                                    <table id="dataTable" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="min-width-90"><?php echo lang('number_participant');?></th>
                                                <th class="min-width-150"><?php echo lang('fullname');?></th>
                                                <th class="min-width-90"><?php echo lang('date_regist');?></th>
                                                <th><?php echo lang('email');?></th>
                                                <th><?php echo lang('phone');?></th>
                                                <th class="min-width-150"><?php echo lang('birthday');?></th>
                                                <th class="min-width-200"><?php echo lang('address');?></th>
                                                <th class="min-width-150"><?php echo lang('school');?></th>
                                                <th class="min-width-150"><?php echo lang('tutor_name');?></th>
                                                <th><?php echo lang('tutor_phone');?></th>
                                                <th><?php echo lang('payment');?></th>
                                                <th class="min-width-150"><?php echo lang('action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php $i=1; foreach ($mathcomp as $u): ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                    <?php 
                                                        // if ($u->number != 0) {
                                                        //     echo set_digit(3, $u->number);
                                                        //     foreach ($u->format as $key) {
                                                        //         echo $key->number;
                                                        //     }
                                                        // }
                                                    ?>
                                                        
                                                </td>
<?php
    $atts = array(
        'class' => 'url_action',
        'title' => lang('see').' '.$u->name
    )
?>
                                                <td><?php echo anchor('admin/mathcomp/profile/'.$u->id, $u->name, $atts); ?></td>
                                                <td><?php echo date('d-m-Y', $u->created_on); ?></td>
                                                <td><?php echo $u->email; ?></td>
                                                <td><?php echo $u->phone; ?></td>
                                                <td><?php echo $u->birthplace .', ' . $u->birthday; ?></td>
                                                <!-- <td><?php //echo ; ?></td> -->
                                                <td><?php echo $u->address; ?></td>
                                                <td><?php echo $u->school; ?></td>
                                                <td><?php echo $u->tutor_name; ?></td>
                                                <td><?php echo $u->tutor_phone; ?></td>
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
                                                <td>
                                                    <?php echo anchor('admin/mathcomp/profile/'.$u->id, '<i class="fa fa-user" aria-hidden="true"></i> <span>'.lang('see').'</span>', $atts); ?>
                                                    <?php echo anchor('admin/mathcomp/edit/'.$u->id, '<i class="fa fa-edit" aria-hidden="true"></i> <span>'.lang('edit').'</span>', 'class="url_action"'); ?>
                                                    <?php echo anchor('admin/mathcomp/delete/'.$u->id, '<i class="fa fa-trash" aria-hidden="true"></i> <span>'.lang('delete').'</span>', 'class="url_action"'); ?>
                                                </td>
                                            </tr>
<?php $i++; endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th><?php echo lang('number_participant');?></th>
                                                <th><?php echo lang('fullname');?></th>
                                                <th><?php echo lang('date_regist');?></th>
                                                <th><?php echo lang('email');?></th>
                                                <th><?php echo lang('phone');?></th>
                                                <th><?php echo lang('birthday');?></th>
                                                <th><?php echo lang('address');?></th>
                                                <th><?php echo lang('school');?></th>
                                                <th><?php echo lang('tutor_name');?></th>
                                                <th><?php echo lang('tutor_phone');?></th>
                                                <th><?php echo lang('payment');?></th>
                                                <th><?php echo lang('action');?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
