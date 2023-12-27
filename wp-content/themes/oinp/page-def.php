<?php 
/**

 * Template Name: Blank Page

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/he/1.2.0/he.js" integrity="sha512-o4gKX6jcK0rdciOZ9X8COYkV9gviTJAbYEVW8aC3OgIRuaKDmcT9/OFXBVzHSSOxiTjsTktqrUvCUrHkQHSn9Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
    <div  id="listing"></div>

</section>


<section class="privacy" >
            <div class="container">
                <h3 class="h3-titles domestic "><?php the_title(); ?></h3>
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
			
				
				


    <style>
		
	  /* form back cta */


	  .blankPage>.in-banner-content {
    display: none;
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
    
    .productDetails{
      width: 100vw;
    }
    .s_Product{
            position: relative;
          }
        #productDetails {
          box-sizing: border-box;
          justify-content: center;
          align-items: center;
          display: flex;
          flex-direction: column;
          font-family: "Poppins", sans-serif;
          padding: 10px !important;
          
        }
        .upper {
          width: 93% !important;
          background-color: #1c1445;
          margin: 10px 0;
          padding: 20px;
          color: white;
          font-family: "Poppins", sans-serif;
          font-size: 1rem !important;
        }
        .nameDiv{
          margin-top: 10px;
        }
        .btnDiv {
          cursor: pointer;
          margin: 10px 0;
          position: absolute;
          top:2% !important;
          left: 4%;
          color: white;
          z-index: 20;
        }
        .pic_details {
          display: flex;
          flex-direction: column !important;
  
          width: 100% !important;
          margin-top: 10px;
        }
      
        .listing{
          height: fit-content;
          width: 100%;
          color: #1c1445;
          border: 1px solid #1c1445;
          box-sizing: border-box;
          padding: 10px;
          border-radius: 10px;
          text-align: justify;
          margin: 20px 0;
        }
        .under{
        color: #1c1445 !important;
          text-decoration: underline !important;

        }

        .picSide > img {
          height: 450px;
          width: 100% !important;
          margin-top: 10px;
        }
        .details_div {
          padding: 15px !important;
        }
        .details_div > h1 {
          font-size: 1.5rem !important;
          font-weight: bold;
        }
        .details_div > p {
          font-size: 1rem !important;
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
          font-size: 1rem;
          font-weight: 300;
        }
        .lin2 > h2 {
          color: rgb(186, 187, 187);
          float: right;
        }
        .inputs {
          display: flex;
          flex-direction: column;
          width: 100%;
        }
        .s_input {
          display: flex;
          flex-direction: column;
          justify-content: flex-start;
        }
        .s_input > p {
          margin-top: 20px;
          margin-bottom: 10px;
          font-size: 1.3rem;
          font-weight: 300;
        }
        .s_input > input {
          padding: 15px;
          background-color: #ced9fc;
          border: none;
          outline: none;
        }
    .products{
    overflow-x: hidden;
    }
    
    .header-products{
      width: 100%;
          display: flex;
          flex-direction: column;
          box-sizing: border-box;
          padding: 10px;
    }
    
    .in-banner-img.services{	
          height: 350px !important;
        background-image: url('https://oinp-stg.local/wp-content/uploads/2023/06/Service_Mobile_500x300_V3.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
          margin-top: -80px;

      }
      .in-banner-img.services>img{
      
          display:none;	
        background: red;
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
    
    .city{
      padding-left:18px !important;	
    }
    #typeFilter{
      width: 77% !important;
    }
    .type{
  padding-left: 5px !important;
    }
  .city>select{
  margin-left: 13px !important;

    }
    
    .price>p{
      margin-top: 16px !important;
      
    }
  }

      .products-component {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        padding-bottom: 50px;
      }
      .header-products {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        padding: 20px 50px;
      }

      .price {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
        margin-left: 20px;
        font-family: "Poppins", sans-serif;
        font-size: 1.2rem;
      }
      .price > p {
        margin-top: 15px;
        margin-right: 8px;
      }
      .p_input > input {
        padding: 10px;
        border-radius: 20px;
        outline: none;
        border: 1px solid rgb(72, 72, 72);
        margin-right: 10px;
        margin-left: 3px;
        font-family: "Poppins", sans-serif;
        font-size: 1rem;
      }
      .city {
        margin-right: 15px;
        width: 20%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        font-family: "Poppins", sans-serif;
        font-size: 1rem;
      }
      .city > select {
        padding: 10px;
        border-radius: 20px;
        width: 80%;
        outline: none;
        font-family: "Poppins", sans-serif;
        font-size: 1rem;
      }
      .type {
        margin-right: 15px;
        width: 20%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        font-family: "Poppins", sans-serif;
        font-size: 1rem;
      }
      .type > select {
        padding: 10px;
        border-radius: 20px;
        width: 80%;
        outline: none;
        font-family: "Poppins", sans-serif;
        font-size: 1rem;
      }

      .products {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        display: flex;
        flex-wrap: wrap;
        justify-content: center !important;
        align-items: flex-start;
      }

      .product {
        width: 31%;
        border: none;
        padding: 2px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        overflow: hidden;
        border-radius: 15px;
        /* margin: 15px; */
        margin-bottom: 20px;
        border: 1px solid beige;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }

      .prod_details {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        padding: 5px 15px;
        font-family: "Poppins", sans-serif;
      }

      .product > img {
        width: 50%;
        height: auto !important;
        border-radius: 15px;
        cursor: pointer;
        transition: transform 0.5s ease-in-out;
        transform: scale(1);
      }

      .product > img:hover {
        transform: scale(1.05);
      }

      .product-title {
        font-weight: bold;
        font-size: 1.3rem;
        flex-shrink: 0; /* Prevent the title from shrinking */
      }

      .product-price {
        color: #000;
        font-size: 1.2rem;
        margin-bottom: 30px;
      }

      .product-description {
        margin-top: 2px;
        margin-bottom: 2px;
        overflow: hidden;
        text-overflow: ellipsis; /* Truncate the description if it exceeds container height */
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limit the description to 3 lines */
        -webkit-box-orient: vertical;
      }

      p.product-description {
        margin-top: 2px;
        margin-bottom: 2px;
      }

      p.product-city {
        margin-top: 2px;
        margin-bottom: 2px;
      }

      .readMore {
        padding: 15px;
        border-radius: 70px;
        width: 40%;
        background-color: #004ac1;
        color: white;
        cursor: pointer;
        outline: none;
        border: 1px solid transparent; /* Added transparent border */
        margin: 10px;
        margin-top: -15px;
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 10px !important;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out,
          border-color 0.3s ease-in-out; /* Added border-color transition */
      }
		.proceed22{
			   padding: 15px;
        border-radius: 70px;
        width: 40%;
        background-color: #004ac1;
        color: white;
        cursor: pointer;
        outline: none;
        border: 1px solid transparent; /* Added transparent border */
        margin: 30px 5px;
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 10px !important;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out,
          border-color 0.3s ease-in-out;
			
		}

      .readMore:hover {
        background-color: white;
        color: black;
        border-color: black; /* Changed border color */
        direction: rtl;
      }

      .showMoreBtn {
        padding: 15px;
        border-radius: 70px;
        width: 15%;
        color: black;
        cursor: pointer;
        outline: none;
        border: 1px solid transparent; /* Added transparent border */
        margin: 10px;
        margin-top: -15px;
        font-size: 16px;
        font-weight: bolder;
        margin: 50px;
        margin-bottom: 10px !important;
        border-color: black; /* Changed border color */
        background-color: white;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out,
          border-color 0.3s ease-in-out; /* Added border-color transition */
      }
      .showMoreBtn:hover {
        background-color: #004ac1;
        color: white;
        direction: rtl;
      }
		
		
		.detailPage {
        box-sizing: border-box;
        justify-content: center;
        align-items: center;
        display: flex;
        flex-direction: column;
        font-family: "Poppins", sans-serif;
        padding: 20px;
			width: 110%;
			margin-left: -35px;
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 15px;
			margin: 1px;
        }
      }
      .aboveDiv {
        width: 90%;
        background-color: #1c1445;
        padding: 40px;
        color: white;
        font-family: "Poppins", sans-serif;
        font-size: 1.3rem;
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 20px;
          font-size: 1rem;
			margin-top: -40px;
        }
      }

      .belowDiv {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
       
        @media screen and (max-width: 767px) {
          width: 100%;
          padding: 20px;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }
      }

      .listing_Div {
        height: fit-content;
        width: 100%;
        color: #1c1445;
        border: 1px solid #1c1445;
        box-sizing: border-box;
        padding: 10px;
        border-radius: 10px;
        text-align: justify;
        margin: 20px 0;
        @media screen and (max-width: 767px) {
          margin: 5px;
			margin-top: 20px;
        }
      }
      .listing_Div > a {
        color: #1c1445;
      }
      .belowLeft {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        margin-top: 20px;
		   flex: 0.4;
        @media screen and (max-width: 767px) {
          padding: 10px;
          margin: 5px;
        }
      }

      .details_div {
        padding: 30px;
		  flex: 0.6;
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
			
    
      /* Media query for smaller screens */
      @media screen and (max-width: 767px) {
		  .inner-pages.customize-support{
			  margin:0 !important;
			  padding: 0 !important;
		  }
		  
		  	 #wpform1450{
        width: 90%;
      }
        .product {
          width: 100%;
          display: flex;
        }
        .header-products {
          display: flex;
          flex-direction: column !important;
          width: 100%;
          overflow: hidden;
        }
        .price {
          display: flex;
          flex-direction: row;
          align-items: flex-start;
        }
        .price > p {
          margin-top: 10px;
        }
        .p_input > input {
          padding: 8px;
          border-radius: 20px;
          outline: none;
          border: 1px solid rgb(72, 72, 72);
          margin: 10px;
          width: 80%;
        }
        .city {
          width: 80%;
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          align-items: center;
        }
        .city > select {
          padding: 10px;
          border-radius: 20px;
          width: 99%;
          outline: none;
          margin: 5px;
          margin-left: 13px;
        }
        .type {
          width: 80%;
          display: flex;
        }
        .type > select {
          border-radius: 20px;
          width: 80%;
          outline: none;
        }
		

        .prod_details {
          display: flex;
          flex-direction: column;
          flex-grow: 1; /* Allow the description to expand vertically */
          padding: 5px 15px;
          font-family: "Poppins", sans-serif;
        }

        .product-title {
          font-weight: bold;
          font-size: 1rem;
          flex-shrink: 0; /* Prevent the title from shrinking */
        }

        .product-price {
          color: #000;
          font-size: 1rem;
          margin-bottom: 20px;
        }

        .product-description {
          margin-top: 15px;
          margin-bottom: 4px;
          overflow: hidden;
          text-overflow: ellipsis; /* Truncate the description if it exceeds container height */
          display: -webkit-box;
          -webkit-line-clamp: 3; /* Limit the description to 3 lines */
          -webkit-box-orient: vertical;
        }

        .readMore {
          padding: 15px;
          border-radius: 70px;
          width: 40%;
          background-color: #004ac1;
          color: white;
          cursor: pointer;
          outline: none;
          border: 1px solid transparent; /* Added transparent border */
          margin: 10px;
          margin-top: -15px;
          font-size: 16px;
          font-weight: bolder;
          margin-bottom: 20px !important;
          transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out,
            border-color 0.3s ease-in-out; /* Added border-color transition */
        }

        .readMore:hover {
          background-color: white;
          color: black;
          border-color: black; /* Changed border color */
          direction: rtl;
        }

        .showMoreBtn {
          padding: 15px;
          border-radius: 70px;
          width: 40%;
          color: black;
          cursor: pointer;
          outline: none;
          border: 1px solid transparent; /* Added transparent border */
          margin: 10px;
          margin-top: -15px;
          font-size: 16px;
          font-weight: bolder;
          margin: 50px;
          margin-bottom: 10px !important;
          border-color: black; /* Changed border color */
          background-color: white;
          transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out,
            border-color 0.3s ease-in-out; /* Added border-color transition */
        }
        .showMoreBtn:hover {
          background-color: #004ac1;
          color: white;
          direction: rtl;
        }
      }
    </style>
				
				
				   <div class="products-component" id="products-component">
      
      <div class="header-products" id="header-products">
        <div class="price">
          <p>Price:</p>
          <div class="p_input">
            <input type="number" placeholder="min" name="min-price" />
            <input type="number" placeholder="max" name="max-price" />
          </div>
        </div>
        <div class="city">
          <select id="cityFilter" name="city">
            <option value="select">All Cities</option>
          </select>
        </div>
        <div class="city">
          <select id="industryFilter" name="industry">
            <option value="select">Select Industry</option>
          </select>
        </div>

      </div>
      <div class="loader" id="loader">
        <i class="fas fa-spinner fa-pulse"></i>
        <!-- Font Awesome spinning icon -->
      </div>
      <div id="wpform1450" >
      </div>
      <div id="wpforms-1450"></div>
      <div class="products" id="products"></div>
      <button id="showMoreBtn" class="showMoreBtn" style="display:none;">Show More</button>
					   
					   
					   <div id='singleProductDetails' >
						   
					   </div>
					   				   
    </div>

    <script>
    function decodeHtmlEntities(html) {
  var txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
}
      
      const products = [];
      let allProductsLoaded = false;
		const fetchData = async () => {
        const loader = document.getElementById("loader"); 
        const productsContainer = document.getElementById("products");	
        try {
          // Show the loader while fetching data
          loader.style.display = "block";
          productsContainer.style.display = "none";
          const response = await fetch(
            "http://localhost/OINP-Staging/wp-content/uploads/2023/12/OINP_business_salev1.json"
          );
          const data = await response.json();

          if (data.status === "OK") {
            products.push(...data.data);
            const cityFilter = document.getElementById("cityFilter");
            const cities = Array.from(
              new Set(products.map((product) => product.city))
            );
            cities.sort();

            cities.forEach((city) => {
              const option = document.createElement("option");
              option.value = city;
              option.textContent = city;
              cityFilter.appendChild(option);
            });

            const industryFilter = document.getElementById("industryFilter");
            const industries = Array.from(
              new Set(products.map((product) => product.industry))
            );
            industries.sort();

            industries.forEach((industry) => {
              const option = document.createElement("option");
              option.value = industry;
              option.textContent = industry;
              industryFilter.appendChild(option);
            });

            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('city')) {
              // Extract the city value using a regular expression
              var cityMatch = window.location.search.match(/[?&]city=([^&:]+)/);
              var cityValue = cityMatch ? cityMatch[1] : null;

              if (cityValue) {
                // Decode the URL-encoded value and then decode HTML entities
                cityValue = new DOMParser().parseFromString(`<!doctype html><body>${decodeURIComponent(cityValue)}`, 'text/html').body.textContent;
                document.getElementById("cityFilter").value = cityValue;
                console.log("Decoded city value:", cityValue);
                showProducts();
                loader.style.display = "none";
                productsContainer.style.display = "flex";
              } else {
                // Handle case where city parameter is present but no value is found
                console.error("No valid city parameter found in the URL.");
              }
            } else {
              showProducts();
              loader.style.display = "none";
              productsContainer.style.display = "flex";
            }

          //   const urlParams = new URLSearchParams(window.location.search);
          //   if (urlParams.has('city')) {
          //     var cityValue = urlParams.get('city');
          //      document.getElementById("cityFilter").value = cityValue;
          //        showProducts();
          //         loader.style.display = "none";
          //         productsContainer.style.display = "flex";
          //   }else{
          //     showProducts(); 
          //     loader.style.display = "none";
          //   productsContainer.style.display = "flex";
          // }

            
       
          } else {
            console.error("Error: Failed to fetch data from the API");
          }
        } catch (error) {
          console.error("Error: Failed to fetch data from the API", error);
        }
      };
      const productContainer = document.getElementById("products");
      const productsPerPage = 6; 
      let currentPage = 1; 

	  const handleFilterChange = () => {
        resetPagination();
        showProducts();
      };
      document.querySelector('select[name="city"]')
        .addEventListener("change", handleFilterChange);
      document.querySelector('select[name="industry"]')
        .addEventListener("change", handleFilterChange);
      document
        .querySelector('input[name="min-price"]')
        .addEventListener("input", handleFilterChange);
      document
        .querySelector('input[name="max-price"]')
        .addEventListener("input", handleFilterChange);

      // Function to filter products based on the selected city, type, and price range
      const filterProducts = (
        selectedCity,
        selectedIndustry,
        minPrice,
        maxPrice
      ) => {
        let filteredProducts = products;

        // Filter products based on selected city (case-insensitive)
        if (selectedCity !== "select") {
          filteredProducts = filteredProducts.filter(
            (product) =>
              product.city.toLowerCase() === selectedCity.toLowerCase()
          );
        }

        if (selectedIndustry !== "select" && typeof selectedIndustry === 'string') {
          filteredProducts = filteredProducts.filter(
            (product) => typeof product.industry === 'string' && 
                        product.industry.toLowerCase() === selectedIndustry.toLowerCase()
          );
        }



        // Filter products based on price range
        if (!isNaN(minPrice) && !isNaN(maxPrice)) {
          filteredProducts = filteredProducts.filter((product) => {
            const productPrice = parseInt(product.price.replace(/[$,]/g, ""));
            return productPrice >= minPrice && productPrice <= maxPrice;
          });
        } else if (!isNaN(minPrice)) {
          filteredProducts = filteredProducts.filter((product) => {
            const productPrice = parseInt(product.price.replace(/[$,]/g, ""));
            return productPrice >= minPrice;
          });
        } else if (!isNaN(maxPrice)) {
          filteredProducts = filteredProducts.filter((product) => {
            const productPrice = parseInt(product.price.replace(/[$,]/g, ""));
            return productPrice <= maxPrice;
          });
        }

        return filteredProducts;
      };
      


      // Function to show products for the current page
      const showProducts = () => {
      
        // resetPagination();
        const selectedCity = document.querySelector(
          'select[name="city"]'
        ).value;
        const selectedIndustry = document.querySelector(
          'select[name="industry"]'
        ).value;
        const minPrice = parseInt(
          document.querySelector('input[name="min-price"]').value
        );
        const maxPrice = parseInt(
          document.querySelector('input[name="max-price"]').value
        );

        const filteredProducts = filterProducts(
          selectedCity,
          selectedIndustry,
          minPrice,
          maxPrice
        );

        const startIdx = (currentPage - 1) * productsPerPage;
        let endIdx = startIdx + productsPerPage;
        if (endIdx > filteredProducts.length) {
          endIdx = filteredProducts.length;
        }
        const paginatedProducts = filteredProducts.slice(startIdx, endIdx);

      const productsHTML = paginatedProducts
  .map(
    (product) => `
      <div class="product" id="${product.id}"> <!-- Use product.id -->
        <img src="${product.thumbnail}" alt="Product" />
        <div class="prod_details">
          <h2 class="product-title">${product.title}</h2>
          <p class="product-description">${product.industry}</p>
          <p class="product-city">Location: ${product.city}</p>
          <h3 class="product-price">${product.price}</h3>
        </div>
        <button class="readMore" data-id="${product.id}">Learn More</button> <!-- Use data-id -->
      </div>
    `
  ).join("");







       
        if (currentPage === 1) {
    productContainer.innerHTML = productsHTML;
  } else {
    productContainer.innerHTML += productsHTML;
  }
 

  showMoreButton();

  const totalProducts = filteredProducts.length;
  const totalPages = Math.ceil(totalProducts / productsPerPage);

  if (currentPage >= totalPages || totalProducts <= productsPerPage) {
    allProductsLoaded = true;
    window.removeEventListener('scroll', debounce(onScroll1, 100));
  }      
      };



