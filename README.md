# WP Frontmatter Exporter

**WP Frontmatter Exporter** is a simple PHP script that converts WordPress posts (or custom post types) into frontmatter markdown files, which are then written in a structured directory format.

## Quick Start

1. Clone or [download](https://codeload.github.com/thaikolja/wp-frontmatter-exporter/zip/refs/heads/main) the script into your WordPress environment.
2. Include the script in your WordPress execution flow.
3. Call the function to export posts:
   `convert_posts_to_frontmatter();`

## Extending

The script is currently set to retrieve the latest three posts of the 'report' post type. To modify this behavior or extend the script:
- Adjust the `get_posts` parameters to change the post-retrieval logic.
- Enhance the frontmatter conversion to include additional or custom post data.

## Contribute

Contributions to improve the script or extend its functionality are welcome. Please submit pull requests or issues through the GitHub repository.

## Credits
- **Author**: Kolja Nolte (kolja.nolte@gmail.com)
- **Version**: 0.0.1
- **Since**: 0.0.1

This format provides sections for a quick start guide, instructions for extending the script's functionality, contribution guidelines, and credits, including authorship and version information.
