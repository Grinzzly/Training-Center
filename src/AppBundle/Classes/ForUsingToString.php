<?php
/**
 * Created by PhpStorm.
 * User: Bjatta
 * Date: 15.06.2017
 * Time: 11:20
 */

namespace AppBundle\Classes;


class ForUsingToString
{
    /**
     * @return string
     */
    public function __toString()
    {
        return  '['
            .$this->getId()
            .'] '
            .$this->getTitle()
            ;
    }
}