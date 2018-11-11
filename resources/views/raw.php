<html>
<head>
<title></title>
</head>
</html>
<body>
    <?php foreach ($storedValue as $key => $value) {?>
        <h4><?php echo(htmlentities($key)); ?></h4>
        <p><?php echo(htmlentities($value)); ?></p>
    <?php } ?>    
</body>
</html>
