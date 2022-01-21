<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$employee['name']}}, Your account has been created.</h2>
<br/>
Your registered email-id is {{$employee['email']}}
<br/>
Your password : {{$employee['password']}}
</body>

</html>