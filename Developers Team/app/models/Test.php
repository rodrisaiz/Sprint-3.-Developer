<?php


class Test extends DB{



    public function test(){


        $decoded_json = array(

            "nombre" => "Rodri",
            "edad" => "34",
            "residencia" => "España",

        );


        $this->write($decoded_json);



    }
    



}