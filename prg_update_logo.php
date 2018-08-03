<?php session_start();

include("db_config.php");
//print_r($_FILES);

    //$error 		= array();
    $extension 	= array("jpeg","jpg","png","gif","PNG","JPG");

    $count_new_img = 0;

    foreach($_FILES["imgtoadd"]["tmp_name"] as $key=>$tmp_name)
    {

        $file_name 	= $_FILES["imgtoadd"]["name"][$key];
        $file_tmp 	= $_FILES["imgtoadd"]["tmp_name"][$key];
        $ext 		= pathinfo($file_name,PATHINFO_EXTENSION);

        //print_r($ext);

		$destin_img_name = 'company-logo.'.$ext;
        $destin_img     = 'img/'.$destin_img_name;

        if(in_array($ext,$extension))
        {

        	$add_logo_bfor_query = "SELECT * FROM `company`;";
        	$result = $conn->query($add_logo_bfor_query);

        	if($result->num_rows>0){

        		$update_logo_url_query = "UPDATE `company` SET `logo` = '".$destin_img."', `updated`='".date("Y-m-d")."' WHERE `company`.`id` = 1;";
        		$update_result = $conn->query($update_logo_url_query);
        		if($update_result === TRUE){
        			echo $destin_img;
        		}

        	}
        	else{

        		$add_logo_url_query = "INSERT INTO `company` (`created`, `updated`, `logo`) VALUES ('".date("Y-m-d")."', '".date("Y-m-d")."', '".$destin_img."');";
        		$add_result = $conn->query($add_logo_url_query);
        		if($add_result === TRUE){
        			echo $destin_img;
        		}

        	}

            move_uploaded_file($file_tmp = $_FILES["imgtoadd"]["tmp_name"][$key],$destin_img);
        }
        else{
        	echo 0;
        }

    }
?>
<?php $conn->close(); ?>