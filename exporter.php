<?php
/**
 * @return void
 * @author Kolja Nolte <kolja.nolte@gmail.com>
 *
 * Function to convert WordPress posts into frontmatter format and write them to files.
 *
 * This function retrieves the latest three posts of the 'report' post type.
 * For each post, it retrieves all the properties and the terms of all taxonomies.
 * It then formats these values into frontmatter syntax and writes them to a file.
 * The file is located in a directory named after the post's ID and name, and is named 'index.md'.
 * The directory is located in the 'content' directory in the current directory.
 *
 * @since 0.0.1
 * @version 0.0.1
 */
function convert_posts_to_frontmatter(): void
{
    /** Get the latest three posts of the 'report' post type */
    $posts = get_posts(['post_type' => 'report', 'numberposts' => 3]);

    /** For each post */
    foreach ($posts as $post) {
        /** Get all the properties of the post */
        $post_vars = get_object_vars($post);
        /** Get the terms for all taxonomies */
        $taxonomies = get_object_taxonomies($post);

        /** For each taxonomy */
        foreach ($taxonomies as $taxonomy) {
            /** Get the terms of the taxonomy */
            $terms = get_the_terms($post->ID, $taxonomy);
            /** If there are terms and no error occurred */
            if (!is_wp_error($terms) && $terms) {
                /** Add the terms to the post properties */
                $post_vars[$taxonomy] = implode(', ', wp_list_pluck($terms, 'name'));
            }
        }

        /** Get the post content and remove it from the post properties */
        $post_content = $post_vars['post_content'];
        unset($post_vars['post_content']);

        /** Start the frontmatter with the header */
        $frontmatter = "---\n";
        /** For each post property */
        foreach ($post_vars as $key => $value) {
            /** Add the property to the frontmatter */
            $frontmatter .= "$key: $value\n";
        }
        /** End the frontmatter header and add the post content */
        $post_content = trim(strip_tags($post_content));
        $frontmatter .= "---\n$post_content\n";

        /** Define the directory path */
        $directory = "./content/reports/{$post->ID}.{$post->post_name}";
        /** Create the directory if it doesn't exist */
        wp_mkdir_p($directory);

        $filename = "{$directory}/index.md";
        /** Write the frontmatter to a file named 'index.md' in the directory */
        file_put_contents($filename, $frontmatter);
    }
}

/** Call the function */
convert_posts_to_frontmatter();