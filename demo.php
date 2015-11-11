
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=1"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/> 

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
//<![CDATA[
window.__CF=window.__CF||{};window.__CF.AJS={"ga_key":{"ua":"UA-714221-40","ga_bs":"2"}};
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) { var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/acv=4125811108/"},atok:"c7569f628d904db7995deb4a20122c05",petok:"c12251537e5e75dcd0d13261d6af8856-1385201363-1800",zone:"mixitup.io",rocket:"0",apps:{"ga_key":{"ua":"UA-714221-40","ga_bs":"2"}}}];CloudFlare.push({"apps":{"ape":"a6f946d3339d3c78ef413612385f45b5"}});var a=document.createElement("script"),b=document.getElementsByTagName("script")[0];a.async=!0;a.src="//ajax.cloudflare.com/cdn-cgi/nexp/acv=616370821/cloudflare.min.js";b.parentNode.insertBefore(a,b);}}catch(e){};
//]]>
</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,700' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="template.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="im/favicon.ico"/>
		
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
		
		<!--

		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM    
		MMMMMMMM   MMMMMMMM   MMMMMMMM     

		MIXITUP BOILERPLATE TEMPLATE
		
		Concept and development by Patrick Kunka
		
		MixItUp is free for non-commercial and commercial use.
		Copyright 2013 Barrel LLC.
		
		http://mixitup.io
		http://www.barrelny.com
		
		TEMPLATE FEATURES
		
		* Filter by category
		* Sort numerically
		
		This template is intended as a simple, barebones starting place for 
		any MixItUp project, without advanced features or fancy responsive styling.
		
		We hope you find this template useful and educational,
		Enjoy!
		
		The MixItUp Team
		
		
		-->
		
		<script type="text/javascript">
		
			/* 
			*	We would normally recommend that all JavaScript is kept in a seperate .js file,
			* 	but we have included it in the document head for convenience.
			*/
			
			// INSTANTIATE MIXITUP
		
			$(function(){
				$('#Grid').mixitup();
			});
			
		</script>
		
		<title>MixItUp Boilerplate Template</title>
	<script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-714221-40']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>
</head>
	<body>
		<div class="wrapper">
			
			<h1><strong>MixItUp</strong> Boilerplate Template</h1>
			
			<p>This template is intended as a simple, barebones starting place for 
			any MixItUp project, without advanced features or fancy responsive styling.</p>
			
			<!-- FILTER CONTROLS -->
			
			<div class="controls">	
				<h3>Filter Controls</h3>
				<ul>
					<li class="filter" data-filter="all">Show All</li>
					<li class="filter" data-filter="category_1">Category 1</li>
					<li class="filter" data-filter="category_2">Category 2</li>
					<li class="filter" data-filter="category_3">Category 3</li>
					<li class="filter" data-filter="category_3 category_1">Category 1 &amp; 3</li>
				</ul>
			</div>
			
			<!-- SORT CONTROLS -->
				
			<div class="controls">
				<h3>Sort Controls</h3>
				<ul>
					<li class="sort" data-sort="data-cat" data-order="desc">Descending</li>
					<li class="sort" data-sort="data-cat" data-order="asc">Ascending</li>
					<li class="sort active" data-sort="default" data-order="desc">Default</li>
				</ul>
			</div>
			
			<hr/>
			
			<!-- GRID -->
			
			<ul id="Grid">
				<li class="mix category_1" data-cat="1">1</li>
				<li class="mix category_3" data-cat="3">3</li>
				<li class="mix category_2" data-cat="2">2</li>
				<li class="mix category_3" data-cat="3">3</li>
				<li class="mix category_2" data-cat="2">2</li>
				<li class="mix category_1" data-cat="1">1</li>
				<li class="gap"></li> <!-- "gap" elements fill in the gaps in justified grid -->
			</ul>
			
		</div>
		
		<script>/* CloudFlare analytics upgrade */
</script>
		
	</body>
</html>