<?php
require_once("configs.php");
$page_cat = "home";
?>

<head>
	<title><?php echo $website['title']; ?></title>
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
	<link rel="shortcut icon" href="wow/static/local-common/images/favicons/wow.ico" type="image/x-icon"/>
	<link rel="search" type="application/opensearchdescription+xml" href="http://eu.battle.net/en-gb/data/opensearch" title="Battle.net Search" />
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common.css?v15" />
	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie.css?v15" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie6.css?v15" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie7.css?v15" /><![endif]-->
	<link title="World of Warcraft - News" href="wow/en/feed/news" type="application/atom+xml" rel="alternate"/>
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow.css?v4" />
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/cms/homepage.css?v15" />
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/cms/blog.css?v15" />
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/cms/cms-common.css?v15" />
	<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/cms.css?v4" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/cms-ie6.css?v4" /><![endif]-->
	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie.css?v4" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie6.css?v4" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie7.css?v4" /><![endif]-->
	<script type="text/javascript" src="wow/static/local-common/js/third-party/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="wow/static/local-common/js/core.js?v15"></script>
	<script type="text/javascript" src="wow/static/local-common/js/tooltip.js?v15"></script>
	<!--[if IE 6]> <script type="text/javascript">
	//<![CDATA[
	try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
	//]]>
	</script>
	<![endif]-->
</head>

<body class="en-us homepage" onunload="opener.location=('index.php')">

