<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?=getenv('URL_BASE')?>">
        <meta charset="UTF-8">
        <title>HTTP Erro 404</title>
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
                        <h1><i class="fa fa-exclamation-triangle fa-lg text-danger" aria-hidden="true"></i> HTTP Erro 404</h1>
                        <h2>Página não encontrada!</h2>
                        <p>O sistema não consegue identificar a página que você está tentando acessar. Motivos possiveis para esse problema devem ser: a página não está disponivel; ou a mesma não existe.</p>
                        <p>Use uma das opções abaixo</p>
                        <p>
                            <a href="#" class="btn btn-lg btn-default" onclick="history.go(-1);" title="Voltar"><i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i></a>
                            <a href="<?=self::currentURL();?>" class="btn btn-lg btn-default" title="Recarregar"><i class="fa fa-refresh fa-lg" aria-hidden="true"></i></a>
                            <a href="<?=self::link('home')?>" class="btn btn-lg btn-default" title="Página Inicial"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>

                        </p>
                    </div>
                </div>
            </div>
        </div>        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>