<?php
//Include constant file
include('../config/constant.php');
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
// Get the value and delete
$id = $_GET['id'];
$image_name = $_GET['image_name'];
//Remove the physical image file is available
if($image_name!="")
{
    //Image is available,so remove it
    $path ="../images/club/".$image_name;
    //Remove image
    $remove =unlink($path);
    //if failed to remove image then add an error massage and stop the process
    if($remove==false)
    {
        //set the session message
        $_SESSION['remove'] = "<div class='error'>Failed to Remove Club Image</div>";
        //Redirect to Manage-club page
    header("location:".SITEURL.'admin/manage-club.php');
    //stop the process
    die();
    }
}
//SQL query to delete data from database
$sql = "DELETE FROM tbl_category where id=$id";
//Execute the query
$res=mysqli_query($conn,$sql);
//check whether the data is delete from database or not
if($res==true){
    //query executed successfully and club deleted

    //create SESSION variable to display message
    $_SESSION['delete'] = "<div class='success'>Club deleted successfully</div>";
    //Redirect page to Manage-club
    header("location:".SITEURL.'admin/manage-club.php');

}
else{
    //Failed to delete club
   
    $_SESSION['delete'] = "<div class='error'>Failed to delete club</div>";
    //Redirect page to Manage Club
    header("location:".SITEURL.'admin/manage-club.php');
}

}else{
    //Redirect to Manage-club page
    header("location:".SITEURL.'admin/manage-club.php');
}


?>