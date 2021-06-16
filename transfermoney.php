<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="/css/nav.css"> -->

    <style type="text/css">
    
    body{
        overflow-x:hidden;
    }
    ul {
    position: relative;
    top:40px;
    list-style-type:none;
    right:-400px;
}

ul li a {
    text-decoration:none;
    color:rgb(255, 255, 255);
    display: block;
    font-family: 'Courier New', Courier, monospace;
    font-weight: bold;
    font-size: 23px;
}

ul li {
    width: 250px;
    text-align: center;
    display: inline-block;
}

ul li a:hover {
    color:rgb(0, 0, 0);
}

.navbar {
    height: 60px;
    width: 1599.99px;
    position:relative;   
    overflow:hidden;
    top:0px;
    z-index: 10;
    background-color:rgb(231, 29, 73);
    
}
.text{
    position:relative;
    top:-30px;
    left:-90px;
}

th{
    color:yellow;
}
      
      button{
           background-color:rgb(240, 158, 185);
           font-family: 'Courier New', Courier, monospace;
           font-weight: bold;
      }
      button:hover{
           background-color:rgb(231, 29, 73);
           color: pink;
      }
      #button1 {
          
           padding:10px;
           margin-left:530px;
           margin-top:7px;
           margin-bottom:20px;
           padding-right:20px;
           padding-left:20px;
           font-size:17px;
           font-family: 'Courier New', Courier, monospace;
           font-weight: bold;
           background-color:#0066CC;
           color:white; 
          }

      #button1:hover {
          background-color:white; 
          color: #0066CC;
           }
      .table{
          background-color: #0066CC;
          text-align:center;
          border-color:white;
          font-family: 'Courier New', Courier, monospace;
          font-size: 20px;
          color:white;
         
      }
      .th{
          background-color:rgb(0, 0, 0);
          font-weight: bold;
         
    }
     
    </style>
</head>

<body>
<script>
    function sweetalertclick(){
            swal({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success",
        });


        }
</script>
<?php
    include 'config.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>

<?php
  include 'navbar.php';
?>

<div class="container-fluid">
        <h2 class="text-center pt-4"style="font-family: 'Courier New', Courier, monospace;font-weight: bold;font-size: 35px">TRANSFER MONEY</h2>
        <button onclick="location.href='transactionhistory.php'" type="button" class="btn" id="button1">Go To Transaction History</button>
        <br>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                    <table class="table table-hover table-sm table-striped table-condensed table-bordered">
                        <thead>
                            <tr>
                            <th class="text-center py-2">ID</th>
                            <th class="text-center py-2">CUSTOMER NAME</th>
                            <th class="text-center py-2">EMAIL</th>
                            <th class="text-center py-2">ACCOUNT BALANCE</th>
                            <th class="text-center py-2">TRANSACTION</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="py-2"><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['name']?></td>
                        <td class="py-2"><?php echo $rows['email']?></td>
                        <td class="py-2"><?php echo $rows['balance']?></td>
                        <td><a href="selecteduserdetail.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn" style="background-color:yellow; color: #0066CC;">Transact</button></a></td> 
                    </tr>
                <?php
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>
         
</body>
</html>

