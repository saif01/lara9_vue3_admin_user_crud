<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="{{ asset('all-assets\common\bootstrap-5.0.2\css\bootstrap.min.css') }}" />
</head>
<body>
    <div class="container">
        <h1 class="text-center">Test</h1>
        <a  href="{{ url('/test/pdf') }}" target="_blank" >Check Snappy PDF</a><br>
        <a  href="{{ url('/test/ldap') }}" target="_blank" >Check LDAP Connection</a><br>
        <a  href="{{ url('/test/oracle') }}" target="_blank" >Check Oracle Connection</a><br>


    </div>
   
    
</body>
</html>