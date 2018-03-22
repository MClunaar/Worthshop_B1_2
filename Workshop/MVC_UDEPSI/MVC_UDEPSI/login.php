<? session_start();?>
<html>

<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>


<form action="controller/login_test.php" method="POST" class="form-group ">

    <input class="form-control" style="margin:50px;" type="text" id="login" name="login"  placeholder="Login">
    <input class="form-control" style="margin:50px;" type="password" id="mdp" name="mdp"  placeholder="Mot de passe">
    <!--<input class="form-control" style="margin:50px;" type="hidden" id="id" name="id">-->
    <button type="submit" class="btn btn-default" >Submit</button>

</form>



</body>
</html>
