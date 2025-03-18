<?php
namespace App;

class Vertex {
    private $vertexId;
    private $color;

    public function __construct($vertexId, $color = "#0dd") {
        $this->vertexId = $vertexId;
        $this->color = $color;
    }

    public function getId(){
        return $this->vertexId;
    }

    public function setId($vertexId){
        $this->vertexId = $vertexId;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}
?>
