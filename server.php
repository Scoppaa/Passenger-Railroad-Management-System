<?php
    session_start();

    // Initializing Variables
    $fname = "";
    $lname = "";
    $initial = "";
    $address = "";
    $city = "";
    $state = "";
    $zip = "";
    $email = "";
    $roleid = "";
    $errors = array();

    // Connect to the database
    $db = mysqli_connect('localhost', 'nsoltysiak', '18password19', 'nsoltysiak');

    // If the register button is clicked
    if (isset($_POST['register']))
    {
        $fname = mysqli_real_escape_string($db, $_POST['fname']);
        $lname = mysqli_real_escape_string($db, $_POST['lname']);
        $initial = mysqli_real_escape_string($db, $_POST['initial']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $zip = mysqli_real_escape_string($db, $_POST['zip']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


        // Ensure that form fields are filled properly
        if (empty($fname))
        {
            array_push($errors, "First Name is required"); // Adds error to array of errors
        }
        if (empty($lname))
        {
            array_push($errors, "Last Name is required"); // Adds error to array of errors
        }
        if (empty($address))
        {
            array_push($errors, "Address is required"); // Adds error to array of errors
        }
        if (empty($city))
        {
            array_push($errors, "City is required"); // Adds error to array of errors
        }
        if (empty($state))
        {
            array_push($errors, "State is required"); // Adds error to array of errors
        }
        if (empty($zip))
        {
            array_push($errors, "Zip Code is required"); // Adds error to array of errors
        }
        if (empty($email))
        {
            array_push($errors, "Email Address is required"); // Adds error to array of errors
        }
        if (empty($password_1))
        {
            array_push($errors, "Password is required"); // Adds error to array of errors
        }

        if ($password_1 != $password_2)
        {
            array_push($errors, "The two passwords do not match");
        }

        // Check database to ensure unique email address
        $unique_user = "SELECT * FROM customer WHERE CUST_EMAIL='$email'";
        $unique_result = mysqli_query($db, $unique_user) or die(mysqli_error($db));

        if (mysqli_num_rows($unique_result)>0)
        {
            $name_error = "Sorry, that email address already exists";
        }

        else
        {
            // If there are no errors, save customer to database
            if (count($errors) == 0)
            {
                $password = md5($password_1);   // Encrypts password before storing in database
                $sql = "INSERT INTO customer (CUST_FNAME, CUST_LNAME, CUST_INITIAL, CUST_ADDRESS, CUST_CITY, CUST_STATE, CUST_ZIP_CODE, CUST_EMAIL, CUST_PASSWORD) VALUES ('$fname', '$lname', '$initial', '$address', '$city', '$state', '$zip', '$email', '$password')";
                $sql2 = "INSERT INTO customer_role (customer_id) SELECT CUST_ID FROM customer WHERE CUST_EMAIL='$email'";
                mysqli_query($db, $sql);
                mysqli_query($db, $sql2);
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: landing.php'); // redirect to home page
            }
        }
    }

    // Log user in from login page
    if (isset($_POST['login']))
    {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Ensure that form fields are filled properly
        if (empty($email))
        {
            array_push($errors, "Email Address is required"); // Adds error to array of errors
        }
        if (empty($password))
        {
            array_push($errors, "Password is required"); // Adds error to array of errors
        }

        if (count($errors) == 0)
        {
            $password = md5($password); // Encrypt password before comparing with that from database
            $query1 = "SELECT * FROM customer_role WHERE role_id=2 AND customer_id = (SELECT CUST_ID FROM customer WHERE CUST_EMAIL='$email' AND CUST_PASSWORD='$password')";
            $result1 = mysqli_query($db, $query1);
            $query2 = "SELECT * FROM customer_role WHERE role_id=1 AND customer_id = (SELECT CUST_ID FROM customer WHERE CUST_EMAIL='$email' AND CUST_PASSWORD='$password')";
            $result2 = mysqli_query($db, $query2);

            if (mysqli_num_rows($result1) == 1)
            {
                // Log user in
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: landingadmin.php'); // redirect to admin home page             
            }

            else if (mysqli_num_rows($result2) == 1)
            {
                // Log user in
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: landing.php'); // redirect to non-admin home page 
            }

            else
            {
                array_push($errors, "The email/password combination is incorrect");
            }
        }
    }

    // Logout
    if (isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['email']);
        header('location: login.php');
    }
?>