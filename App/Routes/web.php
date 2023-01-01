<?php

$cms->router->get('/','Home@Index');

// Login Page
$cms->router->get('/giris','Auth@Index');
// Login Post
$cms->router->post('/giris','Auth@Login');
$cms->router->get('/cikis','Auth@Logout');

// Musteriler
$cms->router->mount('/musteri',function() use ($cms){
    
    $cms->router->get('/','Customer@Index');
    $cms->router->get('/ekle','Customer@Add');
    $cms->router->get('/guncelle/([0-9]+)','Customer@Edit');
});

$cms->router->mount('/proje',function() use ($cms){
    
    $cms->router->get('/','Project@Index');
    $cms->router->get('/ekle','Project@Add');
    $cms->router->get('/guncelle/([0-9]+)','Project@Edit');
});
