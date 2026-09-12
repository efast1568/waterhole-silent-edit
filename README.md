# Waterhole Silent Edit

A Waterhole extension that allows authorized users to clear edit information from posts and comments without modifying their content.

## Features

* Adds **Clear edit information** to the post and comment action menu.
* Only appears when the post or comment has edit information.
* Clears `edited_at` without modifying the post or comment content.
* Supports both posts and comments.
* Uses a single `silent-edit` permission.
* Administrators are automatically authorized through Waterhole's native permission system.
* Supports English and Traditional Chinese translations.
* Uses the `tabler-pencil-off` icon.

## Requirements

* Waterhole 0.7.x
* PHP 8.2 or later

## Installation

Install the extension with Composer:

```bash
composer require subarist/waterhole-silent-edit
```

Enable the extension from the Waterhole Administration Control Panel.

## Permission

The extension provides one permission:

**Allow clearing edit information**

Users with this permission can clear the edit information of posts and comments.

Administrators are automatically authorized by Waterhole.

## Usage

When a post or comment has been edited, authorized users will see:

> Clear edit information

Selecting this action immediately clears the edit information.

The original content is not changed.

## Translations

Included translations:

* English
* Traditional Chinese (`zh-Hant`)

## Compatibility

This extension is intended for Waterhole 0.7.x.

## License

This project is open-sourced under the [MIT License](LICENSE).

## Links

* [GitHub Repository](https://github.com/efast1568/waterhole-silent-edit)
* [Waterhole](https://waterhole.dev/)
