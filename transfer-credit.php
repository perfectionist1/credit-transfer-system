<?php
    if (isset($_GET['transfer_id'])) {
        $transfer_user_id = $_GET['transfer_id'];
        $query = "SELECT * FROM tbl_user WHERE id = '$transfer_user_id'";
        $transfer_user = query($query, 2);
    }
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Transfer Credit</h3>
        <hr/>
    </div>

    <?php
    if (isset($_SESSION['user_id'])){
        if (isset($_GET['transfer'])){
            showMessage();
        }
    }
    ?>

    <div class="col-sm-12">
        <div class="well profile_table">
            <table class="table table-striped table-bordered table-responsive">
                <tr>
                    <th>Name</th>
                    <td><?php echo $transfer_user['first_name'].' '.$transfer_user['last_name'];?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $transfer_user['username'];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $transfer_user['email_address'];?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $transfer_user['address'];?></td>
                </tr>
                <tr>
                    <th>Total credit</th>
                    <td>
                        <?php
                        $user_id = $transfer_user['id'];
                        $query = "SELECT * FROM tbl_credit WHERE user_id = '$user_id'";
                        $credit = query($query, 2);
                        echo '$'.$credit['total_credit'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Transfer Credit</th>
                    <td>
                        <form class="form-inline" action="process.php" method="POST">
                            <input type="hidden" name="transfer_user_id" value="<?php echo $transfer_user['id'];?>" />
                            <input type="hidden" name="current_user_id" value="<?php echo $_SESSION['user_id'];?>" />
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount" />
                                </div>
                            </div>
                            <input type="submit" name="transfer" class="btn btn-success" onclick="return confirm('Are you sure to transfer credit?')" value="Transfer">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>