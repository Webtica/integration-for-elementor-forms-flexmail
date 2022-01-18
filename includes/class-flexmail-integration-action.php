<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

class Flexmail_Integration_Action_After_Submit extends \ElementorPro\Modules\Forms\Classes\Action_Base {

	/**
	 * Get Name
	 *
	 * Return the action name
	 *
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'flexmail integration';
	}

	/**
	 * Get Label
	 *
	 * Returns the action label
	 *
	 * @access public
	 * @return string
	 */
	public function get_label() {
		return __( 'Flexmail', 'flexmail-elementor-integration' );
	}

	/**
	 * Register Settings Section
	 *
	 * Registers the Action controls
	 *
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	public function register_settings_section( $widget ) {
		$widget->start_controls_section(
			'section_flexmail-elementor-integration',
			[
				'label' => __( 'Flexmail', 'flexmail-elementor-integration' ),
				'condition' => [
					'submit_actions' => $this->get_name(),
				],
			]
		);

		$widget->add_control(
			'flexmail_username',
			[
				'label' => __( 'Flexmail API username', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '12345',
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter your API username you recieved from Flexmail', 'flexmail-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'flexmail_api',
			[
				'label' => __( 'Flexmail API key', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => ' 0057128e35647553ea8...',
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter your API key you recieved from Flexmail', 'flexmail-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'flexmail_source_id',
			[
				'label' => __( 'Flexmail source ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => ' 4927...',
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter your source ID. you can ask this from Flexmail support', 'flexmail-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'api_help_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('Note that you will have to contact Flexmail support in order to recieve a API username, key and source ID.', 'flexmail-elementor-integration'),
			]
		);

		$widget->add_control(
			'flexmail_gdpr_checkbox',
			[
				'label' => __( 'GDPR Checkbox', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$widget->add_control(
			'flexmail_gdpr_checkbox_field',
			[
				'label' => __( 'Acceptance Field ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'acceptancefieldid',
				'separator' => 'before',
				'description' => __( 'Enter the acceptance checkbox field id - you can find this under the acceptance field advanced tab - if the acceptance checkbox is not checked then the email and extra information will not be added to the list', 'flexmail-elementor-integration' ),
    			'condition' => array(
    				'flexmail_gdpr_checkbox' => 'yes',
    			),
				'dynamic' => [
					'active' => true,
				],
			]
		);


		$widget->add_control(
			'flexmail_language',
			[
				'label' => __( 'Language', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'description' => 'The languages that you can give to your contact are the languages that you had to choose during onboarding. If you want to add or remove a language afterwards, you can contact flexmail only the languages you have will work',
				'default' => 'nl',
				'options' => [
					'nl'  => esc_html__( 'NL', 'flexmail-elementor-integration' ),
					'fr'  => esc_html__( 'FR', 'flexmail-elementor-integration' ),
					'en'  => esc_html__( 'EN', 'flexmail-elementor-integration' ),
					'de'  => esc_html__( 'NL', 'flexmail-elementor-integration' ),
					'it'  => esc_html__( 'IT', 'flexmail-elementor-integration' ),
					'es'  => esc_html__( 'ES', 'flexmail-elementor-integration' ),
					'ru'  => esc_html__( 'RU', 'flexmail-elementor-integration' ),
					'da'  => esc_html__( 'DA', 'flexmail-elementor-integration' ),
					'se'  => esc_html__( 'SE', 'flexmail-elementor-integration' ),
					'zh'  => esc_html__( 'ZH', 'flexmail-elementor-integration' ),
					'pt'  => esc_html__( 'PT', 'flexmail-elementor-integration' ),
					'pl'  => esc_html__( 'PL', 'flexmail-elementor-integration' ),
					'hu'  => esc_html__( 'HU', 'flexmail-elementor-integration' ),
					'bg'  => esc_html__( 'BG', 'flexmail-elementor-integration' ),
					'hr'  => esc_html__( 'HR', 'flexmail-elementor-integration' ),
					'cs'  => esc_html__( 'CS', 'flexmail-elementor-integration' ),
					'et'  => esc_html__( 'ET', 'flexmail-elementor-integration' ),
					'fi'  => esc_html__( 'FI', 'flexmail-elementor-integration' ),
					'el'  => esc_html__( 'EL', 'flexmail-elementor-integration' ),
					'ga'  => esc_html__( 'GA', 'flexmail-elementor-integration' ),
					'lv'  => esc_html__( 'LV', 'flexmail-elementor-integration' ),
					'lt'  => esc_html__( 'LT', 'flexmail-elementor-integration' ),
					'mt'  => esc_html__( 'MT', 'flexmail-elementor-integration' ),
					'ro'  => esc_html__( 'RO', 'flexmail-elementor-integration' ),
					'sk'  => esc_html__( 'SK', 'flexmail-elementor-integration' ),
					'sl'  => esc_html__( 'SL', 'flexmail-elementor-integration' ),
				],
			]
		);

		/* Lists currently not supported
		$widget->add_control(
			'flexmail_list',
			[
				'label' => __( 'Flexmail List ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => '5',
				'separator' => 'before',
				'description' => __( 'Enter your list number', 'flexmail-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);*/