document.addEventListener('click', (event) => {
  
  if (event.target.classList.contains('readMore')) {
    const productId = event.target.dataset.id;
    const clickedProduct = document.getElementById(`${productId}`); // Use product ID to get element
    const productDetails = products.find(product => product.id === productId);
    
    // Store the product details in localStorage
    localStorage.setItem('clickedProduct', JSON.stringify(productDetails));
    

    
    // Redirect to the next page
    const url = "http://localhost/OINP-Staging/domestic-business-listing-form?business-id="+productId;
    window.location.replace(url);
  }
});




      // Function to truncate the overview text
      const truncateOverview = (overview, maxChars) => {
        if (overview.length > maxChars) {
          return overview.substring(0, maxChars) + "...";
        }
        return overview;
      };

      // Function to show or hide the "Show More" button
      const showMoreButton = () => {
        const filteredProducts = filterProducts(
          document.querySelector('select[name="city"]').value,
//           document.querySelector('select[name="type"]').value,
          parseInt(document.querySelector('input[name="min-price"]').value),
          parseInt(document.querySelector('input[name="max-price"]').value)
        );

        const totalProducts = filteredProducts.length;
        const totalPages = Math.ceil(totalProducts / productsPerPage);

       
      };

		
				
const submitForm = document.getElementById('wpforms-submit-1450')
							
