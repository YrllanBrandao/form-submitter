<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- loading recaptcha script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/recaptcha.css">
    <title>Recaptcha</title>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center container-main ">
    <form action="/recaptcha" onsubmit="return formState()" method="post" class="d-flex flex-column align-items-center gap-2">
        <h1 class="fs-3 text-light text-center">
            Resolva o captcha para prosseguir com o envio!
        </h1>
        <div class="g-recaptcha" data-sitekey="6Le2oGMoAAAAABXPMOY5gyzB-7_F2GrYrWeCzop3" ></div>
        <button type="submit" class="btn btn-primary px-5">Enviar</button>
    </form>
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

    <script>
    function formState() {
        const token = grecaptcha.getResponse();
        if (token !== "") {
            return true;
        }
        alert("Preencha o reCaptcha");
        return false;
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>