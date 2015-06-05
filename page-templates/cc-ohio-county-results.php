<?php
/**
 Template Name: CC - Ohio County Results
*/



get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php                         
				cc_ohio_county_results();                        
				while ( have_posts() ) : the_post(); ?>
			<?php                              
				//get_template_part( 'content', 'page' ); ?>				
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); 

function cc_ohio_county_results() {
?>
<script type="text/javascript">
	function checkAll(formname, checktoggle)
	{
	  var checkboxes = new Array(); 
	  checkboxes = document[formname].getElementsByTagName('input');
	 
	  for (var i=0; i<checkboxes.length; i++)  {
		if (checkboxes[i].type == 'checkbox')   {
		  checkboxes[i].checked = checktoggle;
		}
	  }
	}
	function printContent(el) {
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>

<?php
	$counties = array(
			"Adams County",
			"Allen County",
			"Athens County",
			"Clark County",
			"Cuyahoga County",
			"Delaware County",
			"Franklin County",
			"Hamilton County",
			"Knox County",
			"Licking County",
			"Lorain County",
			"Lucas County",
			"Marion County",
			"Meigs County",
			"Montgomery County",
			"Perry County",
			"Richland County",
			"Sandusky County",
			"Stark County",
			"Summit County",
			"Trumbull County",
			"Union County",
			"Washington County"
		);
		
		$newurl = '/PHPExcel/Examples/oh-county-new-xls.php';
?>
	<form id="form1" name="form1" method="post" action="">
		<strong>Select County:</strong><br /><br />
		<div style="margin-left:20px;">
			<select name="county">
			<?php
				if ($_POST["county"]) {
					echo "<option value='" . $_POST["county"] . "'>" . $_POST["county"] . "</option>";
				} else {
					echo "<option value=''>---Select County---</option>";
				}
				foreach($counties as $key => $value):
				echo '<option value="' . $value . '">' . $value . '</option>'; 
				endforeach;
				?>
			</select>
		</div>	
		<br /><br />
		<?php
			if ($_POST["chk_group"]) {
				$reportarr = $_POST["chk_group"];
			} else {
				$reportarr = array();
			}
		?>
		<strong>Select forms to include in report:</strong><br /><br />
		<div style="margin-left:20px;">
			<a onclick="javascript:checkAll('form1', true);" href="javascript:void();">check all</a>&nbsp;
			<a onclick="javascript:checkAll('form1', false);" href="javascript:void();">uncheck all</a>
			<br /><br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="33" <?php if(in_array('33', $reportarr)) echo "checked='checked'"; ?> />General<br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="38" <?php if(in_array('38', $reportarr)) echo "checked='checked'"; ?> />Active Living<br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="30" <?php if(in_array('30', $reportarr)) echo "checked='checked'"; ?> />Healthy Eating<br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="31" <?php if(in_array('31', $reportarr)) echo "checked='checked'"; ?> />Tobacco<br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="32" <?php if(in_array('32', $reportarr)) echo "checked='checked'"; ?> />Supplemental<br />
			<input class="checkbox1" type="checkbox" name="chk_group[]" value="35" <?php if(in_array('35', $reportarr)) echo "checked='checked'"; ?> />Success Stories<br /><br />
		</div>
		<input id="form1_submit" type="submit" value="Submit" />
	</form>
	<br /><br />
<?php
	if ($_POST["county"]) {
	$countyform="";
	$titles="";
?>	
	<form id="form2" name="form2" method="post" action="<?php echo $newurl; ?>">


<?php	
		echo "<div id='printdiv'>";
		echo "<span style='font-size:18pt;font-weight:bold;color:#000080;'>" . $_POST["county"] . " Report</span><hr />";
	
		if(!empty($_POST['chk_group'])) {

			$keysarray = $_POST['chk_group'];
			$keycount = 0;
			$noentries;
			foreach ($keysarray as $k) {
			
				$startform = GFFormsModel::get_form_meta( $k ); 
				//var_dump($startform['title']);
				if (strpos($startform['title'],'-') !== false) {
					$titlearr = explode("-",$startform['title']);
					
					$titles = $titles . trim($titlearr[2]) . "|";
				}
				foreach( $startform['fields'] as $startfield ) {
					if ($startfield['label'] == 'cc_ohio_county') {
						$countykey = $startfield['id'];
						
					}				
				}
			
				$search_criteria = array();
				$search_criteria["field_filters"][] = array( 'key' => $countykey, 'value' => $_POST["county"] );
				$entries = GFAPI::get_entries( $k, $search_criteria );
				//print_r($search_criteria);
				//var_dump($entries);
				
				if (empty($entries)) {
					//echo "NO ENTRIES";
					$noentries = $noentries . $keycount . "|";
				}
				$keycount = $keycount + 1;
				
				$entry = $entries[0];
				foreach ($entry as $entrykey => $entryval) {
					$entryid = 0;
					if ($entrykey == 'id') {
						$entryid = $entryval;
					}
					if ($entryid > 0) {				
						$lead = RGFormsModel::get_lead( $entryid ); 
						$form = GFFormsModel::get_form_meta( $lead['form_id'] ); 
						echo "<span style='font-size:14pt;font-weight:bold;'>" . $form['title'] . "</span><br /><br />";
						$countyform = $countyform . $form['title'] . "|";
						//var_dump($form);
						
							foreach( $form['fields'] as $field ) {
								if ($field['label'] != 'cc_ohio_county' && $field['label'] != 'cc_ohio_update_entry_id' && $field['label'] != 'cc_ohio_year') {
							
									if ($field['type'] == 'section') {
										echo "<br /><strong>" . $field['label'] . "</strong><br />";
										$countyform = $countyform . "SECTION_" . $field['label'] . "|";
									} elseif ( $field['type'] == 'html') {
										$newhtml = str_replace('<br />', ' ', $field['content']);
										$newhtml = str_replace('font-size:16pt;', 'font-size:12pt;', $newhtml);
										echo "<br /><span>" . $newhtml . "</span><br />";										
										$countyform = $countyform . "HTML_" . $newhtml . "|";
									} elseif ($field['type'] == 'textarea') { 
										$lastchr = substr($field['label'], -1);
										$fieldlbl = "";
										if ($lastchr == ":") {
											$fieldlbl = $field['label'];
										} else {
											$fieldlbl = $field['label'] . ":";
										}										
										echo "<span style='margin-left: 20px;'>" . $fieldlbl . $lead[ $field['id'] ] . "</span><br />";										
										$countyform = $countyform . "TEXTAREA_" . $fieldlbl . $lead[ $field['id'] ] . "|";										
									} elseif ($field['type'] == 'text') {
										$lastchr = substr($field['label'], -1);
										$fieldlbl = "";
										if ($lastchr == ":") {
											$fieldlbl = $field['label'];
										} else {
											$fieldlbl = $field['label'] . ":";
										}										
										echo "<span style='margin-left: 20px;'>" . $fieldlbl . $lead[ $field['id'] ] . "</span><br />";										
										$countyform = $countyform . "TEXT_" . $fieldlbl . $lead[ $field['id'] ] . "|";										
									} else {
										$lastchr = substr($field['label'], -1);
										$fieldlbl = "";
										if ($lastchr == ":") {
											$fieldlbl = $field['label'];
										} else {
											$fieldlbl = $field['label'] . ":";
										}
										//echo $field['type'] . "<br />";
										
										$reslt = $lead[ $field['id'] ];
										if (empty($reslt)) {
											$reslt = 0;
										}
										
										echo "<span style='margin-left: 20px;'>" . $fieldlbl . $reslt . "</span><br />";										
										$countyform = $countyform . $fieldlbl . $reslt . "|";
									}
								}
							}						
						
					}
					
				}
				
				
				$countyform = str_replace("'","",$countyform);
				echo "<br /><br />";
			}
			
			//var_dump($titles);
			if (!empty($noentries)) {
				//var_dump($titles);
				$noentries = substr_replace($noentries ,"", -1);
				
				if (strpos($noentries,'|') !== false) {
					$noearr = explode("|", $noentries);
					foreach ($noearr as $noe) {
						$titlecount = 0;
						//var_dump($titles);
						$titlearr = explode("|", $titles);
						foreach ($titlearr as $ti) {						
							if ($titlecount == floatval($noentries)) {
								$titles = str_replace($ti . "|", "", $titles);
							}
							$titlecount = $titlecount + 1;
						}						
						
					}					
				} else {
					$titlecount = 0;
					//var_dump($titles);
					$titlearr = explode("|", $titles);
					foreach ($titlearr as $ti) {						
						if ($titlecount == floatval($noentries)) {
							$titles = str_replace($ti . "|", "", $titles);
						}
						$titlecount = $titlecount + 1;
					}
					//unset($titles[floatval($noentries)]);
				}
				
			}
			
			//var_dump($titles);
			//var_dump($countyform);
			//echo "<div style='display:none;'>County Form<input type='hidden' name='countyform' value='" . $countyform . "/></div>";
		}

?>
			<div style='display:none;'>
				<input type='hidden' name='countyform' value='<?php echo $countyform ?>' />
				<input type='hidden' name='formlist' value='<?php echo rtrim($titles,"|") ?>' />
				<input type='hidden' name='county' value='<?php echo $_POST["county"] ?>' />
			</div>
			</div>
			
			<input type="button" onclick="printContent('printdiv')" value="Print Report" />&nbsp;&nbsp;&nbsp;<input id="form2_submit" type="submit" value="Export to Excel" />
			</form>
<?php		
	} 


}