//submitForm.addEventListener('click', () => {
submitForm?.addEventListener('click', () => {
							
							const loader = document.getElementById("loader");
							const formToBeSubmitted = document.getElementById('wpform1450')
							const confirmationMsg = document.getElementById("wpforms-confirmation-1450");
							const componentPage = document.getElementById('products-component');

						

  if (confirmationMsg) {
  	loader.style.display = "block";
//     confirmationMsg.style.display = "none";
	formToBeSubmitted.style.display = "none"
  }

							
  // Function to check if the confirmation div exists
  const checkConfirmationDiv = () => {
    const confirmation = document.getElementById("wpforms-confirmation-1450");

    if (confirmation ) {
//       confirmationMsg.style.display = "none";
	  formToBeSubmitted.style.display = "none"
	  loader.style.display = "block";
							
							
      navigate2(); // Call navigate2 function
    } else {
      setTimeout(checkConfirmationDiv, 0.00001);
    }
  };

  // Start checking for the confirmation div
  checkConfirmationDiv();
});

const resetPagination = () => {
  currentPage = 1;
  allProductsLoaded = false;
  scrolledHeight = 600;
};




let isLoading = false;


const paginate = () => {
  if (!isLoading) {
    isLoading = true;
    setTimeout(() => {
      currentPage++;
      showProducts();
      isLoading = false;
    }, 200);
  }
}

let scrolledHeight = 600;

const debounce = (func, delay) => {
  let timeout;
  return function() {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      timeout = null;
      func.apply(context, args);
    }, delay);
  }
}

const onScroll1 = () => {
  if (allProductsLoaded) return;

  const screenHeight = window.innerHeight;
  if (window.scrollY >= scrolledHeight) {
    paginate();
    scrolledHeight += screenHeight;
  }
}

window.addEventListener('scroll', debounce(onScroll1, 100));



      // Call the fetchData function to fetch and populate the products
      fetchData();
    </script>


	</div>
							
			
       </section>

<?php get_footer();  ?>