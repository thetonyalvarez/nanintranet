<?php

function gmail_signature_function()
{
	function console_log($output, $with_script_tags = true)
	{
		echo $output;
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
			');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}

	$firstname			= get_field('first_name');
	$lastname			= get_field('last_name');
	$pref_name_option 	= get_field('preferred_name_option');
	$pref_name 			= get_field('preferred_name');
	$pref_name_yes 		= "Yes, I want to add designations and/or use a different name in my signature";
	$pref_name_choice 	= ($pref_name_option == $pref_name_yes) ? $pref_name : $firstname . " " . $lastname;
	$title 				= get_field('title');
	$office_ext			= get_field('office_extension');
	$office_ext_print	= (empty($office_ext)) ? "" : ' ext. ' . $office_ext;
	$license_number 	= get_field('license_number');
	$iabs_alt 			= get_field('iabs_link_alternate');
	$fax_raw	 		= get_field('fax');
	$office_location 	= get_field('agent_office_location');
	$addtnl_text 		= get_field('additional_text_below_contact_info');
	$tagline 			= get_field('tagline');
	$agent_website 			= get_field('approved_agent_website_url');
	$social_instagram 			= get_field('instagram');
	$headshot 			= get_field('headshot_in_signature');


	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';

	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.

	$iabs_alt2 = get_field('iabs_link_alternate');
	console_log($iabs_alt2);
	console_log($iabs_alt);

	if ($license_number == '0') {
		$iabs = '<a href="' . $iabs_alt . '"rel=noopener style=color:#15c target=_blank"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	} else {
		$iabs = '<a href="https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&cid=' . $license_number . '"rel=noopener style=color:#15c target=_blank"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	};

	if ($title != 'Other') {
		$title_block = '<br><div style=font-family:arial;display:inline>' . $title . '</div>';
	};

	$nan_email 			= get_field('nan_email');
	
  $cell 				= get_field('cell_phone');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

  $office_number 				= get_field('office_number');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $office_number,  $matches)) {
		$office_number_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

	if (!empty($cell)) {
		$cell_block = '<span style=color:#8d8d8d>C. </span><a href="tel:+1' . $cell . '"rel=noopener style=color:#f16624 target=_blank>' . $cell_formatted . ' </a><div style=font-family:arial;display:inline></div><span style=color:#f16624;display:inline-block>|</span><div style=font-family:arial;display:inline></div>';
	}

	// Fax formatting
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $fax_raw,  $matches)) {
		$fax_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};
	if (!empty($fax_raw)) {
		$fax_block = '<span style=color:#8d8d8d>F. </span><a href="tel:+1' . $fax_raw . '"rel=noopener style=color:#f16624 target=_blank>' . $fax_formatted . ' </a><div style=font-family:arial;display:inline></div><span style=color:#f16624;display:inline-block>|</span><div style=font-family:arial;display:inline></div>';
	}

  // Approved agent website
  if (!empty($agent_website)) {
    $agent_website_block = '<span> | </span><a href=https://www.' . $agent_website . ' rel=noopener style=color:#f16624 target=_blank>' . $agent_website . '</a>';
  } else {
    $agent_website_block = '';
  }

  // Social media handles
  if (!empty($social_instagram)) {
    $social_instagram_block = '<span><img src="https://nanimages.s3.us-east-2.amazonaws.com/social-media-instagram.png" height=12.8 width=12.8/><a href="https://www.instagram.com/' . $social_instagram . '" target="_blank" style="color:#f16624;padding-left:5px">' . $social_instagram . '</a></span><br>';
  } else {
    $social_instagram_block = '';
  }

  // Headshot
  if (!empty($headshot)) {
    $headshot_block = '<br><a href="https://www.nanproperties.com" target="_blank"><img src="' . $headshot . '" height=200 width=200/></a><div><br/></div><div><br/></div>';
  } else {
    $headshot_block = '';
  }

	// Tagline
	if (!empty($tagline)) {
		$tagline_block = '<tr><td height="10"></td></tr><tr><td>' . $tagline . '</td></tr>';
	} else {
		$tagline_block = '';
	}

	// Additional text block
	if (!empty($addtnl_text)) {
		$addtnl_text_block = '<tr><td height="10"></td></tr><tr><td>' . $addtnl_text . '</td></tr>';
	} else {
		$addtnl_text_block = '';
	}

	// Office Phone //
  if (!empty($office_number)) {
    $office_phone_print = '<a href=tel:+1' . $office_number_formatted . ' rel=noopener style=color:#f16624 target=_blank>' . $office_number_formatted . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $heights_address . '</span><br>';;
  } else {
    if ($office_location == 'Galleria') {
      $office_phone_print = '<a href=tel:+1' . $galleria_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $galleria_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $galleria_address . '</span><br>';
    }
    if ($office_location == 'Heights') {
      $office_phone_print = '<a href=tel:+1' . $heights_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $heights_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $heights_address . '</span><br>';
    }
    if ($office_location == 'Galveston') {
      $office_phone_print = '<a href=tel:+1' . $galveston_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $galveston_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $galveston_address . '</span><br>';
    }
  }



	$topProducerLogo2019 			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2019.png';
	$topProducerLogo2020       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2020.png';
	$topProducerLogo2021       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2021.png';
	$topProducerLogo2022       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2022.png';
	$luxSpecLogo       				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO.jpg';
	$luxSpecLogo2020				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2020.jpg';
	$luxSpecLogo2021				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2021.jpg';
	$CIREMastersLogo   				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_MastersCircle_LOGO_2021.jpeg';
	$CIREMastersLogo2023   				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_MastersCircle_LOGO_2023.jpg';
	$CIRE_Affiliate_Award_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_Affiliate_LOGO.jpg';
	$HBJ_2019_Top_25_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_Top25_LOGO.jpg';
	$HBJ_2020_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_SalesVolume_Logo.jpg';
	$HBJ_2020_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_Transactions_Logo.jpg';
	$HBJ_2021_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_SalesVolume_Logo.jpg';
	$HBJ_2021_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_Transactions_Logo.jpg';
	$HBJ_All_Awards_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_All_Awards.jpg';
	$Leading_RE_Logo				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_LeadingRE_LOGO.png';
	$Salesforce_Certified_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/SFU_CRT_BDG_Admin_RGB.jpg';
	$Prism_Logo						= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Prism_2020_Logo.jpg';
	$customlogo1					= (get_field('custom_logo_1'));
	$team_logo_square			= (get_field('team_logo_square'));

  if(!empty(get_field('cire_masters_circle')) || !empty(get_field('cire_masters_circle_2023'))) {
    if (!empty(get_field('cire_masters_circle_2023'))) {
      $CIREMastersLogoOutput = $CIREMastersLogo2023;
    } else if (!empty(get_field('cire_masters_circle_2023'))) {
      $CIREMastersLogoOutput = $CIREMastersLogo;
    } else {
      $CIREMastersLogoOutput = '';
    };
  };

	$logoBlock_topProducer2019 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2019 . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_topProducer2020 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2020 . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_topProducer2021 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=133 style=font-size:12.8px;width:133px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2021 . '"width=133></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_topProducer2022 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=133 style=font-size:12.8px;width:133px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2022 . '"width=133></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_CIREMasters = '<td height=100><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Masters Circle"class=CToWUd height=100 src="' . $CIREMastersLogoOutput . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_CIRELuxurySpecialist = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:208px width=208><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Luxury Specialist"class=CToWUd height=100 src="' . $luxSpecLogo . '"width=208></table>';
	$logoBlock_CIRELuxurySpecialist2020 = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:208px width=208><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Luxury Specialist"class=CToWUd height=100 src="' . $luxSpecLogo2020 . '"width=208></table>';
	$logoBlock_CIRELuxurySpecialist2021 = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:208px width=208><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Luxury Specialist"class=CToWUd height=100 src="' . $luxSpecLogo2021 . '"width=208></table>';
	$logoBlock_CIREAffiliateAward = '<td height=100><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Affiliate Award"class=CToWUd height=100 src="' . $CIRE_Affiliate_Award_Logo . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';

	$logoBlock_HBJ_2019_Top25 = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=100><img alt="Houston Business Journal\'s Top 25 Real Estate Firms in Houston, 2019"class=CToWUd height=100 src="' . $HBJ_2019_Top_25_Logo . '"width=419></table>';
	$logoBlock_HBJ_2020_Top_SalesVolume = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=100><img alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2020"class=CToWUd height=100 src="' . $HBJ_2020_Top_SalesVolume_Logo . '"width=419></table>';
	$logoBlock_HBJ_2020_Top_Transactions = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=100><img alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2020"class=CToWUd height=100 src="' . $HBJ_2020_Top_Transactions_Logo . '"width=419></table>';
	$logoBlock_HBJ_2021_Top_SalesVolume = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=100><img alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2021"class=CToWUd height=100 src="' . $HBJ_2021_Top_SalesVolume_Logo . '"width=419></table>';
	$logoBlock_HBJ_2021_Top_Transactions = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=100><img alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2021"class=CToWUd height=100 src="' . $HBJ_2021_Top_Transactions_Logo . '"width=419></table>';
	$logoBlock_HBJ_All_Awards = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:408px;margin:0 valign=center width=408><tr valign=center><td height=88><img alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume and Transactions, 2019, 2020, 2021"class=CToWUd height=88 src="' . $HBJ_All_Awards_Logo . '"width=408></table>';

	$logoBlock_Leading_RE_Logo = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px;margin:0 valign=center width=204><tr valign=center><td height=54><img alt="Leading RE" class=CToWUd height=44 src="' . $Leading_RE_Logo . '"width=204></table>';

	$logoBlock_Prism_Logo = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img class=CToWUd src="' . $Prism_Logo . '"width=100></table>';

	$logoBlock_SalesforceCertified = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Salesforce Certified"class=CToWUd src="' . $Salesforce_Certified_Logo . '"width=100></table>';

	$logoBlock_customlogo1 = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img class=CToWUd src="' . $customlogo1 . '"width=100></table>';

	$boolean_topProducer2019 			= (get_field('top_producer_2019') == 1) ? $logoBlock_topProducer2019 : '';
	$boolean_topProducer2020 			= (get_field('top_producer_2020') == 1) ? $logoBlock_topProducer2020 : '';
	$boolean_topProducer2021 			= (get_field('top_producer_2021') == 1) ? $logoBlock_topProducer2021 : '';
	$boolean_topProducer2022 			= (get_field('top_producer_2022') == 1) ? $logoBlock_topProducer2022 : '';
	$boolean_CIREMasters 				  = (!empty($CIREMastersLogoOutput)) ? $logoBlock_CIREMasters : '';
	$boolean_CIRELuxurySpecialist		= (get_field('cire_luxury_specialist') == 1) ? $logoBlock_CIRELuxurySpecialist : '';
	$boolean_CIRELuxurySpecialist2020	= (get_field('cire_luxury_specialist_2020') == 1) ? $logoBlock_CIRELuxurySpecialist2020 : '';
	$boolean_CIRELuxurySpecialist2021	= (get_field('cire_luxury_specialist_2021') == 1) ? $logoBlock_CIRELuxurySpecialist2021 : '';
	$boolean_CIREAffiliateAward			= (get_field('cire_affiliate_award') == 1) ? $logoBlock_CIREAffiliateAward : '';
	$boolean_HBJ2019Top25				= (get_field('hbj_2019_top_25') == 1) ? $logoBlock_HBJ_2019_Top25 : '';
	$boolean_HBJ2020TopSalesVolume		= (get_field('hbj_2020_top_salesvolume') == 1) ? $logoBlock_HBJ_2020_Top_SalesVolume : '';
	$boolean_HBJ2020TopTransactions		= (get_field('hbj_2020_top_transactions') == 1) ? $logoBlock_HBJ_2020_Top_Transactions : '';
	$boolean_HBJ2021TopSalesVolume		= (get_field('hbj_2021_top_salesvolume') == 1) ? $logoBlock_HBJ_2021_Top_SalesVolume : '';
	$boolean_HBJ2021TopTransactions		= (get_field('hbj_2021_top_transactions') == 1) ? $logoBlock_HBJ_2021_Top_Transactions : '';
	$boolean_HBJAllAwards				= (get_field('hbj_all_awards') == 1) ? $logoBlock_HBJ_All_Awards : '';
	$boolean_LeadingRE					= (get_field('leading_re_logo') == 1) ? $logoBlock_Leading_RE_Logo : '';
	$boolean_SalesforceCertified		= (get_field('salesforce_certified') == 1) ? $logoBlock_SalesforceCertified : '';
	$boolean_Prism						= (get_field('prism_award_2020') !== null) ? $logoBlock_Prism_Logo : '';
	$boolean_customlogo1				= (get_field('custom_logo_1') !== null) ? $logoBlock_customlogo1 : '';

	$code_logos = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr><td height=20><tr valign=center style=vertical-align:center>' . $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_topProducer2022 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist . '</table><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr valign=center>' . $boolean_CIREAffiliateAward . $boolean_HBJ2019Top25 . '</table>';

	$code_logos_0 = '<tr id="code_logos_0">' . $boolean_SalesforceCertified . '</tr>';

	$code_logos_1_leadingRE = '<div><br/></div><table id="leading_re" border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:400px;margin:0 valign=center width=400><tr valign=center style=vertical-align:center>' . $boolean_LeadingRE . '</table>';

	$code_logos_1 = '<div><br/></div><table id="code_logos_1" border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr valign=center style=vertical-align:center>' . $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_topProducer2022 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist . $boolean_CIRELuxurySpecialist2020 . $boolean_CIRELuxurySpecialist2021 . '</tr></table>';

	$code_logos_2 = '<div><br/></div><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr valign=center>' . $boolean_CIREAffiliateAward . $boolean_Prism . $boolean_customlogo1 . '</table>';

	$code_logos_3 = '<div><br/></div>' . $boolean_HBJAllAwards . $boolean_HBJ2021TopSalesVolume . $boolean_HBJ2021TopTransactions . $boolean_HBJ2020TopSalesVolume . $boolean_HBJ2020TopTransactions . $boolean_HBJ2019Top25;

  $main_logo_square = (!empty($team_logo_square)
  ) ? $team_logo_square : 'https://nanimages.s3.us-east-2.amazonaws.com/NanChristies_Logo_LockupVertical_DarkGray_Transparent.jpg';

	$print_logos_0 = (get_field('salesforce_certified') == 1
	) ? $code_logos_0 : ''; 

	$print_logos_1_leadingRE = (get_field('leading_re_logo') == 1
	) ? $code_logos_1_leadingRE : '';

	$print_logos_1 = (get_field('top_producer_2019') == 1 ||
		get_field('top_producer_2020') == 1 ||
		get_field('top_producer_2021') == 1 ||
		get_field('top_producer_2022') == 1 ||
		get_field('cire_masters_circle') == 1 ||
		get_field('cire_luxury_specialist') == 1 ||
		get_field('cire_luxury_specialist_2020') == 1 ||
		get_field('cire_luxury_specialist_2021') == 1
	) ? $code_logos_1 : '';

	$print_logos_2 = (get_field('cire_affiliate_award') == 1 ||
		get_field('prism_award_2020') == 1 ||
		get_field('custom_logo_1') == 1
	) ? $code_logos_2 : '';

	$print_logos_3 = (get_field('hbj_2019_top_25') == 1 ||
		get_field('hbj_2020_top_salesvolume') == 1 ||
		get_field('hbj_2020_top_transactions') == 1 ||
		get_field('hbj_2021_top_salesvolume') == 1 ||
		get_field('hbj_2021_top_transactions') == 1 ||
		get_field('hbj_all_awards') == 1
	) ? $code_logos_3 : '';

	$print_logos = (get_field('top_producer_2019') == 1 ||
		get_field('cire_luxury_specialist') == 1 ||
		get_field('cire_luxury_specialist_2020') == 1 ||
		get_field('cire_luxury_specialist_2021') == 1 ||
		get_field('cire_masters_circle') == 1 ||
		get_field('cire_affiliate_award') == 1 ||
		get_field('hbj_2019_top_25') == 1 ||
		get_field('hbj_2020_top_salesvolume') == 1 ||
		get_field('hbj_2020_top_transactions') == 1 ||
		get_field('hbj_2021_top_salesvolume') == 1 ||
		get_field('hbj_2021_top_transactions') == 1 ||
		get_field('hbj_all_awards') == 1 ||
		get_field('salesforce_certified') == 1
	) ? $code_logos : '';

	$code = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body><div id="compiled-signature" class="compiled-signature">' . $iabs . '<br><a href=https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Texas Real Estate Commission Consumer Protection Notice</span></a><div><br/></div>' . $headshot_block . '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:485px;border:none width=485><tr valign=top><td style=font-size:12.8px;width:10px;padding-right:10px><img alt=photo class=CToWUd height=91 src="' . $main_logo_square . '"width=96><td><table><tr style=border:none><td style="border-right:1px solid #f16624"width=0></table><td style="font-family:arial;display:inline-block;text-align:initial;font-stretch:normal;line-height:normal;color:#646464;padding:0 10px"><table border=0 cellpadding=0 cellspacing=0><tr><td style=font-family:arial;display:inline-block;text-align:initial;font-stretch:normal;line-height:normal><div style=font-family:arial;display:inline><strong>' . $pref_name_choice . '</strong></div>' . $title_block . $tagline_block . '<tr><td style="font-family:arial;font-stretch:normal;line-height:normal;padding:5px 0"><span style=display:inline-block>' . $cell_block . ' ' . $fax_block . ' <span style=color:#8d8d8d>O. </span>' . $office_phone_print . $social_instagram_block . '<span><a href=https://www.nanproperties.com rel=noopener style=color:#f16624 target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q">nanproperties.com</a></span>' . $agent_website_block . '</td></tr>' . $addtnl_text_block . '<tr><td height="20"></td></tr>' . $print_logos_0 . '</table></table>' . $print_logos_1_leadingRE . $print_logos_1 . $print_logos_2 . $print_logos_3 . '</div></body></html>';

	$output = (get_field('custom_signature_boolean') == 1
	) ? get_field('custom_signature') : $code;



	return $output;
}

