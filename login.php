<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Google Font Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(to right,#2cbaf2,#2696ff,#2cbaf2,#2cbaf2);

  padding: 30px;
}

.container {
  position: relative;
  max-width: 850px;
  width: 100%;
  background: #fff;
  padding: 40px 30px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  perspective: 2700px;
}

.container .cover {
  position: absolute;
  top: 0;
  left: 50%;
  height: 100%;
  width: 50%;
  z-index: 98;
  transition: all 1s ease;
  transform-origin: left;
  transform-style: preserve-3d;
  backface-visibility: hidden;
}

.container #flip:checked ~ .cover {
  transform: rotateY(-180deg);
}

.container #flip:checked ~ .forms .login-form {
  pointer-events: none;
}

.container .cover .front,
.container .cover .back {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.cover .back {
  transform: rotateY(180deg);
}

.container .cover img {
  position: absolute;
  height: 100%;
  width: 100%;
  object-fit: cover;
  z-index: 10;
}

.container .cover .text {
  position: absolute;
  z-index: 10;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.container .cover .text::before {
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  opacity: 0.5;
  background: black;
}

.cover .text .text-1,
.cover .text .text-2 {
  z-index: 20;
  font-size: 26px;
  font-weight: 600;
  color: #fff;
  text-align: center;
}

.cover .text .text-2 {
  font-size: 15px;
  font-weight: 500;
}

.container .forms {
  height: 100%;
  width: 100%;
  background: #fff;
}

.container .form-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-content .login-form,
.form-content .signup-form {
  width: calc(100% / 2 - 25px);
}

.forms .form-content .title {
  position: relative;
  font-size: 24px;
  font-weight: 500;
  color: #333;
}

.forms .form-content .title:before {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 25px;
  background: #3189f5;
}

.forms .signup-form .title:before {
  width: 20px;
}

.forms .form-content .input-boxes {
  margin-top: 30px;
}

.forms .form-content .input-box {
  display: flex;
  align-items: center;
  height: 50px;
  width: 100%;
  margin: 10px 0;
  position: relative;
}

.form-content .input-box input {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  padding: 0 30px;
  font-size: 16px;
  font-weight: 500;
  border-bottom: 2px solid rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.form-content .input-box input:focus,
.form-content .input-box input:valid {

}

.form-content .input-box i {
  position: absolute;
  color: #2cbaf2;
  font-size: 17px;
}

.forms .form-content .text {
  font-size: 14px;
  font-weight: 500;
  color: #333;
}

.forms .form-content .text a {
  text-decoration: none;
}

.forms .form-content .text a:hover {
  text-decoration: underline;
}

.forms .form-content .button {
  color: #fff;
  margin-top: 40px;
}

.forms .form-content .button input {
  color: #fff;
  background: #31b4f5;
  border-radius: 6px;
  padding: 0;
  cursor: pointer;
  transition: all 0.4s ease;
}

.forms .form-content .button input:hover {
  background: #1d7cab;
}

.forms .form-content label {
  color: #5b13b9;
  cursor: pointer;
}

.forms .form-content label:hover {
  text-decoration: underline;
}

.forms .form-content .login-text,
.forms .form-content .sign-up-text {
  text-align: center;
  margin-top: 25px;
}

.container #flip {
  display: none;
}

@media (max-width: 730px) {
  .container .cover {
    display: none;
  }

  .form-content .login-form,
  .form-content .signup-form {
    width: 100%;
  }

  .form-content .signup-form {
    display: none;
  }

  .container #flip:checked ~ .forms .signup-form {
    display: block;
  }

  .container #flip:checked ~ .forms .login-form {
    display: none;
  }
}

#preloader {
		  position: fixed;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #fff;
		  z-index: 9999999; }
		
		.loader {
		  top: 50%;
		  width: 50px;
		  height: 50px;
		  border-radius: 100%;
		  position: relative;
		  margin: 0 auto; }
		
		#loader-1:before, #loader-1:after {
		  content: "";
		  position: absolute;
		  top: -10px;
		  left: -10px;
		  width: 100%;
		  height: 100%;
		  border-radius: 100%;
		  border: 7px solid transparent;
		  border-top-color: #3c9cfd; }
		
		#loader-1:before {
		  z-index: 100;
		  animation: spin 2s infinite; }
		
		#loader-1:after {
		  border: 7px solid #fafafa; }
		
		@keyframes spin {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg); }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg); } }

            .btn {
                display: inline-block; 
                padding: 10px 20px; 
                font-size: 16px; 
                color: white; 
                background-color: red; 
                border: none; 
                border-radius: 5px; 
                text-decoration: none; 
                transition: background-color 0.3s, transform 0.2s; 
                z-index: 2;
                margin-top: 20px;
                border: 2px solid white;
            }

            .btn-danger {
                background-color: #5dbff0; 
            }

            .btn:hover {
                background-color: #094461; 
                transform: scale(1.1); 
            }
            
            input{
                color: grey;
            }


    </style>
   </head>
<body>

                    <div id="preloader">
					  <div class="loader" id="loader-1"></div>
					</div>
					
					<!-- JavaScript to hide preloader after 2 seconds -->
					<script>
					  // Hide the preloader after 2 seconds (2000 milliseconds)
					  setTimeout(function() {
					    document.getElementById("preloader").style.display = "none";
					  }, 2000);
					</script>





  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
    <div class="front">
            <img src="images/lg-bg.jpg" alt="no img">
            <div class="text">
                <span class="text-1">Welcome back! <br> Access your library account</span>
                <span class="text-2">Log in to manage your books</span>
                <a href="index.php" class="btn btn-danger">Back to Home</a>
            </div>
        </div>
        <div class="back">
            <img src="images/lg-bg1.jpg" alt="no img">
            <div class="text">
                <span class="text-1">Start your reading journey <br> with just one click</span>
                <span class="text-2">Let's log in and explore</span>
                      
            </div>
        </div>

    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Staff Login</div>
          <form action="loginAction.php" method = "post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name = "gmail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name = "password" required>
              </div>
              <!-- <div class="text"><a href="#" style = "color: #2cbaf2;">Forgot password?</a></div> -->
              <div class="button input-box">
                <input type="submit" value="Login">
              </div>
              <div class="text sign-up-text" >Don't have an account? <label for="flip" style = "color: #2cbaf2">Sigup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Staff Signup</div>
        <form action="registerAction.php" method = "post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your fullname" name = "fullname" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name = "gmail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name = "password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Register">
                
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip" style = "color: #2cbaf2">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>

  
</body>
</html>