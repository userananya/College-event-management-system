
    <?php include('partials-front/menu.php') ?>
    <section class="food-search text-center">
        <div class="container">
            
            <h3 style="color:white">Event Central: Your Campus Connection</h3><br/>
             <p style="color:yellow">Welcome to our college event management  portal! Discover and participate in a diverse range of events, from exciting competitions to engaging workshops. Stay updated on schedules, register with ease, and connect with fellow students.Whether you're looking to showcase your talents, gain new skills, or simply have fun, our platform is designed to enhance your college experience. Join us in making every event a standout moment and connect with your peers through engaging and well-organized activities! Join us in making every event a memorable experience!</p>
             <br>

        </div>
    </section>
    <?php
           if(isset($_SESSION['order']))
           {
               echo $_SESSION['order'];
               unset ($_SESSION['order']);//Removing sesion message
           }
        ?>
    <!-- Club Section Starts Here -->
    <section class="categories">
        <div class="container">
     <h2 class="text-center">Clubs</h2>        
  <?php
     //create SQL Query to display clubs from database
     $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 6";
     //Execute the query
     $res = mysqli_query($conn,$sql);
      //count rows to check whether the club is available or not
     $count =mysqli_num_rows($res);
     if($count>0)
     {
        //club available
        while($row=mysqli_fetch_assoc($res))
     {
        //Get the values like id,title,image_name
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        ?>
        <a href="<?php echo SITEURL;?>club-events.php?category_id=<?php echo $id;?>">
    
            <div class="box-3 float-container">
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
                      <img src="<?php echo SITEURL;?>images/club/<?php echo $image_name;?>" class="img-responsive img-curve"  >

                    <?php

                 }
                ?>
              

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
                
            </a>

        <?php

     }
    }
    else
    {
        //clubs not available
        echo "<div class='error'>Image not added</div>";
    }
     
  ?>
           
            <div class="clearfix"></div>
            <p class="text-center">
            <a href="club.php">See All Clubs</a>
        </p>
        </div>
    </section>
    <!-- Club Section Ends Here -->

    <!-- event Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Events</h2>
            <?php
            //create SQL Query to display events from database
     $sql2 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 2";
     //Execute the query
     $res2 = mysqli_query($conn,$sql2);
      //count rows to check whether the club  is available or not
     $count2 =mysqli_num_rows($res2);
     if($count2>0)
     {
        //clubs available
        while($row2=mysqli_fetch_assoc($res2))
     {
        //Get the values like id,title,image_name
        $id= $row2['id'];
        $title= $row2['title'];
        $price= $row2['price'];
        $club= $row2['club'];
        $description= $row2['description'];       
        $location= $row2['location'];       
        $date= $row2['date'];       
        $time= $row2['time'];       
        $image_name = $row2['image_name'];
        ?>
         <div class="food-menu-box">
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
                      <img src="<?php echo SITEURL;?>images/event/<?php echo $image_name;?>" class="img-responsive img-curve" >

                    <?php

                 }
                ?>       
                
                </div>

                <div class="food-menu-desc">
                    <h4 style="color: black"><?php echo $title; ?></h4>
                    <p style="color:blue"class="food-price">₹<?php echo $price; ?></p>
                    <p class="food-price">Location: <?php echo $location; ?></p>
                    <p class="food-price">Date: <?php echo $date; ?></p>
                    <p class="food-price">Time: <?php echo $time; ?></p>
                    <p class="food-price">Club: <?php echo $club; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?> 
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>register.php?food_id=<?php echo $id;?>" class="btn btn-primary">Register Now</a>
                </div>
            </div>  

        <?php

     }
    }
    else
    {
        //clubs not available
        echo "<div class='error'>Image not added</div>";
    }
     
  ?>
            <div class="clearfix"></div>     

        <p class="text-center">
            <a href="events.php">See All Events</a>
        </p>
    </section>
    <!-- events Section Ends Here -->
    <?php include('partials-front/footer.php') ?>

   

    