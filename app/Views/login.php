
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('movie.css')?>"> 
</head>
<body>
<div class="register">
    <form action="/loginUser" method="post">
        <h1>Login</h1>
        <h4><?php echo session()->getFlashData("error")?></h4>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"> 
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" >  
        <button type="submit" class="btn">Login</button>
        <p> Does'nt have an account?<a href="./register"> Register here</a></p>
    </form>
</div>
</body>
</html>