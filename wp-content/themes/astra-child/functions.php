<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

include('custom-shortcodes.php');




/**
 * Remove annoying Elementor license notice
 */
add_action("admin_enqueue_scripts", function() {
    ?>
    <style>
        .e-notice--extended.e-notice--dismissible.e-notice.notice {
            display: none !important;
        }
    </style><?php
});



/**
 * Validate image file size.
 */
function validate_image()
{
  $featured_images = af_get_field('featured_images');
  $extra_images = $featured_images('extra_images');

  $file_size_limit = 2 * 1024 * 1024; // 2MB in bytes

  $images = array(
    $featured_images['featured_image'], $extra_images['extra_image_1'], $extra_images['extra_image_2'], $extra_images['extra_image_3'], $extra_images['extra_image_4']
  );

  foreach ($images as $image) {
    if (isset($_FILES[$image]) && $_FILES[$image]['size'] > $file_size_limit) {
      af_add_error($image, 'File size must be less than 2MB.');
    }
  }
}

add_action('af/form/validate/', 'validate_image');


/**
 * Format phone number fields function
 */
function format_phone_number($phone_number)
{
  if (strlen($phone_number) == 10) {
    return substr($phone_number, 0, 3) . '.' . substr($phone_number, 3, 3) . '.' . substr($phone_number, 6, 4);
  } else {
    return $phone_number;
  }
}







/* Format phone number in 2023 */
function formatPhoneNumber($phoneNumber) {
  $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

  if ($phoneNumber[0] == '1') {
      $phoneNumber = substr($phoneNumber, 1);
  }

  $areaCode = substr($phoneNumber, 0, 3);
  $prefix = substr($phoneNumber, 3, 3);
  $lineNumber = substr($phoneNumber, 6);

  return "($areaCode) $prefix-$lineNumber";
}

