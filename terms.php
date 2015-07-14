<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl='content';
$sql_gallary = "select * from  $tabl where id='2'";
$exec_gallery = mysql_query($sql_gallary);
$fetch_gal = mysql_fetch_assoc($exec_gallery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">

<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
		-webkit-filter:blur(3px);
		-moz-filter:blur(3px);
		-o-filter:blur(3px);
		-ms-filter:blur(3px);
		filter: url(blur.svg#blur);
	}
	.usr-img{
		padding-left: 50px;
		padding-top:5px;
	}
	.user-comments .comment-data{
		min-height: 80px;
		background:#fff;
		padding:10px;
		box-shadow: 0 0 1px 1px #8d9cde;
	}	
	.user-comments{
		margin-top: 10px;
	}
	#blog-ref a{
		color:#356e6f;
	}

</style>

<script type="text/javascript">
	$(document).ready(function(){

		$(function(){
			$('#header').data('size','big');
		});
		$('.feedback').data('hidden','false');
		$('#icon a').on('click',function(e){
			e.preventDefault();
			if($('.feedback').data('hidden')=='false'){
				$('.feedback').animate({right:'0%'},1000);
				$('.feedback').data('hidden','true');
				$('body').append($('<div class="blur"></div>'));
			}
			else{
				$('.feedback').animate({right:'-32.7%'},1000);
				$('.feedback').data('hidden','false');
				$('.blur').remove();
			}
		});
		$('#feed-close').on('click',function(e){
			e.preventDefault();
			if($('.feedback').data('hidden')=='true'){
				$('.feedback').animate({right:'-32.7%'},1000);
				$('.feedback').data('hidden','false');
				$('.blur').remove();
			}
		});
		$(window).scroll(function(e){
			var headerHeight = $('#header').height();

			if($(this).scrollTop() > headerHeight){
				if($('#header').data('size') == 'big'){
					$('#header').hide();
					$('#fake-header').slideDown('2000');
					$('#header').data('size','small');
				}
			}
			else{
				if($('#header').data('size') == 'small'){
					$('#fake-header').hide();
					$('#header').slideDown('2000');
					$('#header').data('size','big');
				}
			}
		});
	});
