<?php 

$this->event->listen(['location', 'view', 'data', 'admin', 'characters_create'], function($event){

  
  


  $extConfigFilePath = dirname(__FILE__).'/../config.json';
         
        if ( file_exists( $extConfigFilePath ) ) { 
            $file = file_get_contents( $extConfigFilePath );
            $json = json_decode( $file, true );
    }


      $displayLabel = isset($json['nova_ext_display_name']['display_name'])
                        ? $json['nova_ext_display_name']['display_name']['value']
                        : 'Display Name';


     $event['data']['label']['nova_ext_display_name'] = $displayLabel;
      $event['data']['inputs']['nova_ext_display_name'] = array(
        'name' => 'display_name',
        'id' => 'nova_ext_display_name',
        'value'=>$this->input->post('display_name')
        
      );
});

$this->event->listen(['location', 'view', 'output', 'admin', 'characters_create'], function($event){

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