/* Get and format user data, to then call that function inside any other function where you need the data */
function get_formatted_user_data($user_id) {
  $data = array();

  // Get fields from User profile
  $default_logo_url = 'https://nanintranet.com/wp-content/uploads/2020/11/Nan_Logo_2021_Screen_Gray.png';
  $data['logo_h'] = get_field('agent_team_logo_horizontal', $user_id) ?: $default_logo_url;
  $data['logo_v'] = get_field('agent_team_logo_vertical', $user_id) ?: $default_logo_url;

  // Get all user metadata
  $data['first_name'] = get_user_meta($user_id, 'First Name', true) ?: 'Nan';
  $data['last_name'] = get_user_meta($user_id, 'Last Name', true) ?: 'Properties';

  // Combine two fields and send to Zapier with key "full_name"
  $data['full_name'] = $data['first_name'] . ' ' . $data['last_name'];

  $data['email'] = get_user_meta($user_id->ID, 'Email', true) ?: 'info@nanproperties.com';
  $data['bio'] = get_user_meta($user_id->ID, 'Bio', true) ?: 'Founded in 2014, Nan and Company Properties, Christie\'s International Real Estate is the industry leader in servicing the Houston real estate market, as well as foreign national clientele.';
  $data['headshot'] = get_user_meta($user_id->ID, 'Headshot', true) ?: '$default_logo_url';
  $office_phone = get_user_meta($user_id->ID, 'Office Phone', true) ?: '(713) 714-6454';
  $data['office_phone'] = formatPhoneNumber($office_phone);
  $data['office_street'] = get_user_meta($user_id->ID, 'Office Street', true) ?: '725 Yale St';
  $data['office_city'] = get_user_meta($user_id->ID, 'Office City', true) ?: 'Houston';
  $data['office_state'] = get_user_meta($user_id->ID, 'Office State', true) ?: 'TX';
  $data['office_zip'] = get_user_meta($user_id->ID, 'Office Zip', true) ?: '77007';
  $cell_phone = get_user_meta($user_id->ID, 'Cell Phone', true) ?: '(713) 714-6454';
  $data['cell_phone'] = formatPhoneNumber($cell_phone);
  $data['iabs'] = get_user_meta($user_id->ID, 'IABS', true) ?: '';
  $data['license_number'] = get_user_meta($user_id->ID, 'License Number', true) ?: '';
  $data['website_url'] = get_user_meta($user_id->ID, 'Website URL', true) ?: 'https://www.nanproperties.com';
  $data['title'] = get_user_meta($user_id->ID, 'Title', true) ?: 'Realtor Associate';
  $data['mls_id'] = get_user_meta($user_id->ID, 'MLS ID', true) ?: '';
  $instagram_url = get_user_meta($user_id->ID, 'Instagram', true) ?: 'https://www.instagram.com/nanproperties';
  $facebook_url = get_user_meta($user_id->ID, 'Facebook', true) ?: 'https://www.facebook.com/nanandcompanyproperties';
  $linkedin_url = get_user_meta($user_id->ID, 'LinkedIn', true) ?: 'https://www.linkedin.com/company/nanandcompanyproperties';
  $twitter_url = get_user_meta($user_id->ID, 'Twitter', true) ?: 'https://twitter.com/NanProperties';

  $data['instagram_url'] = $instagram_url;
  $data['facebook_url'] = $facebook_url;
  $data['linkedin_url'] = $linkedin_url;
  $data['twitter_url'] = $twitter_url;

  $instagram_handle = trim(parse_url($instagram_url, PHP_URL_PATH), '/');
  $facebook_handle = trim(parse_url($facebook_url, PHP_URL_PATH), '/');
  $linkedin_handle = trim(parse_url($linkedin_url, PHP_URL_PATH), '/');
  $twitter_handle = trim(parse_url($twitter_url, PHP_URL_PATH), '/');

  // Remove query string from handles
  $data['instagram_handle'] = explode('?', $instagram_handle)[0];
  $data['facebook_handle'] = explode('?', $facebook_handle)[0];
  $data['linkedin_handle'] = explode('?', $linkedin_handle)[0];
  $data['twitter_handle'] = explode('?', $twitter_handle)[0];

  return $data;
}

/* Write the Agent Signature section MJML code that will be passed into a variable to be used in Zapier for the Email Campaign object. */
function createMjmlFromUserData($data) {
  $ig_logo_url = 'https://nanimages.s3.us-east-2.amazonaws.com/social-media-icons/instagram---filled(144x144)%403x.svg';
  $fb_logo_url = 'https://nanimages.s3.us-east-2.amazonaws.com/social-media-icons/facebook---filled(144x144)%403x.svg';
  $li_logo_url = 'https://nanimages.s3.us-east-2.amazonaws.com/social-media-icons/linkedin---filled(144x144)%403x.svg';
  $tw_logo_url = 'https://nanimages.s3.us-east-2.amazonaws.com/social-media-icons/twitter---filled(144x144)%403x.svg';

  $mjml = '
    <mj-section background-color="#FFFFFF" padding="20px">
        <mj-column width="180px" padding="0 0 12px 0">
            <!-- AGENT HEADSHOT -->
            <mj-image padding="0" src="{{headshot}}" alt="{{full_name}}"></mj-image>
            <!-- END AGENT HEADSHOT -->
        </mj-column>
        <mj-column width="380px" padding="0 0 12px 0">
            <!-- IMPORTANT COLUMN-->
            <mj-text padding="0px 20px 0px" font-size="18px" font-family="Helvetica, sans-serif" color="#f16624" font-weight="bold">{{full_name}}</mj-text>
            <mj-text padding="10px 20px" font-size="16px" font-family="Helvetica, sans-serif" color="#7c7d7d">{{title}}</mj-text>
            <mj-text font-family="Helvetica, sans-serif" color="#7c7d7d" font-size="16px" line-height="24px" padding="30px 20px 12px">
                C: {{cell_phone}}
                <br/>
                O: {{office_phone}}
                <br/>
                E: {{email}}
                <br/>
                <br/>
                <img style="display:inline;padding-right:10px" src="' . $ig_logo_url . '"><span>{{instagram_url}}</span>
                <br/>
                <img style="display:inline;padding-right:10px" src="' . $tw_logo_url . '"><span>{{facebook_url}}</span>
                <br/>
                <img style="display:inline;padding-right:10px" src="' . $li_logo_url . '"><span>{{linkedin_url}}</span>
                <br/>
                <img style="display:inline;padding-right:10px" src="' . $tw_logo_url . '"><span>{{twitter_url}}</span>
                <br/>
            </mj-text>
            <!-- END IMPORTANT COLUMN-->
        </mj-column>
      </mj-section>
    ';

  // Replace the placeholders with actual data
  foreach($data as $key => $value){
      $mjml = str_replace('{{' . $key . '}}', $value, $mjml);
  }

  return $mjml;
}

