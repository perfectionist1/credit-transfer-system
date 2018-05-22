<?php

if(isset($_GET['transferred_history_id'])){
    adminValidation();
    $user_id = $_GET['transferred_history_id'];
    $query = "SELECT username FROM tbl_user WHERE id = '$user_id'";
    $user_details = query($query, 2);
}else{
    $user_id = $_SESSION['user_id'];
}
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Credit Transfer History <?php if (isset($_GET['transferred_history_id'])){echo "of ".$user_details['username'];} ?></h3>
        <hr/>
    </div>
    <div class="col-sm-12">
        <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Time & Date</th>
                    <th>Transferred to</th>
                    <th>Transferred Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //transfer history
                $query = "SELECT * FROM tbl_transfer WHERE user_id = '$user_id' ORDER BY id DESC ";
                $result = query($query, 1);
                $serial = 1;
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $serial++; ?></td>
                    <td><?php echo $row['transferred_date']; ?></td>
                    <?php
                    $transferred_user_id = $row['transferred_to_user_id'];
                    $query = "SELECT * FROM tbl_user WHERE id = '$transferred_user_id'";
                    $transferred_id_info = query($query, 2);
                    $transferred_username = $transferred_id_info['username'];
                    ?>
                    <td>
                        <?php
                            if(!empty($transferred_username)){
                                ?>
                                <a href="?user-id=<?php echo $row['transferred_to_user_id']; ?>" class="text-info" title="View Profile"><?php echo $transferred_username;?></a>
                        <?php
                            }else{
                                echo "user deleted";
                            }
                        ?>
                    </td>
                    <td><?php echo '$'.$row['transferred_amount']; ?></td>
                </tr>
                    </tr>
                    <?php
                }
                }else{
                ?>
                <tr>
                    <td colspan="4" align="center">No transferred history available</td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>