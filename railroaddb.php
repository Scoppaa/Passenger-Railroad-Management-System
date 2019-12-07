<!doctype html>
<html>

<head>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="util.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <?php
    session_start();
    include "railroadutils.php";

    // echo "DEBUG: Session Login Value = " . $_SESSION['login'] . "<br>";
    
    if (!isset($_SESSION['login']) || $_SESSION['login'] == '')
    {
        echo $_SESSION['login'];
        header ("Location: login.php");
    } 
    
    
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
        showRailroadSchedule();
        //showRailroadScheduleAdmin();
    }
    
    
    //Display table showing customer records by search term
    
    else if ($displayAction == 'doSearch')
    {
        doSearch();
    }

    else if ($displayAction == 'fullDisplayEntries')
    {
        showRailroadSchedule();
    }
    $conn->close();
?>
</body>

</html>
