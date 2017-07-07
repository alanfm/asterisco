<?php

use HTMLBuilder\Page;
use HTMLBuilder\ElementFactory;

$page = new Page(getenv('APP_TITLE'));
$page->add_in_head(ElementFactory::make('base')->attr('href', [getenv('URL_BASE')]))
     ->add_in_head('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">')
     ->add_in_head('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">')
     ->add_in_head(ElementFactory::make('link')->attr('rel', ['stylesheet'])->attr('href', ['public/css/font-awesome.css']))
     ->add_in_head('<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">')
     ->add_in_head(ElementFactory::make('style')->value("html{position:relative;min-height:100%;}body{font-family:'Dosis',sans-serif;margin-top:6rem;}"));

$content[] = ElementFactory::make('h2')->attr('class', ['text-danger'])->value(ElementFactory::make('i')->attr('class', ['fa', 'fa-exclamation-triangle', 'fa-lg'])->attr('aria-hidden',['true']));
$content[] = ElementFactory::make('h1')->value('Erro 404');
$content[] = ElementFactory::make('p')->value('Página não encontrada! Ou você digitou o endereço errado ou a página não está disponível no momento.');
$content[] = ElementFactory::make('p')->value(ElementFactory::make('a')->attr('href', '#')->attr('class', ['btn', 'btn-lg', 'btn-default'])->attr('onclick', 'history.go(-1);')->attr('title', 'Voltar')->value(ElementFactory::make('i')->attr('class', ['fa', 'fa-chevron-left', 'fa-lg'])->attr('aria-hidden', ['true'])))
                                      ->value(ElementFactory::make('a')->attr('href', [self::currentURL()])->attr('class', ['btn', 'btn-lg', 'btn-default'])->attr('title', 'Recarregar')->value(ElementFactory::make('i')->attr('class', ['fa', 'fa-refresh', 'fa-lg'])->attr('aria-hidden', ['true'])))
                                      ->value(ElementFactory::make('a')->attr('href', [self::link('')])->attr('class', ['btn', 'btn-lg', 'btn-default'])->attr('title', 'Página Inicial')->value(ElementFactory::make('i')->attr('class', ['fa', 'fa-home', 'fa-lg'])->attr('aria-hidden', ['true'])));

$container = ElementFactory::make('div')->attr('class', ['container-fluid'])->value(ElementFactory::make('div')->attr('class', ['row'])->value(ElementFactory::make('div')->attr('class', ['col-lg-6', 'col-lg-offset-3'])->value(ElementFactory::make('div')->attr('class', ['jumbotron', 'text-center'])->value($content))));
$page->add_in_body($container);

$page->render();