<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Event</h2><br/>
        <?php
        if(isset($_GET['id']))
        {
           //Get the id of selected food
           $id=$_GET['id'];

            $sql = "SELECT*FROM tbl_food WHERE id=$id";
               //Execute the query
            $res = mysqli_query($conn,$sql);
            
                //count rows to check whether the id is valid or not
                $count =mysqli_num_rows($res);//Function to count all the rows in the database
                 if($count==1){
                    //Get the details
                    $row =mysqli_fetch_assoc($res);
                    $title= $row['title'];
                    $description= $row['description'];
                    $price= $row['price'];
                    $location= $row['location'];
                    $date= $row['date'];
                    $time= $row['time'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $club = $row['club'];
                    $featured= $row['featured'];
                    $active = $row['active'];
                    
                 }
                 else{
                  $_SESSION['no-food-found'] = "<div class='error'>Event not found</div>";
                  header("location:".SITEURL.'admin/manage-event.php');
               }

          }
               
          else{
                    //Redirect to manage event page
                    header("location:".SITEURL.'admin/manage-event.php');
         }
            


         ?>
        <form action="" method="POST" enctype="multipart/form-data">   
        <table >
             <tr>
                <td><pre>Title:  </pre></td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
             </tr>
             <tr>
                <td><pre>Description:  </pre></td>
                <td><textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea></td>
            </tr>
             <tr>
                <td><pre>Price:  </pre></td>
                <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
             </tr>
             <tr>
                <td><pre>Event location:  </pre></td>
                <td><input type="text" name="location" value="<?php echo $location; ?>"></td>
             </tr>
             <tr>
                <td><pre>Event Date:  </pre></td>
                <td><input type="date" name="date" value="<?php echo $date; ?>"></td>
             </tr>
             <tr>
                <td><pre>Event Time:  </pre></td>
                <td><input type="text" name="time" value="<?php echo $time; ?>"></td>
             </tr>
             <tr>
                <td><pre>Current Image:  </pre></td>
                <td>
                  <?php
                       if($current_image!="")
                       {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL?>images/event/<?php echo $current_image; ?>" width="150px">
                        <?php
                       }
                       else
                       {
                        //Display Message
                         echo "<div class='error'>Image not added</div>";

                       }
                  
                  
                  ?>
                </td>
             </tr>
             <tr>
                <td><pre>Club:  </pre></td>
                <td>
                    <select  name="category">
                     <?php
                    //create php code to display clubs from database
                    //create sql query to get all active clubs from database
                    $sql1= "SELECT * FROM tbl_category WHERE active='Yes'";
                    //Executing query
                    $res1 = mysqli_query($conn,$sql1);
                    //count rows to check whether we hava clubs or not
                    $count1 = mysqli_num_rows($res1);
                    //If count is greater than 0 then we have clubs else we donot have clubs
                    if($count1>0)
                    {
                        //we have category
                        while($row1=mysqli_fetch_assoc($res1))
                        {
                            //get the details of clubs
                            $category_id=$row1['id'];
                            $category_title=$row1['title'];
                            ?>
                             <option <?php if($current_category==$category_id){ echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php

                        }
                    }
                    else
                    {
                        //we donot have club
                        ?>
                        <option value="0">No Club Found</option>
                        <?php
                    }
                   ?>
                        
            </td>
            
             </tr>
             <tr>
                <td><pre>Club:  </pre></td>
                <td><input type="text" name="club" value="<?php echo $club; ?>"></td>
             </tr>
             <tr>
                <td><pre>New Image:  </pre></td>
                <td><input type="file" name="image"></td>
             </tr>
             <tr>
                <td><pre>Featured:  </pre></td>
                <td><input <?php if($featured=="Yes"){ echo "checked";} ?>  type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No</td>
             </tr>
             <tr>
                <td><pre>Active:  </pre></td>
<td><input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
<input <?php if($active=="No"){ echo "checked";}?> type="radio" name="active" value="No">No</td>
             </tr>
             <tr>
                <td  colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value="<?php echo $id ;?>">  
                <input type="submit" name="submit" value="Update Event" class="btn-secondary">
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
     $description=$_POST['description'];
     $price=$_POST['price'];
     $location=$_POST['location'];
     $date=$_POST['date'];
     $time=$_POST['time'];
     $current_image=$_POST['current_image'];
     $category=$_POST['category'];
     $club=$_POST['club'];
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
        $image_name = "Event_Club_".rand(000,999).'.'.$ext;//e.g.Event_club_456.jpg
        
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path="../images/event/".$image_name;
                //Finally upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload </div>";
                     //Redirect page to Add-food
                     header("location:".SITEURL.'admin/manage-event.php');
                     //STOP the process.because we dont want to insert data without image in database
                     die();
                }
                 //B.Remove the current image if available
                 if($current_image!="")
                 {
                  $remove_path = "../images/event/".$current_image;
                  $remove = unlink($remove_path);
                  //check whether the image is removed or not
                  //If failed to remove then display message and stop the process
                  if($remove==false){
                   //failed to remove image
                   $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                   header("location:".SITEURL.'admin/manage-event.php');
                  
                  }
                 }               
               }
               else
            {
               $image_name = $current_image;//Default image when image is not selected
            }             
            }
            else
            {
               $image_name = $current_image;//Default image when button is not clicked
            }

    
    //3. create sql query to update event
    $sql2= "UPDATE tbl_food SET
    title='$title' ,
    description='$description' ,
    price='$price' ,
    location='$location' ,
    date='$date' ,
    time='$time' ,
    image_name='$image_name',
    category_id='$category',
    club='$club',
    featured='$featured' ,
    active='$active' 
    WHERE id='$id'
    ";
    //Execute the query
    $res2 = mysqli_query($conn,$sql2);
    if($res2==True){
        
      echo'
      <script>
      alert("Event updated successfully");
      window.location ="manage-event.php";
      </script>
  
      ';

    }
    else{
      echo'
      <script>
      alert("failed to update event");
      window.location ="manage-event.php";
      </script>
  
      ';
        
    }
}
?>
</div>
</div>
<?php include('partials/footer.php');?>