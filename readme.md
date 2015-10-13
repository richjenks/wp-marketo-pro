# Marketo Pro

The ultimate plugin for integrating Marketo with WordPress

## Shortcode

The `[marketo]` shortcode adds a form to your content and has the following options:

- `id`: Form ID (see below)
- `tag`: Which HTML tag to use for the lighbox trigger
- `class`: HTML classes to be applied to the lightbox trigger

To use a lightbox form, use an enclosing shortcode and put the trigger between the tags, like so: `[marketo id=42]Click Me![/marketo]`

*To get around WordPress' poor shortcode nesting whereby you cannot have a self-closing shortcode followed by an enclosing shortcode, you can embed a Marketo form by using the enclosing shortcode (`[marketo][/marketo]`) with nothing between the tags. If you put something between the tags it will become the lightbox trigger.*

Here's a full example: `[marketo id=42 tag=button class="btn btn-primary"]Click Me![/marketo]`

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

## Settings

If you're deploying this plugin to a non-technical user, you can prefill the plugin's options by copying `config.php.sample` to `config.php` and entering values into it. These options cannot be changed without either removing `config.php` or editing it then deactivating and reactivating the plugin.

## Hooks

This plugin exposes the following filters:

- `marketo_pro_capability`: The capability required to edit Marketo Pro settings (passed `$capability`)
- `marketo_pro_atts`: Attributes used to output a form, either embedded, lightbox or widget (passed `$atts`)
- `marketo_pro_content`: Lightbox text (passed `$atts`)

and the following actions:

- `marketo_pro_before_form`: Fires immediately before a form is output
- `marketo_pro_after_form`: Fires immediately after a form is output