</script>

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "include/header.php";?>
<!-- ---------------------MAIN ------------------------------- -->
<div id="main" class="row container" style="padding:10px;height:auto; overflow:hidden">
	<div class="col-sm-2 col-sm-push-1" id="blog-ref" style="color:#fff;height:auto;padding:10px;">
		
		
		
	</div>
	<div class="col-sm-10 col-sm-pull-1" style="background:#fff;height:auto;">
		<h2 style="color:#de5842;"> Terms &amp; Conditions </h2> 
		<p> <br>
		This document is published in accordance with the provisions of Rule 3 (1) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of www.Makeuber.com website.
		<br> <br>
		The domain name <a href="Index.php" style="color:blue;"> www.makeuber.com </a> (hereinafter referred to as "Website") is owned by Modadome Online Private Limited a company incorporated under the Companies Act, 1956 with its registered office at A-112,Manar Manha ,Somesunderplaya Main Road ,Kudlu Gate, Bangalore - 560 068, Karnataka, India (hereinafter referred to as "Makeuber").
		<br><br>
		You shall be subject to the policies that are applicable to the Website for such transaction. By mere use of the Website or while you transact, You shall be contracting with Makeuber - owned by Modadome Online Private Limited and these terms and conditions .
		<br><br>
		For the purpose of these Terms of Use, wherever the context so requires "You" or "User" shall mean any natural or legal person who has agreed to become a buyer or seller of either services or products on the Website by providing Registration Data while registering on the Website as Registered User using the computer systems or by filling physical documents and lodging with MakeUber . 
		Makeuber allows the User to surf the Website or making purchases without registering on the Website or notifying Us. The term "We", "Us", "Our" shall mean MakeUber- Modadome Online Private Limited.
		<br><br>
		When You use any of the services provided by Us through the Website, including but not limited to, (e.g. Product Reviews, Seller Reviews , Bidding process, product purchase , service purchase), You will be subject to the rules, guidelines, policies, terms, and conditions applicable to such service, and they shall be deemed to be incorporated into this Terms of Use and shall be considered as part and parcel of this Terms of Use. We reserve the right, at Our sole discretion, to change, modify, add or remove portions of these Terms of Use, at any time without any prior written notice to You. It is Your responsibility to review these Terms of Use periodically for updates / changes. Your continued
		use of the Website following the posting of changes will mean that You accept and agree to the revisions. As long as You comply with these Terms of Use, We grant You a personal, non-exclusive, non-transferable, limited privilege to enter and use the Website.
		<br><br>
		<b> Membership Eligibility </b> 
		<br>
		Persons who are "incompetent to contract" within the meaning of the Indian Contract Act, 1872 including minors, un-discharged insolvents etc. are not eligible to use the Website. If you are a minor i.e. under the age of 18 years, you shall not register as a User of the MakeUber website and shall not transact on or use the website. As a minor if you wish to use or transact on website, such use or transaction may be made by your legal guardian or parents on the Website. Makeuber reserves the right to terminate your membership and / or refuse to provide you with access to the Website if it is brought to Makeuber's notice or if it is discovered that you are under the age of 18 years.
		<br><br>
		<b> Your Account and Registration Obligations </b> 
		<br>
		If You use the Website, You shall be responsible for maintaining the confidentiality of your Display Name and Password and You shall be responsible for all activities that occur under your Display Name and Password. You agree that if You provide any information that is untrue, inaccurate, not current or incomplete or We have reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, or not in accordance with the this Terms of Use, We shall have the right to indefinitely suspend or terminate or block access of your membership on the Website and refuse to provide You with access to the Website.
		<br><br> 
		<b> Communications </b>
		<br>
		When You use the Website or send emails or other data, information or communication to us, 
		You agree and understand that You are communicating with Us through electronic records and 
		You consent to receive communications via electronic records from Us periodically and as and 
		when required. We maycommunicate with you by email or by such other mode of communication, electronic or otherwise.
		<br><br> 
		
		<b> Platform for Transaction and Communication </b> 
		<br> 
		The Website is a platform that Users utilize to meet and interact with one another for their transactions. Makeuber is not and cannot be a party to or control in any manner any transaction between the Website's Users.
		<br><br>
	<i> Henceforward: </i> 
	<br> 
	<ol type="I" > 
	<li> All commercial/contractual terms are offered by and agreed to between Buyers and Sellers alone. The commercial/contractual terms include without limitation price, shipping costs, payment methods, payment terms, date, period and mode of delivery, warranties related to products and services and after sales services related to products and services. Makeuber does not have any control or does not determine or advise or in any way involve itself in the offering or acceptance ofsuch commercial/contractual terms between the Buyers and Sellers. </li>
	<li>Makeuber does not make any representation or Warranty as to specifics (such as quality, value, salability, etc) of the products or services proposed to be sold or offered to be sold or purchased on the Website. Makeuber does not implicitly or explicitly support or endorse the sale or purchase of any products or services on the Website. Makeuber accepts no liability for any errors or omissions, whether on behalf of itself or third parties. </li>
	<li> Makeuber is not responsible for any non-performance or breach of any contract entered into between Buyers and Sellers. Makeuber cannot and does not guarantee that the concerned Buyers and/or Sellers will perform any transaction concluded on the Website. Makeuber shall not and is not required to mediate or resolve any dispute or disagreement between Buyers and Sellers. </li>
	<li>Makeuber does not make any representation or warranty as to the item-specifics (such as legal title, creditworthiness, identity, etc) of any of its Users. You are advised to independently verify the bona fides of any particular User that You choose .</li>
	<li> Makeuber does not at any point of time during any transaction between Buyer and Seller on the Website come into or take possession of any of the products or services offered by Seller nor does it at any point gain title to or have any rights or claims over the products or services offered by Seller to Buyer. You shall independently agree upon the manner and terms and conditions of delivery, payment, insurance etc. with the seller(s) that You transact with.</li>
	<li> At no time shall Makeuber hold any right, title or interest over the products nor shall Makeuber have any obligations or liabilities in respect of such contract entered into between Buyers and Sellers. Makeuber is not responsible for unsatisfactory or delayed performance of services or damages or delays as a result of products which are out of stock, unavailable or back ordered. </li>
	<li> The Website is only a platform that can be utilized by Users to reach a larger base to buy and sell products or services. Makeuber is only providing a platform for communication and it is agreed that the contract for sale of any of the products or services shall be a strictly bipartite contract between the Seller and the Buyer.</li>
		Makeuber is not responsible for unsatisfactory or delayed performance of services or damages or delays as a result of products which are out of stock, unavailable or back ordered.
	<li> You release and indemnify Makeuber and/or any of its executives  and representatives from any cost, damage, liability or other consequence of any of the actions of the Users of the Website and specifically waive any claims that you may have in this behalf under any applicable law. Notwithstanding its reasonable efforts in that behalf, Makeuber cannot take responsibility or control the information provided by other Users which is made available on the Website. You may find other User's information to be offensive, harmful, inconsistent, inaccurate, or deceptive. Please use caution and practice safe trading when using the Website. </li>
	<br><br> 
	<b> Fee/Charges  </b> 
	<br> 
	Membership on the Website is free for buyers. Makeuber does not charge any fee for browsing and buying on the Website. Makeuber reserves the right to change its Fee Policy from time to time. In particular, Makeuber may at its sole discretion introduce new services and modify some or all of the existing services offered on the Website. In such an event Makeuber reserves the right to introduce fees for the new services offered or amend/introduce fees for existing services, as the case may be. Changes to the Fee Policy shall be posted on the Website and such changes shall automatically become effective immediately after they are posted on the Website. Unless otherwise stated, all fees shall be quoted in Indian Rupees. You shall be solely responsible for compliance of all applicable laws including those in India for making payments to Modadome Online Private Limited.
	<br><br> 

	<b> Use of the Website </b> 
	<br> 
	You agree, undertake and confirm that Your use of Website shall be strictly governed by the following binding principles:
	<br> <br> 
	<ol type="I"> 
	<li> You shall not host, display, upload, modify, publish, transmit, update or share any information which:</li> 
	<ol type="a"> 
		<li> belongs to another person and to which You does not have any right to; </li> 
		<li> is grossly harmful, harassing, blasphemous, defamatory, obscene, pornographic, paedophilic, libellous, invasive of another's privacy, hateful, or racially, ethnically objectionable, disparaging, relating or encouraging money laundering or gambling, or otherwise unlawful in any manner whatever; or unlawfully threatening or unlawfully harassing including but not limited to "indecent representation of women" within the meaning of the Indecent Representation of Women (Prohibition) Act, 1986;</li>
		<li> is misleading in any way;</li>
		<li> is patently offensive to the online community, such as sexually explicit content, or content that promotes obscenity, pedophilias, racism, bigotry, hatred or physical harm of any kind against any group or individual;</li>
		<li>  Harasses or advocates harassment of another person;</li>
		<li>  Involves the transmission of "junk mail", "chain letters", or unsolicited mass mailing or "spamming";</li>
		<li>  promotes illegal activities or conduct that is abusive, threatening, obscene, defamatory or libellous;</li>
		<li>  infringes upon or violates any third party's rights [including, but not limited to, intellectual property rights, rights of privacy (including without limitation unauthorized disclosure of a person's name, email address, physical address or phone number) or rights of publicity];</li>
		<li>  promotes an illegal or unauthorized copy of another person's copyrighted work (see "Copyright complaint" below for instructions on how to lodge a complaint about uploaded copyrighted material), such as providing pirated computer programs or links to them, providing information to circumvent manufacture-installed copy-protect devices, or providing pirated music or links to pirated music files;</li>
		<li> Contains restricted or password-only access pages, or hidden pages or images (those not linked to or from another accessible page);</li>
		<li> Provides material that exploits people in a sexual, violent or otherwise inappropriate manner or solicits personal information from anyone;</li>
		<li>  Provides instructional information about illegal activities such as making or buying illegal weapons, violating someone's privacy, or providing or creating computer viruses;</li>
		<li> contains video, photographs, or images of another person (with a minor or an adult).</li>
		<li> tries to gain unauthorized access or exceeds the scope of authorized access to the Website or to profiles, blogs, communities, account information, bulletins,friend request, or other areas of the Website or solicits passwords or personal identifying information for commercial or unlawful purposes from other users;</li>
		<li> Engages in commercial activities and/or sales without Our prior written consent such as contests, sweepstakes, barter, advertising and pyramid schemes, or the buying or selling of "virtual" products related to the Website. Throughout this Terms of Use, Makeuber's prior written consent means a communication coming from Makeuber's Legal Department, specifically in response to Your request, and specifically addressing the activity or conduct for which You seek authorization;</li>
		<li> Solicits gambling or engages in any gambling activity which We, in Our sole discretion, believes is or could be construed as being illegal;</li>
		<li> Interferes with another USER's use and enjoyment of the Website or any other individual's User and enjoyment of similar services;</li>
		<li>  Refers to any website or URL that, in Our sole discretion, contains material that is inappropriate for the Website or any other website, contains content thatwould be prohibited or violates the letter or spirit of these Terms of Use.</li>
		<li> Harm minors in any way;</li>
		<li> Infringes any patent, trademark, copyright or other proprietary rights or third party's trade secrets or rights of publicity or privacy or shall not be fraudulent orinvolve the sale of counterfeit or stolen products;</li>
		<li> violates any law for the time being in force;</li>
		<li>  Deceives or misleads the addressee/ users about the origin of such messages or communicates any information which is grossly offensive or menacing innature;</li>
		<li>  Impersonate another person;</li>
		<li> contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer resource; or contains any trojan horses, worms, time bombs, cancelbots, easter eggs or other computer programming routines that may damage, detrimentally interfere with, diminish value of, surreptitiously intercept or expropriate any system, data or personal information;</li>
		<li> Threatens the unity, integrity, defence, security or sovereignty of India, friendly relations with foreign states, or public order or causes incitement to thecommission of any cognizable offence or prevents investigation of any offence or is insulting any other nation.</li>
		<li> Shall not be false, inaccurate or misleading;</li>
		<li>  shall not, directly or indirectly, offer, attempt to offer, trade or attempt to trade in any item, the dealing of which is prohibited or restricted in any manner under the provisions of any applicable law, rule, regulation or guideline for the time being in force.</li>
		<li>  shall not create liability for Us or cause Us to lose (in whole or in part) the services of Our internet service provider ("ISPs") or other suppliers;</li>
		</ol>
		<li>  You shall not use any "deep-link", "page-scrape", "robot", "spider" or other automatic device, program, algorithm or methodology, or any similar or equivalent manual process, to access, acquire, copy or monitor any portion of the Website or any Content, or in any way reproduce or circumvent the navigational structure or presentation of the Website or any Content, to obtain or attempt to obtain any materials, documents or information through any means not purposely made available through the Website. We reserve Our right to bar any such activity. </li> 
		<li> You shall not attempt to gain unauthorized access to any portion or feature of the Website, or any other systems or networks connected to the Website or tony server, computer, network, or to any of the services offered on or through the Website, by hacking, password "mining" or any other illegitimate means. 
		<li> You shall not probe, scan or test the vulnerability of the Website or any network connected to the Website nor breach the security or authentication measures on the Website or any network connected to the Website. You may not reverse look-up, trace or seek to trace any information on any other User of or visitor to Website, or any other customer, including any account on the Website not owned by You, to its source, or exploit the Website or any service or information made available or offered by or through the Website, in any way where the purpose is to reveal any information, including but not limited to personal identification or information, other than Your own information, as provided for by the Website. </li> 
		<li>You shall not make any negative, denigrating or defamatory statement(s) or comment(s) about Us or the brand name or domain name used by Us Makeuber , Makeuber.com, Modadome Online Pvt. Ltd. or otherwise engage in any conduct or action that might tarnish the image or reputation, of Makeuber or sellers on platform or otherwise tarnish or dilute any Makeuber's trade or service marks, trade name and/or goodwill associated with such trade or service marks, trade name as may be owned or used by us. </li> 
		<li>You agree not to use any device, software or routine to interfere or attempt to interfere with the proper working of the Website or any transaction being conducted on the Website, or with any other person's use of the Website. 
		<li>You may not forge headers or otherwise manipulate identifiers in order to disguise the origin of any message or transmittal You send to Us on or through the Website or any service offered on or through the Website. You may not pretend that You are, or that You represent, someone else, or impersonate any other individual or entity. 
		<li>You shall at all times ensure full compliance with the applicable provisions of the Information Technology Act, 2000 and rules thereunder as applicable and as amended from time to time and also all applicable Domestic laws, rules and regulations (including the provisions of any applicable Exchange Control Laws or Regulations in Force) and International Laws, Foreign Exchange Laws, Statutes, Ordinances and Regulations (including, but not limited to Sales Tax/VAT, Income Tax, Octroi, Service Tax, Central Excise, Custom Duty, Local Levies) regarding Your use of Our service and Your listing, purchase, solicitation of offers to purchase, and sale of products or services. You shall not engage in any transaction in an item or service, which is prohibited by the provisions of any applicable law including exchange control laws or regulations for the time being in force. </li> 
		<li>Solely to enable Us to use the information You supply Us with, so that we are not violating any rights You might have in Your Information, You agree to grant Us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub-licensable (through multiple tiers) right to exercise the copyright, publicity, database rights or any other rights You have in Your Information, in any media now known or not currently known, with respect to Your Information. We will only use Your information in accordance with the Terms of Use and Privacy Policy applicable to use of the Website. </li> 
		<li>From time to time, You shall be responsible for providing information relating to the products or services proposed to be sold by You. In this connection, You undertake that all such information shall be accurate in all respects. You shall not exaggerate or over emphasize the attributes of such products or services so as to mislead other </li> 
		Damages or losses resulting from use of Content and /or appearance of Content on the Website. You hereby represent and warrant that You have all necessary rights in and to all Content which You provide and all information it contains and that such Content shall not infringe any proprietary or other rights of third parties or contain any libellous, tortious, or otherwise unlawful information. 
		<li>Your correspondence or business dealings with, or participation in promotions of, advertisers found on or through the Website, including payment and deliveryof related products or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between You and such advertiser. We shall not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings or as the result of the presence of such advertisers on the Website. </li> 
		<li>It is possible those other users (including unauthorized users or "hackers") may post or transmit offensive or obscene materials on the Website and that You may be involuntarily exposed to such offensive and obscene materials. It also is possible for others to obtain personal information about You due to your use of the Website, and that the recipient may use such information to harass or injure You. We does not approve of such unauthorized uses, but by using the Website You acknowledge and agree that We are not responsible for the use of any personal information that You publicly disclose or share with others on the Website. Please carefully select the type of information that You publicly disclose or share with others on the Website. </li> 
		<li>Makeuber shall have all the rights to take necessary action and claim damages that may occur due to your involvement/participation in any way on your own or through group/s of people, intentionally or unintentionally in DoS/DDoS (Distributed Denial of Services).</li> 
		</ol>
		<br><br>

		<b> Contents Posted on Site </b> 
		<br> 
		All text, graphics, user interfaces, visual interfaces, photographs, trademarks, logos, sounds, music and artwork 
		(collectively, "Content"), is a third party user generated content and Makeuber has no control over such third party
		user generated content as Makeuber is merely an intermediary for the purposes of this Terms of Use.
		<br>
		Except as expressly provided in these Terms of Use, no part of the Website and no Content may be copied, reproduced, 
		republished, uploaded, posted, publicly displayed, encoded, translated, transmitted or distributed in any way 
		(including "mirroring") to any other computer, server, Website or other medium for publication or distribution 
		or for any commercial enterprise, without Makeuber's express prior written consent.
		<br> 
		You may use information on the products and services purposely made available on the Website for downloading, 
		provided that You<br><br>
		<ol> 
		<li> Do not remove any proprietary notice language in all copies of such documents. </li>
		<li> Use such information only for your personal, non-commercial informational purpose and do not copy or post such 
		information on any networked computer or broadcast it in any media </li> 
		<li> Make no modifications to any such information </li> 
		<li> Do not make any additional representations or warranties relating to such documents.</li> 
		<br> 
		You shall be responsible for any notes, messages, emails, billboard postings, photos, drawings, profiles, 
		opinions, ideas, images, videos, audio files or other materials or information posted or transmitted to the Website
		(collectively, "Content"). Such Content will become Our property and You grant Us the worldwide, perpetual and 
		transferable rights in such Content. We shall be entitled to, consistent with Our Privacy Policy as adopted in accordance with applicable law, use the Content or any of its elements for any type of use forever, including but not limited to promotional and advertising purposes and in any media whether now known or hereafter devised, including the creation of derivative works that may include the Content You provide. You agree that any Content You post may be used by us, consistent with Our Privacy Policy and Rules of Conduct on Site as mentioned herein, and You are not entitled to any payment or other compensation for such use.
		<br><br> 
		
		<b> Privacy </b> 
		<br> 
		We view protection of Your privacy as a very important principle. We understand clearly that 
		You and Your Personal Information is one of Our most important assets. We store and process Your 
		Information including any sensitive financial information collected (as defined under the Information Technology Act,
		2000), if any, on computers that may be protected by physical as well as reasonable technological security measures 
		and procedures in accordance with Information Technology Act 2000 and Rules there under. Our current Privacy Policy 
		is available at <a href="privacy.php" style="color:blue;"> Privacy Policy </a> . If You object to Your Information being transferred or used in this way please do not use 
		Website.<br><br> 
 
		We and our affiliates will share / sell / transfer / license / covey some or all of your personal information with another business entity should we (or our assets) plan to merge with or are acquired by that business entity, or re-organization, amalgamation, restructuring of business or for any other reason what so ever. Should such a transaction or situation occur, the other business entity or the new combined entity will be required to follow the privacy policy with respect to your personal information. Once you provide your information to us, you provide such information to us and our affiliate and we and our affiliate may use such information to provide you various services with respect to your transaction whether such transaction are conducted on <a href="Index.php" style="color:blue;"> www.Makeuber.com </a>or with third party merchant’s or third party merchant's website.

	
		
		
		</p> 
		
	</div>
    
</div>


<!-- -----------------COMMENT----------------------- -->



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<!----------------------------FOOTER------------------- -->
<?php include "include/footer.php";?>

</body>
</html>