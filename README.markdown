# Channel Form - Rename a file on upload

Rename the filename of [File field](https://ellislab.com/expressionengine/user-guide/add-ons/channel/custom_fields.html#file-field) in a [Channel Form](https://ellislab.com/expressionengine/user-guide/add-ons/channel/channel_form/).

## Installation

* Copy the /system/expressionengine/third_party/channel_form_file_rename/ folder to your /system/expressionengine/third_party/ folder

## Usage
Add a field to your Channel Field form, whose name is your File field name with _rename at the end.

	{exp:channel:form channel="site" return="my/form/ENTRY_ID"}
		<input type="hidden" name="my_file_field_rename" value="{exp:guid:uniqid}">
	{/exp:channel:form}

CREDIT: Based on a modified copy of an addon by Rob Sanchez: http://github.com/rsanchez/channel_form_file_add_prefix