# Display Name - A [Nova](https://anodyne-productions.com/nova) Extension

<p align="center">
  <a href="https://github.com/reecesavage/nova-ext-display-name/releases/tag/v1.1.1"><img src="https://img.shields.io/badge/Version-v1.1.0-brightgreen.svg"></a>
  <a href="http://www.anodyne-productions.com/nova"><img src="https://img.shields.io/badge/Nova-v2.7.5+-orange.svg"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-v8.x-blue.svg"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-red.svg"></a>
</p>

This extension allows characters to use a Display Name as an alternative to the First Name, Last Name, Suffix which is default in Nova. If Display Name is blank the default method will be displayed.

This extension requires:

- Nova 2.7.5+
- Nova Extension [`jquery`](https://github.com/jonmatterson/nova-ext-jquery)

## Upgrade Considerations
- If upgrading Nova 2.6+ with this Nove Extension already deployed:
- Remove `$config['extensions']['enabled'][] = 'nova_ext_display_name';` from `application/config/extensions.php` prior to the Nova upgrade.
- After upgrading Nova to 2.7.5+, follow the installation steps below. The database tables still contain your data

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

## Usage

- Create or Edit a character.
- Enter a Display Name.
- Enter other values as normal.
- Save or Submit
- If Display Name is present the value will be displayed on the Manifest.

## Issues

If you encounter a bug or have a feature request, please report it on GitHub in the issue tracker here: https://github.com/reecesavage/nova-ext-display-name/issues

## License

Copyright (c) 2023 Reece Savage.

This module is open-source software licensed under the **MIT License**. The full text of the license may be found in the `LICENSE` file.
