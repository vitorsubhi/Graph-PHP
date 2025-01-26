<?php
namespace App;

class Vertex {
    private $id;
    private $color;

    public function __construct($id, $color = "#0dd") {
        $this->id = $id;
        $this->color = $color;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $thid->id = $id;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}
?>
