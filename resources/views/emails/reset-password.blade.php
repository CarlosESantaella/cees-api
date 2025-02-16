<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reseteo de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .button {
            display: inline-block;
            padding: 12px 18px;
            background-color: #007bff;
            color: #fff !important;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Reseteo de Contraseña</h2>
        <p>Hola,</p>
        <p>Has solicitado restablecer tu contraseña. Para continuar, por favor haz clic en el siguiente botón y establece una nueva contraseña.</p>
        <p style="text-align:center;">
            <a href="{{ $resetUrl }}" class="button">Restablecer Contraseña</a>
        </p>
        <p>Si no has solicitado el cambio, por favor ignora este mensaje.</p>
        <p>Saludos,<br>Equipo de Soporte</p>
        <div class="footer">
            <p>© {{ date('Y') }} AGILE REPORT. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>