/* Format all forms before returning to Zapier. Get the formatted user data. */
function modify_zapier_request_for_all_forms($request, $form, $args)
{

  // Get current user
  $current_user = wp_get_current_user();

  // Get current time
  $current_date = current_datetime()->format('Y-m-d');

  // Get user data
  $user_data = get_formatted_user_data($current_user->ID);

  // Get Agent Signature
  $mjml = createMjmlFromUserData($user_data);

  // Agent Details
  $request['body']['full_name'] = $user_data['full_name'];
  $request['body']['email'] = $user_data['email'];
  $request['body']['bio'] = $user_data['bio'];
  $request['body']['headshot'] = $user_data['headshot'];
  $request['body']['office_phone'] = $user_data['office_phone'];
  $request['body']['office_street'] = $user_data['office_street'];
  $request['body']['office_city'] = $user_data['office_city'];
  $request['body']['office_state'] = $user_data['office_state'];
  $request['body']['office_zip'] = $user_data['office_zip'];
  $request['body']['cell_phone'] = $user_data['cell_phone'];
  $request['body']['iabs'] = $user_data['iabs'];
  $request['body']['license_number'] = $user_data['license_number'];
  $request['body']['website_url'] = $user_data['website_url'];
  $request['body']['title'] = $user_data['title'];
  $request['body']['mls_id'] = $user_data['mls_id'];
  $request['body']['instagram_url'] = $user_data['instagram_url'];
  $request['body']['facebook_url'] = $user_data['facebook_url'];
  $request['body']['linkedin_url'] = $user_data['linkedin_url'];
  $request['body']['twitter_url'] = $user_data['twitter_url'];
  $request['body']['instagram_handle'] = $user_data['instagram_handle'];
  $request['body']['facebook_handle'] = $user_data['facebook_handle'];
  $request['body']['linkedin_handle'] = $user_data['linkedin_handle'];
  $request['body']['twitter_handle'] = $user_data['twitter_handle'];
  $request['body']['logo_horizontal'] = $user_data['logo_h'];
  $request['body']['logo_vertical'] = $user_data['logo_v'];
  $request['body']['agent_signature_mjml'] = $mjml;

  // Submission details
  $request['body']['created_date'] = $current_date;

  return $request;
}
add_filter('af/form/zapier/request', 'modify_zapier_request_for_all_forms', 10, 3);



