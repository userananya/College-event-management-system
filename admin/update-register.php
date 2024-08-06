<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h2>Update Register</h2>
    <br/><br/>
<?php
        if(isset($_GET['id']))
        {
           //Get the id of selected event
           $id=$_GET['id'];

            $sql = "SELECT*FROM tbl_order WHERE id=$id";
               //Execute the query
            $res = mysqli_query($conn,$sql);         
                $count =mysqli_num_rows($res);
                 if($count==1){
                    // details available
                    $row =mysqli_fetch_assoc($res);
                    $food=$row['food'];
                    $club=$row['club'];
                    $order_date=$row['order_date'];
                    $customer_name=$row['customer_name'];
                    $stream=$row['stream'];
                    $sem=$row['sem'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $stu_code=$row['stu_code'];
                    
                 }
                 else{
                  //details not available
                  header("location:".SITEURL.'admin/manage-register.php');
               }

          }
               
          else{
                    //Redirect to manage register page
                    header("location:".SITEURL.'admin/manage-register.php');
              }
            


         ?>
        <form action="" method="POST" enctype="multipart/form-data">   
        <table >
             <tr>
                <td><pre>Event Name: </pre></td>
                <td><b><?php echo $food; ?></b></td>
             </tr>
             <tr>
                <td><pre>Club: </pre></td>
                <td><b><?php echo $club; ?></b></td>
             </tr>
             <tr>
                <td><pre>Student Name:  </pre></td>
                <td>
                <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>
            <tr>
                <td><pre> Stream:  </pre></td>
                <td>
                <input type="text" name="stream" value="<?php echo $stream; ?>">
                </td>
            </tr>
            <tr>
                <td><pre>Semester:  </pre></td>
                <td>
                <input type="number" name="sem" value="<?php echo $sem; ?>">
                </td>
            </tr>
            <tr>
                <td><pre>Student Contact:  </pre></td>
                <td>
                <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"> 
                </td>
            </tr>
            <tr>
                <td><pre>Student Email:  </pre></td>
                <td>
                <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>
            <tr>
                <td><pre>Student Code:  </pre></td>
                <td>
                <input type="password" name="stu_code" value="<?php echo $stu_code; ?>">
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                    <input type="submit" name="submit" value="Update Register" class="btn-secondary">
                </td>
             </tr>
        </table>
        </form>
        <?php
            // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the details from the form
                $id= $_POST['id'];
                $customer_name =$_POST['customer_name'];
                $stream =$_POST['stream'];
                $sem =$_POST['sem'];
                $customer_contact =$_POST['customer_contact'];
                $customer_email =$_POST['customer_email'];
                $stu_code =$_POST['stu_code'];               
                //create SQL to update the data
                $sql2 = "UPDATE  tbl_order SET
                 customer_name= '$customer_name',
                 stream= '$stream',
                 sem= '$sem',
                 customer_contact= '$customer_contact',
                 customer_email= '$customer_email',
                 stu_code= '$stu_code' 
                 WHERE id=$id   
                 ";
                 //echo $sql2; die();
                 //Execute query
                 $res2 = mysqli_query($conn,$sql2);
                 if($res2==true){
                    //query executed and order updated                
                    $_SESSION['update'] = "<div class='success text-center'>Register updated successfully</div>";
                     header("location:".SITEURL.'admin/manage-register.php');
            
                }
                else{
                    //failed to update
                    $_SESSION['update'] = "<div class='error text-center'>Failed to update register</div>";
                    header("location:".SITEURL.'admin/manage-register.php');
                }


            }
            
            
            ?>

        </div>
        </div>
        <?php include('partials/footer.php'); ?>