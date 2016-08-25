<?php

/**
 * Created by PhpStorm.
 * User: razumovsu
 * Date: 30.07.16
 * Time: 20:26
 */
class Youtube
{


    private $result = '';
    private $searchString = '';

    /**
     * Return the result of searching
     *
     * @return string
     */
    public function getResult()
    {
        if(!$this->searchString){
            throw new Exception('First must be executed the search() method!');
        }
        echo $this->result;
    }

    /**
     * Search algorithm
     *
     * @param $searchString
     * @return string
     */
    public function search($searchString)
    {
        // do something
        $this->searchString = $searchString;
        $this->result = 'Result youtube: ' . $this->searchString;
        return $this->result;
        //echo $this->result;
    }

}