/* Format open house data before returning to Zapier */
function modify_zapier_request_open_house_request($request, $form, $args)
{

  // Get current user
  $current_user = wp_get_current_user();

  // Get user data
  $user_data = get_formatted_user_data($current_user->ID);

  $open_house_dates = af_get_field('open_house_dates'); // type: group

  $office_phone = af_get_field('office_phone'); // type: number
  $cell_phone = af_get_field('cell_phone'); // type: number

  $formatted_office_phone = 'O: ' . format_phone_number($office_phone);
  $formatted_cell_phone = 'C: ' . format_phone_number($cell_phone);


  // Remove elements with value 0
  $open_house_dates = array_filter($open_house_dates, function ($value) {
    return $value !== 0;
  });

  $times = array();
  foreach (array_keys($open_house_dates) as $key) {
    if (strpos($key, 'open_house_date_group_') === 0 && $open_house_dates[$key] !== 0) {
      $start_time = date('g:ia', strtotime($open_house_dates[$key]['start_time']));
      $end_time = date('g:ia', strtotime($open_house_dates[$key]['end_time']));

      // Remove minutes from start time and end time if time is at the top of the hour
      if (date('i', strtotime($start_time)) == 0) {
        $start_time = date('ga', strtotime($start_time));
      }

      if (date('i', strtotime($end_time)) == 0) {
        $end_time = date('ga', strtotime($end_time));
      }

      $times[] = $start_time . '-' . $end_time;
    }
  }

  $times = array_filter($times, function ($value) {
    return $value !== '12am-12am';
  });

  $request['body']['times'] = $times;
  $request['body']['office_phone'] = 'O: ' . $user_data['office_phone'];
  $request['body']['cell_phone'] = 'C: ' . $user_data['cell_phone'];

  return $request;
}
add_filter('af/form/zapier/request/key=form_63f2d8ae12179', 'modify_zapier_request_open_house_request', 10, 3);



/**
 * Format Signature Card data before returning to Zapier
 */
function modify_zapier_request_signature_card_request($request, $form, $args)
{
  $instagram_handle = af_get_field('instagram_handle'); // type: text

  // if IG handle, then include IG url in the request
  $ig_logo = !empty($instagram_handle) ? 'https://nanintranet.com/wp-content/uploads/2023/03/instagram128x128@3x.png' : 'https://nanintranet.com/wp-content/uploads/2023/03/1x1.png';
  $instagram_handle = !empty($instagram_handle) ? ($instagram_handle[0] === '@' ? $instagram_handle : '@' . $instagram_handle) : '';

  // Get business_card_agent_website
  $business_card_agent_website = af_get_field('business_card_agent_website'); // type: text

  // Create business_card_agent_website_final variable and set its value
  $business_card_agent_website_final = '';
  if (!empty($business_card_agent_website)) {
    $business_card_agent_website_final = 'nanproperties.com | ' . $business_card_agent_website;
  } else {
    $business_card_agent_website_final = 'nanproperties.com';
  }

  $request['body']['ig_logo'] = $ig_logo;
  $request['body']['business_card_agent_website_final'] = $business_card_agent_website_final;
  $request['body']['instagram_handle'] = $instagram_handle;

  return $request;

}

add_filter('af/form/zapier/request/key=form_6402e3737a91f', 'modify_zapier_request_signature_card_request', 10, 3);



/* TODO */
/**
 * Format eflyer data before returning to Zapier
 */
function modify_zapier_request_eflyer_request($request, $form, $args)
{
  // First, get the group field
  $eflyer_details = get_field('eflyer_details');
  $listing_mls = get_field('listing_mls');

  $type           = $eflyer_details['type'];
  $subject_line   = $eflyer_details['subject_line'];
  $subtitle       = $eflyer_details['subtitle'];
  $description    = $eflyer_details['description'];
  $destination_url = $eflyer_details['destination_url'];

  $mls_id = $listing_mls['mls_id'];

  // if destination url
  $destination_url = empty($destination_url) ? (empty($mls_id) ? 'https://www.nanproperties.com/our-listings' : 'https://www.har.com/' . $mls_id) : $destination_url;


  $request['body']['eflyer_type'] = $type;
  $request['body']['subject_line'] = $subject_line;
  $request['body']['subtitle'] = $subtitle;
  $request['body']['description'] = $description;
  
  return $request;

}

add_filter('af/form/zapier/request/key=form_645325b31c02c', 'modify_zapier_request_eflyer_request', 10, 3);