		$widget->add_control(
			'flexmail_email_field',
			[
				'label' => __( 'Email Field ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'email',
				'description' => __( 'Enter the email field id - you can find this under the email field advanced tab', 'flexmail-elementor-integration' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'flexmail_send_first_last_name',
			[
				'label' => __( 'Send first and last name', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::SWITCHER
			]
		);

		$widget->add_control(
			'flexmail_name_field',
			[
				'label' => __( 'Name Field ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'name',
				'description' => __( 'Enter the name field id - you can find this under the name field advanced tab', 'flexmail-elementor-integration' ),
    			'condition' => array(
    				'flexmail_send_first_last_name' => 'yes',
    			),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'flexmail_last_name_field',
			[
				'label' => __( 'Lastname Field ID', 'flexmail-elementor-integration' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'lastname',
				'description' => __( 'Enter the lastname field id - you can find this under the lastname field advanced tab', 'flexmail-elementor-integration' ),
    			'condition' => array(
    				'flexmail_send_first_last_name' => 'yes',
    			),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$widget->add_control(
			'need_help_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('Need help? <a href="https://plugins.webtica.be/support/?ref=plugin-widget" target="_blank">Check out our support page.</a>', 'flexmail-elementor-integration'),
			]
		);

		$widget->end_controls_section();

	}

	/**
	 * On Export
	 *
	 * Clears form settings on export
	 * @access Public
	 * @param array $element
	 */
	public function on_export( $element ) {
		unset(
			$element['flexmail_username'],
			$element['flexmail_api'],
			$element['flexmail_source_id'],
			$element['flexmail_language'],
			$element['flexmail_gdpr_checkbox'],
			$element['flexmail_gdpr_checkbox_field'],
			$element['flexmail_email_field'],
			$element['flexmail_send_first_last_name'],
			$element['flexmail_name_field'],
			$element['flexmail_last_name_field']
		);

		return $element;
	}

	/**
	 * Run
	 *
	 * Runs the action after submit
	 *
	 * @access public
	 * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record
	 * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
	 */
	public function run( $record, $ajax_handler ) {
		$settings = $record->get( 'form_settings' );

		//  Make sure that there is an Flexmail username set
		if ( empty( $settings['flexmail_username'] ) ) {
			return;
		}

		//  Make sure that there is an Flexmail API key set
		if ( empty( $settings['flexmail_api'] ) ) {
			return;
		}
		
		//  Make sure that there is an Flexmail source ID set
		if ( empty( $settings['flexmail_source_id'] ) ) {
			return;
		}

		// Make sure that there is a Flexmail Email field ID
		if ( empty( $settings['flexmail_email_field'] ) ) {
			return;
		}

		// Get submitted Form data
		$raw_fields = $record->get( 'fields' );

		// Normalize the Form Data
		$fields = [];
		foreach ( $raw_fields as $id => $field ) {
			$fields[ $id ] = $field['value'];
		}

		// Make sure that the user has an email
		if ( empty( $fields[ $settings['flexmail_email_field'] ] ) ) {
			return;
		}

		//GDPR Checkbox
		$gdprcheckbox = $settings['flexmail_gdpr_checkbox'];
		if ($gdprcheckbox == "yes") {
			//  Make sure that there is a acceptence field if switch is set
			if ( empty( $settings['flexmail_gdpr_checkbox_field'] ) ) {
				return;
			}
			// Make sure that checkbox is on
			$gdprcheckboxchecked = $fields[$settings['flexmail_gdpr_checkbox_field']];
			if ($gdprcheckboxchecked != "on") {
				return;
			}
		}

		//check to send first and last name 
		$firstlastnamecheck = $settings['flexmail_send_first_last_name'];
		if ($firstlastnamecheck == "yes") {
			//  Make sure that there is a firstname field if switch is set
			if ( empty( $settings['flexmail_name_field'] ) ) {
				return;
			}
			//  Make sure that there is a lastname field if switch is set
			if ( empty( $settings['flexmail_last_name_field'] ) ) {
				return;
			}
			$datatosend = json_encode(["email" => $fields[$settings['flexmail_email_field']], "first_name" => $fields[$settings['flexmail_name_field']], "name" => $fields[$settings['flexmail_last_name_field']], "language" => $settings['flexmail_language'], "source" => (int)$settings['flexmail_source_id']]);
		}
		else {
			$datatosend = json_encode(["email" => $fields[$settings['flexmail_email_field']], "language" => $settings['flexmail_language'], "source" => (int)$settings['flexmail_source_id']]);
		}
		
		//Send data to Flexmail
		wp_remote_post( 'https://api.flexmail.eu/contacts', array(
			'method'      => 'POST',
		    'timeout'     => 45,
		    'httpversion' => '1.0',
		    'blocking'    => false,
		    'headers'     => [
	            'accept' => 'application/json',
		    	'content-Type' => 'application/json',
	            'Authorization' => 'Basic ' . base64_encode( $settings['flexmail_username'] . ':' . $settings['flexmail_api'] ),
		    ],
		    'body'        => $datatosend
			)
		);	

	}
}