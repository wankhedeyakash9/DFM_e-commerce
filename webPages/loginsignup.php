<html>
    <head>
        <title>furniture wala</title>
        <link rel="stylesheet" href="../styleSheets/loginSignup.css" >
        
        
    </head>
    <body>
        <div class="container" id="form-wrap">
            <button  class="btn lsbtn" id="login-btn">Login</button>
            <button class="btn lsbtn" id="signup-btn">Signup</button>
            <div id="logo"><img src="../dfmlogo.png" alt="dfm logo" id="dfmid"></div>
             <div id="container1">
                    <form action="login.php" method="post" class="login-form">
                        <h2 class="text-center text-info" class="h">Login</h2>
                        
                        <div id="l-mesg"></div>
                        
                        <div id="unamediv">
                            <label for="uname" class="label1">Username</label><br>
                            <input class="style1" type="text" name="uname" id="uid" placeholder="username" required><br>
                        </div> 
                        <div id="password-div">
                            <label for="password" class="label1"> Password</label><br>
                            <input class="style1"type="password" name="pwd" id="passid" placeholder="********" required>
                        </div>
                        <div id="submit-option">
                        <input style="align-content:right;"type="submit" name="Login" class="btn btn-primary btn-sm" value="Sign In"> 
                        <a href="./forget.php" class="lslink"><b>Forget Password?</b></a>
                        </div>

                    </form>
                    
            </div>
            
            <div id="container2">
                <form method="post" onsubmit="return valid()" action="signup.php" id="signup-form">
                    <div>
                        <h2  class="text-center text-info" class="h">Signup</h2>
            
                        <div id="s-mesg"></div>
                        
                        <label for="Ufullname" class="label1">Username</label><br>
                        <input  class="style1" type="text" name="fullname" id="fname" placeholder="Username" required>
                        <br>    
                        <label for="email-address" class="label1">Email-address</label><br>
                        <input class="style1" title="after @ dot(.)should be there" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" name="email" id="eid" placeholder="abcdefghij@email.com" required>
                        <br>
                        <label  for="contact-number" class="label1">Contact-number</label><br>
                        <input pattern="[0-9]{10}" title="Please input 10 digit number" class="style1" type="number" name="cnumber" id="cnum" placeholder="+91" required><br>
                        <label for="password" class="label1">Password </label>
                        <br><input pattern=".{8,}" title="Password Should Be More Than 8 Characters" class="style1"type="password" name="password" id="spid" placeholder="********"required><br>
                        <label class="label1">Repeat Password</label>
                        <br><input class="style1"type="password" name="rpassword" id="respid" placeholder="reenter the password" required>
                        <br>
                        <input type="submit" name="signup" value="Sign Up">
                        <a href="#" id="already" class="lslink"><b> Already a Member?</b></a>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>
<script type="text/javascript" src="../scripts/loginsignup.js"> </script>
