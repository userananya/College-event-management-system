
<?php include('partials-front/menu.php') ?>
<?php
//check whether the event id is set or not
 if(isset($_GET['food_id']))
 {
    //food_id is set and get the id
    $food_id= $_GET['food_id'];
    //Get the category title based on club  id
    $sql = "SELECT * from tbl_food WHERE id=$food_id";
    //Execute the query
    $res = mysqli_query($conn,$sql);
    $count =mysqli_num_rows($res);
    //check whether the data is available or not
    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];      
        $image_name = $row['image_name']; 
        $club = $row['club'];       

    }
    else
    {
        //event not Available
        //Redirect to home page
    header('location:'.SITEURL);

    }
   
 }
 else
 {
    
    //Redirect to home page
    header('location:'.SITEURL);
 }
 ?>


    <!-- event sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">      
            <h2 class="text-center text-white">Fill this form to register.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend class="text-yellow">Selected Event</legend>

                    <div class="food-menu-img">
                    <?php
                //check whether the image is available or not
                 if($image_name=="")
                 {
                   //display massage
                 echo "<div class='error'>Image not Available</div>"; 
                 }
                 else
                 {
                    //image available
                    ?>
                      <img src="<?php echo SITEURL;?>images/event/<?php echo $image_name;?>" class=" img-responsive img-curve" >

                    <?php

                 }
                ?>       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3 class="text-white"><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">
                        <input type="hidden" name="club" value="<?php echo $club ?>">
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend class="text-yellow">Registration Details</legend>
                    <div class="text-yellow order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ananya Samanta" class="input-responsive" required>

                    <div class="text-yellow order-label">Stream</div>
                    <input type="text" name="stream" placeholder="E.g. CSE" class="input-responsive" required>
                    
                    <div class=" text-yellow order-label">Semester</div>
                    <input type="number" name="sem" placeholder="E.g. 6" class="input-responsive" required>

                    <div class="text-yellow order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class=" text-yellow order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g.abcd.drf.in@gmail.com" class="input-responsive" required>

                    <div class="text-yellow order-label">Student Code</div>
                    <input type="password" name="stu_code" placeholder="NIT/2024/3457" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Registration" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the details from the form
                $food = $_POST['food'];
                $club = $_POST['club'];
                $order_date=date("Y-m-d h:i:sa");
                $status = "ordered";
                $customer_name =$_POST['full-name'];
                $stream =$_POST['stream'];
                $sem =$_POST['sem'];
                $customer_contact =$_POST['contact'];
                $customer_email =$_POST['email'];
                $stu_code =$_POST['stu_code'];
                //save the order in the database
                //create SQL to save the data
                $sql2 = "INSERT INTO tbl_order SET
                 food='$food',
                 club='$club',
                 order_date= '$order_date',
                 customer_name= '$customer_name',
                 stream= '$stream',
                 sem= $sem,
                 customer_contact= '$customer_contact',
                 customer_email= '$customer_email',
                stu_code= '$stu_code'    
                 ";
                 //echo $sql2; die();
                 //Execute query
                 $res2 = mysqli_query($conn,$sql2);
                 if($res2==true){
                    //query executed and register saved                
                    $_SESSION['order'] = "<div class='success text-center'>Registered successfully</div>";
                    //Redirect to home page
                    header("location:".SITEURL);
            
                }
                else{
                    //failed to save register
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Register </div>";
                    header("location:".SITEURL);
                }


            }
            
            
            ?>

        </div>
    </section>
    <!-- event sEARCH Section Ends Here -->
    <?php include('partials-front/footer.php') ?>

   