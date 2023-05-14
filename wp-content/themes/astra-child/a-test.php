<?php

function gmail_signature_function()
{
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
	

	$galleria_phone 	= '713.714.6454';
	$galleria_address 	= '2200 Post Oak Blvd., Suite 1475, Houston, TX 77056';
	$heights_phone	 	= '713.714.6454';
	$heights_address 	= '725 Yale St., Houston, TX 77007';
	$galveston_phone	= '409.206.5800';
	$galveston_address 	= '10327 FM 3005, 2nd Floor, Galveston, TX 77554';
	$sugarland_phone	= '713.714.6454';
	$sugarland_address 	= 'Three Sugar Creek Center, Suite 100, Sugar Land, TX 77478';

	// If IABS is not on HAR hosting (say, on our own servers), this will check for '000000' and then pull the corresponding ACF field, where you have to manually add the IABS URL found on the custom server.
	
    if ($license_number == '0') {
		$iabs = '<a href="' . $iabs_alt . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
    } else {
		$iabs = '<a href="https://members.har.com/mhf/terms/dispBrokerInfo.cfm?sitetype=aws&cid=' . $license_number . '"rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Information About Brokerage Services</span></a>';
	};
	
	if($title != 'Other') {
		$title_block = '<br><div style=font-family:arial;display:inline>' . $title . '</div>';
	};
	
	$nan_email 			= get_field('nan_email');
	$cell 				= get_field('cell_phone');
	if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $cell,  $matches)) {
		$cell_formatted = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
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
	
	// Office Location //
	if ($office_location == 'Galleria') {
		$office_location_print = '<a href=tel:+1' . $galleria_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $galleria_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $galleria_address . '</span><br>';
	}
	if ($office_location == 'Heights') {
		$office_location_print = '<a href=tel:+1' . $heights_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $heights_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $heights_address . '</span><br>';
	}
	if ($office_location == 'Galveston') {
		$office_location_print = '<a href=tel:+1' . $galveston_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $galveston_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $galveston_address . '</span><br>';
	}
	if ($office_location == 'Sugar Land') {
		$office_location_print = '<a href=tel:+1' . $sugarland_phone . ' rel=noopener style=color:#f16624 target=_blank>' . $sugarland_phone . $office_ext_print . '</a><br><span style=color:#8d8d8d>E. </span><a href="mailto:' . $nan_email . '@nanproperties.com"rel=noopener style=color:#f16624 target=_blank>' . $nan_email . '@nanproperties.com</a><br><span style=color:#8d8d8d;text-align:initial;font-size:12.8px;display:inline-block>' . $sugarland_address . '</span><br>';
	}



	$topProducerLogo2019 			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2019.png';
	$topProducerLogo2020       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2020.png';
	$topProducerLogo2021       		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Top_Producer_2021.png';
	$luxSpecLogo       				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO.jpg';
	$luxSpecLogo2020				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2020.jpg';
	$luxSpecLogo2021				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_LuxurySpecialist_LOGO_2021.jpg';
	$CIREMastersLogo   				= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_MastersCircle_LOGO_2021.jpeg';
	$HBJ_2019_Top_25_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_Top25_LOGO.jpg';
	$HBJ_2020_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_SalesVolume_Logo.jpg';
	$HBJ_2020_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2020_Top_Transactions_Logo.jpg';
	$HBJ_2021_Top_SalesVolume_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_SalesVolume_Logo.jpg';
	$HBJ_2021_Top_Transactions_Logo	= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_2021_Top_Transactions_Logo.jpg';
	$HBJ_All_Awards_Logo			= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_HBJ_All_Awards.jpg';
	$CIRE_Affiliate_Award_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_CIRE_Affiliate_LOGO.jpg';
	$Salesforce_Certified_Logo		= 'https://nanimages.s3.us-east-2.amazonaws.com/SFU_CRT_BDG_Admin_RGB.jpg';
	$Prism_Logo						= 'https://nanimages.s3.us-east-2.amazonaws.com/Email_Signature_Logos_Prism_2020_Logo.jpg';
	$customlogo1					= (get_field('custom_logo_1'));
	$team_logo						= (get_field('team_logo'));
	
	$logoBlock_topProducer2019 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2019 . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_topProducer2020 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2020 . '"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_topProducer2021 = '<td height="100`"><table border=0 cellpadding=0 cellspacing=0 width=133 style=font-size:12.8px;width:133px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Top Producer, Nan and Company Properties"class=CToWUd height=100 src="' . $topProducerLogo2021 . '"width=133></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
	$logoBlock_CIREMasters = '<td height=100><table border=0 cellpadding=0 cellspacing=0 width=100 style=font-size:12.8px;width:100px><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="CIRE Masters Circle"class=CToWUd height=100 src="' . $CIREMastersLogo .'"width=100></table><td height=50><table border=0 cellpadding=0 cellspacing=0 width=10><tr><td></table>';
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

	$logoBlock_Prism_Logo = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img class=CToWUd src="' . $Prism_Logo . '"width=100></table>';

	$logoBlock_SalesforceCertified = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img alt="Salesforce Certified"class=CToWUd src="' . $Salesforce_Certified_Logo . '"width=100></table>';

	$logoBlock_customlogo1 = '<td height=100><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:100px width=100><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img class=CToWUd src="' . $customlogo1 . '"width=100></table>';

	$logoBlock_team_logo = '<td height=20 id="testing_here"><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:400px width=400><tr valign=center><td style=font-size:12.8px;width:10px;padding-right:10px><img class=CToWUd src="' . $team_logo . '"width=400></table>';

	$boolean_topProducer2019 			= (get_field('top_producer_2019') == 1) ? $logoBlock_topProducer2019 : '';
	$boolean_topProducer2020 			= (get_field('top_producer_2020') == 1) ? $logoBlock_topProducer2020 : '';
	$boolean_topProducer2021 			= (get_field('top_producer_2021') == 1) ? $logoBlock_topProducer2021 : '';
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
	$boolean_SalesforceCertified		= (get_field('salesforce_certified') == 1) ? $logoBlock_HBJ_All_Awards : '';
	$boolean_Prism						= (get_field('prism_award_2020') !== null) ? $logoBlock_Prism_Logo : '';
	$boolean_customlogo1				= (get_field('custom_logo_1') !== null) ? $logoBlock_customlogo1 : '';
	$boolean_team_logo					= (get_field('team_logo') !== null) ? $logoBlock_team_logo : '';

	$code_logos = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr><td height=20><tr valign=center style=vertical-align:center>' . $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist . '</table><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr valign=center>' . $boolean_CIREAffiliateAward . $boolean_HBJ2019Top25 . '</table>';

	$code_logos_0 = '<tr>' . $boolean_SalesforceCertified . $boolean_team_logo . '</tr>';
	
	$code_logos_1 = '<table id="testing_code_1" border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr><td height=20><tr valign=center style=vertical-align:center>' . $boolean_topProducer2019 . $boolean_topProducer2020 . $boolean_topProducer2021 . $boolean_CIREMasters . $boolean_CIRELuxurySpecialist . $boolean_CIRELuxurySpecialist2020 . $boolean_CIRELuxurySpecialist2021 . '</table>';
	
	$code_logos_2 = '<table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:204px valign=center width=204><tr valign=center>' . $boolean_CIREAffiliateAward . $boolean_Prism . $boolean_customlogo1 . '</table>';
	
	$code_logos_3 = $boolean_HBJAllAwards . $boolean_HBJ2021TopSalesVolume . $boolean_HBJ2021TopTransactions . $boolean_HBJ2020TopSalesVolume . $boolean_HBJ2020TopTransactions . $boolean_HBJ2019Top25;
	
	$print_logos_0 = (
			get_field('salesforce_certified') == 1 ||
			get_field('team_logo') == 1

		) ? $code_logos_0 : '';

	$print_logos_1 = (
			get_field('top_producer_2019') == 1 ||
			get_field('top_producer_2020') == 1 ||
			get_field('top_producer_2021') == 1 ||
			get_field('cire_masters_circle') == 1 ||
			get_field('cire_luxury_specialist') == 1 ||
			get_field('cire_luxury_specialist_2020') == 1 ||
			get_field('cire_luxury_specialist_2021') == 1 
		) ? $code_logos_1 : '';
	
	$print_logos_2 = (
			get_field('cire_affiliate_award') == 1 ||
			get_field('prism_award_2020') == 1 ||
			get_field('custom_logo_1') == 1 
		) ? $code_logos_2 : '';
	
	$print_logos_3 = (
			get_field('hbj_2019_top_25') == 1 ||
			get_field('hbj_2020_top_salesvolume') == 1 ||
			get_field('hbj_2020_top_transactions') == 1 ||
			get_field('hbj_2021_top_salesvolume') == 1 ||
			get_field('hbj_2021_top_transactions') == 1 ||
			get_field('hbj_all_awards') == 1
		) ? $code_logos_3 : '';

	$print_logos = (
			get_field('top_producer_2019') == 1 ||
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

	$code = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body><div id="compiled-signature">' . $iabs . '<br><a href=https://www.trec.texas.gov/sites/default/files/pdf-forms/CN%201-2.pdf rel=noopener style=color:#15c target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q"><span style=color:#15c;font-size:small>Texas Real Estate Commission Consumer Protection Notice</span></a><div><br/></div><table border=0 cellpadding=0 cellspacing=0 style=font-size:12.8px;width:485px;border:none width=485><tr valign=top><td style=font-size:12.8px;width:10px;padding-right:10px><img alt=photo class=CToWUd height=91 src="https://ci5.googleusercontent.com/proxy/xJfyUdVPQkmenOxWAzkOo2BqMX_-Z62aRGQ_ZD2hQ9rMjF5kMtBo3ef4sfhNQ3-Xs_HZOLW4pcp-Ve3kzA_dYCBrqRN4Tu0Q_XdYaxwXaOS1paTDmO4ykJK9FPI0q3HldN6PNBkeqTydHdTCcKqW4aiti3D4a3X_jJFkdtOQYj9UlsDbPCl92V-sWnImZW3W1Q37SgPzE-939uSswCoR1KGsbqOsLZThQjRJvfz7ip6iCWSqGsp_CEkbpG5WR12FSka7qfkDmv6wMLp9EkGMeBTgCLdeMKi__bKCh4Foh0mqDe75KWM=s0-d-e1-ft#https://s3.amazonaws.com/ucwebapp.wisestamp.com/45e1539a-97de-483f-a127-6d5ae71332e1/NanChristies_Logo_LockupVertical__NoBorder_DarkGray_Transparent_V22.crop_3713x3545_344,564.preview.format_png.resize_200x.png"width=96><td><table><tr style=border:none><td style="border-right:1px solid #f16624"width=0></table><td style="font-family:arial;display:inline-block;text-align:initial;font-stretch:normal;line-height:normal;color:#646464;padding:0 10px"><table border=0 cellpadding=0 cellspacing=0><tr><td style=font-family:arial;display:inline-block;text-align:initial;font-stretch:normal;line-height:normal><div style=font-family:arial;display:inline><strong>' . $pref_name_choice . '</strong></div>' . $title_block . '<tr><td style="font-family:arial;font-stretch:normal;line-height:normal;padding:5px 0"><span style=display:inline-block>' . $cell_block . ' ' . $fax_block . ' <span style=color:#8d8d8d>O. </span>' . $office_location_print . '<span><a href=https://www.nanproperties.com rel=noopener style=color:#f16624 target=_blank data-saferedirecturl="https://www.google.com/url?q=http://nanproperties.com/&source=gmail&ust=1551449162934000&usg=AFQjCNHt6vQIQhW7C9w8FJOnLajD_LDl0Q">nanproperties.com</a></span></span></td></tr><tr><td height="10"></td></tr>' . $print_logos_0. '</table></table>'
		. $print_logos_1 . $print_logos_2 . $print_logos_3 . '</div></body></html>'
		;

	$output = (
		get_field('custom_signature_boolean') == 1
	) ? get_field('custom_signature') : $code;



	return $output;

}

?>