<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
        <h2>Manage Registration</h2>
        <br/><br/>
        <?php
        if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset ($_SESSION['update']);//Removing sesion message
           }
           ?>
           <br>
           <?php
           if(isset($_GET['id']))
 {
   
    //club_id is set and get the id
    $event_id= $_GET['id'];
    //Get the club title based on club id
    $sql1 = "SELECT * from tbl_food WHERE id=$event_id";
    //Execute the query
    $res1 = mysqli_query($conn,$sql1);
    //Get the value from database
    $row1 = mysqli_fetch_assoc($res1);
    //Get the title
    $event_title = $row1['title'];
 }
 else
 {
    //club not passed
    
    header('location:'.SITEURL.'admin/manage-event.php');
 }
 ?>
        
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Registered Event</th>
                <th>club</th>
                <th><pre>Registration Date </pre></th>
                <th><pre>Name  </pre></th>
                <th><pre>Stream  </pre></th>
                <th><pre>Sem  </pre></th>
                <th><pre>Contact  </pre></th>
                <th><pre>Email   </pre></th>
                <th><pre>stu-code  </pre></th>
                <th><pre>Actions  </pre></th>             

            </tr>
            <?php
            //Query to get all registers from database

               $sql = "SELECT*FROM tbl_order WHERE  food = '$event_title'";
               //Execute the query

               $res = mysqli_query($conn,$sql);

                //count rows to check whether we have data in database or not

                $count =mysqli_num_rows($res);
                //Function to get all the rows in the database
                $sn=1 ;// create a variable and assign the variable 
                ?>
                <b style="color:blue">Event name:<?php echo $event_title; ?></b><br/>
                <b  style="color:blue">Total registration:<?php echo $count; ?></b><br/></br>
                <?php
                if($count>0){
               //Register available
                  while($row=mysqli_fetch_assoc($res)){


                    //using while loop to get all data from database
                    //And while loop will run as long as we have data in database
                    //Get all the register details

                    $id=$row['id'];
                    $food=$row['food'];
                    $club=$row['club'];
                    $order_date=$row['order_date'];
                    $customer_name=$row['customer_name'];
                    $stream=$row['stream'];
                    $sem=$row['sem'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $stu_code=$row['stu_code'];
                    //Display the values in our table
                    ?>
                    <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $food; ?></td>
                <td><?php echo $club; ?></td>
                <td><?php echo $order_date; ?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $stream; ?></td>
                <td><?php echo $sem; ?></td>
                <td><?php echo $customer_contact; ?></td>
                <td><?php echo $customer_email; ?></td>
                <td><?php echo $stu_code; ?></td>
        
                <td>
                <a href="<?php echo SITEURL;?>admin/update-register.php? id=<?php echo $id; ?>" class="btn-secondary"> Update Register</a>
                </td>
                  </tr>
                    <?php

                  }
                }else{
                   //Register not available
                   ?>
                   <tr>
                    <td colspan="6"><div class="error">No Registration on this event.</div></td>
                   </tr>
                   <?php

                }
               
            ?>
            
       </table>
       
        </div>
       
    </div>

<?php include('partials/footer.php'); ?>