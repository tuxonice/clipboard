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
                <h2>1. How to use</h2>
                <p><code>[GET] <?php echo($host); ?>/ui</code></p>
                <p>Clipboard user interface with pre generated hash</p>
                
                <p><code>[GET] <?php echo($host); ?>/ui/{hash}</code></p>
                <p>Clipboard user interface with hash</p>
                
                <p><code>[POST] <?php echo($host); ?>/{hash}</code></p>
                <p>Post content to clipboard using the hash {hash}</p>
                
                <p><code>[GET] <?php echo($host); ?>/{hash}</code></p>
                <p>Get content of the clipboard for the hash {hash} in JSON format</p>
                
                <p><code>[GET] <?php echo($host); ?>/raw/{hash}</code></p>
                <p>Get content of the clipboard for the hash {hash} in raw format</p>
                
                <p><code>[GET] <?php echo($host); ?>/xml/{hash}</code></p>
                <p>Get content of the clipboard for the hash {hash} in XML format</p>
                
                <h2>2. Hash format</h2>
                <p>Hash value valid characters: <b>a</b> to <b>z</b>, <b>0</b> to <b>9</b>, <b>:</b>, <b>-</b>, <b>.</b> and <b>_</b></p>
                
                <h2>3. Limit rate</h2>
                <p>Endpoint rate limit is 60 requests per minute</p>

                <h2>4. Cache lifetime</h2>
                <p>The content lifetime is <?php echo($cachetimeout); ?> minutes from the last POST request</p>

                <h3>License</h3>
                <p>
                    <small>THE SERVICE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                            SOFTWARE.
                    </small>
                </p>
            </div>
        </div>        
      </div>
    </div> <!-- /container -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>

