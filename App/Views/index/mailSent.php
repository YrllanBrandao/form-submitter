<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ativação de formulário necessária</title>
    <link rel="stylesheet" href="./css/mailSent.css">
</head>
<body>

<div class="container d-flex justify-content-center align0">

    <div class="message">
        <h2><strong>O formulário ainda não foi ativado</strong></h2>
    </div>
    <div class="confirmation-text">
        <p>O e-mail para ativação do <strong>Formulário</strong> foi enviado com sucesso para sua caixa de entrada.</p>
        <p>Verifique sua caixa de entrada e, se não encontrar o e-mail, verifique a pasta de <strong>spam</strong>.</p>
    </div>
    <div class="illustration">
        <img src="images/mail_sent.svg" alt="Ilustração de e-mail enviado com sucesso" width="150px">
    </div>
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
    <script>
        const buttonBack = document.getElementById("btn-back");

        buttonBack.addEventListener("click", ()=>{
            window.history.back();
        })
    </script>
</body>
</html>
