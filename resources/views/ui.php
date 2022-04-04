<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clipboard - A simple web storage for text</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
                    <textarea id="value-01" class="form-control" rows="3" name="<?php echo($key); ?>" id="<?php echo($key); ?>"><?php echo($value); ?></textarea>
                </div>
                
                <hr/>
                <?php } ?>
  
                <button type="submit" class="btn btn-default">Send</button>
            </form>
        </div>        
      </div>
    </div> <!-- /container -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
