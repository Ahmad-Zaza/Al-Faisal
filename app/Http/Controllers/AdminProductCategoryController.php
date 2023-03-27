<?php

namespace App\Http\Controllers;

use App\Http\Models\ProductCategory;
use App\Http\Models\SubProductCategoryInfo;
use Session;
use Request;
use CRUDBooster;
use Illuminate\Support\Facades\DB;

class AdminProductCategoryController extends \crocodicstudio_voila\crudbooster\controllers\CBController
{

	public function cbInit()
	{

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "name";
		$this->limit = "20";
		$this->orderby = "sorting,asc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = true;
		$this->button_action_style = "button_icon";
		$this->button_add = true;
		$this->button_edit = true;
		$this->button_delete = true;
		$this->button_detail = true;
		$this->button_show = true;
		$this->button_filter = true;
		$this->button_import = false;
		$this->button_export = false;
		$this->table = "product_category";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
		$this->col[] = ["label" => "Name En", "name" => "name_en"];
		$this->col[] = ["label" => "Name Ar", "name" => "name_ar"];
		// $this->col[] = ["label"=>"active","name"=>"active"];
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];
		$this->form[] = ['label' => 'Name Ar', 'name' => 'name_ar', 'type' => 'text', 'validation' => 'required|string', 'width' => 'col-sm-10', 'placeholder' => 'You can only enter the letter only'];
		$this->form[] = ['label' => 'Name En', 'name' => 'name_en', 'type' => 'text', 'validation' => 'required|string', 'width' => 'col-sm-10', 'placeholder' => 'You can only enter the letter only'];
		// $this->form[] = ['label' => 'Has Sub Categories', 'name' => 'has_sub_category', 'type' => 'select', 'validation' => 'required', 'width' => 'col-sm-9', 'dataenum' => '1|Yes;0|No'];
		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ['label'=>'Name Ar','name'=>'name_ar','type'=>'text','validation'=>'required|string','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
		//$this->form[] = ['label'=>'Name En','name'=>'name_en','type'=>'text','validation'=>'required|string','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
		//$this->form[] = ['label'=>'Has Sub Categories','name'=>'has_sub_category','type'=>'checkbox','validation'=>'required','width'=>'col-sm-9','table'=>'product','foreign_key'=>'product_category_id'];
		//// $this->form[] = ['label'=>'Add Product','name'=>'product','type'=>'child','width'=>'col-sm-10'];

		// sub form for products
		$columns[] = ['label' => 'Product Image', 'name' => 'image', 'type' => 'filemanager'];
		$columns[] = ['label' => 'Product Image Alt', 'name' => 'image_alt', 'type' => 'text'];
		$columns[] = ['label' => 'Product Image Title Ar', 'name' => 'title_ar', 'type' => 'text', 'required' => true];
		$columns[] = ['label' => 'Product Image Title En', 'name' => 'title_en', 'type' => 'text', 'required' => true];
		$columns[] = ['label' => 'Product Description Ar', 'name' => 'description_ar', 'type' => 'textarea'];
		$columns[] = ['label' => 'Product Description En', 'name' => 'description_en', 'type' => 'textarea'];
		$this->form[] = ['label' => 'Add Product', 'name' => 'product', 'type' => 'child', 'columns' => $columns, 'table' => 'product', 'foreign_key' => 'product_category_id'];

		// sub form for sub_categories
		$columns1[] = ['label' => 'Name Ar', 'name' => 'name_ar', 'type' => 'text', 'required' => true];
		$columns1[] = ['label' => 'Name En', 'name' => 'name_en', 'type' => 'text', 'required' => true];

		$this->form[] = ['label' => 'Add Sub Category', 'name' => 'sub_product_category', 'type' => 'child', 'columns' => $columns1, 'table' => 'sub_product_category', 'foreign_key' => 'product_category_id'];

		# OLD END FORM

		/*
	        | ----------------------------------------------------------------------
	        | Sub Module
	        | ----------------------------------------------------------------------
			| @label          = Label of action
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        |
	        */
		$this->sub_module = array();
		// $this->sub_module[] = ['label'=>'Products','path'=>'product_image_info','parent_columns'=>'name_ar','foreign_key'=>'product_category_id','button_color'=>'primary'];

		/*
	        | ----------------------------------------------------------------------
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        |
	        */
		$this->addaction = array();


		/*
	        | ----------------------------------------------------------------------
	        | Add More Button Selected
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button
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
		$this->alert        = array();



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
	        | FESAL VOILA DONT REMOVE THIS LINE
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
		$this->script_js = NULL;

		$this->script_js = "
			$(function() {
				 // hide name of form from the image filemanager input 
				jQuery('label.control-label').each(function() {
					var currentElement = $(this);
					var value = currentElement.text();
					if(value.includes('Add Product')){
						currentElement.addClass('hide');
					}
				});
				// hide forms 
				$('#form-group-addproduct').addClass('hide');
				$('#form-group-addsubcategory').addClass('hide');
				
				$(window).on('load', function() {
					if($('#has_sub_category').val() == '0'){
						$('#form-group-addproduct').removeClass('hide');
					}
				});
				$('#has_sub_category').on('change', function(){
					console.log('heeeeeeeeeeeeeeeeeeee');
					if($('#has_sub_category').val() == '0'){
						$('#form-group-addproduct').removeClass('hide');

						// if($('#form-group-addsubcategory').hasClass('hide'))
						// 	$('#form-group-addsubcategory').addClass('');
						// else
						// 	$('#form-group-addsubcategory').addClass('hide');
					}else{
						// $('#form-group-addsubcategory').removeClass('hide');

						if($('#form-group-addproduct').hasClass('hide'))
							$('#form-group-addproduct').addClass('');
						else
							$('#form-group-addproduct').addClass('hide');
					}
				});
			 });
		";
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
		$this->style_css = NULL;



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


	/*
	    | ----------------------------------------------------------------------
	    | Hook for button selected
	    | ----------------------------------------------------------------------
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	public function actionButtonSelected($id_selected, $button_name)
	{
	}


	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate query of index result
	    | ----------------------------------------------------------------------
	    | @query = current sql query
	    |
	    */


	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate row of index table html
	    | ----------------------------------------------------------------------
	    |
	    */


	/*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before add data is execute
	    | ----------------------------------------------------------------------
	    | @arr
	    |
	    */
	public function hook_before_add(&$postdata)
	{
		$postdata['has_sub_category'] = 1;
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
		$category = ProductCategory::where('id', '=', $id)->first();
		if ($category["has_sub_category"] == 1) {
			$prods = DB::table('product')->where('product_category_id', $id)->delete();
		}
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
		$category = ProductCategory::where('id', '=', $id)->first();
		if ($category["has_sub_category"] == 1) {
			DB::table('product')->where('product_category_id', $id)->delete();
		}
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
		$category = ProductCategory::where('id', '=', $id)->first();
		if ($category["has_sub_category"] == 1) {
			DB::table('product')->where('product_category_id', $id)->delete();
		}
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

	}



	//By the way, you can still create your own method in here... :)


}
