<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Club</h2><br/>
        <?php
        if(isset($_GET['id']))
        {
           //Get the id of selected category
           $id=$_GET['id'];

            $sql = "SELECT*FROM tbl_category WHERE id=$id";
               //Execute the query
            $res = mysqli_query($conn,$sql);
            
                //count rows to check whether the id is valid or not
                $count =mysqli_num_rows($res);//Function to count all the rows in the database
                 if($count==1){
                    //Get the details
                    $row =mysqli_fetch_assoc($res);
                    $title= $row['title'];
                    $current_image = $row['image_name'];
                    $featured= $row['featured'];
                    $active = $row['active'];
                    
                 }
                 else{
                  $_SESSION['no-category-found'] = "<div class='error'>Club not found</div>";
                  header("location:".SITEURL.'admin/manage-club.php');
               }

          }
               
          else{
                    //Redirect to manage club page
                    header("location:".SITEURL.'admin/manage-club.php');
         }
            


         ?>
        <form action="" method="POST" enctype="multipart/form-data">   
        <table >
             <tr>
                <td><pre>Title:  </pre></td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
             </tr>
             <tr>
                <td><pre>Current Image:  </pre></td>
                <td>
                  <?php
                       if($current_image!="")
                       {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL?>images/club/<?php echo $current_image; ?>" width="150px">
                        <?php
                       }
                       else
                       {
                        //Display Message
                         echo "<div class='error'>Club not added</div>";

                       }
                  
                  
                  ?>
                </td>
             </tr>
             <tr>
                <td><pre>New Image:  </pre></td>
                <td><input type="file" name="image"></td>
             </tr>
             <tr>
                <td><pre>Featured:  </pre></td>
                <td><input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){ echo "checked";}?>type="radio" name="featured" value="No">No</td>
             </tr>
             <tr>
                <td><pre>Active:  </pre></td>
<td><input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
<input <?php if($active=="No"){ echo "checked";} ?>type="radio" name="active" value="No">No</td>
             </tr>
             <tr>
                <td  colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value="<?php echo $id ;?>">  
                <input type="submit" name="submit" value="Update Club" class="btn-secondary">
                </td>
             </tr>
         </table>
         </form>  
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    //1. Get all the values from form to update
    $id=$_POST['id'];
     $title=$_POST['title'];
     $current_image=$_POST['current_image'];
     $featured=$_POST['featured'];
     $active=$_POST['active'];
     //2.updating new image if selected
     //check whether the image is selected or not

    if(isset($_FILES['image']['name']))
    {
      //Get the image details
      $image_name = $_FILES['image']['name'];
      //check whether the image is available or not
      if($image_name!="")
      {
         //Image available
         //A. upload the new image

        
         //Auto rename our image
        //Get the extension of our image (jpg,png etc) //e.g.food.jpg
        $ext= end(explode('.',$image_name));
        //Rename the image
        $image_name = "Event_Club_".rand(000,999).'.'.$ext;//e.g.Food_category_456.jpg
        
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/club/".$image_name;
                //Finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload </div>";
                     //Redirect page to Add-category
                     header("location:".SITEURL.'admin/manage-club.php');
                     //STOP the process.because we dont want to insert data without image in database
                     die();
                }
                 //B.Remove the current image if available
                 if($current_image!="")
                 {
                  $remove_path = "../images/club/".$current_image;
                  $remove = unlink($remove_path);
                  //check whether the image is removed or not
                  //If failed to remove then display message and stop the process
                  if($remove==false){
                   //failed to remove image
                   $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                   header("location:".SITEURL.'admin/manage-club.php');
                   die();//stop the process
 
                  }
                 }               

               }
               else
               {
                  $image_name = $current_image;
               }
            }
            else
            {
               $image_name = $current_image;
            }

    
    //3. create sql query to update Club
    $sql2= "UPDATE tbl_category SET
    title='$title' ,
    image_name='$image_name',
    featured='$featured' ,
    active='$active' 
    WHERE id='$id'
    ";
    //Execute the query
    $res2 = mysqli_query($conn,$sql2);
    if($res2==True){
        
        $_SESSION['update'] = "<div class='success'>Club updated successfully</div>";
        //Redirect  to Manage-club page
        header("location:".SITEURL.'admin/manage-club.php');

    }
    else{
        
        $_SESSION['update'] = "<div class='error'>Failed to update club</div>";
        //Redirect  to Manage-clubpage
        header("location:".SITEURL.'admin/manage-club.php');
    }
}
?>
</div>
</div>






<?php include('partials/footer.php');?>