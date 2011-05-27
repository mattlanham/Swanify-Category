<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$plugin_info = array(
			     'pi_name' => 'Swanify Category',
			     'pi_version' =>'0.1',
			     'pi_author' =>'Matthew Lanham',
			     'pi_author_url' => 'http://www.swanify.com',
			     'pi_description' => 'Returns category ID for given category URL',
			     'pi_usage' => Swanify_category::usage()
			     );

	class Swanify_category 
	{
		
		function Swanify_category() 
		{
			$this->EE =& get_instance();
		}
		
		function get() 
		{
			$category_url = $this->EE->TMPL->fetch_param('category_url');
			$group_id     = $this->EE->TMPL->fetch_param('group_id');
			
			$whereClause = "cat_url_title = '".$category_url."'";
			
			if(!empty($group_id)){
				$whereClause .= "AND group_id = '".$group_id."'";
			}
			
			$query = $this->EE->db->query("SELECT * FROM exp_categories WHERE ".$whereClause." LIMIT 1");
			
			if($query->num_rows() > 0)
			{
				$category = $query->row();
				return $category->cat_id;
			}
			
			return false;
		}
		
		
		function usage()
		{
			return "Returns category ID for given category URL";
		}
		
	}
	
?>