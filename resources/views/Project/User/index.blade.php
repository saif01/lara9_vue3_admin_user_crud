<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="container">

        
       <div class="mt-3  ">
            <a class="btn btn-success"  href="{{ url('/test/pdf') }}" target="_blank" >Check Snappy PDF</a>
            <a class="btn btn-info"  href="{{ url('/test/ldap') }}" target="_blank" >Check LDAP Connection</a>
            <a class="btn btn-warning"  href="{{ url('/test/oracle') }}" target="_blank" >Check Oracle Connection</a>
             <a class="btn btn-secondary"  href="{{ url('/test/phpinfo') }}" target="_blank" >Check PHP Info</a>
            <div>Laravel Version: {{ App::VERSION() }}. PHP Version: {{ phpversion() }} </div>
       </div>

        <hr>

        <div id="app">
            <index-component testdata="testing"/>
        </div>

    </div>

    @vite('resources/js/Project/User/js/app.js')
</body>
</html>