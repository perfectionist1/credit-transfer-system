<?php

    //show array data
    function debug($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    //default time zone
    date_default_timezone_set('Asia/Dhaka');



    //validation
    function validation($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

    //admin validation
    function adminValidation(){
        $logged_user = $_SESSION['user_id'];
        $query = "SELECT account_status FROM tbl_user WHERE id = '$logged_user'";
        $result = query($query, 2);
        $result_status = $result['account_status'];
        if($result_status != 2){
            redirect('dashboard.php?all_users');
        }
    }

    //menu active class
    function activeClass($url){
        if(isset($_GET[$url])){
            echo "active";
        }
    }

    //Create message
    /*
        *   Hints
        *  status 0 = error
        *  status 1 = success
     */
    function message($status, $message){
        if ($status == 0){
            $_SESSION['message'] = '
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> '.$message.'
                        </div>
                    </div>
                </div>';
        }elseif($status == 1){
            $_SESSION['message'] = '
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="fa fa-check-circle" aria-hidden="true"></span> '.$message.'
                        </div>
                    </div>
                </div>';
        }
    }

    //View message
    function showMessage(){
        if(isset($_SESSION['message'])){
            ?>
            <div class="center"><p><?php echo $_SESSION['message'];?></p></div>
            <?php
            unset($_SESSION['message']);
        }
    }

//header redirect
function redirect($location){
    header("Location:$location");
}

//Query
/*
    *   Hints
    *  status null = no return value
    *  status 1 = return all from database
    *  status 2 = return all from database by id with mysqli_fetch_assoc
 */
function query($query, $status=null){
    global $link;
    if($status == null){
        if(!mysqli_query($link, $query)){
            die("Query Problem : ".mysqli_error($link));
        }else{
            return true;
        }
    }elseif($status == 1){
        if(!mysqli_query($link, $query)){
            die("Query Problem : ".mysqli_error($link));
        }else{
            $result = mysqli_query($link, $query);
            return $result;
        }
    }elseif ($status == 2){
        if(!mysqli_query($link, $query)){
            die("Query Problem : ".mysqli_error($link));
        }else{
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }
}