<?php
/**
 * Created by PhpStorm.
 * User: sevskis
 * Date: 4/20/18
 * Time: 10:17
 */

namespace App\Controller;


class Calculator
{
    public function add($a,$b)
    {
        $this->validateInput($a, $b);
        return $a + $b;
    }

    public function subtract($a,$b)
    {
        $this->validateInput($a, $b);
        return $a - $b;
    }

    /**
     * @param $a
     * @param $b
     */
    protected function validateInput($a, $b): void
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \UnexpectedValueException();
        }
    }
}