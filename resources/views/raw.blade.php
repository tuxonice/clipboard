<html lang="en">
<head>
<title></title>
</head>
<body>
@foreach ($storedValue as $key => $value)
<h4>{{ $key }}</h4>
<p>{{ $value }}</p>
@endforeach
</body>
</html>
