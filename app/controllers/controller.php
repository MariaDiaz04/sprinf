<?php
namespace App\controllers;
require '../app/request/request.php';



class controller {

    public function page($view, $datas = null) {
        if (isset($datas)) { foreach ($datas as $key => $value) { ${$key} = json_decode(json_encode($value)); } }
        include '../src/views/'.$view.'.php';
    }
    
    public function view($view, $datas = null) {
        
        if (isset($datas)) { foreach ($datas as $key => $value) { ${$key} = json_decode(json_encode($value)); } }
        include '../src/views/app.php';
        include '../src/views/'.$view.'.php';
        echo '</div>';
        $this->layout('footer');
        echo '</div></div><div class="content-backdrop fade"></div>';
        $this->layout('endpage');

    }

    public function Route($route, $paremeters=null){
        if(isset($route)){

            $get =$route;
        if(isset($paremeters)){
            foreach ($paremeters as $key => $value) {
                
                $get = $get.'&'.$key.'='.$value;
            }
        }

        }else{

        $get='home';

        }

        return $get;
    }

    public function redirect($route, $paremeters=null) {
        header('location:'.$this->Route( $route, $paremeters ));
    }

    public function layout($layout, $datas = null) {
        if (isset($datas)) { foreach ($datas as $key => $value) { ${$key} = json_decode(json_encode($value)); } }
        include '../src/views/layouts/'.$layout.'.php';
    }

    public function js(string $name) {
        echo "<script src='../src/views/".$name.".js'></script>";
    }
    
    public function format($date, $format = 'd-m-Y'){
        return date_format(date_create($date), $format);
    }

}