<?php

$this->event->listen(['location', 'view', 'data', 'admin', 'user_all'], function($event){
     
   
   $users = $this->user->get_users('');
		if ($users->num_rows() > 0)
		{   
			foreach ($users->result() as $p)
			{   

                   
                   $main_char = $this->char->get_character_name($p->main_char, true);
                   $query = $this->db->get_where('characters', array('charid' => $p->main_char));
       $model = ($query->num_rows() > 0) ? $query->row() : false;
       if(!empty($model))
       {
       	  $main_char= !empty($model->first_name)?str_replace($model->first_name, '', $main_char):$main_char;
       	  $main_char= !empty($model->last_name)?str_replace($model->last_name, '', $main_char):$main_char;
       	  $main_char= !empty($model->suffix)?str_replace($model->suffix, '', $main_char):$main_char;

       	  $main_char= !empty($model->display_name)?trim($main_char).' '.$model->display_name:$main_char;
       }


				$data['users'][$p->status][$p->userid] = array(
					'id' => $p->userid,
					'main_char' => $main_char,
					'email' => $p->email,
					'name' => $p->name,
					'left' => ( ! empty($p->leave_date)) ? timespan($p->leave_date, now()) : '',
				);
			}
		}
		$event['data']['users']= $data['users'];

});