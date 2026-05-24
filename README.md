# Display Name - A [Nova](https://anodyne-productions.com/nova) Extension

<p align="center">
  <a href="https://github.com/reecesavage/nova-ext-display-name/releases/tag/v1.2.0"><img src="https://img.shields.io/badge/Version-v1.2.0-brightgreen.svg"></a>
  <a href="http://www.anodyne-productions.com/nova"><img src="https://img.shields.io/badge/Nova-v2.7.5+-orange.svg"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-v8.x-blue.svg"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-red.svg"></a>
</p>

This extension allows characters to use a Display Name as an alternative to the First Name, Last Name, Suffix which is default in Nova. If Display Name is blank the default method will be displayed.

This extension requires:

- Nova 2.7.5+

## Upgrade Considerations

### Upgrading from a version older than 1.2.0
The model code injected by older releases of this extension didn't carry version markers. After upgrading the extension files, open the admin Status panel - it will detect the existing `get_character_name()` method in `application/models/Characters_model.php` and offer an **Update Model Code** button to replace it in place with the new shim form. No manual surgery required.

If anything looks off, the fallback is always to replace `application/models/Characters_model.php` with the stock Nova stub, then click **Install Model Code** on the admin page.

### Upgrading Nova
- If upgrading Nova 2.6+ with this Nova Extension already deployed:
- Remove `$config['extensions']['enabled'][] = 'nova_ext_display_name';` from `application/config/extensions.php` prior to the Nova upgrade.
- After upgrading Nova to 2.7.5+, follow the installation steps below. The database tables still contain your data.

## Installation

- Copy the entire directory into `application/extensions/nova_ext_display_name`.
- Add the following to `application/config/extensions.php`:
```
$config['extensions']['enabled'][] = 'nova_ext_display_name';
```

### Setup Using Admin Panel - Preferred

- Navigate to your Admin Control Panel.
- Choose **Display Name** under Manage Extensions.
- The **Status** panel at the top shows the live state of the database column and the model code.
- Click **Set Up Database** to add the `display_name` column to `<prefix>characters`. The button only appears when something is missing; it's safe to re-run.
- Click **Install Model Code** to inject the display-name shim into `application/models/Characters_model.php` so character names use the Display Name when one is set.

Installation is complete when the Status panel reads "All present" / "Installed and up to date" across the board.

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
