
<?php

?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Sent Credit Request</h3>
        <hr/>
    </div>

    <?php
    if (isset($_SESSION['user_id'])){
        if(isset($_GET['sent_credit_request'])){
            showMessage();
        }
    }
    ?>

    <div class="col-sm-12">
        <div class="well profile_table">
            <table class="table table-striped table-bordered table-responsive">
                <tr>
                    <th>Current Credit</th>
                    <td>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM tbl_credit WHERE user_id = '$user_id'";
                        $credit = query($query, 2);
                        echo '$'.$credit['total_credit'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Credit Request Amount</th>
                    <td>
                        <form class="form-inline" action="process.php" method="POST">
                            <input type="hidden" name="sent_request_id" value="<?php echo $user_id;?>" />
                            <div class="form-group">
                                <label class="sr-only" for="amount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" />
                                </div>
                            </div>
                            <input type="submit" name="sent-credit-request" class="btn btn-success" onclick="return confirm('Are you sure to sent request?')" value="Sent Request">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<!--Request History-->
<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Sent Credit History</h3>
        <hr/>
    </div>

    <div class="col-sm-12">
        <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Time & Date</th>
                    <th>Amount</th>
                    <th>Request Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM tbl_credit_request WHERE user_id = '$user_id' ORDER BY id DESC";
                    $all_info_of_sent_request = query($query,1);
                    if(mysqli_num_rows($all_info_of_sent_request) > 0) {
                        $serial = 1;
                        while ($row = mysqli_fetch_assoc($all_info_of_sent_request)) {
                            ?>
                            <tr align="center" class="<?php
                                if($row['request_status'] == 0){
                                    echo "danger";
                                }elseif ($row['request_status'] == 1){
                                    echo "active";
                                }elseif ($row['request_status'] == 2){
                                    echo "success";
                                }
                            ?>">
                                <td><?php echo $serial++;?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['amount'];?></td>
                                <td>
                                    <?php
                                        if($row['request_status'] == 0){
                                            echo "Refused";
                                        }elseif ($row['request_status'] == 1){
                                            echo "Pending";
                                        }elseif ($row['request_status'] == 2){
                                            echo "Accepted";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }else {
                        ?>
                        <tr>
                            <td colspan="4" align="center">No request history</td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>