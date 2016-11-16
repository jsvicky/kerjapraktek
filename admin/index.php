<!DOCTYPE html>
<html>
<head><title>Login Administrator CV.VD Production</title>


<link href="style_login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="halaman/validasi/sixgha.js"></script>
<script type="text/javascript" src="halaman/validasi/sixgha-validation.js"></script>

</head>
  <body OnLoad="document.login.username.focus();">
  <body>
    <form id="login" name="login" method="POST" action="cek_login.php"> 
    <h1 align="center">Login Administrator</h1>
    
    <div>
    	<label for="username">Username</label> 
    	<input type="text" name="username" id="username" class="field required" title="Username harus di isi" />
    </div>			

    <div>
    	<label for="password">Password</label>
    	<input type="password" name="password" id="password" class="field required" title="Password harus di isi" />
    </div>			
    
    <div class="submit"><button type="submit">Login</button></div>
   
    <p class="copyright">Copyright &copy; 2016 by <a href="#">CV.VD Production</a>. All rights reserved.</p>
    </form>	
  </body>
</html>