function webapp_signature_function()
{

	$firstname			= get_field('first_name');
	$lastname			= get_field('last_name');
	$pref_name_option 	= get_field('preferred_name_option');
	$pref_name 			= get_field('preferred_name');
	$pref_name_yes 		= "Yes, I want to add designations and/or use a different name in my signature";
	$pref_name_choice 	= ($pref_name_option == $pref_name_yes) ? $pref_name : $firstname . " " . $lastname;
	$title 				= get_field('title');
	$license_number 	= get_field('license_number');
	$iabs_alt 			= get_field('iabs_link_alternate');
	$fax_raw	 		= get_field('fax');
	$office_location 	= get_field('agent_office_location');
	$addtnl_text 		= get_field('additional_text_below_contact_info');
	$tagline 			= get_field('tagline');
	$agent_website 			= get_field('approved_agent_website_url');


	// Variables for office locations
	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';

	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.
	if ($license_number == '0') {
		$iabs = '<a href="' . $iabs_alt . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	} else {
		$iabs = '<a href="https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&cid=' . $license_number . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	};


	if ($title != 'Other') {
		$title_block = '<br/>
		<div style="font-family: arial; display: inline;">
			' . $title . '
		</div>';
	}

	$nan_email 			= get_field('nan_email');
	$cell 				= get_field('cell_phone');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

	if (!empty($cell)) {
		$cell_block = '<span style="color: #8d8d8d;">C. </span>
		<a style="color: #f16624;" href="tel:+1' . $cell . '" target="_blank" rel="noopener">
			' . $cell_formatted . '
		</a>;

		<div style="font-family: arial; display: inline;"></div>
		<span style="color: #f16624; display: inline-block;"> | </span>
		<div style="font-family: arial; display: inline;"></div>';
	}

  // Format office phone for 
	$office_number 		= get_field('office_number');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $office_number,  $matches)) {
		$office_number_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

	// Fax formatting
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $fax_raw,  $matches)) {
		$fax_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};
	if (!empty($fax_raw)) {
		$fax_block = '<span style=color:#8d8d8d>F. </span><a href="tel:+1' . $fax_raw . '"rel=noopener style=color:#f16624 target=_blank>' . $fax_formatted . ' </a><div style=font-family:arial;display:inline></div><span style=color:#f16624;display:inline-block>|</span><div style=font-family:arial;display:inline></div>';
	}

	$office_ext			= get_field('office_extension');
	$office_ext_print	= (empty($office_ext)) ? "" : ' ext. ' . $office_ext;

	// Office Phone //
  if (!empty($office_number)) {
    $office_phone_print = '<!-- office -->
    <span style="color: #8d8d8d;"> O. </span>
    <a style="color: #f16624;" href="tel:+1' . $office_number_formatted . '" target="_blank" rel="noopener">' . $office_number_formatted . $office_ext_print . '
    </a>
    <!-- end office -->
    
    <!-- email-->
    <br/>
    <span style="color: #8d8d8d;">E. </span>
    <a style="color: #f16624;" href="mailto:' . $nan_email . '@nanproperties.com" target="_blank"  rel="noopener">
      ' . $nan_email . '@nanproperties.com
    </a>
    <!-- end email -->

    <span style="font-size: 12.8px; color: #8d8d8d;"> </span>
    <div style="font-family: arial; display: inline;"></div>
    
    <!-- address -->
    <span style="text-align: initial; font-size: 12.8px; display: inline-block;">
      <span style="color: #8d8d8d;">' . $heights_address . '</span>
    </span>
    <!-- end address -->';
  } else {
    if ($office_location == 'Galleria') {
      $office_phone_print = '<!-- office -->
      <span style="color: #8d8d8d;"> O. </span>
      <a style="color: #f16624;" href="tel:+1' . $galleria_phone . '" target="_blank" rel="noopener">' . $galleria_phone . $office_ext_print . '
      </a>
      <!-- end office -->
      
      <!-- email-->
      <br/>
      <span style="color: #8d8d8d;">E. </span>
      <a style="color: #f16624;" href="mailto:' . $nan_email . '@nanproperties.com" target="_blank"  rel="noopener">
        ' . $nan_email . '@nanproperties.com
      </a>
      <!-- end email -->
  
      <span style="font-size: 12.8px; color: #8d8d8d;"> </span>
      <div style="font-family: arial; display: inline;"></div>
      
      <!-- address -->
      <span style="text-align: initial; font-size: 12.8px; display: inline-block;">
        <span style="color: #8d8d8d;">' . $galleria_address . '</span>
      </span>
      <!-- end address -->';
    }
    if ($office_location == 'Galveston') {
      $office_location_print = '<!-- office -->
      <span style="color: #8d8d8d;"> O. </span>
      <a style="color: #f16624;" href="tel:+1' . $galveston_phone . '" target="_blank" rel="noopener">' . $galveston_phone . $office_ext_print . '
      </a>
      <!-- end office -->
      
      <!-- email-->
      <br/>
      <span style="color: #8d8d8d;">E. </span>
      <a style="color: #f16624;" href="mailto:' . $nan_email . '@nanproperties.com" target="_blank"  rel="noopener">
        ' . $nan_email . '@nanproperties.com
      </a>
      <!-- end email -->
  
      <span style="font-size: 12.8px; color: #8d8d8d;"> </span>
      <div style="font-family: arial; display: inline;"></div>
      
      <!-- address -->
      <span style="text-align: initial; font-size: 12.8px; display: inline-block;">
        <span style="color: #8d8d8d;">' . $galveston_address . '</span>
      </span>
      <!-- end address -->';
    }
    if ($office_location == 'Heights') {
      $office_location_print = '<!-- office -->
      <span style="color: #8d8d8d;"> O. </span>
      <a style="color: #f16624;" href="tel:+1' . $heights_phone . '" target="_blank" rel="noopener">' . $heights_phone . $office_ext_print . '
      </a>
      <!-- end office -->
      
      <!-- email-->
      <br/>
      <span style="color: #8d8d8d;">E. </span>
      <a style="color: #f16624;" href="mailto:' . $nan_email . '@nanproperties.com" target="_blank"  rel="noopener">
        ' . $nan_email . '@nanproperties.com
      </a>
      <!-- end email -->
  
      <span style="font-size: 12.8px; color: #8d8d8d;"> </span>
      <div style="font-family: arial; display: inline;"></div>
      
      <!-- address -->
      <span style="text-align: initial; font-size: 12.8px; display: inline-block;">
        <span style="color: #8d8d8d;">' . $heights_address . '</span>
      </span>
      <!-- end address -->';
    }
  }

	$topProducerLogo2019       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2019.png';
	$topProducerLogo2020       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2020.png';
	$topProducerLogo2021       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2021.png';
	$topProducerLogo2022       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2022.png';
	$luxSpecLogo       				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO.jpg';
	$luxSpecLogo2020				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2020.jpg';
	$luxSpecLogo2021				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2021.jpg';
	$CIREMastersLogo   				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_MastersCircle_LOGO_2021.jpeg';
	$HBJ_2019_Top_25_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_Top25_LOGO.jpg';
	$HBJ_2020_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_SalesVolume_Logo.jpg';
	$HBJ_2020_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_Transactions_Logo.jpg';
	$HBJ_2021_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_SalesVolume_Logo.jpg';
	$HBJ_2021_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_Transactions_Logo.jpg';
	$CIRE_Affiliate_Award_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_Affiliate_LOGO.jpg';
	$Salesforce_Certified_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/SFU_CRT_BDG_Admin_RGB.jpg';
	$Prism_Logo						= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Prism_2020_Logo.jpg';
	$customlogo1					= (get_field('custom_logo_1'));
	$team_logo_square			= (get_field('team_logo_square'));

	$logoBlock_topProducer2019 = '
		<td height="100`">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="2019" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="100" height="100" src=' . $topProducerLogo2019 . '/>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2020 = '
		<td height="100`">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="2020" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="100" height="100" src=' . $topProducerLogo2020 . '/>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2021 = '
		<td height="100`">
			<table width="133" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:133px">
				<tr valign="center">
					<td id="2021" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="133" height="100" src=' . $topProducerLogo2021 . '/>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2022 = '
		<td height="100`">
			<table width="133" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:133px">
				<tr valign="center">
					<td id="2022" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="133" height="100" src=' . $topProducerLogo2022 . '/>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIREMasters = '
		<td height="100">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="CIREMasters" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Masters Circle" width="100" height="100" src=' . $CIREMastersLogo . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="CIRELS19" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist_2020 = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="CIRELS20" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo2020 . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist_2021 = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="CIRELS21" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo2021 . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIREAffiliateAward = '
		<td height="100">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="CIREAF" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Affiliate Award" width="100" height="100" src="' . $CIRE_Affiliate_Award_Logo . '" />
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_HBJ_2019_Top25 = '
		<td height="100">
			<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="HBJ19" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Houston Business Journal\'s Top 25 Real Estate Firms in Houston, 2019" width="419" height="100" src="' . $HBJ_2019_Top_25_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_HBJ_2020_Top_SalesVolume = '
		<td height="100">
			<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="HBJ19V" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2020" width="419" height="100" src="' . $HBJ_2020_Top_SalesVolume_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_HBJ_2020_Top_Transactions = '
		<td height="100">
			<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="HBJ20T" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2020" width="419" height="100" src="' . $HBJ_2020_Top_Transactions_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_HBJ_2021_Top_SalesVolume = '
		<td height="100">
			<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="HBJ21V" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2021" width="419" height="100" src="' . $HBJ_2021_Top_SalesVolume_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_HBJ_2021_Top_Transactions = '
		<td height="100">
			<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="HBJ21T" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2021" width="419" height="100" src="' . $HBJ_2021_Top_Transactions_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_Prism_Logo = '
		<td height="100">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
				<tr valign="center">
					<td id="PRISM" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="2020 Prism Award Winner" width="100" height="100" src="' . $Prism_Logo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$boolean_topProducer2019 			= (get_field('top_producer_2019') == 1) ? $logoBlock_topProducer2019 : '';
	$boolean_topProducer2020 			= (get_field('top_producer_2020') == 1) ? $logoBlock_topProducer2020 : '';
	$boolean_topProducer2021 			= (get_field('top_producer_2021') == 1) ? $logoBlock_topProducer2021 : '';
	$boolean_topProducer2022 			= (get_field('top_producer_2021') == 1) ? $logoBlock_topProducer2022 : '';
	$boolean_CIREMasters 				= (get_field('cire_masters_circle') == 1) ? $logoBlock_CIREMasters : '';
	$boolean_CIRELuxurySpecialist		= (get_field('cire_luxury_specialist') == 1) ? $logoBlock_CIRELuxurySpecialist : '';
	$boolean_CIRELuxurySpecialist2020	= (get_field('cire_luxury_specialist_2020') == 1) ? $logoBlock_CIRELuxurySpecialist_2020 : '';
	$boolean_CIRELuxurySpecialist2021	= (get_field('cire_luxury_specialist_2021') == 1) ? $logoBlock_CIRELuxurySpecialist_2021 : '';
	$boolean_CIREAffiliateAward			= (get_field('cire_affiliate_award') == 1) ? $logoBlock_CIREAffiliateAward : '';
	$boolean_HBJ2019Top25				= (get_field('hbj_2019_top_25') == 1) ? $logoBlock_HBJ_2019_Top25 : '';
	$boolean_HBJ2020TopSalesVolume		= (get_field('hbj_2020_top_salesvolume') == 1) ? $logoBlock_HBJ_2020_Top_SalesVolume : '';
	$boolean_HBJ2020TopTransactions		= (get_field('hbj_2020_top_transactions') == 1) ? $logoBlock_HBJ_2020_Top_Transactions : '';
	$boolean_HBJ2021TopSalesVolume		= (get_field('hbj_2021_top_salesvolume') == 1) ? $logoBlock_HBJ_2021_Top_SalesVolume : '';
	$boolean_HBJ2021TopTransactions		= (get_field('hbj_2021_top_transactions') == 1) ? $logoBlock_HBJ_2021_Top_Transactions : '';
	$boolean_Prism						= (get_field('prism_award_2020') !== null) ? $logoBlock_Prism_Logo : '';
  $main_logo_square = (!empty($team_logo_square)
  ) ? $team_logo_square : 'https://nanimages.s3.us-east-2.amazonaws.com/NanChristies_Logo_LockupVertical_DarkGray_Transparent.jpg';

	$code_logos = '
		<table width="204" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:204px" valign="center" >
			<tbody>
				<tr>
					<td height="20"></td>
				</tr>
				<tr valign="center" style="vertical-align:center;">'
		. $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_topProducer2022 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist . $boolean_CIRELuxurySpecialist2020 . $boolean_CIRELuxurySpecialist2021 .
		'
				</tr>
			</tbody>
		</table>
		<table width="204" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:204px" valign="center" >
			<tbody>
				<tr valign="center">
				'
		. $boolean_CIREAffiliateAward . $boolean_Prism . $boolean_HBJ2021TopSalesVolume . $boolean_HBJ2021TopTransactions . $boolean_HBJ2020TopSalesVolume . $boolean_HBJ2020TopTransactions  . $boolean_HBJ2019Top25 .
		'
				</tr>
			</tbody>
		</table>
	';

	$print_logos = (get_field('top_producer_2019') == 1 ||
		get_field('top_producer_2020') == 1 ||
		get_field('top_producer_2021') == 1 ||
		get_field('top_producer_2022') == 1 ||
		get_field('cire_luxury_specialist') == 1 ||
		get_field('cire_luxury_specialist_2020') == 1 ||
		get_field('cire_luxury_specialist_2021') == 1 ||
		get_field('cire_masters_circle') == 1 ||
		get_field('cire_affiliate_award') == 1 ||
		get_field('hbj_2019_top_25') == 1 ||
		get_field('hbj_2020_top_salesvolume') == 1 ||
		get_field('hbj_2020_top_transactions') == 1 ||
		get_field('hbj_2021_top_salesvolume') == 1 ||
		get_field('hbj_2021_top_transactions') == 1 ||
		get_field('prism_award_2020') == 1
	) ? $code_logos : '';

	$code = '
		<table style="font-family: arial;" border="0" width="485" cellspacing="0"
			cellpadding="0">
			<tbody>
				<tr>
					<td>
						' . $iabs . '
						<br/>
						<a style="color: #1155cc;"
							href="https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf"
							target="_blank" rel="noopener"
							data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span
								style="color: #1155cc; font-size: small;">Texas Real Estate Commission
								Consumer Protection Notice</span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		<table style="font-size: 12.8px; width: 485px; border: none;" border="0"
			width="485" cellspacing="0" cellpadding="0">
			<tbody>
				<tr valign="top">
					<td style="font-size: 12.8px; width: 10px; padding-right: 10px;"><img
							class="CToWUd"
							src="' . $main_logo_square . '"
							alt="photo" width="96" height="91" /></td>
					<td>
						<table>
							<tbody>
								<tr style="border: none;">
									<td style="border-right: 1px solid #f16624;" width="0"></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="font-family: arial; display: inline-block; text-align: initial;
						font-stretch: normal; line-height: normal; color: #646464; padding: 0px
						10px;">
						<table border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td style="font-family: arial; display: inline-block; text-align:
										initial; font-stretch: normal; line-height: normal;">
										<div style="font-family: arial; display: inline;">
											<strong>' . $pref_name_choice . '</strong>
										</div>
										' . $title_block . '
									</td>
								</tr>
								<tr>
									<td style="font-family: arial; font-stretch: normal; line-height: normal;
										padding: 5px 0px;">
										<span style="display: inline-block;">

											' . $cell_block . ' ' . $fax_block . $office_phone_print . '
											
											<span>
												<a style="color: #f16624;" href="https://www.nanproperties.com"
												target="_blank" rel="noopener"
												data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q">
													nanproperties.com
												</a>
											</span>
										<!-- email -->
										</span>

									</td>
								</tr>
								<tr>
									<td>
										<a
											href="http://www.facebook.com/nanandcompanyproperties/" target="_blank"
											rel="noopener"
											data-saferedirecturl="https://www.google.com/url?q=http://www.facebook.com/nanandcompanyproperties/&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNFWDpjvkE8Z4j180ryQzmlNrnkY6Q">
											<img
												class="CToWUd" style="border-radius: 0px; border: 0px; width: 16px;
												height: 16px;"
												src="https://nanimages.s3.us-east-2.amazonaws.com/facebook-logo-32.png"
												width="16" height="16" />
										</a> 
										<a
											href="https://www.linkedin.com/company/nanandcompanyproperties/"
											target="_blank" rel="noopener"
											data-saferedirecturl="https://www.google.com/url?q=http://www.linkedin.com/company/3961833?trk%3Dtyah%26trkInfo%3DclickedVertical%253Acompany%252CclickedEntityId%253A3961833%252Cidx%253A1-1-1%252CtarId%253A1480977656088%252Ctas%253A%2520nan%2520and%2520com&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNFApm433yMUhml0jFJY5H2LXem6uQ">
											<img
												class="CToWUd" style="border-radius: 0px; border: 0px; width: 16px;
												height: 16px;"
												src="https://nanimages.s3.us-east-2.amazonaws.com/linkedin-logo-32.png"
												width="16" height="16" />
										</a> 
										<a
											href="http://twitter.com/nanproperties" target="_blank" rel="noopener"
											data-saferedirecturl="https://www.google.com/url?q=http://twitter.com/nanproperties&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNFJXLvAVu79J9EC5oG7Ec8r2oKcrA">
											<img
												class="CToWUd" style="border-radius: 0px; border: 0px; width: 16px;
												height: 16px;"
												src="https://nanimages.s3.us-east-2.amazonaws.com/twitter-logo-32.png"
												width="16" height="16" />
										</a>
										<a
											href="http://instagram.com/nanproperties" target="_blank"
											rel="noopener"
											data-saferedirecturl="https://www.google.com/url?q=http://instagram.com/nanproperties&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNHKQNcmI6rSfvukpXKHvF0WKjVpug">
											<img
												class="CToWUd" style="border-radius: 0px; border: 0px; width: 16px;
												height: 16px;"
												src="https://nanimages.s3.us-east-2.amazonaws.com/instagram-logo-32.png"
												width="16" height="16" />
										</a> 
										<a
											href="https://www.youtube.com/channel/UCy_Lo0gLaK3AdAwi-nuUjDg"
											target="_blank" rel="noopener"
											data-saferedirecturl="https://www.google.com/url?q=https://www.youtube.com/channel/UCy_Lo0gLaK3AdAwi-nuUjDg&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNEt2kdAkFAuu6VktPgZvDMzoKO_0w">
											<img
												class="CToWUd"
												src="https://nanimages.s3.us-east-2.amazonaws.com/youtube-logo-32.png"
												width="16" height="16" />
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>'
		. $print_logos . '

	';

	$output = (get_field('custom_signature_boolean') == 1
	) ? the_field('custom_signature') : $code;

	return $output;
}

