<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get started with FormSubmitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
   <div class="container-fluid p-0 m-0">
   <h1>Form Submitter</h1>
    <p>
    Precisa criar formulário e não possui um back-end? 
    </p>

    <div class="card">
        <div class="card-header">
            Exemplo de Formulário válido 
        </div>
        <p class="html">&lt;form action="<mark style="background-color: #ffc7fb !important;">https://formsubmit.co/your@email.com</mark>"
                                    method="POST"&gt;<br>
                                    <span class="gray">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" name="name" required&gt;<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="email" name="email" required&gt;<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;button type="submit"&gt;Send&lt;/button&gt;<br>
                                    </span>
                                    &lt;/form&gt;
                                </p>

    </div>
   </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>