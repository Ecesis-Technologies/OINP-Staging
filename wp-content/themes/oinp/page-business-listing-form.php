<?php 
/**

 * Template Name: Business Listing Form Page

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site may use a

 * different template.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package mysite

 */
get_header(); ?>


<section class="inner-banner blankPage">

    <?php

    while (have_posts()) : the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.

        if (comments_open() || get_comments_number()) :

            comments_template();

        endif;

    endwhile; // End of the loop.

    ?>

</section>



<section class="privacy">
            <div class="container">
                
                <h3 class="h3-titles domestic">Business Details</h3>
                
				<div class="prod" id="prod" ></div>
              
                <?php

				the_content();



				wp_link_pages(array(

					'before' => '<div class="page-links">' . esc_html__('Pages:', 'mysite'),

					'after'  => '</div>',

				));

				?>
				
				
				 <script
      src="https://kit.fontawesome.com/32c3f00aad.js"
      crossorigin="anonymous"
    ></script>
			
				
				


    <script
      src="https://kit.fontawesome.com/32c3f00aad.js"
      crossorigin="anonymous"
    ></script>

    <style>
 
      .detailPage {
        box-sizing: border-box;
        justify-content: center;
        align-items: center;
        display: flex;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 15px;
        }
      }
      .aboveDiv {
        width: 100%;
        background-color: #1c1445;
        padding: 40px;
        color: white;
        font-family: "Poppins", sans-serif;
        font-size: 1.3rem;
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 20px;
          font-size: 1rem;
        }
      }

      .belowDiv {
        display: flex;
        flex-direction: row;
        justify-content:space-between;
        align-items: flex-start;
        width: 107%;
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 20px;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }
      }

      .listing_Div {
        color: #1c1445;
        border: 1px solid #1c1445;
        box-sizing: border-box;
        padding: 10px;
        border-radius: 10px;
        text-align: justify;
        margin: 20px 0;
        @media screen and (max-width: 767px) {
          margin: 5px;
        }
      }
      .listing_Div > a {
        color: #1c1445;
      }
      .belowLeft {        
        display: flex;
        flex:0.4;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        @media screen and (max-width: 767px) {
          padding: 10px;
          margin: 5px;
        }
      }

      .details_div {
        padding: 40px 0;
        padding-right:'10px';
        padding-left:'30px';
        flex:0.6;
        @media screen and (max-width: 767px) {
          padding: 15px;
        }
      }
      .details_div > h1 {
        font-size: 2.5rem;
        font-weight: bold;
      }
      .details_div > p {
        font-size: 1.3rem;
        font-weight: 300;
      }

      .lin1 {
        display: flex;
        width: 100%;
        justify-content: space-between;
      }
      .lin2 {
      }
      .lin2 > p {
        font-size: 1.3rem;
        font-weight: 300;
      }
      .lin2 > h2 {
        color: rgb(186, 187, 187);
        float: right;
      }

      .lin3 > p {
        font-size: 14px;
        font-weight: 300;
      }
  
      .blankPage>.in-banner-content {
    display: none;
}

     .product_{
        width: 100%;
        height:200px;
        display: flex;
        justify-content:center;
        align-items:center;
        flex-direction:row;
        background:'red';
      }
      .product_>img{
        width:300px;
        height:300px;
      }
	
		
		
		 #wpform1450{
        width: 70%;
      }

      #wpforms-1450{
        width: 65% !important;
      }
      .loader {
        height: 50vh;
        font-size: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: normal;
        margin-top: 3rem;
      }

      #wpforms-submit-1450{
        display:flex;
        justify-content: center !important;
        align-items: center !important;
        margin-top: 20px !important;
      }