function har_signature_function()
{

	$firstname			= get_field('first_name');
	$lastname			= get_field('last_name');
	$pref_name_option 	= get_field('preferred_name_option');
	$pref_name 			= get_field('preferred_name');
	$pref_name_yes 		= "Yes, I want to add designations and/or use a different name in my signature";
	$pref_name_choice 	= ($pref_name_option == $pref_name_yes) ? $pref_name : $firstname . " " . $lastname;
	$title 				= get_field('title');
	$license_number 	= get_field('license_number');
	$iabs_alt 			= get_field('iabs_link_alternate');
	$fax_raw	 		= get_field('fax');
	$office_location 	= get_field('agent_office_location');
	$addtnl_text 		= get_field('additional_text_below_contact_info');
	$tagline 			= get_field('tagline');
	$agent_website 			= get_field('approved_agent_website_url');
	$social_instagram 			= get_field('instagram');

	// Variables for office locations
	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';

	// Tagline
	if (!empty($tagline)) {
		$tagline_block = '<tr><td height="10"></td></tr><tr><td>' . $tagline . '</td></tr>';
	} else {
		$tagline_block = '';
	}

	// Additional text block
	if (!empty($addtnl_text)) {
		$addtnl_text_block = '<tr><td height="10"></td></tr><tr><td>' . $addtnl_text . '</td></tr>';
	} else {
		$addtnl_text_block = '';
	}

	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.
	if ($license_number == '0') {
		$iabs = '<a href="' . $iabs_alt . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	} else {
		$iabs = '<a href="https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&cid=' . $license_number . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	};

	if ($title != 'Other') {
		$title_block = $title;
	}

	$nan_email 			= get_field('nan_email');
	$cell 				= get_field('cell_phone');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

	$office_number 		= get_field('office_number');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $office_number,  $matches)) {
		$office_number_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

  // Approved Agent Website
  if (!empty($agent_website)) {
    $agent_website_block = '
    <!-- agent website block -->
    <span> | 
      <a style="color: #f16624;" href="https://www.' . $agent_website . '"
      target="_blank" rel="noopener">' . $agent_website . '
      </a>
    </span>
    <br/>
    ';
  } else {
    $agent_website_block = '';
  }

	// Fax formatting
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $fax_raw,  $matches)) {
		$fax_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};
	if (!empty($fax_raw)) {
		$fax_block = '<span style=color:#8d8d8d>F. </span><a href="tel:+1' . $fax_raw . '"rel=noopener style=color:#f16624 target=_blank>' . $fax_formatted . ' </a><div style=font-family:arial;display:inline></div><span style=color:#f16624;display:inline-block>|</span><div style=font-family:arial;display:inline></div>';
	}

  // Social media handles
  if (!empty($social_instagram)) {
    $social_instagram_block = '<span><img src="https://nanimages.s3.us-east-2.amazonaws.com/social-media-instagram.png" height=12.8 width=12.8/><a href="https://www.instagram.com/' . $social_instagram . '" target="_blank" style="padding-left:5px">' . $social_instagram . '</a></span><br>';
  } else {
    $social_instagram_block = '';
  }

	// if (!empty($office_phone)) {
	// 	$office_block = '
	// 	<span style="color: #f16624; display: inline-block;"> | </span>

	// 	<span style="color: #8d8d8d;"> D. </span>
	// 	<a style="color: #f16624;" href="tel:+1' . $office_phone . '" target="_blank" rel="noopener">
	// 		' . $office_phone_formatted . '
	// 	</a>';
	// }

	if (!empty($cell)) {
		$cell_block = '<span style="color: #8d8d8d;">C. </span>
		<a style="color: #f16624;" href="tel:+1' . $cell . '" target="_blank" rel="noopener">
			' . $cell_formatted . '
		</a>
		<div style="font-family: arial; display: inline;"></div>
		<span style="color: #f16624; display: inline-block;"> | </span>
		<div style="font-family: arial; display: inline;"></div>';
	}

	$office_ext			= get_field('office_extension');
	$office_ext_print	= (empty($office_ext)) ? "" : ' ext. ' . $office_ext;

	// Office Phone //
  if (!empty($office_number)) {
    $office_phone_print = '<!-- office -->
    <font color:"#8d8d8d"> O. </font>
    <font>
      <a style="color: #f16624;" href="tel:+1' . $office_number_formatted . '" target="_blank" rel="noopener">' . $office_number_formatted . ' ' . $office_ext_print . '
      </a>
    </font>
    <!-- end office -->
    
    <!-- email-->
    <br/>

    <span style="display:inline-block">
      <font color="#8d8d8d">E. </font>
      <font>
        <a href="mailto:' . $nan_email  . '@nanproperties.com" value="' . $nan_email  . '@nanproperties.com" style="color:#f16624" target="_blank">
          ' . $nan_email . '@nanproperties.com
        </a>
      </font>
    </span>

    
    <!-- end email -->

    <font color="#8d8d8d" style="font-size:12.8px">&nbsp;</font>

    
    <!-- address -->
    <span style="text-align:initial;font-size:12.8px;color:#8d8d8d;display:inline-block">
      <span style="color:#8d8d8d">' . $heights_address . '</span>
    </span>
    <!-- end address -->
    <br>';
  } else {
    if ($office_location == 'Galleria') {
      $office_phone_print = '<!-- office -->
      <font color:"#8d8d8d"> O. </font>
      <font>
        <a style="color: #f16624;" href="tel:+1' . $galleria_phone . '" target="_blank" rel="noopener">' . $galleria_phone . ' ' . $office_ext_print . '
        </a>
      </font>
      <!-- end office -->
      
      <!-- email-->
      <br/>
  
      <span style="display:inline-block">
        <font color="#8d8d8d">E. </font>
        <font>
          <a href="mailto:' . $nan_email  . '@nanproperties.com" value="' . $nan_email  . '@nanproperties.com" style="color:#f16624" target="_blank">
            ' . $nan_email . '@nanproperties.com
          </a>
        </font>
      </span>
  
      
      <!-- end email -->
  
      <font color="#8d8d8d" style="font-size:12.8px">&nbsp;</font>
  
      
      <!-- address -->
      <span style="text-align:initial;font-size:12.8px;color:#8d8d8d;display:inline-block">
        <span style="color:#8d8d8d">' . $galleria_address . '</span>
      </span>
      <!-- end address -->
      <br>';
    }
    if ($office_location == 'Galveston') {
      $office_phone_print = '<!-- office -->
      <font color:"#8d8d8d"> O. </font>
      <font>
        <a style="color: #f16624;" href="tel:+1' . $galveston_phone . '" target="_blank" rel="noopener">' . $galveston_phone . ' ' . $office_ext_print . '
        </a>
      </font>
      <!-- end office -->
      
      <!-- email-->
      <br/>
  
      <span style="display:inline-block">
        <font color="#8d8d8d">E. </font>
        <font>
          <a href="mailto:' . $nan_email  . '@nanproperties.com" value="' . $nan_email  . '@nanproperties.com" style="color:#f16624" target="_blank">
            ' . $nan_email . '@nanproperties.com
          </a>
        </font>
      </span>
  
      
      <!-- end email -->
  
      <font color="#8d8d8d" style="font-size:12.8px">&nbsp;</font>
  
      
      <!-- address -->
      <span style="text-align:initial;font-size:12.8px;color:#8d8d8d;display:inline-block">
        <span style="color:#8d8d8d">' . $galveston_address . '</span>
      </span>
      <!-- end address -->
      <br>';
    }
    if ($office_location == 'Heights') {
      $office_phone_print = '<!-- office -->
      <font color:"#8d8d8d"> O. </font>
      <font>
        <a style="color: #f16624;" href="tel:+1' . $heights_phone . '" target="_blank" rel="noopener">' . $heights_phone . ' ' . $office_ext_print . '
        </a>
      </font>
      <!-- end office -->
      
      <!-- email-->
      <br/>
  
      <span style="display:inline-block">
        <font color="#8d8d8d">E. </font>
        <font>
          <a href="mailto:' . $nan_email  . '@nanproperties.com" value="' . $nan_email  . '@nanproperties.com" style="color:#f16624" target="_blank">
            ' . $nan_email . '@nanproperties.com
          </a>
        </font>
      </span>
  
      
      <!-- end email -->
  
      <font color="#8d8d8d" style="font-size:12.8px">&nbsp;</font>
  
      
      <!-- address -->
      <span style="text-align:initial;font-size:12.8px;color:#8d8d8d;display:inline-block">
        <span style="color:#8d8d8d">' . $heights_address . '</span>
        </span>
      <!-- end address -->
      <br>';
    }
  }

	$topProducerLogo2019       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2019.png';
	$topProducerLogo2020       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2020.png';
	$topProducerLogo2021       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2021.png';
	$topProducerLogo2022       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2022.png';
	$luxSpecLogo       				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO.jpg';
	$luxSpecLogo2020				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2020.jpg';
	$luxSpecLogo2021				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2021.jpg';
	$CIREMastersLogo   				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_MastersCircle_LOGO.jpg';
	$CIRE_Affiliate_Award_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_Affiliate_LOGO.jpg';
	$HBJ_2019_Top_25_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_Top25_LOGO.jpg';
	$HBJ_2020_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_SalesVolume_Logo.jpg';
	$HBJ_2020_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_Transactions_Logo.jpg';
	$HBJ_2021_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_SalesVolume_Logo.jpg';
	$HBJ_2021_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_Transactions_Logo.jpg';
	$Leading_RE_Logo				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_LeadingRE_LOGO.png';
	$HBJ_All_Awards					= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_All_Awards.jpg';
	$Prism_Logo						= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Prism_2020_Logo.jpg';
	$team_logo_square						= (get_field('team_logo_square'));


	$logoBlock_topProducer2019 = '
		<td height="100`">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="HARTOP19" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="100" height="100" src=' . $topProducerLogo2019 . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2020 = '
		<td height="100`">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="HARTOP20" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="100" height="100" src=' . $topProducerLogo2020 . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2021 = '
		<td height="100`">
			<table width="133" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:133px">
				<tr valign="center">
					<td id="HARTOP21" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="133" height="100" src=' . $topProducerLogo2021 . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_topProducer2022 = '
		<td height="100`">
			<table width="133" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:133px">
				<tr valign="center">
					<td id="HARTOP22" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="Top Producer, Nan and Company Properties" width="133" height="100" src=' . $topProducerLogo2022 . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIREMasters = '
		<td height="100">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="HARCIREM" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Masters Circle" width="100" height="100" src=' . $CIREMastersLogo . '>
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="HARCIRELS19" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist2020 = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="HARCIRELS20" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo2020 . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIRELuxurySpecialist2021 = '
		<td height="100">
			<table width="208" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:208px">
				<tr valign="center">
					<td id="HARCIRELS21" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Luxury Specialist" width="208" height="100" src="' . $luxSpecLogo2021 . '"/>
					</td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_CIREAffiliateAward = '
		<td height="100">
			<table width="100" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:100px">
				<tr valign="center">
					<td id="HARCIREAA" style="font-size:12.8px;width:10px;padding-right:10px">
						<img class="CToWUd" alt="CIRE Affiliate Award" width="100" height="100" src="' . $CIRE_Affiliate_Award_Logo . '" />
					</td>
				</tr>
			</table>
		</td>
		<td height="50">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td></td>
				</tr>
			</table>
		</td>
	';

	$logoBlock_Leading_RE_Logo = '
		<tr valign=center>
			<td height=54>
				<img alt="Leading RE" class=CToWUd height=44 src="' . $Leading_RE_Logo . '"width=204>
			</td>
		</tr>
	';

	$logoBlock_Prism_Logo = '
		<td id="HARPRISM" height="100">
			<img class="CToWUd" alt="2020 Prism Award Winner" width="100" height="100" src="' . $Prism_Logo . '"/>
		</td>
	';

	$logoBlock_HBJ_All_Awards = '
		<tr valign="center">
			<td height="100">
				<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
					<tr valign="center">
						<td id="HARHBJ" style="font-size:12.8px;width:10px;padding-right:10px">
							<img class="CToWUd" alt="Houston Business Journal\'s Top 25 Real Estate Firms in Houston, 2019" width="419" height="100" src="' . $HBJ_2019_Top_25_Logo . '"/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	';

	$logoBlock_HBJ_2019_Top25 = '
		<tr valign="center">
			<td height="100">
				<table width="419" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:419px">
					<tr valign="center">
						<td id="HARHBJ19" style="font-size:12.8px;width:10px;padding-right:10px">
							<img class="CToWUd" alt="Houston Business Journal\'s Top 25 Real Estate Firms in Houston, 2019" width="419" height="100" src="' . $HBJ_2019_Top_25_Logo . '"/>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	';

	$logoBlock_HBJ_2020_Top_SalesVolume = '
		<tr valign="center">	
			<td id="HARHBJ20V" height="100">
				<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2020" width="419" height="100" src="' . $HBJ_2020_Top_SalesVolume_Logo . '"/>
			</td>
		</tr>
	';

	$logoBlock_HBJ_2020_Top_Transactions = '
		<tr valign="center">	
			<td id="HARHBJ20T" height="100">
				<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2020" width="419" height="100" src="' . $HBJ_2020_Top_Transactions_Logo . '"/>
			</td>
		</tr>
	';

	$logoBlock_HBJ_2021_Top_SalesVolume = '
		<tr valign="center">	
			<td id="HARHBJ21V" height="100">
				<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume, 2021" width="419" height="100" src="' . $HBJ_2021_Top_SalesVolume_Logo . '"/>
			</td>
		</tr>
	';

	$logoBlock_HBJ_2021_Top_Transactions = '
		<tr valign="center">	
			<td id="HARHBJ21T" height="100">
				<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Transactions, 2021" width="419" height="100" src="' . $HBJ_2021_Top_Transactions_Logo . '"/>
			</td>
		</tr>
	';

	$logoBlock_HBJ_All_Awards = '
		<tr valign="center">	
			<td id="HARHBJALL" height="88">
				<img class="CToWUd" alt="Houston Business Journal\'s Top Residential Professionals by Sales Volume and Transactions, 2019, 2020, 2021" width="408" height="88" src="' . $HBJ_All_Awards . '"/>
			</td>
		</tr>
	';




	$boolean_topProducer2019 			= (get_field('top_producer_2019') == 1) ? $logoBlock_topProducer2019 : '';
	$boolean_topProducer2020 			= (get_field('top_producer_2020') == 1) ? $logoBlock_topProducer2020 : '';
	$boolean_topProducer2021 			= (get_field('top_producer_2021') == 1) ? $logoBlock_topProducer2021 : '';
	$boolean_topProducer2022 			= (get_field('top_producer_2022') == 1) ? $logoBlock_topProducer2022 : '';
	$boolean_CIREMasters 				= (get_field('cire_masters_circle') == 1) ? $logoBlock_CIREMasters : '';
	$boolean_CIRELuxurySpecialist		= (get_field('cire_luxury_specialist') == 1) ? $logoBlock_CIRELuxurySpecialist : '';
	$boolean_CIRELuxurySpecialist2020	= (get_field('cire_luxury_specialist_2020') == 1) ? $logoBlock_CIRELuxurySpecialist2020 : '';
	$boolean_CIRELuxurySpecialist2021	= (get_field('cire_luxury_specialist_2021') == 1) ? $logoBlock_CIRELuxurySpecialist2021 : '';
	$boolean_CIREAffiliateAward			= (get_field('cire_affiliate_award') == 1) ? $logoBlock_CIREAffiliateAward : '';
	$boolean_HBJ2019Top25				= (get_field('hbj_2019_top_25') == 1) ? $logoBlock_HBJ_2019_Top25 : '';
	$boolean_HBJ2020TopSalesVolume		= (get_field('hbj_2020_top_salesvolume') == 1) ? $logoBlock_HBJ_2020_Top_SalesVolume : '';
	$boolean_HBJ2020TopTransactions		= (get_field('hbj_2020_top_transactions') == 1) ? $logoBlock_HBJ_2020_Top_Transactions : '';
	$boolean_HBJ2021TopSalesVolume		= (get_field('hbj_2021_top_salesvolume') == 1) ? $logoBlock_HBJ_2021_Top_SalesVolume : '';
	$boolean_HBJ2021TopTransactions		= (get_field('hbj_2021_top_transactions') == 1) ? $logoBlock_HBJ_2021_Top_Transactions : '';
	$boolean_HBJAllAwards				= (get_field('hbj_all_awards') == 1) ? $logoBlock_HBJ_All_Awards : '';
	$boolean_Leading_RE					= (get_field('leading_re_logo') == 1) ? $logoBlock_Leading_RE_Logo : '';
	$boolean_Prism						= (get_field('prism_award_2020') == 1) ? $logoBlock_Prism_Logo : '';

  $main_logo_square = (!empty($team_logo_square)
  ) ? $team_logo_square : 'https://nanimages.s3.us-east-2.amazonaws.com/NanChristies_Logo_LockupVertical_DarkGray_Transparent.jpg';

	$code_logos = '
		<table width="204" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:204px" valign="center" >
			<tbody>
				<tr>
					<td height="20"></td>
				</tr>
				<tr valign="center" style="vertical-align:center;">'
		. $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_topProducer2022 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist  . $boolean_CIRELuxurySpecialist2020  . $boolean_CIRELuxurySpecialist2021 . $boolean_CIREAffiliateAward . $boolean_Prism .
		'
				</tr>
			</tbody>
		</table>
		<table width="204" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:204px" valign="center" >
			<tbody>
				'
		. $boolean_HBJAllAwards . $boolean_HBJ2021TopSalesVolume . $boolean_HBJ2021TopTransactions . $boolean_HBJ2020TopSalesVolume . $boolean_HBJ2020TopTransactions . $boolean_HBJ2019Top25 .
		'
			</tbody>
		</table>
	';

	$print_logos_0 = '
		<table width="400" border="0" cellspacing="0" cellpadding="0" style="font-size:12.8px;width:400px" valign="center" >
			<tbody>
				<tr>
					<td height="20"></td>
				</tr>
				<tr valign="center" style="vertical-align:center;">'
		. $boolean_Leading_RE .
		'
				</tr>
			</tbody>
		</table>
	';

  $print_logos = (get_field('top_producer_2019') == 1 ||
		get_field('top_producer_2020') == 1 ||
		get_field('top_producer_2021') == 1 ||
		get_field('top_producer_2022') == 1 ||
		get_field('cire_luxury_specialist') == 1 ||
		get_field('cire_luxury_specialist_2020') == 1 ||
		get_field('cire_luxury_specialist_2021') == 1 ||
		get_field('cire_masters_circle') == 1 ||
		get_field('cire_affiliate_award') == 1 ||
		get_field('prism_award_2020') == 1 ||
		get_field('hbj_2019_top_25') == 1 ||
		get_field('hbj_2020_top_salesvolume') == 1 ||
		get_field('hbj_2020_top_transactions') == 1 ||
		get_field('hbj_2021_top_salesvolume') == 1 ||
		get_field('hbj_2021_top_transactions') == 1 ||
		get_field('hbj_all_awards') == 1
	) ? $code_logos : '';

	$code = '<div id="compiled-signature" class="compiled-signature">
		<table style="font-family: arial;" border="0" width="485" cellspacing="0"
			cellpadding="0">
			<tbody>
				<tr>
					<td>
						' . $iabs . '
						<br/>
						<a style="color: #1155cc;"
							href="https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf"
							target="_blank" rel="noopener"
							data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&amp;source=gmail&amp;ust=1551449162934000&amp;usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span
								style="color: #1155cc; font-size: small;">Texas Real Estate Commission
								Consumer Protection Notice</span>
						</a>
					</td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
			</tbody>
		</table>
		<table style="font-size: 12.8px; width: 485px; border: none;" border="0"
			width="485" cellspacing="0" cellpadding="0">
			<tbody>
				<tr valign="top">
					<td style="font-size: 12.8px; width: 10px; padding-right: 10px;">
						<img
							class="CToWUd"
							src="' . $main_logo_square . '"
							alt="photo" width="96" height="91" />
					</td>
					<td>
						<table>
							<tbody>
								<tr height="91" style="border:none" border="0">
									<td width="0">
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="font-family: arial; display: inline-block; text-align: initial;
						font-stretch: normal; line-height: normal; color: #646464; padding: 0px
						10px;">
						<table border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td style="font-family: arial; display: inline-block; text-align:
										initial; font-stretch: normal; line-height: normal;">
											<div style="font-family: arial; display: inline;">
												<strong>' . $pref_name_choice . '</strong>
												<br/>
												' . $title_block . '
											</div>
										
										<br/>
									</td>
								</tr>
                ' . $tagline_block . '
								<tr>
									<td style="font-family: arial; font-stretch: normal; line-height: normal;
										padding: 5px 0px;">
										<span style="display: inline-block;">

											' . $cell_block . ' ' . $fax_block . '<br>' . $office_phone_print . $social_instagram_block . '

											<span>
												<a style="color: #f16624;" href="https://www.nanproperties.com"
												target="_blank" rel="noopener">nanproperties.com
												</a>
											</span>
                      <br/>
                      ' . $agent_website_block . '
										<!-- email -->
										</span>

									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		' . $addtnl_text_block . $print_logos_0 . $print_logos . '</div>

	';
	$output = (get_field('custom_signature_boolean') == 1
	) ? the_field('custom_signature') : $code;

	return $output;
}

