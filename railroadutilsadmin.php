<?php

// Function createa DB connection

function connectToDB()
{   
    global $conn;
    
    $servername = "localhost";
    $username = "root";         // For SECS server
    $username = "nsoltysiak";      // For SECS server
    $password = "18password19";     //For SECS server
    $dbname = "nsoltysiak";        // For SECS server
    
    //echo "DEBUG: Connecting to DB <br>";
	$conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
    //echo "DEBUG: Connected successfully (". $conn->host_info. ") <br>";
    
}

function deleteRecord()
{
    global $conn;
    $TRIP_ID = $_POST['TRIP_ID'];
    
    if (!empty($TRIP_ID)){
        //echo "Here is the id: '$TRIP_ID'";
        $sql = "DELETE FROM trip WHERE TRIP_ID  = '$TRIP_ID'";
        //echo $sql . "<br>";
        if ($conn->query ($sql) == TRUE) {
            //echo "DEBUG: Record deleted <br>";
        }
        else
        {
            echo "Could not add record: " . $conn->connect_error . "<br>";
        }
    }
    else
    {
        echo "Must provide a TRIP_ID to delete a record a record <br>";
    }
}

//Search Functionality
function doSearch()
{
    global $conn;

    $searchTerm = trim($_POST['txtSearchTerm']);
    $sql = "SELECT * FROM trip WHERE TS_ARRIVAL LIKE '%" . $searchTerm . "%' OR TS_DEPARTURE LIKE '%" . $searchTerm . "%' OR TRACK_ID LIKE '%" . $searchTerm . "%' OR TRIP_ARR_TIME LIKE '%" . $searchTerm . "%' OR TRIP_DEP_TIME LIKE '%" . $searchTerm . "%'";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {         
        
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Available Trip Reservations</h2>";
        
        //Start Search
        echo "<div class='search-container'><div class ='search'><form id='insertForm' action='{$thisPHP}' method='post'>";
        echo "<input type='text' name='txtSearchTerm' style='float:left'><input type='submit' name='btnSearch' value='Search' style='float:left'>";
        echo "</form></div></div>";
        //End Search
        
        //Start Clear Search
        echo "<div class='search-container'><div class ='search'><form id='form' action='{$thisPHP}' method='post'>";
        echo "<input type='submit' name='fullDisplay' value='Clear Search Term'></form></div></div><br>";
        //End Clear Search
        
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th><th>Train ID</th></tr></thead>"; 
        while($row = $result->fetch_assoc()) 
        {
            echo '<tbody><tr class="row100">';
            $TRIP_ID = $row["TRIP_ID"];
            echo  
                  ' <td class="column100 column2" data-column="column2"> ' . $row["TS_DEPARTURE"] .
                  ' </td> <td class="column100 column3" data-column="column3"> ' . $row["TRIP_DEP_TIME"] .
                  ' </td> <td class="column100 column4" data-column="column4"> ' . $row["TS_ARRIVAL"] . 
    		      ' </td> <td class="column100 column5" data-column="column5"> ' . $row["TRIP_ARR_TIME"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRACK_ID"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRAIN_ID"] .
                  '</td>'; 
            echo "<form action='{$thisPHP}' method='post' style='display:inline' >";
            echo "</td></tr></tbody>";
            
            
        }
        //echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td><td>" . $_GET[w7] . "</td></tr></tfoot>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
        //Confirmation Table
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Selected Trip</h2>";
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th></tr></thead>"; 
        echo '<tbody><tr class="row100">';
        echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td></tr></tfoot>";
        
        echo "</td></tr></tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } 
    else 
    {
        echo "0 results";
    }
    
}


function showRailroadSchedule()
{
    global $conn;
    global $thisPHP;
    
    $sql = "SELECT TRIP_ID, TRIP_ARR_TIME, TRIP_DEP_TIME,TS_ARRIVAL,TS_DEPARTURE, TRACK_ID, TRAIN_ID FROM trip";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {         
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Available Trip Reservations</h2>";
        //Start Search
        echo "<div class='search-container'><div class ='search'><form id='insertForm' action='{$thisPHP}' method='post'>";
        echo "<input type='text' name='txtSearchTerm' style='float:left'><input type='submit' name='btnSearch' value='Search' style='float:left'>";
        echo "</form></div></div>";
        //End Search
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th><th>Train ID</th></tr></thead>"; 
        while($row = $result->fetch_assoc()) 
        {
            echo '<tbody><tr class="row100">';
            $TRIP_ID = $row["TRIP_ID"];
            echo  
                  ' <td class="column100 column2" data-column="column2"> ' . $row["TS_DEPARTURE"] .
                  ' </td> <td class="column100 column3" data-column="column3"> ' . $row["TRIP_DEP_TIME"] .
                  ' </td> <td class="column100 column4" data-column="column4"> ' . $row["TS_ARRIVAL"] . 
    		      ' </td> <td class="column100 column5" data-column="column5"> ' . $row["TRIP_ARR_TIME"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRACK_ID"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRAIN_ID"] .
                  '</td>'; 
            echo "<form action='{$thisPHP}' method='post' style='display:inline' >";
            echo "</td></tr></tbody>";
            
        }
        
        //echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td><td>" . $_GET[w7] . "</td></tr></tfoot>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
        //Confirmation Table
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Selected Trip</h2>";
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th></tr></thead>"; 
        echo '<tbody><tr class="row100">';
        echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td></tr></tfoot>";
        echo "</td></tr></tbody>";
        echo "</table>";
        echo "</div>";
        
        /*
        //Confirm Trip Button
        echo "<div class='search-container'><div class ='search'><form method='POST' action='{$thisPHP}'>";
        echo "<input type='submit' name='btnSet' value='Confirm Trip' style='float:left'>";
        echo "</form></div></div>";
        //End Confirm Trip Button
        */
        
        $sqlq = "UPDATE train SET TRAIN_CAPACITY = TRAIN_CAPACITY - 1 WHERE TRAIN_ID = '" .$_GET[w6]."'";
        $result = $conn->query($sqlq);
        
        /*
        //Decrements the train capacity when user selects a trip
        if (isset($_POST["btnSet"]))
        {
        echo 'alert("Here")';
        $sqlq = "UPDATE train SET TRAIN_CAPACITY = TRAIN_CAPACITY - 1 WHERE TRAIN_ID = '".$_GET[w1]."'";
        $result = $conn->query($sqlq);
        }
        */
        
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
    }
    
    else 
    {
        echo "0 results";
    }
    
    //echo "<h2>Selected Trip</h2>";
}

function showRailroadScheduleAdmin()
{
    global $conn;
    global $thisPHP;
    
    
    
    $sql = "SELECT TRIP_ID, TRIP_ARR_TIME, TRIP_DEP_TIME,TS_ARRIVAL,TS_DEPARTURE, TRACK_ID, TRAIN_ID FROM trip";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {         
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Available Trip Reservations</h2>";
        /*
        //Start Search
        echo "<div class='search-container'><div class ='search'><form id='insertForm' action='{$thisPHP}' method='post'>";
        echo "<input type='text' name='txtSearchTerm' style='float:left'><input type='submit' name='btnSearch' value='Search' style='float:left'>";
        echo "</form></div></div>";
        //End Search
        */
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th><th>Train ID</th><th>Delete?</th></tr></thead>";
        while($row = $result->fetch_assoc()) 
        {
            echo '<tbody><tr class="row100">';
            $TRIP_ID = $row["TRIP_ID"];
            echo  
                  ' <td class="column100 column2" data-column="column2"> ' . $row["TS_DEPARTURE"] .
                  ' </td> <td class="column100 column3" data-column="column3"> ' . $row["TRIP_DEP_TIME"] .
                  ' </td> <td class="column100 column4" data-column="column4"> ' . $row["TS_ARRIVAL"] . 
    		      ' </td> <td class="column100 column5" data-column="column5"> ' . $row["TRIP_ARR_TIME"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRACK_ID"] . 
                  '</td>  <td class="column100 column6" data-column="column6"> ' . $row["TRAIN_ID"] .
                  '</td> <td class="column100 column7" data-column="column7">'; 
            echo "<form action='{$thisPHP}' method='post' style='display:inline;border-width:0px;background-color:transparent;'>";
            echo "<input type='hidden' name='TRIP_ID' value='{$TRIP_ID}'>";
            echo "<input type='submit' name='btnDelete' value='Delete' style='z-index:1;'></form>";
            echo "</td></tr></tbody>";
            
        }
        
        //echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td><td>" . $_GET[w7] . "</td></tr></tfoot>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
        //Confirmation Table
        echo '<div class="limiter">';
        echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
        echo '<div class="table100 ver2 m-b-110">';
        echo "<h2>Selected Trip</h2>";
        echo '<table data-vertable="ver2" id="tableMainAdmin">';
        
        echo "<thead><tr class='row100 head'><th>Departure Station</th><th>Departure Time</th><th>Arrival Station</th><th>Arrival Time</th><th>Track ID</th><th>Train ID</th></tr></thead>"; 
        echo '<tbody><tr class="row100">';
        echo "<tfoot><tr class='row100'><td>" . $_GET[w1] . "</td><td>" . $_GET[w2] . "</td><td>" . $_GET[w3] . "</td><td>" . $_GET[w4] . "</td><td>" . $_GET[w5] . "</td><td>" . $_GET[w6] . "</td></tr></tfoot>";
        echo "</td></tr></tbody>";
        echo "</table>";
        echo "</div>";
        
        /*
        //Confirm Trip Button
        echo "<div class='search-container'><div class ='search'><form method='POST' action='{$thisPHP}'>";
        echo "<input type='submit' name='btnSet' value='Confirm Trip' style='float:left'>";
        echo "</form></div></div>";
        //End Confirm Trip Button
        */
        
        $sqlq = "UPDATE train SET TRAIN_CAPACITY = TRAIN_CAPACITY - 1 WHERE TRAIN_ID = '" .$_GET[w6]."'";
        $result = $conn->query($sqlq);
        
        /*
        //Decrements the train capacity when user selects a trip
        if (isset($_POST["btnSet"]))
        {
        echo 'alert("Here")';
        $sqlq = "UPDATE train SET TRAIN_CAPACITY = TRAIN_CAPACITY - 1 WHERE TRAIN_ID = '".$_GET[w1]."'";
        $result = $conn->query($sqlq);
        }
        */
        
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
    }
    
    else 
    {
        echo "0 results";
    }
    
    //echo "<h2>Selected Trip</h2>";
}


function displayInsertForm()
{
    global $thisPHP;
    
    // A heredoc for specifying really long strings
    $str = <<<EOD
    <form action='{$thisPHP}' method='post'>
    <fieldset>
        <legend>Journal Data Entry</legend> First Name:
        <input type="text" name="CUST_FNAME" size="30">
        <br> Last Name:
        <input type="text" name="CUST_LNAME">
        <br> Address:
        <input type="text" name="CUST_ADDRESS" size="30">
        <br> Email:
        <input type="text" name="CUST_EMAIL" size="30">
        <br> City:
        <input type="text" name="CUST_CITY" size="20">
        <br> State:
        <input type="text" name="CUST_STATE" list="states">
        <br>
        <datalist id="states">
            <option value="AL"></option>
            <option value="AK"></option>
            <option value="AZ"></option>
            <option value="AR"></option>
            <option value="CA"></option>
            <option value="CO"></option>
            <option value="CT"></option>
            <option value="DE"></option>
            <option value="FL"></option>
            <option value="GA"></option>
            <option value="HI"></option>
            <option value="ID"></option>
            <option value="IL"></option>
            <option value="IN"></option>
            <option value="IA"></option>
            <option value="KS"></option>
            <option value="KY"></option>
            <option value="LA"></option>
            <option value="ME"></option>
            <option value="MD"></option>
            <option value="MA"></option>
            <option value="MI"></option>
            <option value="MN"></option>
            <option value="MS"></option>
            <option value="MO"></option>
            <option value="MT"></option>
            <option value="NE"></option>
            <option value="NV"></option>
            <option value="NH"></option>
            <option value="NJ"></option>
            <option value="NM"></option>
            <option value="NY"></option>
            <option value="NC"></option>
            <option value="ND"></option>
            <option value="OH"></option>
            <option value="OK"></option>
            <option value="OR"></option>
            <option value="PA"></option>
            <option value="RI"></option>
            <option value="SC"></option>
            <option value="SD"></option>
            <option value="TN"></option>
            <option value="TX"></option>
            <option value="UT"></option>
            <option value="VT"></option>
            <option value="VA"></option>
            <option value="WA"></option>
            <option value="WV"></option>
            <option value="WI"></option>
            <option value="WY"></option>
        </datalist>
        <br> Zip Code:
        <input type="text" name="CUST_ZIP_CODE" size="30">
        <br> Username:
        <input type="text" name="CUST_USERNAME" size="30">
        <br> Password:
        <input type="text" name="CUST_PASSWORD" size="30">
        <br>
        <input type="submit" name="btnInsert" value="Insert"><br>
    </fieldset>
    </form>
EOD;

    echo $str;
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        //=================================================================
        //click on table body
        //$("#tableMainAdmin tbody tr").click(function () {
        $('#tableMainAdmin tbody').on('click', 'tr', function() {
            //get row contents into an array
            var tableData = $(this).children("td").map(function() {
                return $(this).text();
            }).get();
            var departurestation = tableData[0];
            var departuretime = tableData[1];
            var arrivalstation = tableData[2];
            var arrivaltime = tableData[3];
            var trackid = tableData[4];
            var trainid = tableData[5];
            window.location.href = "landingadmin.php?w1=" + departurestation + "&w2=" + departuretime + "&w3=" + arrivalstation + "&w4=" + arrivaltime + "&w5=" + trackid + "&w6=" + trainid;

        });

        $("#thebutton").click(function() {
            $('#tableMainAdmin > tbody').append('<tr class="datarow"><td>11111</td><td>22222</td><td>33333</td><td>44444</td><td>55555</td></tr>')
        })
    });

</script>
