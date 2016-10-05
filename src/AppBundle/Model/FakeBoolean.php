<?php

namespace AppBundle\Model;

class FakeBoolean {

    /**
     * @var
     */
    private $choix;

    /**
     * @return mixed
     */
    public function getChoix()
    {
        return $this->choix;
    }

    /**
     * @param mixed $choix
     */
    public function setChoix($choix)
    {
        $this->choix = $choix;
    }





}