function propertybase_signature_code_function()
{

	$firstname			= get_field('first_name');
	$lastname			= get_field('last_name');
	$pref_name_option 	= get_field('preferred_name_option');
	$pref_name 			= get_field('preferred_name');
	$pref_name_yes 		= "Yes, I want to add designations and/or use a different name in my signature";
	$pref_name_choice 	= ($pref_name_option == $pref_name_yes) ? $pref_name : $firstname . " " . $lastname;
	$title 				= get_field('title');
	$license_number 	= get_field('license_number');
	$iabs_alt 			= get_field('iabs_link_alternate');
	$fax_raw	 		= get_field('fax');
	$office_location 	= get_field('agent_office_location');
	$agent_website 	= get_field('approved_agent_website_url');

	// Variables for office locations
	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';

	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.
	if ($license_number == '0') {
		$iabs = '&lt;a href=&quot;' . $iabs_alt . '&quot;&gt;Info About Brokerage Services&lt;/a&gt;';
	} else {
		$iabs = '&lt;a href=&quot;https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&amp;cid=' . $license_number . '&quot;&gt;Info About Brokerage Services&lt;/a&gt;';
	};


	if ($title != 'Other') {
		$title_block = '&lt;li&gt;' . $title . '&lt;/li&gt;';
	}

	$nan_email 			= get_field('nan_email');
	$cell 				= get_field('cell_phone');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

	$office_number 		= get_field('office_number');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $office_number,  $matches)) {
		$office_number_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

  // Approved Agent Website
  if (!empty($agent_website)) {
    $agent_website_block = $agent_website;
  } else {
    $agent_website_block = '';
  }


	// Fax formatting
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $fax_raw,  $matches)) {
		$fax_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};
	if (!empty($fax_raw)) {
		$fax_block = ' | F. &lt;/span&gt;' . $fax_formatted;
	}

	if (!empty($cell)) {
		$cell_block = ' | C. ' . $cell_formatted;
	}

	$office_ext			= get_field('office_extension');
	$office_ext_print	= (empty($office_ext)) ? "" : ' ext. ' . $office_ext;
	$license_number 	= get_field('license_number');
	
  // Office Phone //
  if (!empty($office_number)) {
    $office_phone_print = '&lt;li style=&quot;color:#8d8d8d&quot;&gt;O. ' . $office_number_formatted;
    ;
  } else {
    if ($office_location == 'Galleria') {
      $office_phone_print = '&lt;li style=&quot;color:#8d8d8d&quot;&gt;O. ' . $galleria_phone;
    }
    if ($office_location == 'Galveston') {
      $office_phone_print = '&lt;li style=&quot;color:#8d8d8d&quot;&gt;O. ' . $galveston_phone;
    }
    if ($office_location == 'Heights') {
      $office_phone_print = '&lt;li style=&quot;color:#8d8d8d&quot;&gt;O. ' . $heights_phone;
    }
  }

  $team_logo_square			= (get_field('team_logo_square'));

  $main_logo_square = (!empty($team_logo_square)
  ) ? $team_logo_square : 'https://nanimages.s3.us-east-2.amazonaws.com/NanChristies_Logo_LockupVertical_DarkGray_Transparent.jpg';


	$code = '
	<pre class="escapedCode" style="white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><code>' . $iabs . '&lt;br/&gt;&lt;a href=&quot;https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf&quot;&gt;TREC Consumer Protection Notice&lt;/a&gt;&lt;div style=&quot;margin-top:10px;display:block;height:20px&quot;&gt;&lt;/div&gt;&lt;div style=&quot;display:flex;&quot;&gt;&lt;img src=&quot;' . $main_logo_square . '&quot; style=&quot;maxwidth:100px;max-height:100px;border-right:1px solid #f16624&quot;&gt;&lt;ul style=&quot;list-style: none; font-family:arial;display:inline-block;font-stretch:normal;margin: 0;padding:0px 10px;lineheight:20px;&quot;&gt;&lt;li&gt;&lt;b&gt;' . $pref_name_choice . '&lt;/b&gt;&lt;/li&gt;' . $title_block . $office_phone_print . $office_ext_print . $cell_block . $fax_block . '&lt;br/&gt;E. ' . $nan_email . '@nanproperties.com&lt;/a&gt;&lt;/li&gt;&lt;li style=&quot;fontsize:12.8px;color:#8d8d8d&quot;&gt;nanproperties.com &#33;	' . $agent_website_block . '&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;</code></pre>
	';

	$output = (get_field('custom_signature_boolean') == 1
	) ? the_field('custom_signature') : $code;

	return $output;
}

