<?php

/**
 * @package EugenePlugin
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
    {
        return require_once("$this->plugin_path/templates/admin.php");
    }

    public function adminCpt()
    {
        return require_once("$this->plugin_path/templates/cpt.php");
    }

    public function adminTaxonomy()
    {
        return require_once("$this->plugin_path/templates/taxonomy.php");
    }

    public function adminWidget()
    {
        return require_once("$this->plugin_path/templates/widget.php");
    }







    public function adminGallery()
	{
		echo "<h1>__Gallery Manager__</h1>";
	}

	public function adminTestimonial()
	{
		echo "<h1>__Testimonial Manager__</h1>";
	}

	public function adminTemplates()
	{
		echo "<h1>__Templates Manager__</h1>";
	}

	public function adminAuth()
	{
		echo "<h1>__Ajax Login/Signup Manager__</h1>";
	}

	public function adminMembership()
	{
		echo "<h1>__Membership Manager__</h1>";
	}

	public function adminChat()
	{
		echo "<h1>__Chat Manager__</h1>";
	}

    // public function eugeneOptionsGroup($input)
    // {

    //     return $input;
    // }

    // public function eugeneAdminSection()
    // {

    //     echo 'check this beautiful section';
    // }

    public function eugeneTextExample()
    {

        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here">';
    }

    public function eugeneFirstName() {

        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your first name">';
    }
}
