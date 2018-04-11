<?php

use yii\db\Migration;
use common\models\Setting;

/**
 * Class m180408_040826_insert_into_settings
 */
class m180408_040826_insert_into_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		//social links
		$this->insert('setting', ['name' => 'facebook','label' => 'Facebook','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		$this->insert('setting', ['name' => 'twitter','label' => 'Twitter','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		$this->insert('setting', ['name' => 'gplus','label' => 'Google Plus','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		$this->insert('setting', ['name' => 'pinterest','label' => 'Pinterest','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		$this->insert('setting', ['name' => 'instagram','label' => 'Instagram','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		
		//logo
		$this->insert('setting', ['name' => 'menu_bar_logo','label' => 'Menu Bar Logo','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HEADER]);
		
		//copyright text after current year and developer name
		$this->insert('setting', ['name' => 'footer_copyright','label' => 'Footer Copyright','default_value' => 'Little World','value' => 'Little World','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_FOOTER]);
		$this->insert('setting', ['name' => 'footer_developer','label' => 'Footer Developer','default_value' => 'Pankaj Salokhe','value' => 'Pankaj Salokhe','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_FOOTER]);
		$this->insert('setting', ['name' => 'footer_developer_link','label' => 'Footer Developer Link','default_value' => 'http://salokhe.in/','value' => 'http://salokhe.in/','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_FOOTER]);
		
		//contact page map address or coordinates of the office
		$this->insert('setting', ['name' => 'contact_map_address','label' => 'Contact Map Address/Coordinates','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_CONTACT_PAGE]);
		$this->insert('setting', ['name' => 'contact_phone','label' => 'Contact Phone','default_value' => '+8956 617 443','value' => '+8956 617 443','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_CONTACT_PAGE]);
		$this->insert('setting', ['name' => 'contact_email','label' => 'Contact Email','default_value' => 'pankaj@salokhe.in','value' => 'pankaj@salokhe.in','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_CONTACT_PAGE]);
		
		//home page slider background
		$this->insert('setting', ['name' => 'main_slider_images','label' => 'Main Slider Images','default_value' => null,'value' => null,'status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HOME_PAGE]);
		
		//home page section
		$this->insert('setting', ['name' => 'home_page_title','label' => 'Home Page Title','default_value' => 'Welcome to Little World','value' => 'Welcome to Little World','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HOME_PAGE]);
		$this->insert('setting', ['name' => 'home_page_content','label' => 'Home Page Content','default_value' => 'Art School is one of free website templates by TemplateMonster.com team. This template is optimized for 1280X1024 screen resolution. It is also XHTML & CSS valid.','value' => 'Art School is one of free website templates by TemplateMonster.com team. This template is optimized for 1280X1024 screen resolution. It is also XHTML & CSS valid.','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_HOME_PAGE]);
		
		//about us page section
		$this->insert('setting', ['name' => 'about_page_title','label' => 'About Page Title','default_value' => 'A Few Words About Us','value' => 'A Few Words About Us','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_ABOUT_PAGE]);
		$this->insert('setting', ['name' => 'about_page_content','label' => 'About Page Content','default_value' => 'Consetetur sadipscing elitr, sed diam nonumy eirmod tempor. Invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et acam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.','value' => 'About Page Content','default_value' => 'Consetetur sadipscing elitr, sed diam nonumy eirmod tempor. Invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et acam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_ABOUT_PAGE]);
		
		//about us page what we offer section
		$this->insert('setting', ['name' => 'about_page_offer_title','label' => 'What We Offer Title','default_value' => 'What We Offer','value' => 'What We Offer','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_ABOUT_PAGE]);
		$this->insert('setting', ['name' => 'about_page_offer_content','label' => 'About Page Content','default_value' => 'Nam liber tempor cum soluta nobis eleifend option

Congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit:

Sed diam nonummy nibh euismod
Tincidunt ut laoreet dolore
Magna aliquam erat volutpat wisi enim
Minim veniam, quis nostrud exerci
Duis autem vel eum iriure dolor
Hendrerit in vulputate velit molestie
Consequat vel illum dolore
Feugiat nulla facilisis at vero eros','value' => 'Nam liber tempor cum soluta nobis eleifend option

Congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit:

Sed diam nonummy nibh euismod
Tincidunt ut laoreet dolore
Magna aliquam erat volutpat wisi enim
Minim veniam, quis nostrud exerci
Duis autem vel eum iriure dolor
Hendrerit in vulputate velit molestie
Consequat vel illum dolore
Feugiat nulla facilisis at vero eros','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_ABOUT_PAGE]);
		
		//schedule page
		$this->insert('setting', ['name' => 'schedule_page_title','label' => 'Schedule Page Title','default_value' => 'About Schedule','value' => 'About Schedule','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_SCHEDULE_PAGE]);
		$this->insert('setting', ['name' => 'schedule_page_sub_title','label' => 'Schedule Page Sub Title','default_value' => 'At vero eos et accusam et justo duo dolores et ea rebum.','value' => 'At vero eos et accusam et justo duo dolores et ea rebum.','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_SCHEDULE_PAGE]);
		$this->insert('setting', ['name' => 'schedule_page_content','label' => 'Schedule Page Content','default_value' => 'Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor. Loremsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.

Eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum 
dolor sit amet','value' => 'Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor. Loremsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.

Eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum 
dolor sit amet','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_SCHEDULE_PAGE]);
		$this->insert('setting', ['name' => 'schedule_page_table_content','label' => 'Schedule Page Table Content','default_value' => '<table class="table">
              <tbody><tr>
                <th>Monday</th>
                <th>Wednesday</th>
                <th>Friday</th>
                <th class="last">Saturday</th>
              </tr>
              <tr>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
              </tr>
              <tr>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
              </tr>
              <tr>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
              </tr>
            </tbody></table>','value' => '<table class="table">
              <tbody><tr>
                <th>Monday</th>
                <th>Wednesday</th>
                <th>Friday</th>
                <th class="last">Saturday</th>
              </tr>
              <tr>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
                <td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
              </tr>
              <tr>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
                <td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
              </tr>
              <tr>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
                <td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
              </tr>
            </tbody></table>','status' => 10,'created_by' => null,'updated_by' => null,'created_at' => time(),'updated_at' => time(), 'setting_group' => Setting::GROUP_SCHEDULE_PAGE]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180408_040826_insert_into_settings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180408_040826_insert_into_settings cannot be reverted.\n";

        return false;
    }
    */
}
