<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
    <h1>登录</h1>
    <form action="/user/login/" method="post">
        @csrf
        <input type="text" name="name"><br>
        <input type="password" name="password"><br>
        <input type="submit" value="登录">
    </form>
</body>
</html>
