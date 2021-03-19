<?php

$this->event->listen(['db', 'insert', 'prepare', 'characters'], function($event){
if(($display_name = $this->input->post('display_name', true)) !== false)
    $event['data']['display_name'] = $display_name;
});