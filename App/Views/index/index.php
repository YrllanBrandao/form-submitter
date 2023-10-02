<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get started with FormSubmitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid p-0 m-0 d-flex container-main align-items-center flex-column pb-1">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Form Submitter <i class="fab fa-wpforms"></i></a>

        <!-- toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-nowrap" href="https://github.com/YrllanBrandao/form-submitter" target="_blank">
                        <i class="fab fa-github"></i> Repositório no GitHub
                    </a>
                </li>
            </ul>
        </div>
        </div>
      </nav>


        <h1>Form Submitter</h1>
        <p>
            Precisa enviar um formulário e não possui um back-end? basta usar o <a href="/" class="text-primary link-none">Form Submitter</a>
        </p>

        <div class="card">
            <div class="card-header">
                Exemplo de Formulário válido
            </div>
            <div class="card-body">
           
                <span>
                &lt;form action="<mark
                    class="bg-warning ">https://formsubmitter.infinityfreeapp.com/submit?target=seuemail@email.com</mark>"
                method="POST"&gt;<br>
                </span>
                <span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" name="name" required&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="email" name="email" required&gt;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;button type="submit"&gt;Send&lt;/button&gt;<br>
                </span>
               <span> &lt;/form&gt;</span>
           
            </div>

        </div>
        <br>
        <p>não é necessário nenhum <strong>cadastro</strong>, apenas é necessário a ativação do formulário</p>


       <main class="step-by-step">
       <div class="container-fluid d-flex flex-column align-items-center container-step">
            <h2 class=" step-title">
           1.  Conecte seu formulário
            </h2>
            <p>
                Você precisa ativar seu e-mail de proprietário uma única vez e poderá utilizar quantos formulários precisar, você também pode usar <a href="">esta página</a> para ativar seu e-mail proprietário.
            </p>
            <span class="card-body card-tag">
            &lt;form action="<mark class="bg-warning">https://formsubmitter.infinityfreeapp.com/submit?target=seuemail@email.com</mark>" method="POST" />
            </span>
        </div>

        <div class="container-fluid d-flex flex-column align-items-center container-step">
            <h2 class=" step-title">
           2.  Adicione quantos campos forem necessários
            </h2>
            <p>
                O form Submitter utiliza o  parâmetro <mark>name</mark> para identificar os campos e reencaminhar para seu e-mail, então não pode haver duplicação 
            </p>
            <span class="card-body card-tag ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" name="name" required&gt;
            </span>
        </div>

        <div class="container-fluid d-flex flex-column align-items-center container-step">
            <h3 class=" step-title">
           2.  Desabilitar o reCaptcha(opcional)
            </h2>
           <p>
           Por <strong>padrão</strong> o <span class="fw-bold">Form Submitter</span> utiliza o  <span class="fw-bold">Google Recaptcha</span> a cada envio, para desabilitar basta utilizar um  <span class="fw-bold">input</span> dp tipo  <span class="fw-bold">hidden(oculto)</span> com o valor  <span class="fw-bold">false</span> conforme o exemplo abaixo:
           </p>
            <span class="card-body card-tag ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type="text" name="_recaptcha" value="false"&gt;<br>
            </span>
        </div>
        
       </main>
          
        

       
    </div>
    <footer class="bg-dark text-light text-center py-3">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Yrllan Brandão</p>
        <div>
            <!-- Links para o LinkedIn e GitHub com ícones do FontAwesome -->
            <a href="https://www.linkedin.com/in/yrllanbrandao/" target="_blank" class="text-light me-3">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://github.com/YrllanBrandao" target="_blank" class="text-light">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>