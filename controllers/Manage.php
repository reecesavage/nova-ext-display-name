<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once MODPATH . 'core/libraries/Nova_controller_admin.php';

class __extensions__nova_ext_display_name__Manage extends Nova_controller_admin
{
    public function __construct()
    {
        parent::__construct();

        $this->ci = & get_instance();
        $this->_regions['nav_sub'] = Menu::build('adminsub', 'manageext');
        //$this->_regions['nav_sub'] = Menu::build('sub', 'sim');
        

        
    }

    public function getQuery($switch)
    {

        switch ($switch)
        {
            case 'display_name':
                $sql = "ALTER TABLE nova_characters ADD COLUMN display_name VARCHAR(255) DEFAULT NULL";
            break;

          

            default:
            break;
        }
        return isset($sql) ? $sql : '';
    }

     public function writeModelCode()
  {   
          
         $extModelPath = APPPATH.'models/characters_model.php';
        if ( !file_exists( $extModelPath ) ) { 
        return [];
        }
        $ModelFile = file_get_contents( $extModelPath );
        $pattern = '/public\sfunction\sget_character_name/';
        if (!preg_match($pattern, $ModelFile)) {
       $writeFilePath = dirname(__FILE__).'/../character.txt';
        if ( !file_exists( $writeFilePath ) ) { 
           return [];
        }
        $file = file_get_contents( $writeFilePath );

       $contents = file($extModelPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $size = count($contents);
      $contents[$size-1] = "\n".$file;
      $temp = implode("\n", $contents);

     
      file_put_contents($extModelPath, $temp);
         
         return true;
        }
      return false;
              


  }

    public function saveColumn($requiredCharacterFields)
    {

        if (isset($_POST['submit']) && $_POST['submit'] == 'Add')
        {
            $attr = isset($_POST['attribute']) ? $_POST['attribute'] : '';


            if (in_array($attr, $requiredCharacterFields['char']) == true)
            {
                $table = "nova_characters";

            }
            if (!empty($table))
            {

                if (!$this
                    ->db
                    ->field_exists($attr, $table))
                {
                    $sql = $this->getQuery($attr);
                    if (!empty($sql))
                    {
                        $query = $this
                            ->db
                            ->query($sql);

                        if (($key = array_search($attr, $requiredCharacterFields['char'])) !== false)
                        {
                            unset($requiredCharacterFields['char'][$key]);
                        }

                       
                        $list['char'] = $requiredCharacterFields;
                      
                        return $list;
                    }
                }

            }
        }

        return false;

    }

    public function config()
    {    
         $data['write']=true;
          Auth::check_access('site/settings');
        $data['title'] = 'Display Name Setting';
        $requiredCharacterFields['char'] = ['display_name'];



       
        $extModelPath = APPPATH.'models/characters_model.php';
         
        if ( !file_exists( $extModelPath ) ) { 
        return [];
        }
        $file = file_get_contents( $extModelPath );

         $pattern = '/public\sfunction\sget_character_name/';
       
        if (!preg_match($pattern, $file)) {
           $data['write']=false;

        if(isset($_POST['submit']) && $_POST['submit']=='write')
        {
             
            if($this->writeModelCode())
            {
              $data['write']=true;
                $message = sprintf(
               lang('flash_success'),
          // TODO: i18n...
              'get_character_name Function',
          lang('actions_added'),
          ''
        );
            }else {
                    $message = sprintf(
               lang('flash_failure'),
          // TODO: i18n...
              'get_character_name Function',
          lang('actions_added'),
          ''
        );
            }
         

        $flash['status'] = 'success';
        $flash['message'] = text_output($message);

        $this->_regions['flash_message'] = Location::view('flash', $this->skin, 'admin', $flash);

        }
        }

        if ($list = $this->saveColumn($requiredCharacterFields))
        {
            $requiredCharacterFields = $list['char'];
           
            $message = sprintf(lang('flash_success') ,
            // TODO: i18n...
            'Column Added successfully', '', '');

            $flash['status'] = 'success';
            $flash['message'] = text_output($message);

            $this->_regions['flash_message'] = Location::view('flash', $this->skin, 'admin', $flash);
        }

        $extConfigFilePath = dirname(__FILE__) . '/../config.json';

        if (!file_exists($extConfigFilePath))
        {
            return [];
        }
        $file = file_get_contents($extConfigFilePath);
        $data['jsons'] = json_decode($file, true);

        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit')
        {

            $data['jsons']['nova_ext_display_name']['display_name']['value'] = $_POST['display_name'];

           

            $jsonEncode = json_encode($data['jsons'], JSON_PRETTY_PRINT);

            file_put_contents($extConfigFilePath, $jsonEncode);

            $message = sprintf(lang('flash_success') ,
            // TODO: i18n...
            'Configuration', lang('actions_updated') , '');

            $flash['status'] = 'success';
            $flash['message'] = text_output($message);

            $this->_regions['flash_message'] = Location::view('flash', $this->skin, 'admin', $flash);

        }

       

    

        $charFields = $this
            ->db
            ->list_fields('nova_characters');
       

        $leftFields = [];
        foreach ($requiredCharacterFields['char'] as $key)
        {
            if (in_array($key, $charFields) == false)
            {
                $leftFields[] = $key;
            }
        }
       
        $data['fields'] = $leftFields;
        $this->_regions['title'] .= 'Display Name Setting';
        $this->_regions['content'] = $this->extension['nova_ext_display_name']
            ->view('config', $this->skin, 'admin', $data);

        Template::assign($this->_regions);
        Template::render();
    }

}
