<html>
   <head>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/examples/cover/cover.css" />
   </head>
   <body class="text-center">
      <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
         <header class="masthead mb-auto">
            <div class="inner">
               <h3 class="masthead-brand">Phoenix</h3>
               <nav class="nav nav-masthead justify-content-center">
                  <a class="nav-link active" href="#">My Project</a>
                  <a class="nav-link" href="#">Login</a>
               </nav>
            </div>
         </header>
         <main role="main" class="inner cover">
            <h1 class="cover-heading">Welcome to My Creative Project.</h1>
            <p class="lead">It is just a simulation how it will work with Phoenix!</p>
            <div style="background: white; padding:50px;">
               <code> <?php echo $data; ?> </code>
            </div>

            <br><br>
            <input type="hidden" id="quote_id" value="<?php echo $quote_id; ?>">
            <input type="hidden" id="sku" value="<?php echo $sku; ?>">
            <input type="number" id="qty" value="1" min="1" max="5">
            <button class="btn btn-primary" id="send">Add product to cart</button>
         </main>
         <footer class="mastfoot mt-auto">
            <div class="inner">
            </div>
         </footer>
      </div>
   </body>

   <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
        $('#send').click(function(){
            jsonData = {
                "quote_id": $('#quote_id').val(),
                "qty": $('#qty').val(),
                "sku": $('#sku').val()
            }
            $.ajax({
                url: "/creative-project/add",
                type: 'GET',
                dataType: 'jsonp',
                contentType: "application/json; charset=utf-8",
                data: jsonData,
                success: function(data) { $(location).attr('href', 'https://dev.magento.digitalphoto.dev/checkout/cart/') },
                error: function(data) {console.log(data)}
            });
        })
    });

  </script>
</html>