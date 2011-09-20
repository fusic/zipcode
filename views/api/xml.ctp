<?php
    echo $this->Xml->header();

    echo '<'.$pluralize.'>';
        foreach ($data as $key => $val) {
            echo '<'.$singularize.'>';
            echo $this->Xml->serialize($val, array('format' => 'tags'));
            echo '</'.$singularize.'>';
        }
    echo '</'.$pluralize.'>';
