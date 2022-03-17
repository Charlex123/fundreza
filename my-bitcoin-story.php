<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['Fname'];


// if(!isset($_SESSION['user'])) {
//     header('Location:');
//     exit();
// }else {
    $user_data = @$_SESSION['user'];
    $userid = @$user_data['id'];
    $name = @$user_data['uname'];
    $lname = @$user_data['Lname'];
    $clientCountry = @$user_data['userCountry'];
    $countryFlag = @$user_data['countryFlag'];
    $email_of_user = @$user_data['email'];
    $refid = @$user_data['invite_id'];

    ob_end_flush();
// }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="all,follow">
	<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Chilanka' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Libre Baskerville' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Kulim Park' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=cabin' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Antic' rel='stylesheet'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Caveat' rel='stylesheet'>
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="css/fontastic.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<title> Bitcoin News Today | My Bitcoin Story </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
	<script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.js"></script>
    <script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
    <!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" integrity="sha512-W3ZfgmZ5g1rCPFiCbOb+tn7g7sQWOQCB1AkDqrBG1Yp3iDjY9KYFh/k1AWxrt85LX5BRazEAuv+5DV2YZwghag==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ==" crossorigin="anonymous" />	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

	<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- inject:css -->
<!-- <link rel="stylesheet" href="css/customs.css?n=1"> -->
	<link rel="stylesheet" href="css/style.css?n=1">
	<link rel="stylesheet" href="css/page.css?n=1">
	<link rel="stylesheet" href="css/customize.css?n=1">
	<link rel="stylesheet" href="css/ncustomize.css?n=1">
	<link rel="stylesheet" href="css/comments.css?n=1">

    <!-- endinject -->
    <link rel="shortcut icon" href="images/btclogo.png" />
	<style>
		body {
		background-color: #ffffff !important;font-family: 'PT Sans';
		width: 100%;margin: 0;padding: 0;color: gray;
		}
		.main-panel {
		background-color: #ffffff !important;color: gray;
		}
		.exit-intro {
			display: none;
		}
        .content-wrapper h1 {
            text-align: center;margin: 2rem auto;
        }
        .content-wrapper p {
            padding: 1rem 5rem;font-size: 18px;line-height: 22px;
        }
		.content-wrapper .cnt {
            padding: 1rem 5rem;font-size: 18px;line-height: 22px;
        }
        .picout {
            margin: 1rem auto;text-align: center;padding: 1rem;
        }
        .content-wrapper .btc-dr {
            padding: 0 5rem 0 5rem;margin: .4rem auto;text-align: center;
        }
        .content-wrapper p.btc-dr ul li {
            list-style: none;margin: .4rem auto;text-align: center;
        }
        .content-wrapper p.btc-border h1{
            color: #222222;
        }
        .content-wrapper .btc-border {
            padding: 1rem 1rem;border: 3px solid #555555;width: 90%;margin: auto;font-weight: bold;
        }
		.table {
			background: transparent;border-radius: 8px;margin: 2rem auto;overflow-x: scroll;
		}
		.table th{
			color: #292929 !important;height: 3rem;font-weight: bold;
			background: rgb(255, 230, 0) !important;border: 1px solid #020418;
		}
		.table td {
			font-size: 16px;font-family: 'Josefin Sans';
			color: rgba(6, 6, 44, 0.986);padding: .5rem;height: 3rem;
			background: orange;border: 1px solid #020418;white-space: nowrap;
		}
		.table .gold {
			background-color: gold;
		}
		.table .vip {
			background-color: greenyellow;
		}
		.table td a {
			text-decoration: none;background-color: #020418;padding: .5rem;
			color: rgb(255, 230, 0);border-radius: 4px;white-space: nowrap;
		}
		.swiper-container {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
      }

      .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 300px;
        height: 300px;
      }

      .swiper-slide img {
        display: block;
        width: 100%;height: 25rem;
		max-height: 25rem;
      }

		@media screen and (max-width: 991px) {
			.content-wrapper h1 {
            text-align: center;margin: 2rem auto;
			}
			.content-wrapper p {
				padding: 1rem 3rem;font-size: 16px;line-height: 22px;
			}
			.content-wrapper .cnt {
				padding: 1rem 3rem;font-size: 16px;line-height: 22px;
			}
			.picout {
				margin: 2rem auto;text-align: center;padding: 1rem;
			}
			.content-wrapper .btc-dr {
				padding: 0 3rem 0 3rem;margin: 1rem auto;text-align: center;
			}
			.content-wrapper p.btc-dr ul li {
				list-style: none;margin: 1rem auto;text-align: center;
			}
			.content-wrapper p.btc-border h1{
				color: #222222;
			}
			.content-wrapper .btc-border {
				padding: 1rem 1rem;border: 3px solid #555555;width: 96%;margin: auto;font-weight: bold;
			}
			.table td a {
				font-size: 14px;
			}
		}

		@media screen and (max-width: 567px) {
			.content-wrapper h1 {
            text-align: center;margin: 2rem auto;
			}
			.content-wrapper p {
				padding: 1rem 2rem;font-size: 16px;line-height: 22px;
			}
			.content-wrapper .cnt {
				padding: 1rem 2rem;font-size: 16px;line-height: 22px;
			}
			.picout {
				margin: 2rem auto;text-align: center;padding: 1rem;
			}
			.content-wrapper .btc-dr {
				padding: 0 2rem 0 2rem;margin: 1rem auto;text-align: center;
			}
			.content-wrapper p.btc-dr ul li {
				list-style: none;margin: 1rem auto;text-align: center;
			}
			.content-wrapper p.btc-border h1{
				color: #222222;
			}
			.content-wrapper .btc-border {
				padding: 1rem 1rem;border: 3px solid #555555;width: 98%;margin: auto;font-weight: bold;
			}
		}

		@media screen and (max-width: 420px) {
			.content-wrapper h1 {
            text-align: center;margin: 2rem auto;
			}
			.content-wrapper p {
				padding: 1rem 1rem;font-size: 16px;line-height: 22px;
			}
			.content-wrapper .cnt {
				padding: 1rem 1rem;font-size: 16px;line-height: 22px;
			}
			.picout {
				margin: 1rem auto;text-align: center;padding: 1rem;
			}
			.content-wrapper .btc-dr {
				padding: 0 1rem 0 1rem;margin: .4rem auto;text-align: center;
			}
			.content-wrapper p.btc-dr ul li {
				list-style: none;margin: .4rem auto;text-align: center;
			}
			.content-wrapper p.btc-border h1{
				color: #222222;
			}
			.content-wrapper .btc-border {
				padding: 1rem 1rem;border: 3px solid #555555;width: 98%;margin: auto;font-weight: bold;
			}
		}
    </style>
  </head>
  <body class="bg-white">
  
	<div id="main bg-white">
		<div class="container-scroller bg-white">
			<!-- partial:partials/_horizontal-navbar.html -->
			
			<div class="horizontal-menu">
				<nav class="navbar top-navbar">
					<div class="container-fluid">
						<div class="navbar-menu-wrapper ">
							
							<a class="navbar-brand brand-logo" href="#"><img src="images/bitcoin-btc-logo.png" alt="logo" class='log'/></a>
							
							<ul class="navbar-nav navbar-nav-left">
								
								<li class="nav-item btc-links">
									<a class="nav-link " href="how-btc-works"> How Bitcoin Works </a>
								</li>
								<li class="nav-item btc-links">
									<a class="nav-link" href="my-bitcoin-story.php?postId=3214553785"> My Bitcoin Story </a>
								</li>
				
							</ul>
							
							<ul class="navbar-nav nav-right">
								
								<li class="buy-crypto">
									<a class="nav-link " href="createaccount"><button class="reg-button"> Sign UP </button></a>
								</li>

								<li class="sell-crypto">
									<a class="nav-link " href="login"><button class="reg-button"> Login </button></a>
								</li>
								
							</ul>
							
						</div>
						
					</div>
					
					
				</nav>

				<!-- middle nav -->

				<div class="middle-nav">
					<div class="right-nav-center justify-content-center">NEWS  <div class='date'><b><small><strong><?php
           	 echo $comment_time = date('M j, Y | H:i:s',time());?></strong></small></b></div></div> 
				</div>
				
				<div class="end-float"></div>

				<div class="bottom-navb bg-none">
					<div class="bottom-nav-center bg-none">
						<ul class="bg-none">
								
							<li class="nav-item btc-links">
								<a class="nav-link" href="home" > <button class="reg-button"> Bitcoin News </button></a> 
							</li>
							
							<li class="nav-item buy-crypto">
								<a class="nav-link " href="createaccount"><button class="reg-button"> Sign UP </button></a>
							</li>

							<li class="nav-item sell-crypto">
								<a class="nav-link " href="login"><button class="reg-button"> Login </button></a>
							</li>
							
						</ul>
					</div>
				</div>

				<!-- marquee -->
				<div id="tickerwrap">
					<!-- TradingView Widget BEGIN -->
					<div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
						<!-- TradingView Widget END -->
				</div>
				<!-- marquee -->
			
			</div>
			<!-- partial -->
		

		<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<div class="main-panel">
					<div class="content-wrapper">
                        <h1> MY BITCOIN STORY </h1>
                        <p>
                            Before you go ahead and read this statement, ensure never to make my mistake and 
                            miss out of a great opportunity to make a lot of money when you see one.
                        </p>

                        <p>
                            My name is John (real name withheld), and I never thought I would ever tell my 
                            bitcoin story but here I am. I see all the hype about bitcoin and how it has hit new 
                            highs of $60,000 while last year it was just worth $4,000.
                        </p>

                        <p>
                            While lots of people are hearing about bitcoin for the first time, I heard about 
                            bitcoin for the first time as far back as 2016, back then the price of bitcoin was 
                            $600.
                        </p>

                        <p>
                            Back in 2016, nobody was really talking about bitcoin, it was also not so easy to 
                            buy bitcoin because of the difficulty in navigating the few exchanges where you 
                            could buy bitcoin.
                        </p>

                        <p>
                            At first when I heard about bitcoin I ignored and was skeptical until a close friend 
                            of mine told me about how it worked. He did a lot of explanation and I went ahead 
                            to do my research. I contemplated for months until in June of 2017, I decided to 
                            buy about $120 worth of bitcoin on the 27th of June, 2017 on blockchain as seen in 
                            the screenshot below.
                            
                            <div class="cnt text-center just-content-center">
                                <img src="images/img4.jpg" alt="" class="picout img-fluid">
                                <div class="text-center"><small>A screenshot of my first bitcoin purchase in 2017, I bought $121 worth of bitcoin</small></div>
                            </div>
                            
                        </p>
                        
                        <p>
                            I further bought more bitcoin on the 8th of July that same year, one of the best ever decisions I made that year.
                            <div class="cnt text-center just-content-center">
                                <img src="images/img3.jpg" alt="" class="picout img-fluid">
                                <div class="text-center"><small>Screenshot of my 2nd bitcoin purchase on the 8th of July, 2021</small></div>
                            </div>
                        </p>

                        <p>
                            Within weeks of buying that same year, bitcoin price surged to new highs and new 
                            highs, I looked forward to checking my bitcoin wallet every single day. It was 
                            really exciting.
                        </p>

                        <p>
                            That same year, bitcon price got to an all time high of $19,000 and the value of what I had bought for just $240 was now worth over $2100 by the end of the year
                        </p>

                        <p>
                            Little did I know all good things come to an end also applied to bitcoin. Investing 
                            in bitcoin involves buying at a low price and selling at a high price. I thought it 
                            would keep rising. I didn’t sell my bitcoin at the all time high price and by June of 2018, bitcoin price 
                            had slumped to $6,100. I suddenly lost interest in bitcoin and I thought it would 
                            never rise again, I had some financial obligations and I sold all my bitcoin. 
                        </p>

                        <p>
                            Fast forward to 2019, bitcoin hit a new low of $3,400, I finally thought this was the 
                            end for bitcoin and I fully wrote of bitcoin and sold the little bitcoin I had left. 
                            Come early 2020 bitcoin was still hovering around $6900 as at January 3rd and rose further 
                            to $9500 by Jan 31st
                            and when the pandemic peaked and there was worldwide 
                            lockdown, bitcoin went all the way down to $4000. 
                            This was life changing because at this time, I thought it was all over because the 
                            whole world was going into recession, the recession is always filled with massive 
                            drops in assets and stocks, hereby I thought bitcoin would keep going down.
                        </p>

                        <p>
                            During the last recession that occurred that occurred between 2007 and 2009 (The 
                            great depression), there was a huge stock market crash and many assets, the Dow 
                            Jones dropped 778 points in one trading day and this economic reasoning led me to 
                            believe bitcoin would crash further and it would take a lot of time to recover.
                            I was totally wrong once again because between March 2020 and April 2021, 
                            bitcoin has gone from $4000 to over $60,000.
                        </p>

                        <p>
                            Don’t be like me and miss out on great opportunities, lots of times we overestimate 
                            the worst that could happen when we invest and we underestimate the great things 
                            that could possibly happen.
                        </p>

                        <p>
                            If I had bought bitcoin at that time, I would have earned 12x my money by now, I 
                            didn’t take action.
                            On the other hand in my opinion, I think bitcoin is a great asset but it has reached a 
                            good point, the key to earning a lot of money with any asset is getting in early 
                            when it’s still cheap and get out at the peak.
                            The best time to invest in an asset is when no one is talking about it
                            Example: Bitcoin in 2015 when it was just over $300 and Tesla in 2016 when it 
                            was about $48. 
                            Today very few people are talking about volatility trading, volatility trading can
                            give you access to huge profits on a daily basis because of the nature of the asset, 
                            volatility just like bitcoin is volatile security/asset.
                        </p>

                        <p>
                            In volatility trading, you can make as much as $200 as far as you know what you 
                            are doing. 
                            Don’t just listen to me, view real profit screenshots of a volatility trading account 
                            below.
                            <div class="cnt text-center just-content-center">
                                <img src="images/img2.jpg" alt="" class="picout img-fluid">
                                <img src="images/img1.jpg" alt="" class="picout img-fluid">
                            </div>
                        </p>

                        <p>
                            The reason why volatility is so profitable is that the price regularly goes up and 
                            down, hereby experienced and knowledgeable traders can go into trades at the right 
                            time and pull out profit when the price swings upward.With these constant changes in price, experienced traders almost always make 
                            profit everyday. Hereby if you are not a good trader, you shouldn’t trade 
                            volatilities yourself, you should get someone experienced to do it for you. 
                            When I initially wanted to start trading volatilities, I was very skeptical and wasn’t 
                            sure how it would pan out, I heard about how profitable it was but the idea of 
                            getting a professional trader to handle your account and trade for you was new to 
                            me, I thought the profits they talked about were unreal until I made my very first
                            profit. At first when I got started, I didn’t earn profit for my first 2 days until the 3rd
                            day when I earned $204 within 24 hours.
                            <div class="cnt text-center just-content-center">
                                <img src="images/img5.jpg" alt="" class="picout img-fluid">
                            </div>
                        </p>

                        <p>
                            I was filled with excitement, it felt unreal so I decided to withdraw part of my 
                            profits to see it I would be able to receive them and damn well I received my 
                            profits almost instantly.
                            <div class="cnt text-center just-content-center">
                                <img src="images/img6.jpg" alt="" class="picout img-fluid">
                            </div>
                        </p>

                        <p>
                            It’s been a wonderful ride ever since because I have made recurrent profits through 
                            volatility trading.
                            <button class="btn btn-warning text-dark btn-md m-2"><a href="https://wa.me/message/C2ER5DVDVZDII1" class="text-dark text-decoration-none"> Click here  <i class="fas fa-share"></i></a></button> to speak with an assistant on how you can start earning profits using 
                            volatility trading system.
                            Volatility trading is a high risk high reward so ensure to get a professional trader to 
                            trade for you, the unfortunate thing is very few traders can consistently make 
                            profits in the volatility market
                        </p>

                        <div class="cnt">
                            <h1>TAKE ACTION NOW</h1>
                            Huge profits being made in any particular market will definitely not last too long 
                            because once the brokers see that too many people are making profits from the 
                            system they will start to block the asset class or might take it out of their system all 
                            together.
                            <button class="btn btn-primary btn-md m-2"><a href="https://wa.me/message/C2ER5DVDVZDII1" class="text-white text-decoration-none"> TAKE ACTION NOW BEFORE IT'S TOO LATE <i class="fas fa-angle-double-right"></i> </a></button>
                             and learn how to get started
                        </div>
					</div>

                    <!--//comments section-->
                    
                    									<div class="">
										<ol id="update" class="timeline">
										<?php
										require_once'dbh.php';
										@$postId = strip_tags($_GET['postId']);
										?>
										<li>
										<div class='text-left'>
										<h1 style="color: orange;text-transform: capitalize;"> Share your thoughts </h1>
										
										</div>
										</li>
										<div class='panele' id="slidepanel<?php #echo $msg_id; ?>">
											<div class="comment-error"></div>
											<form action="" method="post" class="comment-form" id="comments-form">
												<div>
													<input type="text" value="<?php echo @$Ename?>" name="Ename" class="forminput" id="Ename" placeholder="Enter Name"/>
													<input type="text" value="<?php echo @$postId?>" class="forminput" id="postId" hidden/>
												</div>
												<div>
													<input type="text" value="<?php echo @$Email?>" name="Email" class="forminput" id="emaild" placeholder="Enter Email"/>
												</div>	
												<div>
													<textarea name="message" class='comments' id="comments" placeholder="Enter Comment"></textarea>
												</div>
												<div>
													<input type="submit" value=" Comment " class="comment_submit" name="submit" style="color: orange" onclick="prevSubmit()"/>
													 <!-- <input type="button" value="Select File" name="uploadDocuments" class="btn btn-md text-white bg-primary" onclick="file_explorer();"> -->
													
												</div>
											</form>
										</div>
										</ol>
										<!-- Display comments -->
										<div class="showcomments">
										<?php @session_start(); require_once'dbh.php'; $showComments = new dbh(); $showComments -> getmComments();?>
										</div>
									</div>
									
									
					<!--// Footer Widget//-->
					<div class="footer-widget">
					<!-- Footer  -->
					
					<!--// Footer CopyRights //-->
						<footer class="footer-main">
							
							<div class="col-12 footer-intro mt-5 mb-5 pt-3 pb-3">
								<div class="footer-head">
									<div class="container">
										<div class="row">
											<div class="col-md-4 mt-5">
												<h2> <i class="fas fa-satellite-dish"></i> KNOW MORE </h2>
												<div class=""></div>
												<div class="clear-fix" style='clear: both'></div>
												<ul>
													<li class='list-item'>
														<a href="how-btc-works">How Bitcoin Works</a>
													</li>
													<li class='list-item'>
														<a href="my-btc-story" target="_blank">My Bitcoin Story</a>
													</li>
													<li>
														<a href="terms">Learn More</a>
													</li> 
												</ul>
											</div>

											<div class="col-md-4 mt-5">
												<h2> <i class="fas fa-home"></i> COMPANY</h2>
												<div class="clear-fix" style='clear: both'></div>
												<ul>
													<li class='list-item'>
														<a href="">Home</a>
													</li>
													<li class='list-item'>
														<a href="createaccount" target="_blank">Get Started</a>
													</li>
													<!--//  <li>
														<a href="terms">Terms & Conditions</a>
													</li> //-->
												</ul>
											</div>

											<div class="col-md-4 mt-5">
												<h2><i class="fa fa-info-circle"></i>&nbsp; QUICK CONTACT </h2>
												<!-- <div class=""></div> -->
												<div class="clear-fix" style='clear: both'></div>
												<div class="footer-form">
													<form onsubmit="return false;" id="Contact_form" enctype="multipart/form-data" method="post">
														
													
														<div class="col-12">
															<div class="form-row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<input class="form-control " name="email" id="email" placeholder="Your Email" value="" type="text">
																	</div>
																</div>
																
																<div class="col-sm-6">
																	<div class="form-group">
																		<input class="form-control " name="subject" id="subject" placeholder="Subject" value="" type="text">
																	</div>
																</div>
																</div>
															</div>
															
															<div class="col-sm-12">
																<div class="form-group">
																	<textarea class="form-control " cols="80" name="message" id="message" placeholder="Your Message" rows="8"></textarea>
																</div>
															</div>
													
														
															<div class="col-sm-12">
																<!-- <div id="status" class="alert-success p-2 m-2 rounded"></div> -->
															</div>
															<div class="col-sm-12">
																<div class="form-btn">
																	<button class="btn pull-right text-dark" id="contact_Btn"
																		data-animation="animated fadeInRight" onclick="ContactMessage()" >
																		<i class='fas fa-paper-plane'></i> Send Message
																	</button>
																</div>
															</div>
													</form>
												</div>
											</div>
										</div>
									
									</div>
								</div>
							</div>

							
							<div class="container text-center mt-5 pt-3 mb-3 mx-auto copywright">
								
								<div class="text-center mx-auto">
									<div class="text-center">Copyright © 2018 - 2021 bitcoinnewstoday.org - All Rights Reserved</div>
								</div>
							</div>

						</footer>
					</div>
					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
	<script src="javascript/front.js?n=1"></script>
	<script src="javascript/interactions.js?n=1"></script>
	<script src="javascript/comments.js?n=1"></script>
    <script src="js/dashboard.js?n=1"></script>
	<script src="javascript/home.js?n=1"></script>
	<script type="text/javascript">
	

    </script>
	</div>
  </body>
</html>