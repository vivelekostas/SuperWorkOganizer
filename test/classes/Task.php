<?php

/**
 * Создаёт задачу
 * 
 */
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

    /**
     * 
     * @param string $name
     * @param string $category
     * @param int $status
     * @throws Exception
     */
    public function __construct(string $name, $category, int $status) {
        if ($name == null){
            throw new Exception('Не указано название!!');
        }

        $this->name = $name;

        if (!(($category == 'weekly') or ( $category == 'simple') or ( $category == 'complex'))) {
            throw new Exception(' Неверно указана категория!');
        }

        $this->category = $category;

        if ($status > '3') {
            throw new Exception(' Неверно указан статус!');
        }

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