<div id="wrapper">
	<?php include("header.php"); ?>
	<div id="content">
		<div class="content-top">
			<div class="content-bot">	
				<div id="homepage">
					<div id="left">
						<script type="text/javascript" src="wow/static/local-common/js/slideshow.js"></script>
						<script type="text/javascript" src="wow/static/local-common/js/third-party/swfobject.js"></script>
						<div id="slideshow">
							<?php
							$slideshows = mysql_query("SELECT * FROM slideshows ORDER BY id DESC LIMIT 5");
							$i=0; 
							echo '<div class="container">';
							while($slideshow=mysql_fetch_array($slideshows)){
							if($i == 0){echo'<div class="slide" id="slide-'.$i.'" style="background-image: url(\'images/slideshows/'.$slideshow['image'].'\');"></div>';}
							if($i != 0){
							echo'<div class="slide" id="slide-'.$i.'" style="background-image: url(\'images/slideshows/'.$slideshow['image'].'\'); display:none;"></div>';}
							$i++;
							}
							echo '</div>';
							?>

							<div class="paging">
									<a href="javascript:;" id="paging-0" onclick="Slideshow.jump(0, this);" onmouseover="Slideshow.preview(0);" class="current"></a>
									<a href="javascript:;" id="paging-1" onclick="Slideshow.jump(1, this);" onmouseover="Slideshow.preview(1);"></a>
									<a href="javascript:;" id="paging-2" onclick="Slideshow.jump(2, this);" onmouseover="Slideshow.preview(2);"></a>
									<a href="javascript:;" id="paging-3" onclick="Slideshow.jump(3, this);" onmouseover="Slideshow.preview(3);"></a>
									<a href="javascript:;" id="paging-4" onclick="Slideshow.jump(4, this);" onmouseover="Slideshow.preview(4);" class=" last-slide"></a>
							</div>
			
							<?php
							$slideshows = mysql_query("SELECT * FROM slideshows ORDER BY id DESC LIMIT 1");
							$slideshow = mysql_fetch_assoc($slideshows);
							echo'<div class="caption">
							<h3><a href="#" class="link">'.$slideshow['title'].'</a></h3>
							'.$slideshow['description'].'
							</div>';
							?>
							
							<div class="preview"></div>
							<div class="mask"></div>
						</div>
						
						<?php $slideshows = mysql_query("SELECT * FROM slideshows ORDER BY id DESC LIMIT 5"); ?>
						<script type="text/javascript">
						//<![CDATA[
							$(function() {
								Slideshow.initialize('#slideshow', [
									<?php
									$i=0; 
									while($slideshow=mysql_fetch_array($slideshows)){
									echo '
									{
										image: "images/slideshows/'.$slideshow['image'].'",
										desc: "'.$slideshow['description'].'",
										title: "'.$slideshow['title'].'",
										url: "'.$slideshow['link'].'",
										id: "'.$slideshow['id'].'"
									}';
									if($i!=4){echo',';}
									$i++;
									}
									?>
								]);

							});
						//]]>
						</script>
						
						
						<div class="featured-news">
							<?php
							$articles_query = mysql_query("SELECT * FROM news ORDER BY DATE desc LIMIT 4")or print("No Articles");
							while($articles = mysql_fetch_array($articles_query)){
							?>
							<div class="featured">
								<a href="news.php?id=<?php echo $articles['id']; ?>">
									<span class="featured-img" style="background-image: url('news/<?php echo $articles['image']; ?>.jpg');"></span>
									<span class="featured-desc"> <?php echo $articles['title']; ?> </span>
								</a>
							</div>
							<?php
							}
							?>
							<span class="clear"></span>
						</div>
  
						<div id="news-updates">
							<?php
							
							if(isset($_GET['new'])){
								$new = intval($_GET['new']);
							}else{
								$new = 0;
							}
							
							$news_first = $new ? $new : 9999999999;
							$news_query = ("SELECT * FROM news WHERE id <= '".$news_first."' ORDER BY `id` desc LIMIT 6");
							$news_query = mysql_query($news_query);
							$counter = 1;
							
							while($counter<=5 && $news=mysql_fetch_array($news_query)){
								if($counter == 1){
									echo '<div class="news-article first-child">';
								}else{
									echo '<div class="news-article">';
								}
							
								echo'
								<h3><a href="news.php?id='.$news['id'].'">'.$news['title'].'</a></h3>
								<div class="by-line">
								by <a href="'.$news['authorlnk'].'">'.$news['author'].'</a><span class="spacer"> // </span> '.$news['date'].'
								<a href="news.php?id='.$news['id'].'#comments" class="comments-link">'.$news['comments'].'</a>
								</div>
								
								<div class="article-left" style="background-image: url(\'news/'.$news['image'].'.jpg\');">
								<a href="news.php?id='.$news['id'].'"><img src="wow/static/images/homepage/thumb-frame.gif" alt="" /></a>
								</div>

								<div class="article-right">
									<div class="article-summary">
									<p>'.substr($news['content'],0,120)."...".'</p>
									<a href="news.php?id='.$news['id'].'" class="more">More</a>
									</div>
								</div>
								
								<span class="clear"><!-- --></span>
								</div>
								';
								
								$counter++;
							}
							
							if($news=mysql_fetch_array($news_query)){ ?>
								<!--Next Page Button-->
								<div class="blog-paging">
								<a class="ui-button button1 button1-next float-right " href="<?php echo'?new='.$news['id'];?>">
								<span><span>Next</span></span></a>
								<span class="clear"><!-- --></span>
								</div>
							<?php }?>
						</div>
					</div>
				
					<!-- Right Panel -->
					<div id="right" class="ajax-update">

						<!-- X -->
						<div class="sidebar-module" id="sidebar-bnet-ads">
							<div class="sidebar-title"><h3 class="title-bnet-ads">Recommended Services</h3></div>
							
							<div class="sidebar-content">
							<div class="bnet-offer">
							<!-- Pet Store -->
							<div class="bnet-offer-bg"><a href="#"><img src="more/QIO9KZQLARHK1291445943163.gif" width="300" height="100" alt="" /></a></div>
							<div class="desc"><a href="#">Free Pets</a>
							<div class="subtitle">The Moonkin Hatchling and Lil' Ragnaros need a home!</div>
							</div>
							</div>
							</div>
						</div>

						<div class="sidebar-module" id="sidebar-sotd">
							<div>
								<div class="sidebar-title">
									<h3 class="title-sotd">
										<a href="#">Screenshot of the Day</a>
									</h3>
								</div>

								<div class="sidebar-content">
									<div class="sotd" style="background-image: url('http://eu.media.blizzard.com/wow/media/screenshots/screenshot-of-the-day/cataclysm/cataclysm-ss1542-large.jpg');">
									<a href="#" class="image"> </a>
										<div class="caption">
											<a href="#" class="view">All screenshots</a>
											<a href="#" class="submit">Submit screenshot</a>
										<span class="clear"><!-- --></span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="sidebar-module" id="sidebar-forums">
							<div class="sidebar-title">
								<h3 class="title-forums">Popular Topics</h3>
							</div><br />
							<div align="center">
							Loading Forum Settings...
							<div class="sidebar-content loading"></div>
							</div>
						</div>
 
					</div>
					<span class="clear"><!-- --></span>
				</div>
			</div>
		</div>
	</div>
	<?php include("footer.php"); ?>
</div>
</body>
</html>
