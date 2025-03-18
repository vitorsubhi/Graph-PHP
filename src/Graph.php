<?php
namespace App;
use App\Vertex;
use App\Edge;

class Graph {
	private array $vertexSet;
	private array $edgeSet;
	private string $name;
	
	public function __construct($name) {
		$this->vertexSet = array();
		$this->edgeSet = array();
		$this->name = $name;
	}

	public function getVertexSet() {
		return $this->vertexSet;
	}

	public function getEdgeSet() {
		return $this->edgeSet;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getVerticesAmount() {
		return count($this->vertexSet);
	}

	public function getEdgesAmount() {
		return count($this->edgeSet);
	}

	public function addVertex(Vertex $vertex) {	        
		if (!in_array($vertex, $this->vertexSet, true)) {
			array_push($this->vertexSet, $vertex);
		}
	}

	public function addVertexByID($vertexID)
	{	        
		$vertex = new Vertex($vertexID);
		$this->addVertex($vertex);
	}
	public function addEdge(Vertex $source, Vertex $target)
	{
		$edge = new Edge($source, $target);

		array_push($this->edgeSet, $edge);
	}
	public function addEdgeByID($id1, $id2)
	{
		$source = new Vertex($id1);
		$target = new Vertex($id2);
		$this->addEdge($source, $target);
	}

	public function degreeOf(Vertex $vertex) {
		if(array_search($vertex, $this->vertexSet) ){
			$degree = 0;
			foreach($this->edgeSet as $edge){
				if($edge->contains($vertex))
					$degree++;
			}
			return $degree;
		}
		return -1;
	}

	public function show(){
		$output = "";
		
		$output .= "<br>================================<br>";
		$output .= "Graph Name: " . $this->name . "<br>";
		$output .= "================================";
		
		$output .= "<br>V = { ";
		foreach($this->vertexSet as $vertex){
			$output .= $vertex->getId() . ", ";
		}
		$output = substr($output, 0, -2);
		$output .= " }";
		
		$output .= "<br>E = {";
		foreach($this->edgeSet as $edge){
			$output .= $edge->show() . ", ";
		}
		$output = substr($output, 0, -2);
		$output .= " }<br>";
		$output .= "================================<br>";
		
		echo $output;
	}

	public function draw() {
		$nodes = '[ ';
		$map = [];
		$data = [];
		$index = 0;
		foreach ($this->vertexSet as $vertex) {
			$name = $vertex->getID();
			$color = $vertex->getColor();
			$nodes .= '{"name": "'.$name.'", "color": "'.$color.'"}, ';
			$map[$name] = $index;
			$index++;
		}
		$nodes = substr($nodes, 0, -2);
		$nodes .= " ]";

		$links = '[ ';

		foreach ($this->edgeSet as $edge) {
			$endPoints = $edge->getVertices();
			$source = $endPoints[0]->getID();
			$target = $endPoints[1]->getID();
			$links .= '{"source" : nodes['.$map[$source].'], "target" : nodes['.$map[$target].']}, ';				
		}
		$links = substr($links, 0, -2);
		$links .= " ]";

		$data['nodes'] = $nodes;
		$data['links'] = $links;

		return $data;
	}
}
?>
