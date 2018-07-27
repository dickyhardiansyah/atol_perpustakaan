<?php

class QueryBuilder {
    var $query;
    var $class;
    var $value;

    public function __construct($query, $class, $value) {
        $this->query = $query;
        $this->class = $class;
        $this->value = $value;
    }

    public function get() {
        return $this->class::get($this->query, $this->value);
    }
}