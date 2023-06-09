<?php

namespace App\Http\Controllers;

use App\Http\Models\Customer;
use App\Http\Models\CustomerModule;
use App\Http\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;
use PDO;
use crocodicstudio_voila\crudbooster\helpers\CRUDBooster;
use Exception;

class AdminCustomersController extends \crocodicstudio_voila\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field         = "first_name";
        $this->limit               = "20";
        $this->orderby             = "sorting,asc";
        $this->global_privilege    = false;
        $this->button_table_action = true;
        $this->button_bulk_action  = true;
        $this->button_action_style = "button_icon";
        $this->button_add          = false;
        $this->button_edit         = false;
        $this->button_delete       = false;
        $this->button_detail       = true;
        $this->button_show         = true;
        $this->button_filter       = true;
        $this->button_import       = false;
        $this->button_export       = false;
        $this->table               = "customers";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col   = [];
        // $this->col[] = ['label'=>'Name','name'=>'name','join'=>'categories,name','callback_php'=>'$row->categories_name."_".$row->categories_id'];
        $this->col[] = ["label" => "Name", "name" => "first_name",'join'=>'customers,last_name','callback_php'=>'$row->first_name." ".$row->last_name'];
        $this->col[] = ["label" => "Last Name", "name" => "last_name",'visible'=>false];
        $this->col[] = ["label" => "Company", "name" => "company_en"];
        $this->col[] = ["label" => "Email", "name" => "email"];
        $this->col[] = ["label" => "Phone", "name" => "phone"];
        $this->col[] = ["label" => "Free Trial","name" => "is_free_trial",'callback_php'=>'$row->is_free_trial?"<span class=\"fa fa-check text-success\"></span>":"<span class=\"fa fa-close text-danger\"></span>"'];
        $this->col[] = ["label" => "Link", "name" => "host_link","callback_php"=>'$row->host_link?"<a target=\"_blank\" href=\"$row->host_link\">$row->host_link</a>":""'];
        $this->col[] = ["label" => "Due Date", "name" => "free_trial_end_date","callback_php"=>'$row->free_trial_end_date?$row->free_trial_end_date:$row->subscription_end_date'];
        $this->col[] = ["label" => "active", "name" => "active"];
        // $this->col[] = ["label" => "Folder Location", "name" => "folder_location"];
        // $this->col[] = ["label" => "Database Name", "name" => "database_name"];
        // $this->col[] = ["label" => "Database Password", "name" => "database_password"];
        # END COLUMNS DO NOT REMOVE THIS LINE

        # START FORM DO NOT REMOVE THIS LINE
        $this->form   = [];
        $this->form[] = ['label' => 'First Name', 'name' => 'first_name', 'type' => 'text', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Last Name', 'name' => 'last_name', 'type' => 'text', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Phone', 'name' => 'phone', 'type' => 'number', 'width' => 'col-sm-10', 'placeholder' => 'You can only enter the number only'];
        $this->form[] = ['label' => 'Company EN', 'name' => 'company_en', 'type' => 'text', 'width' => 'col-sm-9', 'placeholder' => 'Please enter a valid email address'];
        $this->form[] = ['label' => 'Company Ar', 'name' => 'company_ar', 'type' => 'text', 'width' => 'col-sm-9', 'placeholder' => 'Please enter a valid email address'];
        $this->form[] = ['label' => 'Email', 'name' => 'email', 'type' => 'email', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Host Link', 'name' => 'host_link', 'type' => 'text', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Folder Location', 'name' => 'folder_location', 'type' => 'text', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Database Name', 'name' => 'database_name', 'type' => 'text', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Database Password', 'name' => 'database_password', 'type' => 'text', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Free Trial Start Date', 'name' => 'free_trial_start_date', 'type' => 'date', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Free Trial End Date', 'name' => 'free_trial_end_date', 'type' => 'date', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Subscription Type', 'name' => 'subscription_type', 'type' => 'select', 'width' => 'col-sm-9', 'dataenum' => 'year|Year;month|Month;six-month|SixMonths'];
        $this->form[] = ['label' => 'Subscription Start Date', 'name' => 'subscription_start_date', 'type' => 'date', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Subscription End Date', 'name' => 'subscription_end_date', 'type' => 'date', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Last Renewal Date', 'name' => 'last_renewal_date', 'type' => 'date', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Users Count', 'name' => 'users_count', 'type' => 'number', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Modules', 'name' => 'modules', 'type' => 'select2', 'width' => 'col-sm-9', 'datatable' => 'modules,name_en', 'relationship_table' => 'customer_module'];
        $this->form[] = ['label' => 'System Language', 'name' => 'sys_lang', 'type' => 'text', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Free Trial', 'name' => 'is_free_trial', 'type' => 'checkbox', 'validation' => 'required', 'width' => 'col-sm-9'];
        $this->form[] = ['label' => 'Active', 'name' => 'active', 'type' => 'radio', 'width' => 'col-sm-10'];
        # END FORM DO NOT REMOVE THIS LINE

        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','width'=>'col-sm-10'];
        //$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','width'=>'col-sm-10'];
        //$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'number','width'=>'col-sm-10','placeholder'=>'You can only enter the number only'];
        //$this->form[] = ['label'=>'Address','name'=>'address','type'=>'textarea','width'=>'col-sm-10'];
        //$this->form[] = ['label'=>'Company EN','name'=>'company_en','type'=>'text','width'=>'col-sm-9','placeholder'=>'Please enter a valid email address'];
        //$this->form[] = ['label'=>'Company Ar','name'=>'company_ar','type'=>'text','width'=>'col-sm-9','placeholder'=>'Please enter a valid email address'];
        //$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','width'=>'col-sm-10'];
        //$this->form[] = ['label'=>'Host Link','name'=>'host_link','type'=>'text','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Free Trial Start Date','name'=>'free_trial_start_date','type'=>'date','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Free Trial End Date','name'=>'free_trial_end_date','type'=>'date','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Subscription Type','name'=>'subscription_type','type'=>'select','width'=>'col-sm-9','dataenum'=>'year|Year;month|Month;six-month|SixMonths'];
        //$this->form[] = ['label'=>'Subscription Start Date','name'=>'subscription_start_date','type'=>'date','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Subscription End Date','name'=>'subscription_end_date','type'=>'date','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Last Renewal Date','name'=>'last_renewal_date','type'=>'date','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Users Count','name'=>'users_count','type'=>'number','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Modules','name'=>'modules','type'=>'select2','width'=>'col-sm-9','datatable'=>'modules,name_en'];
        //$this->form[] = ['label'=>'System Language','name'=>'sys_lang','type'=>'text','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Free Trial','name'=>'is_free_trial','type'=>'checkbox','validation'=>'required','width'=>'col-sm-9'];
        //$this->form[] = ['label'=>'Active','name'=>'active','type'=>'radio','width'=>'col-sm-10'];
        # OLD END FORM

        /*
        | ----------------------------------------------------------------------
        | Sub Module
        | ----------------------------------------------------------------------
        | @label          = Label of action
        | @path           = Path of sub module
        | @foreign_key       = foreign key of sub table/module
        | @button_color   = Bootstrap Class (primary,success,warning,danger)
        | @button_icon    = Font Awesome Class
        | @parent_columns = Sparate with comma, e.g : name,created_at
        |
         */
        $this->sub_module = array();

        /*
        | ----------------------------------------------------------------------
        | Add More Action Button / Menu
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
        | @icon        = Font awesome class icon. e.g : fa fa-bars
        | @color        = Default is primary. (primary, warning, success, info)
        | @showIf        = If condition when action show. Use field alias. e.g : [id] == 1
        |
         */
        $this->addaction   = array();
        $this->addaction[] = [
            'label' => 'Activate',
            'url'   => CRUDBooster::mainpath('activateCustomer/[id]'),
            'icon'  => 'fa fa-check',
            'color' => 'success',
            // 'target' => '_blank',
            'showIf' => '[is_free_trial] == 0 && [active] == 0'
        ];
        $this->addaction[] = [
            'label' => 'Renewal',
            'url'   => CRUDBooster::mainpath('renewalSubscriptionPage/[id]'),
            'icon'  => 'fa fa-check',
            'color' => 'success',
            // 'target' => '_blank',
            'showIf' => '[active] == 1'
        ];

        // $this->addaction[] = [
        //     'label' => 'Generate Json',
        //     'url'   => CRUDBooster::mainpath('generateJson/[id]'),
        //     'icon'  => 'fa fa-check',
        //     'color' => 'danger',
        // ];

        // $this->addaction[] = [
        //     'label' => 'Send Host Link',
        //     'url'   => CRUDBooster::mainpath('send-link/[id]'),
        //     'icon'  => 'fa fa-envelope',
        //     'color' => 'info',
        // ]; 

        /*
        | ----------------------------------------------------------------------
        | Add More Button Selected
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @icon        = Icon from fontawesome
        | @name        = Name of button
        | Then about the action, you should code at actionButtonSelected method
        |
         */
        $this->button_selected = array();

        /*
        | ----------------------------------------------------------------------
        | Add alert message to this module at overheader
        | ----------------------------------------------------------------------
        | @message = Text of message
        | @type    = warning,success,danger,info
        |
         */
        $this->alert = array();

        /*
        | ----------------------------------------------------------------------
        | Add more button to header button
        | ----------------------------------------------------------------------
        | @label = Name of button
        | @url   = URL Target
        | @icon  = Icon from Awesome.
        |
         */
        $this->index_button = array();

        /*
        | ----------------------------------------------------------------------
        | Customize Table Row Color
        | ----------------------------------------------------------------------
        | @condition = If condition. You may use field alias. E.g : [id] == 1
        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
        |
         */
        $this->table_row_color = array();

        /*
        | ----------------------------------------------------------------------
        | IF NOT SUCCESS ADD  $this->col[] = ["label"=>"active","name"=>"active"]; IN COLUMNS
        |
         */

        $this->table_row_color[] = ["condition" => "[active]==1", "color" => "success"];
        $this->table_row_color[] = ["condition" => "[active]==0", "color" => "danger"];

        /*
        | ----------------------------------------------------------------------
        | You may use this bellow array to add statistic at dashboard
        | ----------------------------------------------------------------------
        | @label, @count, @icon, @color
        |
         */
        $this->index_statistic = array();

        /*
        | ----------------------------------------------------------------------
        | Add javascript at body
        | ----------------------------------------------------------------------
        | javascript code in the variable
        | $this->script_js = "function() { ... }";
        |
         */
        $this->script_js = null;

        /*
        | ----------------------------------------------------------------------
        | Include HTML Code before index table
        | ----------------------------------------------------------------------
        | html code to display it before index table
        | $this->pre_index_html = "<p>test</p>";
        |
         */
        $this->pre_index_html = null;

        /*
        | ----------------------------------------------------------------------
        | Include HTML Code after index table
        | ----------------------------------------------------------------------
        | html code to display it after index table
        | $this->post_index_html = "<p>test</p>";
        |
         */
        $this->post_index_html = null;

        /*
        | ----------------------------------------------------------------------
        | Include Javascript File
        | ----------------------------------------------------------------------
        | URL of your javascript each array
        | $this->load_js[] = asset("myfile.js");
        |
         */
        $this->load_js = array();

        /*
        | ----------------------------------------------------------------------
        | Add css style at body
        | ----------------------------------------------------------------------
        | css code in the variable
        | $this->style_css = ".style{....}";
        |
         */
        $this->style_css = null;

        /*
        | ----------------------------------------------------------------------
        | Include css File
        | ----------------------------------------------------------------------
        | URL of your css each array
        | $this->load_css[] = asset("myfile.css");
        |
         */
        $this->load_css = array();
    }

    public function activateCustomer($id)
    {
        $customer = Customer::where('id', $id)->first();

        if ($customer->is_free_trial) {
            $customer->free_trial_start_date = Carbon::now()->format('Y-m-d');
            $customer->free_trial_end_date   = Carbon::now()->addMonth()->format('Y-m-d');
        } else if ($customer->subscription_type == 'year') {
            $customer->last_renewal_date     = $customer->subscription_start_date     = Carbon::now()->format('Y-m-d');
            $customer->subscription_end_date = Carbon::now()->addYear()->format('Y-m-d');
        } else if ($customer->subscription_type == 'month') {
            $customer->last_renewal_date     = $customer->subscription_start_date     = Carbon::now()->format('Y-m-d');
            $customer->subscription_end_date = Carbon::now()->addMonth()->format('Y-m-d');
        } else if ($customer->subscription_type == 'six-month') {
            $customer->last_renewal_date     = $customer->subscription_start_date     = Carbon::now()->format('Y-m-d');
            $customer->subscription_end_date = Carbon::now()->addMonths(6)->format('Y-m-d');
        }
        $customer->active    = 1;
        $customer->save();
        //-------------------------------------------//
        //--- Send Email with Details
        if (!$customer->is_free_trial) {
            //------------------------------------------------//
            $customer->custom_token = null;
            $customer->save();
            //----------------------------------------------------//
            $this->createCustomerFiles($customer);
            //----------------------------------------------------//
        }
        //-------------------------------------------//
        CRUDBooster::redirect(
            CRUDBooster::adminPath('customers'),
            "customer {$customer->first_name} {$customer->last_name} Activated!",
            "success"
        );
    }
    //---------------------------------------------------------------------------------------------//
    private function createCustomerFiles(Customer $customer)
    {
        set_time_limit(0);
        // 1- create host dir
        $folderName = strtolower(str_replace(" ", "", $customer->website) . ".shms.io");
        $folderPath = env("MAIN_SUBDOMAIN_PATH") . "/$folderName";
        if (file_exists($folderPath)) {
            rrmdir($folderPath);
        }
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        //-----------------------//
        // 2- copy from public dir to private dir
        $formDir = env("MAIN_WEBSITE_PATH") . '/main/shipping_system';
        $toDir = $folderPath;
        $this->copydir($formDir, $toDir);
        //-----------------------//
        // 4- change the value of the backend url to customer host main.js app.json
        $mainJsFileName = env("MAIN_SUBDOMAIN_PATH") . "/$folderName/main.js";
        $mainJsFileFile = file_get_contents($mainJsFileName);
        $mainJsFileFile = str_replace('$$endPointUrl$$', 'https://' . $folderName . '/backend', $mainJsFileFile);
        $jsonData = json_encode($this->getCustomerModulesJson($customer));
        $mainJsFileFile = str_replace('$$SettingsJSON$$', $jsonData, $mainJsFileFile);
        file_put_contents($mainJsFileName, $mainJsFileFile);
        //-----------------------//
        $appJsonFileName = $folderPath . '/assets/config/app.json';
        $appJsonFileFile = file_get_contents($appJsonFileName);
        $replacedAppJsonFile = str_replace('$$endPointUrl$$', 'https://' . $folderName . '/backend', $appJsonFileFile);
        file_put_contents($appJsonFileName, $replacedAppJsonFile);
        //-----------------------//
        // 5- add customer color
        $stylesFileName = $folderPath . '/assets/themes/elmer/dist/css/style.css';
        $styleFile = file_get_contents($stylesFileName);
        $replacedStyleFile = str_replace('$$main-color$$', $customer->color?$customer->color:env("DEFAULT_MAIN_COLOR"), $styleFile);
        file_put_contents($stylesFileName, $replacedStyleFile);
        //-----------------------//
        // 5- add settings file
        $jsonData = json_encode($this->getCustomerModulesJson($customer));
        $appJsonFileName = $folderPath . '/assets/config/settings.json';
        file_put_contents($appJsonFileName, $jsonData);
        $appJsonFileName = $folderPath . '/backend/storage/settings.json';
        file_put_contents($appJsonFileName, $jsonData);
        //-----------------------//
        // 6- create customer db and change settings in .env of backend
        $customerDB = "shms_db_{$customer->id}";
        $customerDBUser = "{$customerDB}";
        $customerDBPassword = $this->randomPassword();
        $customerEmailPassword = $this->randomPassword();
        $customerDBHost = "localhost";
        $customer->database_name = $customerDB;
        $customer->database_password = $customerDBPassword;
        $customer->folder_location = $folderPath;
        $customer->save();
        //----
        $rootUser = env("MAIN_DB_USER");
        $rootUserPassword = env("MAIN_DB_PASSWORD");
        //----
        $dbh = new PDO("mysql:host=localhost", $rootUser, $rootUserPassword);
        $dbh->exec("DROP DATABASE IF EXISTS `$customerDB`;");
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }

        $dbh->exec("CREATE DATABASE `$customerDB` CHARACTER SET utf8 COLLATE utf8_general_ci;");
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }
        $dbh->exec("DROP USER IF EXISTS `$customerDBUser`@'localhost';");
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }

        $dbh->exec("CREATE USER '$customerDBUser'@'localhost' IDENTIFIED BY '$customerDBPassword';");
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }
        $dbh->exec("GRANT ALL ON `$customerDB`.* TO '$customerDBUser'@'localhost';
                FLUSH PRIVILEGES;");
        //-----------------------//
        $dbh = new PDO("mysql:host=$customerDBHost;dbname=$customerDB", $rootUser, $rootUserPassword);
        //-----------------------//
        $query = file_get_contents(env("MAIN_WEBSITE_PATH") . '/main/db.sql');
        $query = str_replace('$$DB_USER$$', $customerDBUser, $query);
        $query = str_replace('$$DB_SERVER$$', $customerDBHost, $query);
        $query = str_replace('$$USERPASSWORD$$', password_hash($customerEmailPassword, PASSWORD_DEFAULT), $query);
        $query = str_replace('$$USERNAME$$', $customer->email, $query);
        $dbh->exec("SET NAMES 'utf8';");
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }
        $dbh->exec("SET SESSION query_cache_type = OFF;");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // $dbh->prepare($query);
        $dbh->exec($query);
        if ($dbh->errorCode() != "00000") {
            throw new Exception("error");
        }
        //-----------------------//
        // 7- create customer db and change settings in .env of backend
        $envFileName = $folderPath . '/backend/.env';
        $envFile = file_get_contents($envFileName);
        $envFile = str_replace('$$DB_DATABASE$$', $customerDB, $envFile);
        $envFile = str_replace('$$DB_USERNAME$$', $customerDBUser, $envFile);
        $envFile = str_replace('$$DB_PASSWORD$$', $customerDBPassword, $envFile);
        file_put_contents($envFileName, $envFile);
        //-----------------------//
        $result = shell_exec("php " . env("MAIN_SUBDOMAIN_PATH") . "/$folderName/backend/artisan config:clear");
        $result = shell_exec("php " . env("MAIN_SUBDOMAIN_PATH") . "/$folderName/backend/artisan cache:clear");
        $result = shell_exec("php " . env("MAIN_SUBDOMAIN_PATH") . "/$folderName/backend/artisan view:clear");
        $result = shell_exec("php " . env("MAIN_SUBDOMAIN_PATH") . "/$folderName/backend/artisan route:clear");
        //-----------------------//
        // 8- send email to the customers
        CRUDBooster::sendEmail([
            'to' => $customer->email,
            'data' => [
                'full_name' => $customer->first_name . ' ' . $customer->last_name,
                'site_link' => 'https://' . env("HOST_LINK") . $folderName,
                'email' => $customer->email,
                'password' => $customerEmailPassword,
            ],
            'template' => 'customer_activation_done',
            'attachments' => [],
        ]);
        //-----------------------//
        // 9- expire token
        $customer->custom_token = null;
        $customer->active = 1;
        $customer->save();
        //-----------------------//
    }
    //---------------------------------------------------------------------------------------------//
    public function renewalSubscriptionPage($id)
    {
        $customer = Customer::find($id);
        $modules = Module::all();
        $customerModules = CustomerModule::where("customers_id", $id)->pluck("id")->toArray();
        return view("customer.renewal-subscription", compact("customer", "modules", "customerModules"));
    }
    //---------------------------------------------------------------------------------------------//
    public function saveRenewalSubscription()
    {
        $data = $_POST;
        $customer                    = Customer::where('id', $data["id"])->first();
        $customer->last_renewal_date = Carbon::now();
        $customer->subscription_type = $data["subscription_type"];
        $customer->subscription_start_date = $data["subscription-start-date"];
        if ($data["subscription_type"] == "year") {
            $customer->subscription_end_date = Carbon::parse($data["subscription-start-date"])->addYear()->format('Y-m-d');
        } else if ($data["subscription_type"] == "month") {
            $customer->subscription_end_date = Carbon::parse($data["subscription-start-date"])->addMonth()->format('Y-m-d');
        } else if ($data["subscription_type"] == "six-month") {
            $customer->subscription_end_date = Carbon::parse($data["subscription-start-date"])->addMonths(6)->format('Y-m-d');
        }
        CustomerModule::where("customer_id", $customer->id)->delete();
        $modules = $data["modules"];
        foreach ($modules as $item) {
            $customerModule = new CustomerModule();
            $customerModule->customers_id = $data["id"];
            $customerModule->modules_id = $item;
            $customerModule->save();
        }
        $customer->is_free_trial = 0;
        $customer->active = 1;
        $customer->save();
        //--------------------------------------------------------------------//
        $folderName = strtolower(str_replace(" ","",$customer->website).".shms.io");
        $folderPath = env("MAIN_SUBDOMAIN_PATH")."/$folderName";
        $jsonData = json_encode($this->getCustomerModulesJson($customer));
        // 1- change the value of the backend url to customer host main.js app.json
        $mainJsFileName = env("MAIN_SUBDOMAIN_PATH")."/$folderName/main.js";
        $mainJsFileFile = file_get_contents($mainJsFileName);
        $mainJsFileFile = str_replace('$$SettingsJSON$$',$jsonData,$mainJsFileFile);
        file_put_contents($mainJsFileName,$mainJsFileFile);
        //---------------------------------------------------------------------//
        // 2- add settings file
        $appJsonFileName = $folderPath.'/assets/config/settings.json';
        file_put_contents($appJsonFileName,$jsonData);
        $appJsonFileName = $folderPath.'/backend/storage/settings.json';
        file_put_contents($appJsonFileName,$jsonData);
        //---------------------------------------------------------------------//
        //3- clear cache
        $result = shell_exec("php ".env("MAIN_SUBDOMAIN_PATH")."/$folderName/backend/artisan config:clear");
        $result = shell_exec("php ".env("MAIN_SUBDOMAIN_PATH")."/$folderName/backend/artisan cache:clear");
        $result = shell_exec("php ".env("MAIN_SUBDOMAIN_PATH")."/$folderName/backend/artisan view:clear");
        $result = shell_exec("php ".env("MAIN_SUBDOMAIN_PATH")."/$folderName/backend/artisan route:clear");
        //---------------------------------------------------------------------//
    }
    //---------------------------------------------------------------------------------------------//
    public function generateJson($id)
    {
        $customer         = Customer::where('id', $id)->first();
        $customerModules  = CustomerModule::where('customers_id', $id)->with('module')->get();
        $modules          = DB::table('modules')->get();
        $obligatedModules = DB::table('modules')->where('is_obligate', 1)->get();
        //-------------------------------------------//
        $data = [];
        foreach ($modules as $module) {
            $data[$module->code] = false;
        }
        foreach ($customerModules as $module) {
            $data[$module->module->code] = true;
        }
        foreach ($obligatedModules as $module) {
            $data[$module->code] = true;
        }
        $data['language']              = $customer->sys_lang; // yazan_edits
        $data['users_count']           = $customer->users_count;
        $data['end_subscription_date'] = $customer->subscription_end_date;
        $data['end_free_trial_date']   = $customer->free_trial_end_date;
        $data['subscription_type']     = $customer->subscription_type; // yazan_edits
        $data['company_en']            = $customer->company_en;
        $data['company_ar']            = $customer->company_ar;
        //-------------------------------------------//
        $file            = 'settings.json';
        $destinationPath = public_path() . "/upload/json/";
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        File::put($destinationPath . $file, json_encode($data));
        //-------------------------------------------//
        return response()->download($destinationPath . $file);
    }
    //---------------------------------------------------------------------------------------------//
    public function sendLink($id)
    {
        $customer = Customer::where('id', $id)->first();
        $value    = $customer->host_link;
        return view('customer.set-host-link', compact('id', 'value'));
    }

    public function saveLink()
    {
        $data                = $_REQUEST;
        $customer            = Customer::where('id', $data['id'])->first();
        $customer->host_link = $_REQUEST['host_link'];
        $customer->save();
        $full_name = $customer['first_name'] . ' ' . $customer['last_name'];
        $link      = $customer['host_link'];
        $email     = $customer['email'];
        $data      = [
            'full_name' => $full_name,
            'link'      => $link,
        ];
        CRUDBooster::sendEmail(['to' => $email, 'data' => $data, 'template' => 'email_template_send_host_link', 'attachments' => []]);
        CRUDBooster::redirect(CRUDBooster::adminPath('customers'), "Email has been sent successfully to Customer {$customer->first_name} {$customer->last_name}", "success");
    }
    /*
    | ----------------------------------------------------------------------
    | ----------------------------------------------------------------------
    | Hook for button selected
    | ----------------------------------------------------------------------
    | @id_selected = the id selected
    | @button_name = the name of button
    |
     */
    public function actionButtonSelected($id_selected, $button_name)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate query of index result
    | ----------------------------------------------------------------------
    | @query = current sql query
    |
     */
    public function hook_query_index(&$query)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate row of index table html
    | ----------------------------------------------------------------------
    |
     */
    public function hook_row_index($column_index, &$column_value)
    {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
     */
    public function hook_before_add(&$postdata)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @id = last insert id
    |
     */
    public function hook_after_add($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before update data is execute
    | ----------------------------------------------------------------------
    | @postdata = input post data
    | @id       = current id
    |
     */
    public function hook_before_edit(&$postdata, $id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
     */
    public function hook_after_edit($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
     */
    public function hook_before_delete($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
     */
    public function hook_after_delete($id)
    {
        //Your code here
        CustomerModule::where("customers_id",$id)->delete();
    }

    //By the way, you can still create your own method in here... :)

    private function copydir($source, $destination)
    {
        if (!is_dir($destination)) {
            $oldumask = umask(0);
            mkdir($destination, 01777); // so you get the sticky bit set 
            umask($oldumask);
        }
        $dir_handle = @opendir($source) or die("Unable to open");
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != ".." && !is_dir("$source/$file")) //if it is file
                copy("$source/$file", "$destination/$file");
            if ($file != "." && $file != ".." && is_dir("$source/$file")) //if it is folder
                $this->copydir("$source/$file", "$destination/$file");
        }
        closedir($dir_handle);
    }

    private function getCustomerModulesJson($customer)
    {
        $customerModules = CustomerModule::where('customers_id', $customer->id)->with('module')->get();
        $modules = Module::all();
        $obligatedModules = Module::where('is_obligate', 1)->get();
        //-------------------------------------------//
        $data = [];
        foreach ($modules as $module) {
            $data[$module->code] = false;
        }
        foreach ($customerModules as $module) {
            $data[$module->module->code] = true;
        }
        foreach ($obligatedModules as $module) {
            $data[$module->code] = true;
        }
        $data['language'] = $customer->sys_lang; // yazan_edits
        $data['users_count'] = $customer->users_count;
        $data['start_subscription_date'] = $customer->subscription_start_date;
        $data['end_subscription_date'] = $customer->subscription_end_date;
        $data['start_free_trial_date'] = $customer->free_trial_start_date;
        $data['end_free_trial_date'] = $customer->free_trial_end_date;
        $data['last_renewal_date'] = $customer->last_renewal_date;
        $data['subscription_type'] = $customer->subscription_type; // yazan_edits
        $data['company_en'] = $customer->company_en;
        $data['company_ar'] = $customer->company_ar;
        $data['logo'] = $customer->logo_path;
        $data['color'] = $customer->color;
        return $data;
    }

    private function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass) . "&L123"; //turn the array into a string
    }

    public function deleteCustomer(){
        $da = new DirectAdmin("https://mohasabeh.com:2222", config("app.mohasabeh_settings.DIRECT_ADMIN_USER_USER"), config("app.mohasabeh_settings.DIRECT_ADMIN_USER_PASSWORD"));
        $result = $da->query('CMD_API_SUBDOMAINS', ["domain" => "mohasabeh.com"]);
        if ($da->error) {
            return new Exception("error");
        }
    }
}
