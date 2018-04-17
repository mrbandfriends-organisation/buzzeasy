<?php
namespace Buzzeasy\App\Traits;

/**
 * Trait providing the ability to include a template via output buffering
 */
trait Templatable
{
    /**
     * Pulls in given template, declares any variables provided inside its scope
     * and returns a string of the parsed template. Checks the theme directory
     * for the template and falls back to plugin directory if it cannot be found
     *
     * example: $this->getTemplate('partials/shared/example.php');
     *
     * @param  string $templateName
     * @param  array  $data
     * @return string
     */
    public function getTemplate(string $templateName, array $data = []) : string
    {
        $templatesDirectory = 'templates/';

        if (!strpos($templateName, '.php')) {
            $templateName = $templateName . '.php';
        }

        $template = $templatesDirectory . $templateName;

        if (locate_template($template)) {
            $template = get_stylesheet_directory() . '/' . $template;
        } else {
            $template = plugin_dir_path(dirname(__FILE__)) . $template;
        }

        if (is_array($data)) {
            extract($data);
        }

        ob_start();

        require $template;

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
