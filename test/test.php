<?php





//var_dump($argv);
//die();
echo 'do yo want to create-task? y/n: ';
$task = readline();
$argv[1] = 'y';
if ($task === $argv[1]) {
    echo "Название задачи: ";
    $name = readline("Название задачи: ");
    $argv[2] = $name;
    echo "Укажите категорию: ";
    $category = readline("Укажите категорию: ");
    $argv[3] = $category;
    
    $newTask = new task($name, $category, 1);
    $newTask->save();
    
    var_dump($newTask);
} else {
    echo 'ИДИ В БАНЮ ДОЛБАНЫЙ ХАЦКЕР';
}
    
        


class task {

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

    public function time() {
        //отсчитывает час и добавляет к уже потраченному на эту задачу времени
    }
    
    public function save() {
        file_put_contents('task.json', $this->name);
    }

}


//$new_perfomans = new task("Pollianna", "weekly", 1 );
//$new_perfomans->name = Pollianna;
//$new_perfomans->status = false;
//$new_perfomans->kategoria = ejemesyachnaya;
//$new_perfomans->display();
//echo "\n";
//var_dump($new_perfomans);












































