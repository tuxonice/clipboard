<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clipboard - A simple web storage for text</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style>
    body {
  padding-top: 50px;
  padding-bottom: 20px;
}

.form-group.required label:after {
  content:" *";
  color:red;
}

   </style> 
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <span class="navbar-brand">Clipboard - A simple web storage for text</span>
        </div>        
      </div>
    </nav>  
      
      
    <div class="container">
      <div class="row">
        <div class="col-md-12">		
            
            <div class="page-header">
  <h2>Clipboard - User Interface</h2>
</div>
            
            <form action="/<?php echo($hash); ?>" method="post" id="main-form">
                <p class="help-block">Hash: <?php echo($hash); ?></p>
				<?php foreach($storedArray as $key => $value) { ?>
                
                <div class="form-group">
                    <label for="value-01">Value</label>
                    <textarea class="form-control" rows="3" name="<?php echo($key); ?>" id="<?php echo(htmlentities($key)); ?>"><?php echo(htmlentities($value)); ?></textarea>
                </div>
                
                <hr/>
                <?php } ?>
  
                <button type="submit" class="btn btn-default">Send</button>
            </form>
        </div>        
      </div>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
