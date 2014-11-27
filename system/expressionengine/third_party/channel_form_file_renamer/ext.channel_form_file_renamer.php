<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel_form_file_renamer_ext
{
	public $settings = array();
	public $name = 'Channel Form - Rename a file on upload';
	public $version = '1.0.0';
	public $description = 'Rename the filename of a File field in a Channel Form.';
	public $settings_exist = 'n';
	public $docs_url = 'http://github.com/westhouseitt/channel_form_file_renamer';

	/**
	 * constructor
	 *
	 * @access	public
	 * @param	mixed $settings = ''
	 * @return	void
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();

		$this->settings = $settings;
	}

	/**
	 * activate_extension
	 *
	 * @access	public
	 * @return	void
	 */
	public function activate_extension()
	{
		$hook_defaults = array(
			'class' => __CLASS__,
			'settings' => '',
			'version' => $this->version,
			'enabled' => 'y',
			'priority' => 10
		);

		$hooks[] = array(
			'method' => 'channel_form_submit_entry_start',
			'hook' => 'channel_form_submit_entry_start'
		);

		foreach ($hooks as $hook)
		{
			$this->EE->db->insert('extensions', array_merge($hook_defaults, $hook));
		}
	}

	/**
	 * update_extension
	 *
	 * @access	public
	 * @param	mixed $current = ''
	 * @return	void
	 */
	public function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}

		$this->EE->db->update('extensions', array('version' => $this->version), array('class' => __CLASS__));
	}

	/**
	 * disable_extension
	 *
	 * @access	public
	 * @return	void
	 */
	public function disable_extension()
	{
		$this->EE->db->delete('extensions', array('class' => __CLASS__));
	}

	/**
	 * settings
	 *
	 * @access	public
	 * @return	void
	 */
	public function settings()
	{
		return array();
	}

	public function channel_form_submit_entry_start()
	{
		foreach ($this->EE->channel_form->custom_fields as $field)
		{
			if ($field['field_type'] === 'file' && ! empty($_FILES[$field['field_name']]['size']) && isset($_POST[$field['field_name'].'_prefix']))
			{
				$new_name = $this->EE->input->post($field['field_name'].'_rename', TRUE);

				unset($_POST[$field['field_name'].'_rename']);

				$_FILES[$field['field_name']]['name'] = $new_name;
			}
		}
	}
}

/* End of file ext.channel_form_file_rename.php */
/* Location: ./system/expressionengine/third_party/channel_form_file_rename/ext.channel_form_file_rename.php */
