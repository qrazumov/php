<?php

/**
 * Created by PhpStorm.
 * User: razumovsu
 * Date: 30.07.16
 * Time: 20:26
 */
class Google
{


    private $result = '';
    private $searchString = '';

    /**
     * Youtube constructor.
     * @param $searchString
     */
    public function __construct($searchString)
    {
        $this->searchString = $searchString;
    }

    /**
     * Return the result of searching
     *
     * @return string
     */
    public function getResult()
    {
        return $this->search();
    }

    /**
     * Search algorithm
     *
     * @param $searchString
     * @return string
     */
    private function search()
    {
        // do something
        $this->result = 'Result google: ' . $this->searchString;
        //return $this->result;
        echo $this->result;
    }

}