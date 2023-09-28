<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Novo envio de formulário</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#0077b6">
    <tr>
        <td align="center" style="padding: 40px 0;">
            <h1 style="color: #ffffff; font-size: 36px; margin: 0;">Você recebeu um novo envio </h1>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
    <tr>
        <td align="center" style="padding: 40px;">
            <h2 style="color: #0077b6; font-size: 24px; margin: 0;">Dados do formulário</h2>
            <table width="100%" cellpadding="10">
                <?php
                     foreach($_POST as $field => $value){
                        
                        ?>
                <tr>
                <td style="color: #333333; font-size: 16px; font-weight: bold; width: 30%; text-align: center;"><?= $field?>:</td>
                    <td style="color: #333333; font-size: 16px; text-align: center;"><?= $value?></td>
                </tr>
        
                    <?php
                    }
        

                    ?>
            </table>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f0f0f0">
    <tr>
        <td align="center" style="padding: 40px;">
          
            <p style="color: #333333; font-size: 12px;">Este e-mail foi enviado por <strong>Form Submitter</strong>.</p>
            
        </td>
    </tr>
</table>

</body>
</html>
