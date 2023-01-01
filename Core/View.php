<?php

namespace Core;

class View
{
    public $content;

    public function load($viewName, $data = [])
    {
        ob_start(); // Bu işlev çıktı tamponlamasını ektin kılar. Çıktı tamponlaması etkinken betikten (başlıklar dışında) hiçbir çıktı gönderilmez ve çıktı dahili bir tamponda saklanır.
        extract($data); // Her anahtarın geçerli bir değişken adı olup olmadığına bakmaktan başka bu değişkenlerin simge tablosundakilerle çakışıp çakışmadığına da bakar.
        require BASEDIR.'/App/View/'.$viewName.'.php';
            $this->content = ob_get_contents(); // Bu dahili tamponun içeriği ob_get_contents() işleviyle bir dizge değişkenine kopyalanabilir. 
        ob_clean(); // Çıktılamak istemiyorsanız, ob_end_clean() işlevi ile tampon içeriğini sessiz sedasız silebilirsiniz.
        return $this->content;
    }
    
}