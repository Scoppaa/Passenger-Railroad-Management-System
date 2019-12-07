<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>   

<div class="container">
    <div class="row">
        <div class="header col-sm-12 mt-3">
            <h2>Passenger Railroad Management System</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm">
            <h3>Create an account</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm">

            <form method="post" action="register.php" class="mt-1 mb-4">
                <!-- Display validation errors here -->
                <?php include('errors.php'); ?>
                
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $fname; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $lname; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="initial" class="col-sm-3 col-form-label">Middle Initial</label>
                    <div class="col-sm-9">
                        <input type="text" name="initial" class="form-control form-box-width" id="initial" value="<?php echo $initial; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" id="address" value="<?php echo $address; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" name="city" class="form-control" id="city" value="<?php echo $city; ?>">
                    </div>

                    <label for="state" class="col-sm-1 col-form-label">State</label>
                    <div class="col-sm-2">
                        <select name="state" class="form-control" id="state">
                            <option>AL</option>
                            <option>AK</option>
                            <option>AZ</option>
                            <option>AR</option>
                            <option>CA</option>
                            <option>CO</option>
                            <option>CT</option>
                            <option>DE</option>
                            <option>FL</option>
                            <option>GA</option>
                            <option>HI</option>
                            <option>ID</option>
                            <option>IL</option>
                            <option>IN</option>
                            <option>IA</option>
                            <option>KS</option>
                            <option>KY</option>
                            <option>LA</option>
                            <option>ME</option>
                            <option>MD</option>
                            <option>MA</option>
                            <option>MI</option>
                            <option>MN</option>
                            <option>MS</option>
                            <option>MO</option>
                            <option>MT</option>
                            <option>NE</option>
                            <option>NV</option>
                            <option>NH</option>
                            <option>NJ</option>
                            <option>NM</option>
                            <option>NY</option>
                            <option>NC</option>
                            <option>ND</option>
                            <option>OH</option>
                            <option>OK</option>
                            <option>OR</option>
                            <option>PA</option>
                            <option>RI</option>
                            <option>SC</option>
                            <option>SD</option>
                            <option>TN</option>
                            <option>TX</option>
                            <option>UT</option>
                            <option>VT</option>
                            <option>WA</option>
                            <option>WV</option>
                            <option>WI</option>
                            <option>WY</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="zip" class="col-sm-3 col-form-label">Zip Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="zip" class="form-control" id="zip" value="<?php echo $zip; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password1" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password_1" class="form-control" id="password1">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password2" class="col-sm-3 col-form-label">Verify Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password_2" class="form-control" id="password2">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="d-flex justify-content-between input-group">
                        <button type="submit" name="register" class="btn btn-success buttons">Register</button>
                        <a href="login.php" class="btn btn-danger buttons" role="button">Already a member?  Sign in here</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>
</html>