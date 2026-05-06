<?php

class Member extends User {
    private $type;

    public function __construct($name, $email, $type) {
        parent::__construct($name, $email);
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }
}