<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ativação de Formulário</title>
    <!-- Incluindo Bootstrap CSS para estilização (opcional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/confirmedForm.css">
</head>
<body>

<div class="container container-main d-flex align-items-center justify-content-center">
    <div class="row justify-content-center ">
        <div class="card-success">
            <div class="alert alert-light text-center ">
                <h1 class="mb-4 text-dark">Formulário Ativado com Sucesso!</h1>
                <p class="text-dark">O seu formulário foi ativado com sucesso. Agora você pode aproveitar todos os recursos e funcionalidades.</p>

                <figure>
                    <img src="./images/confirmedForm.svg" alt="Personagem alegre" width="150px">
                </figure>

                 <!-- custom button back -->
                 <?php
                    if(isset($_SESSION['form_source_address'])){
                        ?>
                            <a href="<?= $_SESSION['form_source_address']  ?>" class="btn btn-primary" >
                            Voltar para página anterior
                            </a>
                        <?php
                    }
                    else{
                        ?>
                            <button class="btn btn-primary" id="btn-back">
                                Voltar para o site de origem
                            </button>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<footer class="fixed-bottom container-fluid py-2 text-light d-flex flex-column align-items-center">
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
    </footer>

<!-- Incluindo Bootstrap JS (opcional, se você precisar de componentes JavaScript) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        const buttonBack = document.getElementById("btn-back");

        buttonBack.addEventListener("click", ()=>{
            window.history.back();
        })
    </script>
</body>
</html>
