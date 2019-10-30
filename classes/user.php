<?php

class User {
    private $id;
    private $username;
    private $first_name;
    private $last_name;
    private $birth_date;
    private $member_since;

    public function __construct($username) {
        $this->username = $username;
    }

    function setId ($id){
        $this->id = $id;
    }

    function setFirstName ($first_name){
        $this->first_name = $first_name;
    }
    
    function setLastName ($last_name){
        $this->last_name = $last_name;
    }

    function setBirthDate ($birth_date){
        $this->birth_date = $birth_date;
    }

    function setMemberSince ($member_since){
        $this->member_since = $member_since;
    }

}