<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E-mail Enviado com Sucesso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/thanks.css">
</head>
<body>

<div class="container container-main d-flex align-items-center justify-content-center">
    <div class="row justify-content-center thanks-card">
        <div class="col-md-6">
            <div class="alert alert-light text-center">
                <h1 class="mb-4 text-dark">Obrigado pelo seu contato!</h1>
                <p class="text-black">Recebemos seu e-mail com sucesso. <?= $_SESSION['form_submitter_data'] ?></p>
                </div>
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
    <footer class=" text-light text-center py-3 fixed-bottom">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Yrllan Brandão</p>
        <div>
            <a href="https://www.linkedin.com/in/yrllanbrandao/" target="_blank" class="text-light me-3">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://github.com/YrllanBrandao" target="_blank" class="text-light">
                <i class="fab fa-github"></i>
            </a>
            
        </div>
    </div>
</footer>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        const buttonBack = document.getElementById("btn-back");

        buttonBack.addEventListener("click", ()=>{
            window.history.back();
        })
    </script>
</body>
</html>
