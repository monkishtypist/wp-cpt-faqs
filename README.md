# WP CPT: FAQs
#### WordPress custom post type for FAQs
Adds a custom post type to WordPress called *FAQs*. Includes a shortcode `[faqs]` to embed FAQs into your posts/pages as a Bootstrap Accordion.

Learn more about [Bootstrap Accordions].

## Installation
### Manual Install
Download the [latest release] from [GitHub].
Unzip the contents to your WordPress Plugins directory (you may need to remove the release version from the directory name).
Activate plugin in WordPress admin.

### Using Composer
You can add the plugin to your install via composer using the following:
```json
{
	"repositories": [
		{
			"type": "vcs",
			"url": "https://github.com/monkishtypist/wpcpt-faqs"
		}
	],
	"require": [
		{
			"monkishtypist/wpcpt-faqs": "^v1.0.1",
		}
	]
}
```

## Shortcode Usage
Insert the following shortcode into your page or post to add a Bootstrap accordion of your FAQs:
`[faqs cat=5 id="100, 102, 103" exclude="104, 105"]`

- `cat=N` displays all FAQs from a specific category or categories, where N is the category ID or IDs (comma separated list)
- `id=N` includes only FAQs with the listed ID(s)
- `exclude=N` excludes FAQs with the listed ID(s)
- If you combine `cat` and `id`, only FAQs meeting both criteria are included.


[Bootstrap Accordions]: https://getbootstrap.com/docs/4.1/components/collapse/#accordion-example
[latest release]: https://github.com/monkishtypist/wpcpt-faqs/releases/latest
[GitHub]: https://github.com/monkishtypist/wpcpt-faqs/