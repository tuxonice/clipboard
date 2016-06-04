<?php
// Routes
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/[{hash}]', function (ServerRequestInterface $request, ResponseInterface $response) {

    $hash = $request->getAttribute('hash');
    $hash = strtolower($hash);
    $hash = trim(preg_replace("/[^a-z0-9\-\.]/", '', $hash));

    if($hash == ''){
        return $this->renderer->render($response, '404.phtml', array('error'=>'Hash not found'));
    }

    $dataPath = $this->settings['data']['data_path'];
    $data = file_get_contents($dataPath.'/'.$hash.'.dat');

    if($data === false){
        return $this->renderer->render($response, '404.phtml', array('error'=>'Hash not found'));
    }


    return $this->renderer->render($response, 'index.phtml', array('data'=>$data));
});


$app->post('/[{hash}]', function (ServerRequestInterface $request, ResponseInterface $response) {

    $hash = $request->getAttribute('hash');
    $hash = strtolower($hash);
    $hash = trim(preg_replace("/[^a-z0-9\-\.]/", '', $hash));
    
    if($hash == ''){
        return $this->renderer->render($response, '404.phtml', array('error'=>'Hash not found'));
    }

    $postData = $_POST;

    $data = array();

    foreach($postData as $key=>$post){
        $data[$key] = strip_tags(htmlspecialchars($post));
    }

    $dataPath = $this->settings['data']['data_path'];
    $fp = fopen($dataPath.'/'.$hash.'.dat', 'w');
    if(!$fp){
        return $this->renderer->render($response, '404.phtml', array('error'=>'Hash not found'));
    }
    $text = '';
    foreach($data as $key=>$line){
        $text .= $key.': '.$line.'<br/>'.chr(10);
    }

    fwrite($fp,$text);
    fclose($fp);
    
    return $this->renderer->render($response, 'index.phtml', array('data'=>$text));
});



