<?php
namespace functional;

interface ListInterface
{
    public function isNil();
}

class SinglyLinkedList implements ListInterface
{
    protected $_car;

    protected $_cdr;

    public function __construct($car, ListInterface $cdr)
    {
        $this->_car = $car;
        $this->_cdr = $cdr;
    }

    public function car()
    {
        return $this->_car;
    }

    public function cdr()
    {
        return clone $this->_cdr;
    }

    public function isNil()
    {
        return false;
    }

    public function __toString()
    {
        $result = '(';
        $car = $this->car();
        if (is_string($car)) {
            $result .= '"' . $car . '"';
        } else if (is_bool($car)) {
            if ($car === true) {
                $result .= 'True';
            } else {
                $result .= 'False';
            }
        } else {
            $result .= (string)$car;
        }
        $result .= ", {$this->cdr()})";
        return $result;
    }
}

class Nil implements ListInterface
{
    public function isNil()
    {
        return true;
    }

    public function __toString()
    {
        return 'Nil';
    }
}
