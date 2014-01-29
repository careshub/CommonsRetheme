<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<pre>
			<?php
			$new_users = array( 'abhattal@co.sutter.ca.us', 'acarpenter@co.shasta.ca.us', 'alison@samuelsandassociates.com', 'aneuwelt@phi.org', 'ajoseph@co.shasta.ca.us', 'aelee@solanocounty.com', 'apendergast@co.shasta.ca.us', 'bbautista@co.humboldt.ca.us', 'bloftus@co.siskiyou.ca.us', 'cmaggio@co.tuolumne.ca.us', 'taaningc@co.mendocino.ca.us', 'cfry@changelabsolutions.org', 'cheadle.a@ghc.org', 'ctucker@co.calaveras.ca.us', 'churt@ceronline.com', 'ctracy@co.calaveras.ca.us', 'christina.ruano@phi.org', 'cvalencia@co.merced.ca.us', 'cyndi.walter@cdph.ca.gov', 'dminock@co.siskiyou.ca.us', 'dkolpacoff@co.siskiyou.ca.us', 'david.reynoso@phi.org', 'ddkirnig@solanocounty.com', 'marlene.gomez@lung.org', 'dean@kelaita.com', 'dkleske@yahoo.com', 'dloijos@health.co.santa-cruz.ca.us', 'schuler.donna@gmail.com', 'danieltorrez@co.imperial.ca.us', 'dunndl@co.monterey.ca.us', 'ezahnd@phi.org', 'emaldonado@tularehhsa.org', 'esmeraldab@tcoe.org', 'fflores-workman@solanocounty.com', 'hlaurison@changelabsolutions.org', 'hellandl@co.mendocino.ca.us', 'hgraff@co.humboldt.ca.us', 'hseligman@medsfgh.ucsf.edu', 'hsilva@co.merced.ca.us', 'negusieh@co.mendocino.ca.us', 'maki.i@ghc.org', 'jane.alvarado@cdph.ca.gov', 'janetteangulo@co.imperial.ca.us', 'jose.arrezola@co.madera.ca.gov', 'jjones@co.shasta.ca.us', 'stullj@co.mendocino.ca.us', 'julissa.gomez@lung.org', 'justine.hearn@cdph.ca.gov', 'Jennifer.Henn@countyofnapa.org', 'jlevy@co.humboldt.ca.us', 'jmazzetti@co.calaveras.ca.us', 'jrsalas@tularehhsa.org', 'jtomlinson@phi.org', 'jacqueline.tompkins@cdph.ca.gov', 'khaught@tularehhsa.org', 'katie.miller@phi.org', 'kawbrey@tularehhsa.org', 'kate.cheyne@phi.org', 'keely@cyanonline.org', 'kimberley.elliott@cdph.ca.gov', 'kfalk-carlsen@co.humboldt.ca.us', 'katherine.hawksworth@cdph.ca.gov', 'kim@cyanonline.org', 'kkarle@co.slo.ca.us', 'karen.smith@countyofnapa.org', 'krose@co.merced.ca.us', 'kschuette@co.shasta.ca.us', 'Lauraapodaca@co.imperial.ca.us', 'lily.chaput@cdph.ca.gov', 'lisa.cirill@cdph.ca.gov', 'lianne.dillon@cdph.ca.gov', 'ldowell@co.calaveras.ca.us', 'brownl@tcha.net', 'lbeckstrom@co.shasta.ca.us', 'Lrios@co.shasta.ca.us', 'lorrene_ritchie@sbcglobal.net', 'mmeza@co.shasta.ca.us', 'maran.perez@cdph.ca.gov', 'mbauman@co.humboldt.ca.us', 'mariapeinado@co.imperial.ca.us', 'mashe@changelabsolutions.org', 'mmsexton@solanocounty.com', 'mljohnson@co.shasta.ca.us', 'maria@samuelsandassociates.com', 'michelle.house@cdph.ca.gov', 'MPickney@co.merced.ca.us', 'mstandish@phi.org', 'mtuekpe@co.sutter.ca.us', 'myriam.alvarez', 'nrowland@tcoe.org', 'natalie.stein@madera-county.com', 'snathan@co.merced.ca.us', 'pmcknight@co.humboldt.ca.us', 'ppullen@tularehhsa.org', 'pattym@tcoe.org', 'pamela.ford@cdph.ca.gov', 'raulmmartinez@co.imperial.ca.us', 'robert.berger@phi.org', 'rccox@solanocounty.com', 'rdeveraux@co.siskiyou.ca.us', 'rstrochlic@berkeley.edu', 'ruben.diaz@phi.org', 'schenckc@co.mendocino.ca.us', 'sgandy@tularehhsa.org', 'sanseth@sierracounty.ws', 'svietti@co.shasta.ca.us', 'sminnick@tularehhsa.org', 'sole@samuelscenter.com', 'soniacontreras@co.imperial.ca.us', 'saguilar@madera-county.com', 'srauzon@berkeley.edu', 'ssandoval@co.merced.ca.us', 'sh@publichealthadvocacy.org', 'smtaylor@co.shasta.ca.us', 'ststolp@co.tuolumne.ca.us', 'kentsr@co.monterey.ca.us', 'millersu@co.mendocino.ca.us', 'susan.watson@phi.org', 'ltenney@co.shasta.ca.us', 'tex.ritter@co.nevada.ca.us', 'tfunk@co.siskiyou.ca.us', 'vanessa.marvin@lung.org', 'van.doreynoso@madera-county.com', 'vrutikanga@co.tuolumne.ca.us' );

			foreach ($new_users as $email) {
					$check = get_user_by( 'email', $email );

					if ( $check ) {
						echo "User $email exists";
					} else {
						echo "User $email does not exist";
					}
			}


			?>
			</pre>
		</div>
	</div>

<?php get_footer(); ?>