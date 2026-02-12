<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Register</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    align-items:center;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

/* Navbar */
.nav{
    width:100%;
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(10px);
}

.logo{
    color:white;
    font-weight:bold;
    font-size:20px;
}

.links a{
    color:white;
    text-decoration:none;
    margin-left:15px;
    padding:6px 14px;
    border-radius:6px;
    transition:.3s;
}

.links a:hover{
    background:white;
    color:#333;
}

/* Form Card */
.form-container{
    margin-top:50px;
    width:380px;
}

.form{
    background:rgba(255,255,255,.2);
    backdrop-filter:blur(20px);
    padding:40px 30px;
    border-radius:20px;
    display:flex;
    flex-direction:column;
    gap:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.form h2{
    text-align:center;
    color:white;
    margin-bottom:10px;
}

.input{
    padding:12px 14px;
    border:none;
    border-radius:10px;
    outline:none;
    font-size:15px;
}

.input:focus{
    box-shadow:0 0 0 2px rgba(255,255,255,.6);
}

button{
    border:none;
    padding:12px;
    border-radius:10px;
    background:white;
    color:#333;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#222;
    color:white;
}

.login-link{
    text-align:center;
    color:white;
    font-size:14px;
}

.login-link a{
    color:#fff;
    font-weight:bold;
}

.error-msg{
    background:#ffe6e6;
    color:#cc0000;
    padding:12px;
    margin:10px 0;
    border-left:5px solid red;
    border-radius:6px;
    font-size:16px;
    font-weight:500;
}


</style>
<link rel="stylesheet" href="css/style.css">

</head>

<body>


<div class="form-container">



<form class="form" method="post" action="handle/register.php">
    <h2>Create Account</h2>
<?php 
require_once 'inc/conn.php';
require_once 'errors/errors.php';

?>

    
    <input class="input" type="text" name="name" placeholder="Full Name" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?>" />
    <input class="input" type="email" name="email" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?>" />
    <input class="input" type="password" name="password" placeholder="Password" />
    <input class="input" type="text" name="phone" placeholder="Phone Number" value="<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone'] ?>" />

    <button type="submit" name="submit">Register</button>
    <p class="login-link">Already have an account? <a href="Login.php">Login</a>
</form>

</div>

</body>
</html>
