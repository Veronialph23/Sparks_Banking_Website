<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="sweetalert.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning !","Oops! Negative values cannot be transferred","warning")';
        echo '}, 100);</script>';
    }


  
   
    else if($amount > $sql1['balance']) 
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Error","Bad Luck! Insufficient Balance","error")';
        echo '}, 100);</script>';
      
    }
    


    
    else if($amount == 0){

        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Warning !","Oops! Zero value cannot be transferred","warning")';
        echo '}, 100);</script>';

     }


    else {
        
               
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                
                if($query){
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Transaction successful!","You have successfully transfered your money.","success").then(function() {
                         window.location = "transactionhistory.php";
                            });';
                    echo '}, 100);</script>';     
                   
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Amount Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
    
    body{
          background-image:url('https://cdn.hipwallpaper.com/i/95/42/U9fJTZ.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed;  
          background-size: cover;
          overflow-x:hidden;
          
        }

    .input-container {
          display: -ms-flexbox; /* IE10 */
          display: flex;
          width: 100%;
          margin-bottom: 15px;
        }

    .icon {
          padding-top:6px;
          padding-bottom:2px;
          background-color: #0066CC;
          color: white;
          min-width: 50px;
          text-align: center;
        }

    .input-field {
          width: 100%;
          padding: 10px;
          outline: none;
          height:100%;
       } 

    .input-field:focus {
          border: 2px solid dodgerblue;
       }

    button {
          background-color: rgb(231, 29, 73);
          color: white;
          padding: 15px 20px;
          border: none;
          cursor: pointer;
          width: 100%;
          opacity: 0.9;
    }

    .btn:hover {
          opacity: 1;
    } 

    .btn:hover {
          background-color:rgb(240, 158, 185);
          color:black;
          opacity: 1;
    }
    
    table{
          background-color:#0066CC;
          text-align:center;
          border-color:white;
          font-family: 'Courier New', Courier, monospace;
          font-size: 20px;
         
         }
    	
    th{
        color:yellow;
    }
    
    
    </style>
</head>

<body>

<?php
  include 'navbar.php';
?>

	<div class="container">
        <h2 class="text-center pt-4"style="font-family: 'Courier New', Courier, monospace;font-weight: bold;font-size: 35px">TRANSACTION</h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <br>
        <div>
            <table class="table table-striped table-condensed table-bordered"style=" background-color:#0066CC;
          text-align:center;
          border-color:white;
          color:white;
          font-family: 'Courier New', Courier, monospace;
          font-size: 20px;">
                <tr>
                    <th class="text-center">S.No</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">email</th>
                    <th class="text-center">Account Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <form method="post" name="tcredit" class="tabletext"style="max-width:500px;margin:auto" >
        <label><h3 style="font-family: 'Courier New', Courier, monospace;font-weight: bold;font-size: 35px">TRANSACT:</h3></label>
        <div class="input-container">
        <i class="fa fa-user-o icon fa-lg"style="padding-top:12px;" ></i>
        <select name="to" class="input-field" required>
            <option value="" disabled selected >Choose Receiver</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        </div>
    
          
            <div class="input-container" >
                   <i class="fa fa-inr icon fa-2x"style="height:41px;"></i>
            <input type="number" class="input-field" name="amount" required placeholder="Enter Amount">   
            </div>
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="myBtn" style="font-family: 'Courier New', Courier, monospace;font-weight: bold;font-size: 20px; background-color:#0066CC"><B>TRANSFER</B></button><br><br>


            </div>
        </form>
    </div>

</body>
</html>


