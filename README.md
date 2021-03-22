# Display Name - A [Nova](https://anodyne-productions.com/nova) Extension

<p align="center">
  <a href="https://github.com/reecesavage/nova-ext-display-name/releases/tag/v1.0.0"><img src="https://img.shields.io/badge/Version-v1.0.0-brightgreen.svg"></a>
  <a href="http://www.anodyne-productions.com/nova"><img src="https://img.shields.io/badge/Nova-v2.6.1-orange.svg"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-v5.3.0-blue.svg"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-red.svg"></a>
</p>

This extension allows characters to use a Display Name as an alternative to the First Name, Last Name, Suffix which is default in Nova. If Display Name is blank the default method will be displayed.

This extension requires:

- Nova 2.6+

## Installation

- Copy the entire directory into `applications/extensions/nova_ext_display_name`.
- Add the following to `application/config/extensions.php`:
```
$config['extensions']['enabled'][] = 'nova_ext_display_name';
```
### Setup Using Admin Panel - Preferred

- Navigate to your Admin Control Panel
- Choose Display Name under Manage Extensions
- Create Database Columns by clicking "Create Column" for each column. Once all columns are added the message "All expected columns found in the database" will appear.
- Click Update Controller Information to add the `get_character_name` function to your `application/models/characters_model.php` file.

Installation is now complete!

### Manual Setup - If not using the method above.

- Run the following commands on your MySQL database:

```
ALTER TABLE nova_characters ADD COLUMN display_name VARCHAR(255) DEFAULT NULL;
```

- Add the following function in your `applications/models/characters_model.php` file to overwrite `get_character_name` function.

```
	public function get_character_name($character = '', $showRank = false, $showShortRank = false, $showBioLink = false)
	{
		$this->db->from('characters');
		
		if ($showRank === true)
		{
			$this->db->join('ranks_'.GENRE, 'ranks_'.GENRE .'.rank_id = characters.rank');
		}
		
		$this->db->where('charid', $character);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$item = $query->row();
		
			$array['rank'] = ($showRank === true) ? $item->rank_name : false;
			$array['rank'] = ($showShortRank === true) ? $item->rank_short_name : $array['rank'];
			
			if(!empty($item->display_name))
			{
				$array['display_name'] = $item->display_name;
			}else {
			$array['first_name'] = $item->first_name;
			$array['last_name'] = $item->last_name;
			$array['suffix'] = $item->suffix;
			}
		    
		    
			foreach ($array as $key => $value)
			{
				if (empty($value))
				{
					unset($array[$key]);
				}
			}
		
			$string = implode(' ', $array);

			if ($showBioLink === true)
			{
				return anchor('personnel/character/'.$item->charid, $string);
			}
		
			return $string;
		}
		
		return false;
	}
}
```
Installation is now complete! 

## Usage

- Create or Edit a character.
- Enter a Display Name.
- Enter other values as normal.
- Save or Submit
- If Display Name is present the value will be displayed on the Manifest.

## Issues

If you encounter a bug or have a feature request, please report it on GitHub in the issue tracker here: https://github.com/reecesavage/nova-ext-display-name/issues

## License

Copyright (c) 2021 Reece Savage.

This module is open-source software licensed under the **MIT License**. The full text of the license may be found in the `LICENSE` file.
