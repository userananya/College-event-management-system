<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Event</h2><br/>
        <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset ($_SESSION['add']);//Removing sesion message
           }
           ?>
           <br/> 
      <!-- Add club form starts -->
        <form  action="" method="POST" enctype="multipart/form-data">
         <table >
             <tr>
                <td><pre>Title:  </pre></td>
                <td><input type="text" name="title" placeholder="Title of the event"></td>
             </tr>
            <tr>
                <td><pre>Description:  </pre></td>
                <td><textarea name="description" cols="30" rows="5" placeholder="Description of the event"></textarea></td>
             </tr> 
             <tr>
                <td><pre>Price:  </pre></td>
                <td><input type="number" name="price"></td>
             </tr>
             <tr>
                <td><pre>Event Location:  </pre></td>
                <td><input type="text" name="location"></td>
             </tr>
             <tr>
                <td><pre>Event Date:  </pre></td>
                <td><input type="date" name="date"></td>
             </tr>
             <tr>
                <td><pre>Event Time:  </pre></td>
                <td><input type="text" name="time"></td>
             </tr>
             <tr>
             <tr>
                <td><pre>Select Image:  </pre></td>
                <td><input type="file" name="image"></td>
             </tr>
             <tr>
                <td><pre>Club:  </pre></td>
                <td>
                    <select  name="category">
                     <?php
                    //create php code to display clubs from database
                    //create sql query to get all active clubs from database
                    $sql= "SELECT * FROM tbl_category WHERE active='Yes'";
                    //Executing query
                    $res = mysqli_query($conn,$sql);
                    //count rows to check whether we hava clubs or not
                    $count = mysqli_num_rows($res);
                    //If count is greater than 0 then we have clubs else we donot have clubs
                    if($count>0)
                    {
                        //we have clubs
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the details of clubs
                            $id=$row['id'];
                            $title=$row['title'];
                            ?>
                             <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                <td><input type="text" name="club"></td>
             </tr>
             <tr>
                <td><pre>featured:  </pre></td>
                <td><input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No</td>
             </tr>
             <tr>
                <td><pre>Active:  </pre></td>
                <td><input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No</td>
             </tr>
             <tr>
                <td  colspan="2">
                    <input type="submit" name="submit" value="Add Event" class="btn-secondary">
                </td>
             </tr>
         </table>
        </form>
        <?php
        //check whether the submit button is clicked or not
         if(isset($_POST['submit'])){
            //echo "clicked";
            //1. Get the value from  form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $location = $_POST['location'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $category = $_POST['category'];
            $club = $_POST['club'];
            //For radio input,we need to check whether the button is selected or not
             if(isset($_POST['featured']))
             {
                //get the value from form
                $featured = $_POST['featured'];
             }else{
                //set the default value
                $featured = "No";
             }
             if(isset($_POST['active']))
             {
                //get the value from form
                $active = $_POST['active'];
             }else{
                //set the default value
                $active = "No";
             }
            //2. upload the image if selected
            //check whether the image is selected or not
             if(isset($_FILES['image']['name']))
             {
                //upload the image
                //To upload image we need image name,source path and destination path
                $image_name=$_FILES['image']['name'];
                //upload the image only if image is selected
   if($image_name!=""){
        //Auto rename our image
        //Get the extension of our image (jpg,png etc) //e.g.food.jpg
        $ext= end(explode('.',$image_name));
        //Rename the image
        $image_name = "Event_Name_".rand(000,999).'.'.$ext;//e.g.Food_category_456.jpg
        
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/event/".$image_name;
                //Finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image </div>";
                     //Redirect page to Add-event
                     header("location:".SITEURL.'admin/add-event.php');
                     //STOP the process.because we dont want to insert data without image in database
                     die();

                }
   }
             }else{
                //Don't upload image and set default value as blank
                $image_name="";

             }

             //2. create SQL query to insert data into database
             //For numerical value we dont need to pass value under quotes'' but string value it is compulsary

             $sql2 = "INSERT INTO tbl_food SET
             title='$title',
             description ='$description',
             price= $price,
             location= '$location',
             date= '$date',
             time= '$time',
             image_name='$image_name',
             category_id='$category',
            club='$club',
             featured ='$featured',
             active ='$active'
             ";
             // Execute query and save in database
             $res2= mysqli_query($conn,$sql2);
             if($res2==True){
               echo'
               <script>
               alert("Event added successfully");
               window.location ="manage-event.php";
               </script>
           
               ';
        
            }
            else{
               echo'
               <script>
               alert("Failed to add event");
               window.location ="manage-event.php";
               </script>
           
               ';
            }
         }
         ?>
</div>
</div>
<?php include('partials/footer.php'); ?>
       