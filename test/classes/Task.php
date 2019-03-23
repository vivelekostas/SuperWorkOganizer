<?php

class Task {

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $name;

    public function display() {
        echo $this->name . PHP_EOL;
        echo $this->category . PHP_EOL;
        echo $this->status . PHP_EOL;
    }
    
    public function __construct(string $name, string $category, int $status) {
        $this->name = $name;
        $this->category = $category;
        $this->status = $status;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setCategory($category) {
        $this->category = $category;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

    public function time() {
        //отсчитывает час и добавляет к уже потраченному на эту задачу времени
    }
    
    
    

}
