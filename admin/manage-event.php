<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
           <h2>Manage Events</h2>
           <br/><br/>
           <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset ($_SESSION['add']);//Removing sesion message
           }
           if(isset($_SESSION['delete']))
           {
               echo $_SESSION['delete'];
               unset ($_SESSION['delete']);
           }
           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset ($_SESSION['upload']);
           }
           if(isset($_SESSION['failed-remove']))
           {
               echo $_SESSION['failed-remove'];
               unset ($_SESSION['failed-remove']);
           }
           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset ($_SESSION['update']);
           }
           ?>
           <br/>
        <!-- Button to add admin -->
         <a href="add-event.php"  class="btn-primary">Add Event</a>
         <br/><br/>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Club</th>
                <th>Image</th> 
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
                <th>See Registration</th>
            </tr>
            <?php
            //Query to get all events from database

               $sql = "SELECT*FROM tbl_food";
               //Execute the query

               $res = mysqli_query($conn,$sql);

                //count rows to check whether we have data in database or not

                $count =mysqli_num_rows($res);//Function to get all the rows in the database
                $sn=1 ;// create a variable and assign the variable 
                if($count>0){
                  //we have data in the database
                  //get the data and display
                  while($rows=mysqli_fetch_assoc($res)){


                    //using while loop to get all data from database
                    //And while loop will run as long as we have data in database
                    //Get individual data

                    $id=$rows['id'];
                    $title=$rows['title'];
                    $price=$rows['price'];
                    $location=$rows['location'];
                    $date=$rows['date'];
                    $time=$rows['time'];
                    $club=$rows['club'];
                    $image_name=$rows['image_name'];
                    $featured=$rows['featured'];
                    $active=$rows['active'];
                    //Display the values in our table
                    ?>
                    <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td>₹<?php echo  $price; ?></td>
                <td><?php echo  $location; ?></td>
                <td><?php echo  $date; ?></td>
                <td><?php echo  $time; ?></td>
                <td><?php echo  $club; ?></td>
                <td>
                <?php
                //check whether the image name is available or not
                if($image_name!=""){
                    //Display the image
                    ?>
                    <img src="<?php echo SITEURL;?>images/event/<?php echo $image_name;?>" width="100px" >
                    <?php

                }
                else
                {
                    //display the error message
                    echo "<div class='error'>Image not added</div>";
                }
                ?>
                </td>
                <?php
                //<td><?php echo $image_name; </td>?>        
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                
                <a href="<?php echo SITEURL;?>admin/update-event.php? id=<?php echo $id; ?>" class="btn-secondary"> Update </a>
                <a href="<?php echo SITEURL;?>admin/delete-event.php? id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete </a>
                </td>
                <td>
                
                <a href="<?php echo SITEURL;?>admin/event-register.php? id=<?php echo $id; ?>" class="btn-secondary2">Registration </a>
                </td>
                  </tr>
                    <?php

                  }
                }else{
                   //we donot have data in the database
                   ?>
                   <tr>
                    <td colspan="6"><div class="error">No event added.</div></td>
                   </tr>
                   <?php

                }
               
            ?>
            
       </table>
       
       
        </div>
       
    </div>

<?php include('partials/footer.php'); ?>