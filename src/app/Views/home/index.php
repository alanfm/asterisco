<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <base href="<?=getenv('URL_BASE')?>">
        <meta charset="UTF-8">
        <title>Microframework Asterisco</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="public/imgs/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="public/imgs/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="public/imgs/favicon-16x16.png">
        <link rel="manifest" href="public/imgs/manifest.json">
        <link rel="mask-icon" href="public/imgs/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <style>
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-top: 6rem;
                font-family: 'Dosis',sans-serif;
            }
            h1 {
                margin-bottom: 6rem;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="jumbotron text-center">
                        <h1><i class="fa fa-asterisk fa-lg text-success" aria-hidden="true"></i> Asterisco</h1>
                        <p>Microframework Asterisco</p>
                        <p><small class="text-muted">Sistema desenvolvido pela <a href="//www.asterisco.xyz" target="_blank">Asterisco Soluções</a> em TI para projetos de pequeno porte.</small></p>
                    </div>
                    <?=App\Libraries\Bootstrap\Pagination::render(16*16, 11, 'clientes/8')?>
                    <?=App\Libraries\Bootstrap\Alerts::render('success')?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>