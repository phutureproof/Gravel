<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Whoops</title>
        <style>
	        @import url(https://fonts.googleapis.com/css?family=Montserrat);
            html, body {
	            font-family: 'Montserrat';
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .container {
                display: table;
                width: 100%;
                height: 100%;
                font-size: 2em;
                text-align: center;
            }

            .error {
                display: table-cell;
                width: 100%;
                height: 100%;
                vertical-align: middle;
	            text-shadow: 2px 2px 2px rgba(125, 125, 125, 0.38);
            }

            h1 {
                margin: 0;
            }
        </style>
    </head>
    <body>
       <div class="container">
           <div class="error">
               <h1>Whoops....</h1>
               <p>Looks like you've found a page that doesn't exist!</p>
           </div>
       </div>
    </body>
</html>