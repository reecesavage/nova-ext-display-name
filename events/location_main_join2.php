<?php 


$this->event->listen(['location', 'view', 'data', 'main', 'main_join_2'], function($event){

      $event['data']['inputs']['nova_ext_display_name'] = array(
        'name' => 'display_name',
        'id' => 'nova_ext_display_name',
        'value'=>$this->input->post('display_name')
        
      );
});

$this->event->listen(['location', 'view', 'output', 'main', 'main_join_2'], function($event){

  switch($this->uri->segment(4)){
    case 'view':
      break;
    default:  
     
                $event['output'] .= $this->extension['jquery']['generator']
                      ->select('[name="suffix"]')->closest('p')
                      ->after(
                        $this->extension['nova_ext_display_name']
                             ->view('_form', $this->skin, 'main', $event['data'])
                      );
      
 }
});
