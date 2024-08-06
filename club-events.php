<?php include('partials-front/menu.php') ?>
<?php
//check whether the id is passed or not
 if(isset($_GET['category_id']))
 {
    //club_id is set and get the id
    $category_id= $_GET['category_id'];
    //Get the club title based on club id
    $sql = "SELECT title from tbl_category WHERE id=$category_id";
    //Execute the query
    $res = mysqli_query($conn,$sql);
    //Get the value from database
    $row = mysqli_fetch_assoc($res);
    //Get the title
    $category_title = $row['title'];
 }
 else
 {
    //club not passed
    //Redirect to home page
    header('location:'.SITEURL);
 }
 ?>

    <!-- event sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2  class="text-yellow">Events on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- event sEARCH Section Ends Here -->



    <!-- events Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Events</h2>
            <?php
            //create sql query to get events based on selected club
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
            //Execute the query
            $res2 = mysqli_query($conn,$sql2);
             //count rows to check whether the event is available or not
            $count2 =mysqli_num_rows($res2);
            if($count2>0)
            {
               //events available
               while($row2=mysqli_fetch_assoc($res2))
               {
            
               //Get the values like id,title,image_name
               $id=$row2['id'];
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
                if($image_name=="")
                 {
                   //display massage
                 echo "<div class='error'>Event not Available</div>"; 
                 }
                 else{
                 
                    //image available
                    ?>
                  <img src="<?php echo SITEURL;?>images/event/<?php echo $image_name;?>" class="img-responsive img-curve" >
                  <?php
                 } 
                 ?>
    
                </div>

                <div class="food-menu-desc">
                    <h4 style="color: black"><?php echo $title ; ?></h4>
                    <p style="color:blue"class="food-price">₹<?php echo $price  ; ?></p>
                    <p class="food-price">location: <?php echo $location  ; ?></p>
                    <p class="food-price">Date: <?php echo $date  ; ?></p>
                    <p class="food-price">Time: <?php echo $time  ; ?></p>
                    <p class="food-price">Club: <?php echo $club  ; ?></p>
                    <p class="food-detail">
                    <?php echo $description ; ?>
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
                //event not available
                echo "<div class='error'>Event not Available</div>"; 
            }
            ?>  

            <div class="clearfix"></div>

            

        </div>

    </section>
    

    <?php include('partials-front/footer.php') ?>

</body>
</html>