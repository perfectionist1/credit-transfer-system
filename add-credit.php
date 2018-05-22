<?php
//admin validation
adminValidation();

if (isset($_GET['add_credit_id'])) {
    $add_credit_id = $_GET['add_credit_id'];
    $query = "SELECT * FROM tbl_user WHERE id = '$add_credit_id'";
    $add_credit_id_info = query($query, 2);
}
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Add Credit</h3>
        <hr/>
    </div>
    <?php
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['add_credit'])){
            showMessage();
        }
    }
    ?>
    <div class="col-sm-12">
        <div class="well profile_table">
            <table class="table table-striped table-bordered table-responsive">
                <tr>
                    <th>Name</th>
                    <td><?php echo $add_credit_id_info['first_name'].' '.$add_credit_id_info['last_name'];?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $add_credit_id_info['username'];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $add_credit_id_info['email_address'];?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $add_credit_id_info['address'];?></td>
                </tr>
                <tr>
                    <th>Total credit</th>
                    <td>
                        <?php
                        $user_id = $add_credit_id_info['id'];
                        $query = "SELECT * FROM tbl_credit WHERE user_id = '$user_id'";
                        $credit = query($query, 2);
                        echo '$'.$credit['total_credit'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Add Credit</th>
                    <td>
                        <form class="form-inline" action="process.php" method="POST">
                            <input type="hidden" name="add_credit_id" value="<?php echo $add_credit_id_info['id'];?>" />
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount" />
                                </div>
                            </div>
                            <input type="submit" name="add-credit" class="btn btn-success" onclick="return confirm('Are you sure to add credit to this user?')" value="Add Credit">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>