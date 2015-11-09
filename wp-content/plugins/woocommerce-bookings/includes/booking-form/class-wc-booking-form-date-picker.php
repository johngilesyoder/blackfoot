<?php
/**
 * Class dependencies
 */
if ( ! class_exists( 'WC_Booking_Form_Picker' ) ) {
	include_once( 'class-wc-booking-form-picker.php' );
}

/**
 * Date Picker class
 */
class WC_Booking_Form_Date_Picker extends WC_Booking_Form_Picker {

	private $field_type = 'date-picker';
	private $field_name = 'start_date';

	/**
	 * Constructor
	 * @param object $booking_form The booking form which called this picker
	 */
	public function __construct( $booking_form ) {
		$this->booking_form                    = $booking_form;
		$this->args                            = array();
		$this->args['type']                    = $this->field_type;
		$this->args['name']                    = $this->field_name;
		$this->args['min_date']                = $this->booking_form->product->get_min_date();
		$this->args['max_date']                = $this->booking_form->product->get_max_date();
		$this->args['default_availability']    = $this->booking_form->product->get_default_availability();
		$this->args['min_date_js']             = $this->get_min_date();
		$this->args['max_date_js']             = $this->get_max_date();
		$this->args['duration_type']           = $this->booking_form->product->get_duration_type();
		$this->args['is_range_picker_enabled'] = $this->booking_form->product->is_range_picker_enabled();
		$this->args['display']                 = $this->booking_form->product->wc_booking_calendar_display_mode;
		$this->args['availability_rules']      = array();
		$this->args['availability_rules'][0]   = $this->booking_form->product->get_availability_rules();
		$this->args['label']                   = $this->get_field_label( __( 'Date', 'woocommerce-bookings' ) );
		$this->args['default_date']            = date( 'Y-m-d', $this->get_default_date() );

		if ( $this->booking_form->product->has_resources() ) {
			foreach ( $this->booking_form->product->get_resources() as $resource ) {
				$this->args['availability_rules'][ $resource->ID ] = $this->booking_form->product->get_availability_rules( $resource->ID );
			}
		}

		$this->find_fully_booked_blocks();
		$this->find_buffer_blocks();
	}

	/**
	 * Attempts to find what date to default to in the date picker
	 * by looking at the fist available block. Otherwise, the current date is used.
	 */
	function get_default_date() {
		$now = strtotime( 'midnight', current_time( 'timestamp' ) );
		$min = $this->booking_form->product->get_min_date();
		if ( empty ( $min ) ) {
			$min_date = strtotime( 'midnight' );
		} else {
			$min_date = $max_date = strtotime( "+{$min['value']} {$min['unit']}", $now );
		}
		$max = $this->booking_form->product->get_max_date();
		$max_date = strtotime( "+{$max['value']} {$max['unit']}", $now );

		$blocks_in_range  = $this->booking_form->product->get_blocks_in_range( $min_date, $max_date );
		$available_blocks = $this->booking_form->product->get_available_blocks( $blocks_in_range );

		if ( empty( $available_blocks[0] ) ) {
			return strtotime( 'midnight' );
		} else {
			return $available_blocks[0];
		}
	}

	/**
	 * Find days which are buffer days so they can be grayed out on the date picker
	 */
	protected function find_buffer_blocks() {
		$buffer_days = WC_Bookings_Controller::find_buffer_day_blocks( $this->booking_form->product->id );
		$this->args['buffer_days'] = $buffer_days;
	}

	/**
	 * Finds days which are fully booked already so they can be blocked on the date picker
	 */
	protected function find_fully_booked_blocks() {
		$booked = WC_Bookings_Controller::find_booked_day_blocks( $this->booking_form->product->id );
		$this->args['partially_booked_days'] = $booked['partially_booked_days'];
		$this->args['fully_booked_days']     = $booked['fully_booked_days'];
	}
}