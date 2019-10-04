<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- <form action="http://localhost/CI-AdminLTE/" id="formfield" method="post"> -->
<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-register'));?>
<!-- <input type="hidden" name="action" value="add_form" /> 
 -->
        <div class="form-group">
          <label>First Name</label>
          <input class="form-control" placeholder="Enter First Name" name="firstname" id="firstname">
       </div>

       <div class="form-group">
         <label>Last Name</label>
         <input class="form-control" placeholder="Enter Last Name" name="lastname" id="lastname">
       </div>
            <input type="button" name="btn" value="Submit" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default" />
            <input type="reset" name="btn" value="Reset" class="btn btn-default" data-modal-type="confirm"/>
</form>

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
                        <th>First Name</th>
                        <td id="fname"></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td id="lname"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit" class="btn btn-success success">Submit</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
                /*$('#submitBtn').click(function() {
                 $('#lname').text($('#lastname').val());
                 $('#fname').text($('#firstname').val());
            });

            $('#submit').click(function(){
                $('#formfield').submit();
            });*/
</script>