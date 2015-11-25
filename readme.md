# Marketo Pro

The ultimate plugin for integrating Marketo with WordPress

## Usage

The `[marketo]` shortcode has the following options:

- `id`: Form ID (see below)
- `tag`: Which HTML tag to use for the lighbox trigger
- `class`: HTML classes to be applied to the lightbox trigger
- `success`: Override form's success redirect with a custom URL

To use a lightbox form, use an enclosing shortcode and put the trigger between the tags, like so: `[marketo id=42]Click Me![/marketo]`.

Because of the way WordPress parses shortcodes, if you plan on having multiple forms on one page you should always use the enclosing form (`[marketo id=42][/marketo]`) rather than the self-closing form (`[marketo id=42]`) to prevent unintended behaviour. If there is nothing between the tags then the form will be embedded rather than shown as a lightbox.

Full example: `[marketo id="42" tag="button" class="btn btn-primary" success="http://google.com"]Click Me![/marketo]`

## Widget

Forms can also be added with the Marketo Form widget, which can be given an optional title. Again, you'll need the form's ID.

## Form IDs

To find the ID for a form:

1. Login to Marketo
1. Design Studio
1. Select a form
1. Click Form Actions dropdown
1. Click Embed Code
1. In popup, look for `<form id="mktoForm_42"></form>`
1. The number is the form's ID

## Default Field Values

Default values for fields can be provided via whitelisted query strings configured on the settings page in the format `query1:name1|query2:name2`. Be sure to avoid any of WordPress' [reserved words](https://codex.wordpress.org/Reserved_Terms)!

## Settings

If you're deploying this plugin to a non-technical user, you can prefill the plugin's options by copying `config.php.sample` to `config.php` and entering values into it. Options are set on plugin activation so edit/remove the file and deactivate then reactivate the plugin to override them.

## Hooks

This plugin exposes the following filters:

- `marketo_pro_capability`: The capability required to edit Marketo Pro settings (passed `$capability`)
- `marketo_pro_atts`: Attributes used to output a form, either embedded, lightbox or widget (passed `$atts`)
- `marketo_pro_content`: Lightbox text (passed `$content`)
- `marketo_pro_values`: Form fields and default values (passed via query string)

and the following actions:

- `marketo_pro_before_form`: Fires immediately before a form is output
- `marketo_pro_after_form`: Fires immediately after a form is output