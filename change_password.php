<?php
if(isset($_GET['change_password_id'])){
    $edit_info_id = $_GET['change_password_id'];
    $query = "SELECT * FROM tbl_user WHERE id = '$edit_info_id'";
    $current_user_info = query($query, 2);
}

//Validation for edit password
/*
                * Hints
 * Admin can edit all users password
 * Users can edit only own password
 */
if($_SESSION['account_status'] != 2){
    if($_SESSION['user_id'] != $current_user_info['id']){
        redirect('dashboard.php?all_users');
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Change Password</h3>
        <hr/>
    </div>
    <?php
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['change_password'])){
            showMessage();
        }
    }
    ?>
    <div class="col-sm-12">
        <div class="well profile_table">
            <form class="form-horizontal" method="POST" action="process.php">
                <input type="hidden" name="change_password_id" value="<?php echo $current_user_info['id'];?>"/>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $current_user_info['first_name'].' '.$current_user_info['last_name'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $current_user_info['username'];?></p>
                    </div>
                </div>
                <?php
                if($_SESSION['account_status'] == 2){
                    if($_SESSION['account_status'] == $current_user_info['account_status']){
                ?>
                <div class="form-group">
                    <label for="old_password" class="col-sm-3 control-label">Old Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password">
                    </div>
                </div>
                    <?php
                    }
                }else {
                ?>
                <div class="form-group">
                    <label for="old_password" class="col-sm-3 control-label">Old Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password">
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="new_password" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_new_password" class="col-sm-3 control-label">Confirm New Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm new password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" class="btn btn-success btn-block" name="change-password" value="Change Password"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>