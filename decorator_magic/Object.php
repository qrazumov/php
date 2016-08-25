<?php
namespace Blog;
class Object
{
    protected $id;
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function render()
    {
        return "id = " . $this->getId();
    }
}