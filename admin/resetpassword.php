<?phpsession_start();if(isset($_REQUEST['email'])){    include("dbconnection.php");$email=$_REQUEST['email'];$passkey=$_REQUEST['passkey'];$result=getUserByEmail($email);$user=mysql_fetch_array($result);}else{	header("location:index.php");}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>    <head><title>The Fun Kids Admin</title>        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>        <link rel="stylesheet" type="text/css" href="css/adminstyle.css" />	 <script src="js/jquery.min.js"></script>        <script src="js/jquery.js" type="text/javascript"></script>        <script src="js/jquery.validate.js" type="text/javascript"></script>        <script type="text/javascript">            $().ready(function() {                $("#LoginForrm").validate({                    rules: {                        email: {                            required: true,                            email: true                        },                        password: {                            required: true                        }                    },                    messages: {                        email: {                            required: "Please enter email address",                            email: "Email address must be in the format of name@domain.com"                        },                        password: {                            required: "Please enter a password"                        }                    }                });                $("#password").focus(function() {                    var password = $("#password").val();                    var email = $("#email").val();                    if(password && email && !this.value) {                        this.value = password + "." + email;                    }                });            });        </script>        <style>       .error {       color: #FF0000;    font-size: 11px;    font-weight: normal;    padding-left: 29px;       }       .error1 {       color: #FF0000;    font-size: 14px;    font-weight: bold;    padding-left: 29px;    }        </style>    </head>    <body>		<div class="wrapper">			<h2>The Fun Kids</h2>			<?php                if (isset($_REQUEST['msg'])) {                    ?>                    <p class="error1" align="center">Invalid user name or password</p>                    <?php                }                ?>                    <div class="content">                        <div id="form_wrapper" class="form_wrapper">                            <form id="LoginForrm" name="LoginForrm" class="login active" method="POST" action="resets_password.php">                                <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>" />                                <input type="hidden" name="email" value="<?php echo $user['email']; ?>" />                                <input type="hidden" name="passkey" value="<?php echo $passkey; ?>" />                                <h3>Reset Password</h3>                                <div>                                    <label>Password: </label>                                    <input type="password" id="password" name="password"/>                                    <span class="error">This is an error</span>                                </div>                                <input type="submit" value="Reset Password"></input>                                <div class="clear"></div>                            </form>                        </div>                        <div class="clear"></div>                    </div>                </div>    </body></html>