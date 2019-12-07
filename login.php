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
                    <h3>Log in to your account</h3>
                </div>
        </div>

      <div class="row mt-3">
        <div class="col-sm">

          <form method="post" action="login.php" class="mt-1 mb-4">
          <!-- Display validation errors here -->
          <?php include('errors.php'); ?>

          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
          </div>

          <div class="form-group row">
            <div class="d-flex justify-content-between input-group">
              <button type="submit" name="login" class="btn btn-success buttons">Login</button>
              <a href="register.php" class="btn btn-danger buttons" role="button">Not yet a member? Sign up here</a>
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