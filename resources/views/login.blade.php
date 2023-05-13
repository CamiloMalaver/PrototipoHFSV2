<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <title>Prototipo HFS</title>
    </head>
    <body class="bg-body">
        <div class="login-card">
            <h1 class="login-title">HFS</h1>
            <label class="login-welcome-message">Bienvenido al sistema</label>
            <form class="login-form" action="">
                <div class="input-container">
                    <input class="input-text" type="email" id="login-email" name="email" placeholder="Ingresa tu email" required>
                </div>
                <div class="input-container">
                    <input class="input-text" type="password" id="login-password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <button class="btn btn-login" type="submit">Ingresar</button>
            </form>            
        </div>
    </body>
</html>