function propertybase_signature_function()
{

	$firstname			= get_field('first_name');
	$lastname			= get_field('last_name');
	$pref_name_option 	= get_field('preferred_name_option');
	$pref_name 			= get_field('preferred_name');
	$pref_name_yes 		= "Yes, I want to add designations and/or use a different name in my signature";
	$pref_name_choice 	= ($pref_name_option == $pref_name_yes) ? $pref_name : $firstname . " " . $lastname;
	$title 				= get_field('title');
	$license_number 	= get_field('license_number');
	$iabs_alt 			= get_field('iabs_link_alternate');
	$fax_raw	 		= get_field('fax');
	$office_location 	= get_field('agent_office_location');
  $agent_website 			= get_field('approved_agent_website_url');


	// Variables for office locations
	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';

	$team_logo_square			= (get_field('team_logo_square'));


	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.
	if ($license_number == '0') {
		$iabs = '<a href="' . $iabs_alt . '">Info About Brokerage Services</a>';
	} else {
		$iabs = '<a href="https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&cid=' . $license_number . '">Info About Brokerage Services</a>';
	};

	if ($title != 'Other') {
		$title_block = '<li>' . $title . '</li>';
	}

	$nan_email 			= get_field('nan_email');
	$cell 				= get_field('cell_phone');

  // Format cell
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

  // Format office phone for 
	$office_number 		= get_field('office_number');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $office_number,  $matches)) {
		$office_number_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};

  // Approved Agent Website
  if (!empty($agent_website)) {
    $agent_website_block = ' | ' . $agent_website .  '';
  } else {
    $agent_website_block = '';
  }


	// Fax formatting
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $fax_raw,  $matches)) {
		$fax_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
	};
	if (!empty($fax_raw)) {
		$fax_block = ' | F. </span>' . $fax_formatted;
	}

	if (!empty($cell)) {
		$cell_block = ' | C. ' . $cell_formatted;
	}


	$office_ext			= get_field('office_extension');
	$office_ext_print	= (empty($office_ext)) ? "" : ' ext. ' . $office_ext;

	$license_number 	= get_field('license_number');

	$team_logo_square			= (get_field('team_logo_square'));

  $main_logo_square = (!empty($team_logo_square)
  ) ? $team_logo_square : 'https://nanimages.s3.us-east-2.amazonaws.com/NanChristies_Logo_LockupVertical_DarkGray_Transparent.jpg';

	// Office Number //
  if (!empty($office_number)) {
    $office_phone_print = '<li style="color:#8d8d8d">O. ' . $office_number_formatted;
    ;
  } else {
    if ($office_location == 'Galleria') {
      $office_phone_print = '<li style="color:#8d8d8d">O. ' . $galleria_phone;
    }
    if ($office_location == 'Galveston') {
      $office_phone_print = '<li style="color:#8d8d8d">O. ' . $galveston_phone;
    }
    if ($office_location == 'Heights') {
      $office_phone_print = '<li style="color:#8d8d8d">O. ' . $heights_phone;
    }
  }


	$code = $iabs . '<br/><a href="https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf">TREC Consumer Protection Notice</a><div style="margin-top:10px;display:block;height:20px"></div><div style="display:flex;"><img src="' . $main_logo_square . '" style="maxwidth:100px;max-height:100px;border-right:1px solid #f16624"><ul style="list-style: none; font-family:arial;display:inline-block;font-stretch:normal;margin: 0;padding:0px 10px;lineheight:20px;"><li><b>' . $pref_name_choice . '</b></li>' . $title_block . $office_phone_print . $office_ext_print . $cell_block . $fax_block . '<br/>E. ' . $nan_email . '@nanproperties.com</a></li><li style="fontsize:12.8px;color:#8d8d8d">nanproperties.com' . $$agent_website_block . '</li></ul></div>';

	$output = (get_field('custom_signature_boolean') == 1
	) ? the_field('custom_signature') : $code;

	return $output;
}

add_shortcode('gmail_shortcode', 'gmail_signature_function');
add_shortcode('webapp_shortcode', 'webapp_signature_function');
add_shortcode('har_shortcode', 'har_signature_function');
add_shortcode('propertybase_code_shortcode', 'propertybase_signature_code_function');
add_shortcode('propertybase_shortcode', 'propertybase_signature_function');