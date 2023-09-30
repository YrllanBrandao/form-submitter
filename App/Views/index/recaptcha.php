<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- loading recaptcha script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Recaptcha</title>
</head>

<body>
    <!-- recaptcha form -->
    <form action="/recaptcha" onsubmit="return formState()" method="post">
        <h1>
            Resolva o captcha e seu formulário será enviado!
        </h1>
        <div class="g-recaptcha" data-sitekey="6Le2oGMoAAAAABXPMOY5gyzB-7_F2GrYrWeCzop3"></div>
        <button type="submit">Enviar</button>
    </form>


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
</body>

</html>