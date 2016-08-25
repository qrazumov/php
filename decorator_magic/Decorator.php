<?php
namespace Blog;
class Decorator
{
    protected $class;

    /**
     * Decorator constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Отрабатывает когда вызывается несуществущее свойство
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->class->{$name};
    }

    /**
     * Отрабатывает когда устанавливается несуществущее свойство
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->class->{$name} = $value;
    }

    /**
     * Отрабатывает когда вызывается несуществущая функция
     * @param $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments = [])
    {
        return call_user_func_array([$this->class, $method], $arguments);
    }
    public function render()
    {
        return 'decorator ' . $this->class->render();
    }
    public function decoratorOnlyMethod()
    {
        return true;
    }
}