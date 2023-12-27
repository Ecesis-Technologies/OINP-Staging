<?php

/**

 * Template Name: OINP  Rewamp

 *

 * This is the template for OINP Home page.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package OINP

 */
$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 

?>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
   document.addEventListener('DOMContentLoaded', function () {
      function addClassOnScroll() {
        const divToModify = document.getElementById('header');
        window.addEventListener('scroll', function () {
          if (window.scrollY > 600) {
            divToModify.classList.add('scrolled'); 
          } else {
            divToModify.classList.remove('scrolled');
          }
        });
      }

    
      addClassOnScroll();
    });
</script>
<?php get_header(); ?>

<style>
	body{
		overflow-x:hidden;
}
.main header{
  transition:all 0.5s;
}
.inner-pages .main header{
      background: rgba(255,255,255,0);
}
.inner-pages .main header.scrolled {
    background: #fff;
    padding-bottom:10px;
}
.main .banner {

    height: 100vh;
    max-height: 918px;

}
.main .banner .banner-inner .banner-item {
    height: 100%;
}

  .main .banner .banner-inner .banner-item .desk-banner {
    object-fit: fill;
    max-height: 918px;

}    
	.main .banner .banner-inner .banner-item .container .banner-learn.color-blue {
    margin-top: 33px;
}
.main .banner .banner-inner .banner-item .container .banner-learn.color-blue:hover {
    background: #fff;
}
.main .banner .banner-inner .banner-item .container .banner-learn svg{
  width:24px;
  position:relative;
  z-index:11;
}
.main .banner .banner-inner .banner-item .container .banner-learn:hover svg path{
    fill:#000;
}
.main .banner .banner-inner .banner-item .container .banner-learn.color-blue::after {
  
    box-shadow: inset -300px 0px 0px #004ac1;
    transition: all .4s cubic-bezier(0.5, 0.24, 0, 1);
}
.main .banner .banner-inner .banner-item .container .banner-learn.color-blue:hover::after {
  
    box-shadow: inset 0px 0px 0px #004ac1;
    transition: all .4s cubic-bezier(0.5, 0.24, 0, 1);
}
	.main .banner-cnt{
		display:none;
	}
	.main .trans-bg {
    background:#004AC1 url('/wp-content/themes/oinp/assets/images/blue_bg.webp');
    width: 100%;
    background-size: cover;
	  background-repeat:no-repeat;
    position:relative;
}
	.main .overview {
		padding-top: 65px;
		padding-bottom: 320px;
		margin-top:0px;
}
	.main .overview .overview-in .overview-content{
		max-width:750px;
	}
	
	.main .overview .overview-in .overview-content .oveview-cont p:last-of-type {
    margin-top: 15px;
    font-size: 30px;
    line-height: 48px;
    font-weight: 400;
}
	.main .overview .overview-in .overview-content .overview-more {
    width: 210px;
    background: #ffff;
    border: 1px solid #FFFFFF;
    height: 56px;
    border-radius: 28px;
    font-size: 16px;
    font-weight: 500;
    color: #000000;
    margin-top: 63px;
    text-align: center;
    letter-spacing: 1.5px;
    cursor: pointer;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    position: relative;
    line-height: 24px;
    gap: 17px;
    cursor: pointer;
}
.main .overview .overview-in .overview-content .overview-more svg {
  z-index:11;
}
	.main .overview .overview-in .overview-content .overview-more:hover {
    border-color: #ffffff;
}
	.main .overview .overview-in .overview-content .overview-more:hover {
    color:#ffffff;
}
.main .overview .overview-in .overview-content .overview-more:hover svg path{
  fill:#fff;
}

	.main .entrepreneurs {

    position: absolute;
    bottom: -108px;
    z-index: 9;
    left: 50%;
    margin: auto;
    transform: translate(-50%,0%);
    width: 100%;
}
	.main .entrepreneurs .entrepreneurs-in {
    display: flex;
    flex-direction: row;
    gap: 42px;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box {
    flex: 1;
    border: 1px solid #004ac1;
    height: auto;
    border-radius: 33px;
    padding: 34px 53px 47px 58px;
    min-width: 300px;
    background: #FFFFFF;
    border: 1px solid #3F3F3F;
    display: flex;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts {
    display: block;
    margin-top: 0px;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-contents .entre-icon {
    display: block;
    max-width: 67px;
    margin-top: -7px;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-contents .entre-icon.hoverIcon{
    display:none;
  }
	.entre-contents{
		display:flex;
	}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts .entre-sub-text {
		text-transform: none;
		font-family: Poppins;
		font-size: 35px;
		font-weight: 600;
		line-height: 44px;
		letter-spacing: 0em;
		text-align: left;
		color:#2C2C2C;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts .entre-main-texts {
		display: block;
		font-family: Poppins;
		font-size: 15px;
		font-weight: 400;
		line-height: 26px;
		letter-spacing: 0em;
		text-align: left;
		color:#2C2C2C;
		max-width: 320px;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts .entre-more {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 25px;
    width: 210px;
    height: 56px;
    border-radius: 28px;
    background: rgba(0,0,0,0);
    border: 1px solid #000;
    margin-top: 65px;
    color: #000;
    font-size: 16px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-weight: 500;
    line-height: 24px;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover {
    background: linear-gradient(#17BD7F, #23A876);
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-sub-text {
    color: #fff;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-main-texts {
    color: #fff;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-more {
    border: 1px solid #fff;
    color: #fff; 
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-more svg path{
  fill:#fff;
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-more svg path{
  fill:#fff;
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-contents .entre-icon {
    display:none;
}
	.main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-contents .entre-icon.hoverIcon{
    display:block;
  }
  .main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-more:hover{
    border: 1px solid #000;
    color: #000;
    background:#fff;
  }
  .main .entrepreneurs .entrepreneurs-in .entrepreneur-box:hover .entre-texts .entre-more:hover svg path{
  fill:#000;
  }
	
	.main .start-business {
    background: #004ac1;
    padding: 43px 0 55px 0;
    overflow: hidden;
}
	.main .start-business .start-business-container{
		position: relative;
    background: #000 url('/wp-content/themes/oinp/assets/images/start_bg.png');
		padding: 110px 110px 110px;
    margin: -300px 110px 0;
    border-radius: 2rem;
		background-repeat:no-repeat;
		background-size: cover;
		background-position:center;
	}
	.business-form{
		margin-top:0;
	}
	.main .start-business .business-in .business-form {
    padding: 48px 55px 0px 52px;

}
	.main .start-business .business-in .business-content .title-cap {
    display: block;
    margin-bottom: 10px;
    font-size: 15px;
    font-weight: 500;
    line-height: 23px;
    letter-spacing: 0.035em;
    text-align: left;
    color: #02A1F1;
}
	.main .start-business .business-in .business-content h2 {
    color: #fff;
    min-width: 350px;
    font-family: Poppins;
    font-size: 35px;
    font-weight: 500;
    line-height: 44px;
    letter-spacing: 0em;
    text-align: left;
}
	.main .start-business .business-in .business-content .business-texts p {

    color: #fff;
    margin-top: 20px;
    font-family: Poppins;
    font-size: 15px;
    font-weight: 400;
    line-height: 26px;
    letter-spacing: 0em;
    text-align: left;
}
	.main .start-business .business-in {
    display: flex;
    flex-direction: row;
    gap: 76px;
}
	.choose-me-flex{
		display:flex;
		gap:50px;
	}
	
	.main .stream {
    background: #004ac1;
    padding: 32px 0 96px;
    margin-top: -2px;
}
	.main .stream .stream-app {
    display: flex;
    flex-direction: column;
    gap: 26px;
    align-items: center;
    justify-content: center;
}
	.main .stream .stream-app .stream-text {
    color: #fff;
    font-size: 30px;
    font-weight: 500;
    line-height: 48px;
    letter-spacing: 0em;
    text-align: left;
		max-width:unset;
}
	.main .stream .stream-app .help-read {
    display: flex;
    flex-direction: row;
    gap: 63px;
    width: 100%;
    align-items: center;
    justify-content: center;
}
	.main .start-business .business-in .business-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
	
	.main .helps {
    position: relative;
    padding-top: 200px;
		padding-bottom:350px;
}
	.start-business {
    overflow: visible !important;
}
.main .entrepreneurs {
    padding: 0;
}
	
/* 	 tbdc helps*/
	.main .helps .helps-in {
    display: flex;
    flex-direction: column;
    gap: 0px;
}
	
	.main .helps .helps-in .helps-left .help-cap {
    color: #02A1F1;
    text-transform: uppercase;
    font-family: Poppins;
    font-size: 15px;
    font-weight: 500;
    line-height: 23px;
    letter-spacing: 0.035em;
    text-align: left;
    margin-bottom: 24px;
}
	.main .helps .helps-in .helps-left .h1-titles {
    color: #0949BB;
    font-family: Poppins;
    font-size: 35px;
    font-weight: 500;
    line-height: 44px;
    letter-spacing: 0em;
    text-align: left;
}
	.main .helps .helps-in .helps-left .helps-content {
    display: block;
    margin-top: 24px;
    color: #000;
    max-width: unset;
    font-family: Poppins;
    font-size: 15px;
    font-weight: 400;
    line-height: 26px;
    letter-spacing: 0em;
    text-align: center;
}
	.main .helps .helps-in .helps-left {
    flex: 1;
		display:flex;
		flex-direction:column;
		align-items:center;
		justify-content:center;
}
	
	.main .helps .helps-in .helps-left .help-btn {
		display:none;
	}
	
	.main .helps .helps-in .helps-right .help-right-tabs {
    margin-top: 45px;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}
	
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head {
    width: unset;
    max-width: unset;
    height: 45px;
    border-radius: 0;
    padding: 7px 10px;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 0;
    border: none;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs {
    flex: 1;
    height: 55px;
    font-size: 15px;
    font-weight: 400;
    color: #fff;
    text-align: center;
    letter-spacing: .1px;
    line-height: 45px;
    border-radius:0px;
    cursor: pointer;
    border-bottom: 3px solid #CDCDCD;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs a {
    display: inline-block;
    font-family: Poppins;
    font-size: 15px;
    font-weight: 600;
    line-height: 26px;
    letter-spacing: 0em;
    color: #979797;
    min-width: 388px;
    text-align: center;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs.selected {
    background: none;
    border-bottom: 3px solid #004ac1;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs:hover {
     background: none;
    border-bottom: 3px solid #004ac1;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .selected a{
		color:#223990;
	}

/* 	tbdc slider */
.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content {
    width: 90%;
    height: 200px;
}
	
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box {
/*     width: 100%;
    display: flex;
    gap: 26px;    */
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box .service-list {
    /* width: unset; */
    display: flex;
    flex-direction: row;
    margin-top: 40px;
    background: #F8F8FA;
    /* min-width: 375px; */
    align-items: center;
    justify-content: center;
    height: 150px;
    border-radius: 33px;
   margin-right: 20px;
		gap:20px;
}
	.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box .service-list .service-title{
			font-weight: 700;
			line-height: 26px;
			letter-spacing: 0em;
			text-align: left;
			max-width: 170px;
	}

  
	.owl-carousel1 .owl-stage-outer{
		/* overflow:visible; */
	}
	
	.owl-carousel1 .owl-item{
		float:left;
	}
	.owl-carousel1 .owl-item {
  /* opacity: 0; */
  /* max-width:375px!important; */
}
.owl-carousel1 .owl-item.active {
  /* opacity: 1; */
}
/* 	slider end */
	.main .start-business .business-in .business-form .busines-form-box .personal .personal-amount-bar {
    display: block;
    width: 100%;
    min-width: 220px;
    height: 11px;
    border-radius: 5.5px;
    margin-top: 20px;
    position: relative;
}

.main .start-business .business-in .business-form .busines-form-box .personal {
    /* display: block; */
    margin-top: 0px;
    flex: 1;
    width: 100%;
}

.main .start-business .business-in .business-form .busines-form-box {
    height: auto;
    max-height: 737px;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    position: absolute;
    width: calc(100% - 85px);
}
.main .start-business .business-in .business-form .busines-form-box .types .ty-busi select.business-type {
  
    max-width: 220px;
	min-width:165px;
    padding: 0 11px 0 30px;

}
	
	.main .start-business .business-in .business-form .busines-form-box .types {
   		 gap: 20px;
		flex-wrap: wrap;
}
	.main .start-business .business-in .business-form {
    min-height: 640px;
}
	
/* 	Map section */
	.main .location-section{
    background: #fff;
    padding: 80px 0 100px 0;
    overflow: hidden;
    margin-top: 918px;
	}
	
	.main .location-section-container{
    position: relative;
    margin: 0px 110px 0;
    min-height:800px;
	}

	.location-contents{
		display:flex;
		gap:67px;
    	align-items: center;
	}
	
	
	.location-map img{
		height:800px;
	}
	
	.location-title h1{
		font-size: 70px;
		font-weight: 600;
		line-height: 72px;
		letter-spacing: 0em;
		text-align: left;
		color:#2C2C2C;
    		max-width:400px;

	}
	
	.location-description p{
		font-family: Poppins;
		font-size: 15px;
		font-weight: 500;
		line-height: 25px;
		letter-spacing: 0em;
		text-align: left;
		color:#000;
		margin-top: 20px;
    	max-width: 360px;
}
	
  /* mouse */
  .location-section-container .mouse-div{
    position: absolute;
    bottom: 7%;
    left: 50%;
    pointer-events: none;
    transform: translateX(-50%);
    z-index: 99;
  }
  .location-section-container .mouse-div span{
    display: block;
    width: fit-content;
    margin: 0 auto;
  }

  .location-section-container .mouse-div span .mouse-img{
    width: 40px;
  }

  .location-section-container .mouse-div .mouse-para{
    max-width: 158px;
    text-align: center;
    padding-top: 14px;
  }
 @media screen and (min-width:1366px){
    .main .banner .banner-inner .banner-item .container {
    top: -15%;
}
 }
  /* mouse end */

		@media screen and (max-width:1400px){
		.main .start-business .start-business-container {
			padding: 110px 80px 110px;
			margin: -300px 80px 0;
		}
		.main .start-business .business-in .business-form {
    		padding: 48px 55px 49px 52px;
		}
		.main .location-section {
		margin-top: 80vh;
		}
		.main .start-business .business-in .business-form {
   			 min-height: 640px;
		}
	}

	@media screen and (max-width:1200px){
		.main .start-business .business-in {
   			 flex-direction: column;
		}

    /* .location-section-container .mouse-div{
      left:20%;
    } */

	}
	
	@media screen and (max-width:991px){
		.choose-me-flex {
			display: flex;
			flex-direction: column;
			gap: 0px;
		}
		
		.main .start-business .start-business-container {
			padding: 110px 50px 110px;
			margin: -300px 50px 0;
		}
		
		.main .start-business .business-in .business-form {
    min-height: 650px;
}
		.location-contents{
			flex-direction:column;
		}

    .main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs a {
    min-width: 330px;
}
    /* .location-section-container .mouse-div{
      left:18%;
    } */
		
	}
		@media screen and (max-width:767px){
		.main .location-section {
   			 margin-top: 0;
		}
			.main .start-business .business-in .business-form {
    min-height: 750px;
    }

    .main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs a {
    min-width: 260px;
    }
    /* .location-section-container .mouse-div{
      bottom: 35%;
        left: 50%;
        transform: translate(-50%, 0px);
    }
    .location-section-container.active .mouse-div{
      bottom: 60%;
    } */
	}
	@media screen and (max-width:733px){
		.main .start-business .start-business-container {
    padding: 110px 30px 110px;
    margin: -300px 40px 0;
}
		.main .start-business .business-in .business-form {
    padding: 48px 30px 75px 30px;
}
		.main .start-business .business-in .business-form .busines-form-box .types { 
    gap: 30px;
}
	}
	
	@media screen and (max-width: 640px){
		.main .banner {
		margin-top: 0px;
		min-height: 600px;
		height: 100%;
		margin-bottom:0px;
		z-index: 2;
}
		.main .banner .banner-inner .banner-item .container .banner-learn {
    position: relative;
    bottom: 0px;
}
		.main .banner .banner-inner .banner-item::after {

    content: none;
}
.main .helps::after {
    content: none;
}
	}

	@media screen and (max-width:575px){
    .main header .top-nav {
        gap: unset;
    }
  .main header .top-nav .language {
      margin-right: 20px;
  }
    .main .banner {
    max-height: 664px;
}
.main .banner .banner-inner .banner-item .container .banner-learn {
    gap: unset;
}
.main .banner .banner-inner .banner-item .container .banner-learn.color-blue span {
    margin-right: 15px;
}
		.main .start-business .start-business-container {
    padding: 50px 10px 50px;
    margin: -300px 20px 0;
    }
		.main .start-business .business-in .business-form {
    padding: 48px 20px 200px 20px;
}
		.main .start-business .business-in .business-form {
    min-height: 600px;
}
.main .location-section-container {
    position: relative;
    margin: 0px 0px 0;
}

.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs a {
    max-width: 175px;
    min-width:unset;
}
.main .overview .overview-in .overview-content .oveview-cont{
  max-width:unset;
}
.main .overview .overview-in .overview-content .oveview-cont p:last-of-type {
    font-size: 22px;
    line-height: 33px;
}
.main .stream .stream-app .stream-text {
    font-size: 22px;
    line-height: 38px;
}
.main .overview .overview-in .overview-content .overview-more {
  margin-top:30px;
}
.main .entrepreneurs {

    bottom: -170px;
    }
    .main .entrepreneurs .entrepreneurs-in .entrepreneur-box {
      min-width:240px;
    }
    .main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts .entre-main-texts {
       max-width: 241px;
    }
    .main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-texts .entre-sub-text {
    max-width: unset;
}
.main .helps .helps-in .helps-left .help-cap {
  max-width:unset;
}

.main .helps .helps-in .helps-left .h1-titles {
    max-width: unset;
    margin-top: 0px;
    text-align:center;
}
.main .helps .helps-in .helps-right .help-right-tabs .help-tab-head .entre-tabs {
  border: none;
  border-bottom: 3px solid #CDCDCD;
}
.main .start-business .start-business-container{
padding: 30px 20px 50px;
}
.main .start-business .business-in .business-content h2{
   min-width: unset;
}

.main .start-business .business-in .business-content .business-texts p{
max-width: unset;
}
.main .start-business .business-in{
gap: 55px;
}
.main .start-business .business-in .business-form{
padding: 48px 20px 165px 20px;
}
.main .stream{
padding: 0px 0 96px;
padding: 0px 0 56px;
}

  /* .location-section-container .mouse-div {
    bottom: 53%;
  }
  .location-section-container.active .mouse-div {
    bottom: 75%;
    
} */
.entre-contents {
    display: flex;
    flex-direction: column-reverse;
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box .entre-contents .entre-icon {
    margin-top: 35px;
    margin-bottom: 20px;
}
.main .entrepreneurs .entrepreneurs-in {
    gap: unset;
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box {
    padding: 0 20px 40px 30px;
    margin-right:30px;
}
.main .overview {

    padding-bottom: 380px;

}
.main .start-business .business-in .business-form .busines-form-box.face-back {
    width: calc(100% - 30px);
}
.g-recaptcha >div:first-child{
  width:200px!important;
}
  }

@media screen and (max-width:425px){
    .main .start-business .business-in .business-content h2{
    font-size: 24px;
    line-height: 36px;
    }
    .main .start-business .business-in .business-form .busines-form-box .form-box-title{
    line-height: normal;
    }
    .main .start-business .business-in .business-form {
        padding: 20px 20px 250px 20px;
    }
      /* .location-section-container .mouse-div {
    bottom: 60%;
  }
  .location-section-container.active .mouse-div {
    bottom: 77%;
    
} */

}

		@media screen and (max-width:375px){
		.main .start-business .business-in .business-form {
    padding: 48px 20px 250px 20px;
}
			.main .start-business .business-in .business-content h2 {
    min-width:unset;

}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box {
    min-width: 240px;
}
/* .main .overview {
    padding-bottom: 250px;
}
.main .entrepreneurs .entrepreneurs-in .entrepreneur-box {
    padding: 24px 10px 0px 10px;
} */

	}

  @media(max-width:353px){
.main .start-business .business-in .business-form {
    padding: 48px 20px 303px 20px;
}
.main .stream .stream-app .stream-text {
    font-size: 16px;
    line-height: 29px;
}
.main .stream .stream-app .help-read{
    gap: 10px;
}
.main .media{
padding: 28px 0 100px 0;
}
.main .media .media-heder .media-tabs{
    padding: 10px 10px;
}
.location-section-container .mouse-div .mouse-para{
  min-width:150px;
  max-width:unset;
}
   /* .location-section-container .mouse-div {
    bottom: 65%;
  }
  .location-section-container.active .mouse-div {
    bottom: 81%;
    
} */

}
	
	@media screen and (min-width:1600px){
			.main .start-business .business-in .business-form {
   			 min-height: 550px;
		}
	}

  .main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box .service-list:hover{
    background:#0661B3;
    height:auto;
    min-height:150px;
    display:block;
  }

  .main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box .service-list .service-flop p.service-content {
    font-size: 19px;
    font-weight: 700;
    line-height: 22px;
    letter-spacing: 0em;
    text-align: left;
    color: #fff;
    margin-left: 0;
    padding-bottom: 0;
}

.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box .service-list .service-flop p.ser-cnt-des{

    font-size: 15px;
    font-weight: 400;
    line-height: 24px;
    letter-spacing: 0em;
    text-align: left;
    color: #fff;
    margin-left: 0;
    padding-bottom: 0;
}
  .service-list .service-flip{
    padding: 0px 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
  }
  .service-list .service-flop{
  display:none;
}

.service-list:hover .service-flip{
  display:none;
}
.service-list:hover .service-flop{
  display:block;
  padding: 25px 43px;
}

  .location-detail{
    position:absolute;
    width:40%;
    height:100%;
    top:27%;
    left: 60%;
    overflow:hidden;
    border-radius: 0 35px 35px 0px; 
    padding-left:75px;
 	}

  .location-detail.active{
    top:0;
    background:#000;
    padding-left:0;
    border: 1px solid #000;
    overflow-y:scroll;
  }
 .location-detail.active::-webkit-scrollbar {
    width: 0px;
}
.location-detail.active::-webkit-scrollbar-thumb {
    background: #17BD7F;
    outline: 1px solid rgba(0,0,0,.44);
    border-radius: 10px;
}
 .location-detail.active::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 0px rgba(0,0,0,0);
    border-radius: 10px;
}


/* 	
	.location-map{
		width:100%;
		min-height: 800px;
	} */
	
	#map{
    position:absolute;
    left:0;
    top:0;
    min-height:800px;
		width:60%;
    border-radius: 35px;
    border:1px solid #A8A8A8;
  }

  .be_cnt{
    padding-top:30px; 
    background:#000; 
  }
  .be_btm{
  font-size: 14px;
  font-weight: 300;
  line-height: 23px;
  letter-spacing: 0em;
  text-align: left;
  margin-left:76px;
  padding-left:30px;
  color:#fff;
  background:url('/wp-content/themes/oinp/assets/images/Arrow 2.png');
  background-repeat: no-repeat;
  background-position-y:center;
  }


  .be_btm svg{
    transform: rotate(180deg);
    margin-right:12px;
  }

  .be_btm svg path{
    fill:#17BD7F;
  }

  .be_lochead{
font-size: 35px;
font-weight: 500;
line-height: 44px;
letter-spacing: 0em;
text-align: left;
color:#17BD7F;
padding-top:37px;
padding-bottom:12px;
padding-left:76px;
padding-right:30px;
  }

  .be_locdet{
    font-family: Poppins;
    font-size: 18px;
    font-weight: 300;
    line-height: 30px;
    letter-spacing: 0em;
    text-align: left;
    color:#fff;
    padding-left:76px;
    padding-right:56px;
  }
 
  .be_cnt ul li a{
    color:#fff;

  }

  .be_cnt ul li{
    padding-top:26px;
    padding-bottom:33px;
    padding-left:76px;
  }

  .be_cnt ul li a p {
font-size: 18px;
font-weight: 500;
line-height: 30px;
letter-spacing: 0em;
text-align: left;

  }

  .be_cnt ul li a p.price{
    font-family: Poppins;
    font-size: 16px;
    font-weight: 300;
    line-height: 26px;
    letter-spacing: 0em;
    text-align: left;

  }
  .be_cnt ul li:hover{
    background:#17BD7F url('/wp-content/themes/oinp/assets/images/loc_arrow.png');
    background-repeat: no-repeat;
    background-position: center;
    background-position-x: 90%;
  }

    @media screen and (max-width:1440px){
    .be_btm {
      margin-left:50px;
    }
    .be_lochead {
      padding-left:50px;
    }
    .be_cnt ul li {
       padding-left: 50px;
    }
    .be_cnt ul li:hover {
      background-position-x: 95%;
    }
    .be_locdet {
      padding-left: 50px;
      padding-right: 35px; 
    }

  }

      @media screen and (max-width:1340px){
          .main .location-section-container {
    margin: 0px 50px 0;
}
  }

   @media screen and (max-width:1200px){
       #map {
         width:55%;
       }
       .location-detail {
          width: 45%;
          left: 55%;
          padding-left: 40px;
        }
        .be_locdet {
           font-size: 16px;
        }
        .be_cnt ul li a p {
          font-size: 16px;
        }
        .be_cnt ul li a p.price {
            font-size: 14px;
        } 
}
@media(max-width:990px){
.be_btm {
    margin-left: 20px;
}
.be_cnt{
    padding-top: 20px;
}
.be_cnt ul li a p{
line-height: 25px;
}
.be_lochead {
font-size: 30px;
line-height: 36px;
padding-top: 14px;
padding-left: 20px;
/* max-width: 100px; */
}
.be_locdet {
    padding-left: 20px;
    padding-right: 20px;
}
.be_cnt ul li{
    padding-top: 20px;
padding-bottom: 20px;
padding-left: 20px;
padding-right: 20px;
}
/* .main .location-section-container{
min-height: 795px;
} */
/* #map{
min-height: 795px;
max-height: 795px;
} */
.be_cnt ul li:hover{
background-size: 25px 25px;
}
.location-detail{
width: auto;
padding-left: 30px;
}
.location-title h1{
    font-size: 52px;
    line-height: 57px;
}
}

@media(min-width:850px) and (max-width:991px){
/* .main .location-section-container{
    min-height: 675px;
}
#map{
min-height: 675px;
max-height: 675px;
} */

}

@media screen and (max-width:767px){
     .main .location-section-container {
    margin: 0px 30px 0;
}
.main .banner .banner-inner .banner-item .container .h1-titles {
    font-size: 45px;
    line-height: 49.95px;
    max-width: 245px;
    font-weight: 600;
    margin-top: 50px;
}
.main .banner .banner-inner .banner-item .container .banner-learn.color-blue{
    margin-top: 20px;
}
.main .location-section{
    padding: 40px 0px 74px 0px;
}
.location-title{
padding-top: 20px;
}
#map{
position: relative;
width:100%;
min-height: 500px;
border-radius: 35px!important;
}
.location-detail{
position: relative;
height: auto;
border-radius: 0px;
padding: 0 20px;
width:100%;
left:0;
}

.location-detail.active{
padding: 0;
margin-top: 20px;
border-radius:35px;
}
.location-title h1{
max-width: unset;
font-size: 40px;
line-height: normal;
}
.location-description p{
font-size: 14px;
max-width: unset;
}
.main .location-section-container{
min-height: auto;
}
.be_cnt{
padding: 30px 0px;
}
.be_btm {
    margin-left: 20px;
}
.be_lochead {
    padding-left: 20px;
}
.be_locdet {
    padding-left: 20px;
    padding-right: 20px;
}
.be_cnt ul li {
    padding-left: 20px;
}


}
@media (max-width: 640px){
.main header .container {
    height: unset;
    align-items: center;
}
}

@media screen and (max-width:575px){
  #map{

    min-height: 250px;

}
	.owl-carousel1 .owl-stage-outer{
		overflow:hidden;
	}
  .location-title h1{
line-height: 45px;
}
.main .helps .helps-in .helps-right .help-right-tabs .help-tab-content .tab-content-box {
    width: 100%;
}
}
.help-tab-content{
    position:relative;
}
.help-tab-content .tab-content-box  .owl-nav{
  position: absolute;
  top: 35%;
  left: -35px;
  right: -35px;
}
.help-tab-content .tab-content-box .owl-nav .owl-prev,
.help-tab-content .tab-content-box .owl-nav .owl-next {
  position: absolute;
  height: 100px;
  color: inherit;
  background: none;
  border: none;
  z-index: 100;
}
/* .help-tab-content .tab-content-box .owl-nav .owl-prev i,
.help-tab-contentt .tab-content-box .owl-nav .owl-next i {
  font-size: 2.5rem;
  color: #cecece;
} */
.help-tab-content .tab-content-box .owl-nav .owl-prev {
  left: 0;
}
.help-tab-content .tab-content-box .owl-nav .owl-next {
  right: 0;
}
.help-tab-content .tab-content-box .owl-nav .owl-prev i{
     font-size: 2.5rem;
  color: #000;
}
.help-tab-content .tab-content-box .owl-nav .owl-next i{
     font-size: 2.5rem;
  color: #000;
}
.help-tab-content .tab-content-box .owl-nav .owl-next.disabled i{
    /* color: #CACACA; */
    display:none;
}
.help-tab-content .tab-content-box .owl-nav .owl-prev.disabled i{
    /* color: #CACACA; */
     display:none;
}


.form-chng{
    display:flex; 
    justify-content: space-between;
}
.main .start-business .business-in .business-form.is-flipped {
    min-height: 630px;
    max-height: 630px;
}
.main .start-business .business-in .business-form .busines-form-box.face-back .form-btn {
    margin:unset;
    margin-top: 20px;
}
.err-msg{
    margin:20px 0 20px 0;
    text-align:center;
}
.main .start-business .business-in .business-form .busines-form-box .submit {
    margin:unset!important;
    margin-top: 20px!important;
}
@media (min-width: 1650px){
    .main .start-business .business-in .business-form.is-flipped {
    min-height: 600px;
    max-height: 600px;
}
}
@media (max-width:575px){
  .main .start-business .business-in .business-form .busines-form-box .submit{
    width: 160px;
    height: 40px;
  }
}


</style>

<?php $secHero = get_field('hero'); ?>

<?php if (have_rows('home_banner')) :

  while (have_rows('home_banner')) : the_row(); 
  $desktop_image=get_sub_field('desktop_image');
  $mobile_image=get_sub_field('mobile_image');
  ?>

    <section class="banner">

      <div class="banner-inner ">

        <div class="banner-item">

          <div class="banner-images">

            <img src="<?php echo $desktop_image['url']; ?>" class="desk-banner" alt="<?php _ol(get_sub_field('title')); ?>">

            <img src="<?php echo $mobile_image['url']; ?>" class="mobile-banner" alt="<?php _ol(get_sub_field('title')); ?>">

          </div>

          <div class="container">

            <h1 class="h1-titles"><?php _ol(get_sub_field('title')); ?></h1>

            <p class="banner-cnt"><?php _ol(get_sub_field('content')); ?></p>

            <a href="<?php _ol(get_sub_field('link')); ?>" target="_blank" class="banner-learn color-blue">

              <span><?php _ol(get_sub_field('link_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#FFFFFF"></path>

              </svg>

            </a>

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>




<section class="location-section">
	<div class="location-section-container">
		<!-- <div class="location-contents"> -->

			<div id="map">  
      <div class="mouse-div">
      <span>
        <img class="mouse-img" src="<?php echo get_template_directory_uri();?>/assets/images/mouse.png">
       </span>
      <p class="mouse-para">CLICK AND DRAG TO EXPLORE</p>
    </div></div>
			<div class="location-detail"  id="popup-content">
      <div class="location-title">
				 <h1>
						Access to Canadian Market
					</h1>
				</div>
				<div class="location-description">
					<p>
					If you are an entrepreneur thinking about immigrating to Canada, the OINP Entrepreneur Success Initiative is here to help. We will make it easy for you every step of the way.
					</p>   
					
				</div>  
    </div>
		<!-- </div> -->
  
		
	</div>
	
</section>

	

<?php $secOverview = get_field('overview'); ?>

<div class="trans-bg">

  <?php if (have_rows('overview')) :
 
    while (have_rows('overview')) : the_row();?>

      <section class="overview">

        <div class="container">

          <div class="overview-in">

            <div class="overview-content">

              <h6 class="overview-sub-title"><?php _ol(get_sub_field('title')); ?></h6>

              <div class="oveview-cont">

                <p><?php _ol(get_sub_field('sub_title')); ?><span style="color:#93BCFF; font-weight:400;"><?php _ol(get_sub_field('description')); ?></span> </p>

              </div>

              <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="overview-more">

                <span><?php _ol(get_sub_field('cta_label')); ?></span>

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 28 16" fill="none">

                    <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#000"></path>

                </svg>

              </a>

            </div>

          </div>

        </div>

      </section>

  <?php

  endwhile;

  endif; ?>
	
		

  <?php $secEntrepreneurs = get_field('entrepreneurs'); ?>

  <?php if (have_rows('entrepreneurs')) :

    while (have_rows('entrepreneurs')) : the_row(); ?>

      <section class="entrepreneurs">

        <div class="container">

          <div class="entrepreneurs-in">

            <?php

            if (have_rows('items')) :

              while (have_rows('items')) : the_row();
				$icon=get_sub_field('icon');
        $hicon=get_sub_field('hover_icon');
            ?>

                <div class="entrepreneur-box">

<!--                   <span >

                    

                  </span> -->

                  <div class="entre-texts">
					  <div class="entre-contents">
						  <span class="entre-sub-text"><?php _ol(get_sub_field('title')); ?></span>
						  <img src="<?php echo $icon['url']; ?>" alt="<?php _ol(get_sub_field('title')); ?> icon" class="entre-icon">
              <img src="<?php echo $hicon['url']; ?>" alt="<?php _ol(get_sub_field('title')); ?> icon" class="entre-icon hoverIcon">
					  </div>

                    

                    <p class="entre-main-texts"><?php _ol(get_sub_field('sub_title')); ?></p>

                    <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="entre-more">

                      <span><?php _ol(get_sub_field('cta_label')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#000"></path>

              </svg>
                      

                    </a>

                  </div>

                </div>

            <?php

            endwhile;

            endif; ?>

          </div>

        </div>

      </section>

  <?php

  endwhile;

  endif;

  ?>
     
</div>

  <section class="helps" style="background:#fff;">

    <div class="container">

      <div class="helps-in" >

        <div class="helps-left">

          <?php if (have_rows('tbdc_helps')) :

            while (have_rows('tbdc_helps')) : the_row(); ?>

              <span class="help-cap"><?php _ol(get_sub_field('title')); ?></span>

              <h2 class="h1-titles"><?php _ol(get_sub_field('sub_title')); ?></h2>

              <p class="helps-content"><?php _ol(get_sub_field('description')); ?></p>

              <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="help-btn">

                <span><?php _ol(get_sub_field('cta_label')); ?></span>

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="arrow icon" class="help-icon-desk">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-arrow.svg" alt="help icon" class="help-icon-mob">



              </a>

          <?php

          endwhile;

          endif; ?>

   </div>
        <div class="helps-right">

          <?php if (have_rows('tbdc_services')) :

            while (have_rows('tbdc_services')) : the_row(); ?>

              <span class="help-right-cap"><?php _ol(get_sub_field('title')); ?></span>

              <div class="help-right-tabs">

                <div class="help-tab-head">

                  <div class="entre-tabs selected"><a href="#international"><?php _ol(get_sub_field('tab_1_heading')); ?></a></div>

                  <div class="entre-tabs"><a href="#domestic"><?php _ol(get_sub_field('tab_2_heading')); ?></a></div>

                </div>

                <div class="help-tab-content">

                  <div class="tab-content-box owl-carousel owl-carousel1" id="international">
                 
                    <?php if (have_rows('tab_1_items')) :

                      while (have_rows('tab_1_items')) : the_row(); 
					                  $iimage=get_sub_field('image');
					          ?>

                        <div class="service-list">
                          <div class="service-flip">
                              <div class="service-icon">

                                    <img src="<?php echo $iimage['url']; ?>" alt="TBDC Sevice - chat icon">

                              </div>
                              <p class="service-title"><?php _ol(get_sub_field('title')); ?></p>

                          </div>

                          <div class="service-flop" >
						                <p class="service-content"><?php _ol(get_sub_field('title')); ?></p>
                            <p class="ser-cnt-des"><?php _ol(get_sub_field('description')); ?></p>
                          </div>
                        </div>



                    <?php

                    endwhile;

                    endif; ?>

                  </div>

                  <div class="tab-content-box owl-carousel owl-carousel1" id="domestic" style="display:none;">

                    <?php if (have_rows('tab_2_items')) :

                      while (have_rows('tab_2_items')) : the_row(); 
					  $dimage=get_sub_field('image');
					  ?>

                      <div class="service-list">
                        <div class="service-flip">

                          <div class="service-icon">

                            <img src="<?php echo $dimage['url']; ?>" alt="TBDC Sevice - chat icon">

                          </div>
							            <p class="service-title"><?php _ol(get_sub_field('title')); ?></p>
                        </div>

                        <div class="service-flop" >
						                <p class="service-content"><?php _ol(get_sub_field('title')); ?></p>
                            <p class="ser-cnt-des"><?php _ol(get_sub_field('description')); ?></p>
                          </div>

                      </div>

                    <?php

                    endwhile;

                    endif; ?>

                  </div>

                </div>

              </div>

          <?php

          endwhile;

          endif; ?>

        </div>

      </div>

    </div>

  </section>



<section class="start-business" id="top">

  <div class="start-business-container">

    <div class="business-in">

      <?php if (have_rows('eligibility_criteria')) :

        while (have_rows('eligibility_criteria')) : the_row(); ?>

          <div class="business-content">
			  
			 <img src="<?php echo get_template_directory_uri();?>/assets/images/tbdc_new.png" style="max-width:60px;margin-bottom:35px;">

            <span class="title-cap"><?php _ol(get_sub_field('title')); ?></span>

            <h2 class="h1-titles"><?php _ol(get_sub_field('sub_title')); ?></h2>

            <div class="business-texts"><?php _ol(get_sub_field('description')); ?></div>


            <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="elig-btn">

              <span><?php _ol(get_sub_field('cta_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#fff"></path>

              </svg>

            </a>

          </div>

      <?php

      endwhile;

      endif; ?>

      <form action="<?php echo site_url(); ?>/rewamp/#top" method="post" style="width:100%">

        <div class="business-form">

             <?php

          // Include form submission script 

           include_once 'home-submit.php';

          ?>


          <div class="busines-form-box">

            <span class="form-box-title"><?php echo __( 'Eligibility requirements', 'oinp' ); ?></span>

            <div class="choose-me">

              <span class="choose-title"><?php echo __( "I'm", 'oinp' ); ?>:</span>
				
			<div class="choose-me-flex">

              <div class="choose-type">
              <input type="hidden" name="lng" value="<?php echo WPGlobus::Config()->language; ?>" />

                <?php /*?><input type="radio" id="inter1" name="radio-button" value="<?php echo __( 'An International Entrepreneur', 'oinp' ); ?>" onclick="chooselookingfor(1)"><?php */?>
                <input type="radio" id="inter1" name="radio-button" value="1" onclick="chooselookingfor(1)">

                <label for="inter1" onclick="chooselookingfor(1)"><?php echo __( 'An International Entrepreneur', 'oinp' ); ?></label>

              </div>

              <div class="choose-type">

                <?php /*?><input type="radio" id="domstk1" name="radio-button" value="<?php echo __( 'A Domestic Business Owner', 'oinp' ); ?>" onclick="chooselookingfor(2)"><?php */?>
                <input type="radio" id="domstk1" name="radio-button" value="2" onclick="chooselookingfor(2)">

                <label for="domstk1" onclick="chooselookingfor(2)"><?php echo __( 'A Domestic Business Owner', 'oinp' ); ?></label>

              </div>
				</div>

            </div>

            <div class="choose-me">

              <span class="choose-title"><?php echo __( 'Looking For', 'oinp' ); ?>:</span>
			
			<div class="choose-me-flex">

              <div class="choose-type">

                <input type="radio" disabled id="inter" value="<?php echo __( 'Investment/Buying a Business', 'oinp' ); ?>" name="radio-button1">

                <label for="inter"><?php echo __( 'Investment/Buying a Business', 'oinp' ); ?></label>

              </div>

              <div class="choose-type">

                <input type="radio" disabled id="domstk" value="<?php echo __( 'Selling Existing Business', 'oinp' ); ?>" name="radio-button1">

                <label for="domstk"><?php echo __( 'Selling Existing Business', 'oinp' ); ?></label>

              </div>
				</div>

            </div>

            <div class="types">

              <div class="ty-busi business">

                <span class="types-title"><?php echo __( 'Type of Business', 'oinp' ); ?></span>

                <select class="business-type" name="type" aria-label="business type select" value="<?php echo !empty($postData['type']) ? $postData['type'] : ''; ?>">

                  <!-- <option>Agriculture</option> -->

                  <option value="<?php echo __( 'Agriculture', 'oinp' ); ?>"><?php echo __( 'Agriculture', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Hospitality', 'oinp' ); ?>"><?php echo __( 'Hospitality', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Retail', 'oinp' ); ?>"><?php echo __( 'Retail', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Manufacturing', 'oinp' ); ?>"><?php echo __( 'Manufacturing', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Technology', 'oinp' ); ?>"><?php echo __( 'Technology', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Healthcare', 'oinp' ); ?>"><?php echo __( 'Healthcare', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Others', 'oinp' ); ?>"><?php echo __( 'Others', 'oinp' ); ?></option>

                </select>

              </div>

              <div class="ty-busi experiance">

                <span class="types-title"><?php echo __( 'Business Experience', 'oinp' ); ?></span>

                <select class="business-type" name="experience" aria-label="business experiance select" value="<?php echo !empty($postData['experience']) ? $postData['experience'] : ''; ?>">

                  <!-- <option>5-7 years</option> -->

                  <option value="<?php echo __( 'Under 2 years', 'oinp' ); ?>"><?php echo __( 'Under 2 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '2-5 years', 'oinp' ); ?>"><?php echo __( '2-5 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '5-7 years', 'oinp' ); ?>"><?php echo __( '5-7 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '7-10 years', 'oinp' ); ?>"><?php echo __( '7-10 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '10-15 years', 'oinp' ); ?>"><?php echo __( '10-15 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '15+ years', 'oinp' ); ?>"><?php echo __( '15+ years', 'oinp' ); ?></option>

                </select>

              </div>
				
			       <div class="personal">

              <div class="personal-title-box">

                <span class="title-text"><?php echo __( 'Personal Net Worth', 'oinp' ); ?> <span><?php //echo __( '(Approx)', 'oinp' ); ?></span></span>

                <span class="personal-amount" id="range-slider__value"><?php echo __( '800,000', 'oinp' ); ?></span>

              </div>

              <div class="personal-amount-bar">

                <!-- <div class="amount-seeker"></div> -->

                <!-- <div class="drag-elem"></div> -->



                <input id="range-slider__range" name="range" class="amount-seeker" type="range" min="0" max="800000" value="<?php echo !empty($postData['range']) ? $postData['range'] : '0'; ?>">



              </div>

            </div>

            </div>

       

            <a href="javascript:void(0)" class="form-btn">

              <span><?php echo __( 'Continue', 'oinp' ); ?></span>

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arrow.png" alt="white-arrow" class="desk-form">

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white arrow.png" alt="white arrow" class="mob-form">

            </a>

            <!-- <input type="button" class="form-btn" aria-label="continue" value="Continue"> -->

            <?php echo $statusMsg;?>
            

          </div>

          <div class="busines-form-box face-back">

            <fieldset>

              <label for="firstname"><?php echo __( 'First Name', 'oinp' ); ?></label>

              <input id="firstname" type="text" name="fname" class="field-box" placeholder="<?php echo __( 'Enter your firstname', 'oinp' ); ?>" value="<?php echo !empty($postData['fname']) ? $postData['fname'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Lastname"><?php echo __( 'Last Name', 'oinp' ); ?></label>

              <input id="Lastname" type="text" name="lname" class="field-box" placeholder="<?php echo __( 'Enter your Lastname', 'oinp' ); ?>" value="<?php echo !empty($postData['lname']) ? $postData['lname'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Email"><?php echo __( 'Enter Email Id', 'oinp' ); ?></label>

              <input id="Email" type="email" name="email" class="field-box" placeholder="<?php echo __( 'Enter your Email Id', 'oinp' ); ?>" value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Mobile"><?php echo __( 'Enter Mobile Number', 'oinp' ); ?></label>

              <input id="Mobile" type="number" name="mobileno" class="field-box" placeholder="<?php echo __( 'Enter your Mobile number', 'oinp' ); ?>" value="<?php echo !empty($postData['mobileno']) ? $postData['mobileno'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>

            </fieldset>

            <div class="form-chng">
                <a href="javascript:void(0)" class="form-btn">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arrow.png" alt="white-arrow" class="desk-form" style="transform: scaleX(-1);">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white arrow.png" alt="white arrow" class="mob-form" style="transform: scaleX(-1);">

                    <span><?php echo __( 'Go Back', 'oinp' ); ?></span>

                </a>

                <input type="submit" class="submit" name="submit" value="<?php echo __( 'Submit', 'oinp' ); ?>">
            </div>



           <?php echo $statusMsg;?>

          </div>



          <!-- <div class="submit-form">

                                

                            </div> -->
                            
         

        </div>

      </form>

    </div>

  </div>

</section>

<?php if (have_rows('stream_app')) :

  while (have_rows('stream_app')) : the_row(); ?>

    <section class="stream">

      <div class="container">

        <div class="stream-app">

          <div class="stream-text"><?php _ol(get_sub_field('description')); ?></div>

          <div class="help-read">

            <a class="read-text-link" href="<?php _ol(get_sub_field('cta_1_url')); ?>">

              <span><?php _ol(get_sub_field('cta_1_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#FFFFFF"></path>

              </svg>

            </a>

            <a class="read-text-link" href="<?php _ol(get_sub_field('cta_2_url')); ?>">

              <span><?php _ol(get_sub_field('cta_2_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#FFFFFF"></path>

              </svg>



            </a>

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>

<?php if (have_rows('why_ontario')) :

  while (have_rows('why_ontario')) : the_row(); ?>

    <section class="why" style="display:none;">

      <div class="container">

        <div class="why-in">

          <div class="why-map">

            <div id="map"></div>

          </div>

          <div class="why-contents">

            <h2 class="h1-titles"><?php _ol(get_sub_field('title')); ?></h2>

            <p class="why-texts"><?php _ol(get_sub_field('description')); ?></p>

            <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="why-btn">

              <span><?php _ol(get_sub_field('cta_label')); ?></span>

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="arrow icon" class="desk-icon">

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-arrow.svg" alt="arrow-icon" class="mobil-icon">

            </a>

            <!-- <input type="button" class="why-btn" value="continue" aria-label="continue"> -->

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>


<?php if (have_rows('social_media')) :

  while (have_rows('social_media')) : the_row(); ?>
<section class="media">

  <div class="container">

    <div class="media-heder">

      <div class="media-tabs">

        <ul class="media-links">

          <li class="active"><a href="https://www.linkedin.com/showcase/oinp-esi/posts/?feedView=all" target="_blank"><?php echo __( 'Social Media', 'oinp' ); ?></a></li>

        </ul>

      </div>

      <div class="view-all">

        <a href="<?php _ol(get_sub_field('view_all_link')); ?>" target="_blank">

          <span><?php echo __( 'View all', 'oinp' ); ?></span>

          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

            <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#000"></path>

          </svg>

        </a>



      </div>

    </div>

    <div class="media-contents">

      <div class="media-tabs owl-carousel owl-carousel2 " id="news">
<?php while (have_rows('links')) : the_row(); ?>
        <div class="media-blocks">



          <iframe src="<?php _ol(get_sub_field('link')); ?>" height="913" width="371" frameborder="0" allowfullscreen="" title="Embedded post"></iframe>

        </div>

<?php endwhile; ?>
      </div>

    </div>

  </div>

</section>

<?php

endwhile;

endif; ?>

<?php if (have_rows('advisor_text')) :

  while (have_rows('advisor_text')) : the_row(); ?>

    <div class="advisor">

      <p class="advisor-texts"><?php _ol(get_sub_field('title')); ?></p>

      <span class="advisor-icon">

        <a href="<?php _ol(get_sub_field('cta_url')); ?>">

          <span><?php _ol(get_sub_field('cta_label')); ?></span>

          <!--<img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arow.svg" alt="advisor more icon">-->
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

            <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#fff"></path>

          </svg>

        </a>

      </span>

    </div>

<?php

endwhile;

endif; ?>


<?php get_footer();  ?>


<script>

	$(document).ready(function() {
     
    
        $('.owl-carousel.owl-carousel1').owlCarousel({
              loop: false, 
              nav: true,
                  navText: [
                      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                      '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                  ],
              autoplay:true,
              margin:20,
              autoplayHoverPause:true,
              responsive: {
                  0: {
                  items: 1
                  },
                  600: {
                  items: 2
                  },
                  1000: {
                    items: 3
                  }
              }
          });

          

      // }
      
        
//tab click 		
 $('.help-tab-head .entre-tabs').on('click', function(e) {

  var currentAttrValue = jQuery(this).find('a').attr('href');

  $('.help-tab-content ' + currentAttrValue).slideDown(400).siblings().slideUp(400);

  $(this).addClass('selected').siblings().removeClass('selected');

  e.preventDefault();
});
		
});

 


// $('.service-list').on('click', function(e) {
//   alert("hii");
//   $(this).find('.service-flip').css('display', 'none');
//   $(this).find('.service-flop').css('display', 'block');
//   e.preventDefault();
// });


</script>


<?php

$coordinates = array();
$args = array(
	'post_type'  => 'locations',
	 'posts_per_page' => 50,
);
$loop = new WP_Query($args);

while ($loop->have_posts()) {
    $loop->the_post();
    $title = get_the_title();
    $description = get_the_content();
    if (have_rows('location')) {
        while (have_rows('location')) {
            the_row();
            $latitude = get_sub_field('latitude');
            $longitude = get_sub_field('longitude');
            $data[] = array('latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'description' => $description );
        }
    }
}

// Encode the coordinates array to JSON
$json_data = json_encode($data);
?>
<style>
  .marker {
    width: 18px;
    height: 18px;
    background-color: green; 
    border-radius: 70%; 
    display: flex;
    justify-content: center;
    align-items: center;
    background:url("/wp-content/themes/oinp/assets/images/map_marker.png");
   
}
</style>

<script>

var ini_locationdetail= document.querySelector('.location-detail').innerHTML;


mapboxgl.accessToken = 'pk.eyJ1Ijoic2l2YWVjZXNpcyIsImEiOiJjbG9oMDBtdDgxMzUwMmtvMWk3cTJ2NXRzIn0.CgekuJWjQEjcgrVXgApkug';
const map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/light-v11',
    style:'mapbox://styles/sivaecesis/cloije31k003t01pb1s9lgic3',
    center: [-79.383935,43.653482],
    zoom: 4.5
});
map.addControl(new mapboxgl.NavigationControl());
var stores = <?php echo $json_data; ?>;
map.on('load', () => {
stores.forEach(function(store) {
    var el = document.createElement('div');
    el.className = 'marker';

    // Create a marker and set its coordinates
    var marker = new mapboxgl.Marker(el)
        .setLngLat([store.longitude, store.latitude])
        .addTo(map);
    el.storeData = store;

    el.addEventListener('click', function () {
      console.log('mouse clicked');
        var storeData = this.storeData;
        var title = storeData.title;
        var description = storeData.description;
            
        document.getElementById('popup-content').innerHTML = description;
        document.getElementById('map').style.borderRadius = '35px 0 0 35px';
        document.getElementsByClassName('location-detail')[0].classList.add('active');
        document.getElementsByClassName('location-section-container')[0].classList.add('active');

    var popup = new mapboxgl.Popup({
        offset: 25, 
    }); 

    marker.setPopup(popup);
    });

     const hoverpopup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false
      });

    el.addEventListener('mouseenter', function () {
        var storeData = this.storeData;
        var title = storeData.title;
        hoverpopup.setHTML( title);
    
        marker.setPopup(hoverpopup);
       hoverpopup.addTo(map);
    });

    el.addEventListener('mouseleave', function () {
        hoverpopup.remove();
    });

  }); 

    }); 

function iniCnt(){
  document.getElementById('popup-content').innerHTML = ini_locationdetail;
  document.getElementsByClassName('location-detail')[0].classList.remove('active');
  document.getElementsByClassName('location-section-container')[0].classList.remove('active');
  document.getElementById('map').style.borderRadius = '35px';
}

</script>

<script>
function goToForm(){
  alert("hii");
}
</script>





