# EduMatchup Elementor Addons

Nine Elementor widgets that recreate the content and visual direction of the supplied EduMatchup Modern homepage and destinations page. Developed by **PlayWithPPC**.

## Widgets

1. EduMatchup Hero
2. EduMatchup Destinations
3. EduMatchup Services
4. EduMatchup Arrival Support
5. EduMatchup Process Steps
6. EduMatchup Study Tools
7. EduMatchup Call to Action
8. EduMatchup Page Intro
9. EduMatchup Destination Directory

Destination cards, service rows, process steps and study tool links use Elementor repeaters, so editors can add, remove and reorder entries. Widget text, links, typography, colors, dimensions and section styling are editable. Responsive column, spacing and padding controls are included.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- Elementor (free) active

The reference theme supplied for this work requires PHP 8.1 for the theme itself. The addon supports PHP 7.4 as its minimum, but it cannot change the theme's separate PHP requirement.

## Install

1. In WordPress, open **Plugins → Add New Plugin → Upload Plugin**.
2. Upload `edu-matchup-elementor-addons.zip`, install and activate it.
3. Go to **Templates → Saved Templates → Import Templates** and import `templates/edumatchup-homepage.json` from the plugin package. Alternatively, add the seven homepage widgets in the order above.
4. Edit the Home page with Elementor and insert the imported **EduMatchup Homepage** template. Set the page layout to match the site's theme settings; the theme header and footer remain provided by the theme.
5. Use each widget's Content and Style tabs to change placeholder copy, links, design and repeatable items.

The template supplies the seven homepage widgets in order and does not automatically replace the site's current front page.

For the destinations page, import `templates/edumatchup-destinations.json` and insert **EduMatchup Destinations Page** on that page. It includes the intro and interactive filterable directory, without a CTA.

## Publish an update

Push the updated plugin source to the public repository, create a GitHub Release with a version tag such as `v1.1.0`, and attach a ZIP named exactly `edu-matchup-elementor-addons.zip`. The ZIP must contain the `edu-matchup-elementor-addons/` folder at its root. WordPress checks GitHub's latest release and uses that asset to offer the update. The release must use a version higher than the installed plugin version.
