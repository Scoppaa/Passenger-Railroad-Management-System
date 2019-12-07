<?php include('server.php'); 

    // If the user is not logged in, they cannot access this page
    if (empty($_SESSION['email']))
    {
        header('location: login.php');
    }
?>

<?php include('railroadutilsadmin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="util.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
        <div class="row">
                <div class="header col-sm-12 mt-3">
                    <h2>Passenger Railroad Management System</h2>
                </div>
        </div>

        <div class="row">
            <div class="col-sm-7">

            </div>

            <div class="mt-3 welcome-login col-sm-4 align-self-end">

                <?php if (isset($_SESSION['email'])): ?>
                    <p class="welcome-info text-right">Welcome <br><strong><?php echo $_SESSION['email']; ?></strong><br><a href="http://secs.oakland.edu/phpmyadmin" class="welcome-info admin-access" target="_blank">Admin Access</a><br><a href="landing.php?logout='1'" class="welcome-info logout-color">Logout</a></p>
                <?php endif ?>

            </div>
        </div>

        <div class="row mt-3">

<div class="content col-sm">

    <?php
    
    //echo "<h2>Railroad DB Manager</h2>";

    //************//
    
    connectToDB();
    
    ///**********//
    
    $thisPHP = $_SERVER['PHP_SELF'];
    $databaseAction = '';            // No default modification action
    $displayAction = 'showRecords';      // Default display 

    if (isset($_POST['btnInsert']))
        $databaseAction = 'doInsert';
    if (isset($_POST["btnDelete"]))
        $databaseAction = 'doDelete';
    if (isset($_POST['showInsertForm']))
        $displayAction = 'showInsertForm';
    else
        $displayAction ='showRecords';
    if (isset($_POST['btnSearch']))
        $displayAction = 'doSearch';
    if (isset ($_POST['fullDisplay']))
        $displayAction = 'fullDisplayEntries';
    
    
    ///*****************//
    // Database Actions
    ///*****************//
    // These two are pre-display database actions.
    // Insertion or Deletion will be done prior to showCustomerRecords()
    // And thus, showCustomerRecords() will show updated database
    
    //Insert Action
    
    if ($databaseAction == 'doInsert')
    {
       insertRecord();
    }
    
    ///**********//
    
    //Delete Action
                  
    else if ($databaseAction == 'doDelete')
    {
        deleteRecord();
    }
    
    ///*****************//
    // Display Actions
    ///*****************//
    
    // Actions -- Either we will show the form for inserting customer Data; 
    // OR the Table with All Customers. 
    // In our implentation the two displays above are Mutually Exclusive.
    
    // Display Form for entering a customers's record
    //echo $displayAction;
        
    if ($displayAction == 'showInsertForm')
    {
        displayInsertForm();
    }
    
    // Default action: show always be true since inialized at script start
    // Display table showing all customer records
    
    else if ($displayAction == 'showRecords')
    {
        showRailroadScheduleAdmin();
    }
    
    
    //Display table showing customer records by search term
    
    else if ($displayAction == 'doSearch')
    {
        doSearch();
    }

    else if ($displayAction == 'fullDisplayEntries')
    {
        showRailroadScheduleAdmin();
    }
    $conn->close();
?>
    </div>
    </div>

  </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>