@media only screen and (max-width: 767px) {
	#wpforms-submit-1450 {
    display:flex;
    justify-content: center !important;
    align-items: center !important;
    margin-top: 10px !important;
      padding: 5px 15px !important;
    
  }
    .wpforms-submit-container{
    display:flex;
    justify-content: center !important;
    align-items: center !important;

  }
    .wpforms-submit{
      padding:5px 25px !important;
      padding-top: 10px !important;
  }
    .wpforms-field-row.wpforms-field-large{
      display:flex !important;
      flex-direction: column !important;
      width: 100% !important;
      
    }
    
    #wpforms-submit-1450{
      padding: 4px 20px !important
    }
    
  #wpforms-1450-field_1{
      width: 100%;
      margin-bottom:10px !important;
    }
    .wpforms-field-row-block.wpforms-first.wpforms-one-half{
      width: 100% !important;
      margin-bottom:12px !important;
    
    }
    .wpforms-field-row-block.wpforms-one-half{
      width: 100% !important;

    }
    #wpforms-1450-field_1-last{
      width: 100% !important;
      margin-left: -20px !important;
    }

    
    
    .wpforms-field wpforms-field-name.form-input{
      display; flex !important;
      flex-direction: column !important; 
    }
    .wpforms-field wpforms-field-name.form-input>input{
      width: 100% !important;
    }
    
    
    #wpform1450{
    width: 100% !important;
      margin-top: -40px !important;
  }
    
    

  #wpforms-submit-1450{
      padding: 4px 20px !important
        background: green !important;
    }
  .wpforms-submit-container{
    display:flex;
    justify-content: center !important;
    align-items: center !important;
    padding: 5px 13% !important;
  }
    .inner-banner.blankPage{
    margin-bottom: -150px !important;
    }
    
    
      /* Media query for smaller screens */
      @media screen and (max-width: 767px) {
		  .inner-pages.customize-support{
			  margin:0 !important;
			  padding: 0 !important;
		  }
		  
		  	 #wpform1450{
        width: 90%;
      }
      
        .showMoreBtn:hover {
          background-color: #004ac1;
          color: white;
          direction: rtl;
        }
      }

     
    </style>
				
            <div id='singleProduct'></div>
            <button class='mobileBtn' style="display:none" onclick="window.location.href = 'https://staging2.futureisontario.com/explore-business-opportunities'">Back</button>

		

    <script>

 

 document.addEventListener('DOMContentLoaded', () => {
  // Retrieve the clicked product from localStorage
  let clickedProduct = {}
  const clickedProduct1 = JSON.parse(localStorage.getItem('clickedProduct'));
  clickedProduct = clickedProduct1

  localStorage.removeItem('clickedProduct')


  if (clickedProduct) {
  
      console.log(clickedProduct);
    // Set the inner HTML with the product details
    let prodd = document.getElementById("prod")
    prodd.innerHTML = `
    <div class="detailPage">
      <div class="aboveDiv">
        <div onclick="window.location.href='https://staging2.futureisontario.com/explore-business-opportunities/'" style="cursor: pointer; width: 50px; display: flex">
          <i class="fa-solid fa-arrow-left-long" style="margin-right: 15px; margin-top:5px"></i>
          Back
        </div>
      </div>

      <div class="belowDiv">
        <div class="belowLeft">
          <img
            src="${clickedProduct1.thumbnail}"
          />
        </div>
        <div class="details_div">
          <h1>${clickedProduct1.title}</h1>
          <p>${clickedProduct1.description}</p>

          <div class="retail">
           <div class="lin3">
              <p><b>ID:</b> ${clickedProduct1.id}</p>
            </div>
            <div class="lin2">
              <p><b>City:</b> ${clickedProduct1.city}</p>
            </div>
            <div class="lin2">
              <p><b>City Description:</b> ${clickedProduct1.city_description === undefined ? "" : clickedProduct1.city_description} </p>
            </div>
            <div class="lin2">


            
            <p><b>Price:</b> ${clickedProduct1.price.includes('$') ? `${clickedProduct1.price} CAD` : clickedProduct1.price}</p>



              <p><b>Industry:</b> ${clickedProduct1.industry}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    `;


}

  })




    </script>


	</div>
				
				
				

	


                 
				
			
       </section>

<?php get_footer();  ?>