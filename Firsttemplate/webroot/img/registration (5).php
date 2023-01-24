<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="./assest/js/script.js"></script> -->
<!-- <link rel="stylesheet" href="./assest/css/style.css"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- <script src="script/script.js"></script> -->
    <title>RegistrationForm</title>
    <style>
    .error{
      color: red;
    }
    #emailErr{
      color:red;
    }
    #success{
      color: green;
    }
    #firstnameErr{
      color:red;
    }
    a{
      /* color: white;   */
      /* text-decoration: none; */
      /* height: 10px; */
    }
    /* button{
      margin:10px 0 0 100px;
    } */
    </style>
   
</head>
<body>
   
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100 box">

          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-12 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registration Form</p>
                      <!-- <p></p> -->
                      <span id="success"></span>
                      <!-- <div class="alert alert-danger" role="alert" id="erRR"></div> -->
                      <p style="color:red;"><span id="erRR"></span></p>
                      <p style="color:green;"></p>
                      <form class="row g-3" method = "post" name="form" id="regform">
                        <div class="col-md-6">
                        <label for="inputFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name"name="first_name"><span id="firstnameErr"></span>
                        </div>
                        <div class="col-md-6">
                        <label for="inputLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name"name="last_name">
                        <span id="lastnameErr"></span>
                        </div>
                        <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span id ="emailErr"></span>
                        </div>
                        <div class="col-md-6">
                        <label for="inputPhoneNumber" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number"name="phone_number">
                        <span id ="PhoneErr"></span>
                        </div>
                        <div class="col-md-6">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span id ="passwordErr"></span>

                        </div>
                        <div class="col-md-6">
                        <label for="inputCPassword4" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="c_password"name="c_password">
                        <span id ="c_passwordErr"></span>

                        </div>
                        <div class="col-md-12 mt-5">
                          <section>
                        <label for="inputPassword4" class="form-label">Gender</label>
                        <input type="radio"  id="gender"name="gender"value="Male" checked>Male
                        <input type="radio"  id="gender"name="gender"value="Female">FeMale
                        <input type="radio"  id="gender"name="gender"value="Other">Other
                        <br>
                        <!-- <span id ="gender_Err"></span> -->
                        </div>
                        <div class="col-12 mt-2">
                          
                          <button type="submit" name="submit" id= "button" class="button btn-primary">Sign Up</button>
                         <br><br> <p>if you have already account-><a href="login.php">Sign in</a></p>
                          
                        </div>
                        </form>
      
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>