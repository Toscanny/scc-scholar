<!DOCTYPE html>
<html>
<head>
<title>SCC Scholarship Management System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel= "stylesheet" href = "css/register.css" >
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("img/1st.png");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}



/* logo display */

  .row {
  display: flex;
}

/* Create three equal columns that sits next to each other */
.column {
  flex: 33.33%;
  padding: 5px;
}







</style>
</head>
<body>



<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
  
   
    <img src="img/SCC.png" alt="ched"  style="width:10vmin;height:10vmin;"> SCC Scholarship Management System
    <!-- <a href="#home" class="w3-bar-item w3-button w3-wide">LOGO</a> -->
    
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">  <i class="fa fa-th"></i> ABOUT</a>
      <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-group"></i> TEAM</a>
      <a href="sms/admin/index.php" class="w3-bar-item w3-button" ><i class="fa fa-registered"></i>SCC</button></a>
      <a href="NewStudent/login.php" class="w3-bar-item w3-button"><i class="fa fa-registered"></i>STUDENT</button></a>
   
   </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="#about" class="w3-bar-item w3-button">  <i class="fa fa-th"></i> ABOUT</a>
      <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-group"></i> TEAM</a>




      <a href="login.php" class="w3-bar-item w3-button" ><i class="fa fa-registered"></i>LOGIN</button></a>
      <a href="register.php" class="w3-bar-item w3-button"><i class="fa fa-registered"></i>REGISTER</button></a>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container " id="home">
  <div class="w3-display-left w3-text-white" style="padding:48px">
    <span class="w3-xxxlarge w3-show-small">St. Cecilia's College - Cebu Inc.</span><br>
    <!-- <span class="w3-xxlarge w3-hide-large w3-hide-medium">Start something that matters</span><br> -->
    <span class="w3-large">SCHOLARSHIP OFFICE - COLLEGE DEPARTMENT</span>
    <p><a href="#about" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Apply for Scholarship NOW!</a></p>
  </div> 

  <div class="w3-display-bottommiddle" style="padding:24px 48px">
    <div class="row">
      <div class="column">
        <img src="img/unifast.png" alt="unifast"style="width:30vmin;height:30vmin;">  </div>
      <div class="column">
      <img src="img/ched.png" alt="ched" style="width:30vmin;height:30vmin;">  </div>
    </div>
    </div>

  
  </div>
</header>





<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">ABOUT THE SCHOLARSHIP PROGRAM</h3>
  <p class="w3-center w3-large"> According to Arcticle IV section 3 of Student Handbook bla bla bla </p>
<!-- 
  <p><b>Section 3 - Scholarship Grants </p></b>
  <ul>
<p>3.1 Scholarship grants are also available to promising and qualified students subject to the terms and conditions set forth by the Scholarship Committee and the Benefactor.</p>
<p>3.1.1 All applicants for scholarship grants must:</p>
<p> 3.1.1.1 Present a letter from their school principal certifying their rank in the honor roll and indicating the number of graduating students (High School). </p>
<p> 3.1.1.2 be in need of financial help;</p>
<p> 3.1.1.3 not enjoy any other scholarship or privilege; </p>
<p> 3.1.1.4 not engaged in any gainful occupation; </p>
<p> 3.1.1.5 carry the normal load of their curriculum;</p>
<p> 3.1.1.6 not have violated or liable for violation of the Students Code of Discipline. </p>
<p>3.1.1.7 Have a weighted general average of 1.2 during the preceding semester for continuing honor students.</p>
</u>  -->



  <div class="w3-row-padding" style="margin-top:64px">




<!-- ********************************************************************************************* -->
<div class="w3-quarter">
   <div class="w3-card w3-center "><br>
      <img src="img/SCC.png" alt="SCC" style="width:70%">
    <div class="w3-container">
          
  <h3>NON-ACADEMIC Scholarship</h3>

<!-- ----------------start modal----------------- -->
     <button onclick="document.getElementById('idA1').style.display='block'" class="w3-button w3-black">INFORMATION</button>
        <div id="idA1" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-red"> 
              <span onclick="document.getElementById('idA1').style.display='none'" 
                class="w3-button w3-display-topright">&times;</span>
                <p style="font-size:2vmax;">Non-Academic Scholarship </p>
            </header>   

          <div class="w3-container w3-justify" >
            <ol>
            <p><b>Cultural scholarship</p></b>
              <ul>
                <li> Application forms are available from the Scholarship Committee Chairman. </li>
                <li> Applicants must be a Senior High school graduate. </li>
                <li> Applicants must undergo a singing audition from the musical coordinator.  </li>
                <li> Providing guidance and support to student's inquiries </li>
                <li> If the applicant passed the singing audition, he/she can avail the 100% free of tuition fee only. </li>
                <li> Must be of good character. </li>
                <li> He/she must maintain the average grade of 2.5.  </li>
                <li>He/she must follow the rules and regulations of the school. Disobedient of the policies will be ground for termination of scholarship </li>
              </ul>

<p><b>Working Student</p></b>
              <ul>
                <li> Applicant must apply from the Scholarship Committee Chairman. </li>
                <li> He/she is free 100% of the tuition fee only.</li>
             </ul>

             
<p><b>Assistant Teacher</p></b>
              <ul>
                <li> Applicant must secure an application form from the SAO/Chairman </li>
                <li>He/she must be interviewed by the SAO/Chairman. </li>
                <li>Must maintain the average grade of 2.5.</li>
             </ul>
</ol>
           
            <a href="" class="w3-button w3-red w3-block"  href="" >Look for Mr. Gemini S. Daguplo to APPLY </a></p>
          </div>
          
         
          <footer class="w3-container w3-red">
          
   <button class="w3-button w3-right " 
   onclick="document.getElementById('idA1').style.display='none'">Close</button>

          </footer>
       </div>
     </div>
        <p></p>
     </div>
  </div>
</div>
<!-- ---------------------end modal------------- -->
<!-- ********************************************************************************************* -->






<!-- ********************************************************************************************* -->
<div class="w3-quarter">
   <div class="w3-card w3-center "><br>
      <img src="img/SCC.png" alt="SCC" style="width:70%">
    <div class="w3-container">
          
    <h3>ACADEMIC <br> Scholarship</h3>
    <!-- <b> <p style="font-size:12px">Unified Student Financial Assistance System for Tertiary Education</p></b> -->

<!-- ----------------start modal----------------- -->
     <button onclick="document.getElementById('idA2').style.display='block'" class="w3-button w3-black">INFORMATION</button>
        <div id="idA2" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-red"> 
              <span onclick="document.getElementById('idA2').style.display='none'" 
                class="w3-button w3-display-topright">&times;</span>
                <p style="font-size:2vmax;"> ACADEMIC Scholarship </p>
            </header>   


            <div class="w3-container w3-justify" >
        <p><center> St. Cecilia's College grants scholarship to deserving studenst who excel in their studies.</p></center>
      
        <p><b>Qualifications</p></b>
        <ul><li>Honor graduates of public and recognized private schools</li></ul>
        <ol>
        <li><b>Valedictorians</b> in a class of at least 100 graduating students are granted 100% tuition fee priviledge. </li>
        <li><b>Salutatorians</b> in a class of at least 100 graduating students are given 75% discount of the tuition fees only. </li>
        <li><b>Top 10 </b> of the graduating class of not less than 100 students shall avail 50% of the tuition fees only.</b> </li>
        <li>The Academic scholarship may be given for the whole four years of study provided the following conditions are met:</li>
         <ul>
        <li>Free Tuition for one semester for students with an average of 1.0-1.2 with no grade of 2.0 in any subjects in the preceding semester and they are enrolled in at least 24 academic units.</li>
        <li>75% Discount of 75% onn tuition fees for one semester for students with an average of 1.31 -1.5 with no grade lower than 2.0 in any subject in the preceding semester. They must be enrolled in at least 24 academic units .</li>
        <li>50% discounts on tuition fees of half scholarship for one semester for students with an average of 1.31-1.5 with no grade less than 2.0 in any subject in the preceding semester. They must be enrolled in at least 24 academic units.</li>
</ul></ol>
<hr>
<!-- 
            <p><b>Requirements </p></b>
              <ul>
                <li> Mangutana pami </li>
              </ul>   -->
            <p><a href="" class="w3-button w3-red w3-block"  href="" >Look for Mr. Gemini S. Daguplo to APPLY </a></p>
          </div>
         
          <footer class="w3-container w3-red">
          <button class="w3-button w3-right " 
   onclick="document.getElementById('idA2').style.display='none'">Close</button>

          </footer>
       </div>
     </div>
        <p></p>
     </div>
  </div>
</div>
<!-- ---------------------end modal------------- -->
<!-- ********************************************************************************************* -->






<!-- ********************************************************************************************* -->
<div class="w3-quarter">
   <div class="w3-card w3-center "><br>
      <img src="img/ched.png" alt="unifast" style="width:70%">
    <div class="w3-container">
          
  <h3>CHED <br> Scholarship</h3>
    <!-- <b> <p style="font-size:12px">The Commission on Higher Education / Komisyon sa Mas Mataas na Edukasyon </p></b>
 -->

    
<!-- ----------------start modal----------------- -->
     <button onclick="document.getElementById('idA3').style.display='block'" class="w3-button w3-black">INFORMATION</button>
        <div id="idA3" class="w3-modal">
          <div class="w3-modal-content w3-card-4 w3-animate-zoom">
            <header class="w3-container w3-red "> 
              <span onclick="document.getElementById('idA3').style.display='none'" 
                class="w3-button w3-display-topright">&times;</span>
                <p style="font-size:2vmax;"> CHED Scholarship </p>
            </header>   

          <div class="w3-container w3-justify" >
<p> &nbsp &nbsp All incoming college freshmen are invited to apply to the CHED Scholarship Program 2022. CHED Scholarship 2022- StuFAPs aims to provide financial assistance to students who are enrolled in authorized public or private Higher Education Institutions (HEIs). This helps to ensure that education shall be accessible to all especially to underprivileged and deserving students.

Qualified beneficiaries shall enroll or must be currently enrolled in any CHED priority courses as per CMO No. 1 s. 2104 and shall receive financial assistance amounting to Php 15,000 to Php 30,000 per semester whichever program an applicant qualifies.</p>
<hr>
        

            <p><b>What are the Qualifications?</p></b>
            <ol>
                <li> Must be a Filipino citizen</li>
                <li> Graduating high school student or high school graduate with a general average</li>
                <li> General Weighted Average (GWA) </li>
                  <ul>
                    <li> For Full State Scholarship Program (FSSP) and Full Private Education Student Financial Assistance (FPESPA), GWA must be 96% or above. </li>
                    <li> For Half-SSP and Half-PESPA, GWA must be 93% but not more than 95%.</li></ul>
                <li> Must have a combined annual gross income of parents/guardian which does not exceed Four Hundred Thousand Pesos (PhP 400,000), or in cases where the income exceeds PhP 400,000 an applicant must present written certification or medical findings of illness of a family member, or school certifications of two or more dependents enrolled in college;</li>
                <li> Avail of only one government-funded financial assistance program.</li>
              </ol><hr>

            <p><b>What are the CHED Scholarships 2022 Requirments? </p></b>
              <ol type="A">
                <li> Citizenship </li>
                  <ul>
                  <li> A certified true copy of the Birth Certificate.</ul></li>
                <li> Academic </li>
                <ul>
                  <li> Duly certified true copy of High school report card for incoming freshmen students eligible for college (High School Graduate); and</li>
                  <li> Duly certified true copy of grades for Grade 11 and 1st semester of Grade 12 for graduating high school students.</li></ul>
                <li> Financial</li>  
                The student-applicants shall submit any of the following documents:
                <ul>
                <li> Latest Income Tax Return (ITR) of parents or guardian;
                <li> Certificate of Tax Exemption from Bureau of Internal Revenue (BIR);
                <li> Certificate of Indigence either from their Barangay or Department of Social Welfare and Development (DSWD);
                <li> Case Study report from DSWD; or
                <li> Latest copy of contract or proof of income may be considered for children of Overseas Filipino Workers (OFWs) and seafarers.

                </ul>
                </ol>
                    
              
        
              
              </ul>  
              <p>To Know More:  <a href= "https://chedscholarships.com/">CLICK HERE!</a></p>
            <p class="w3-button w3-red w3-block"  href="" >Look for Mr. Gemini S. Daguplo to APPLY </a></p>
          </div>
         
          <footer class="w3-container w3-red">
          <button class="w3-button w3-right " 
   onclick="document.getElementById('idA3').style.display='none'">Close</button>

          </footer>
       </div>
     </div>
        <p></p>
     </div>
  </div>
</div>
<!-- ---------------------end modal------------- -->
<!-- ********************************************************************************************* -->




<!-- ********************************************************************************************* -->
<div class="w3-quarter">
   <div class="w3-card w3-center "><br>
      <img src="img/unifast.png" alt="unifast" style="width:70%">
    <div class="w3-container">       
  <h3>UNIFAST <br> Subsidy</h3>
    <!-- <b> <p style="font-size:12px">Unified Student Financial Assistance System for Tertiary Education</p></b> -->

<!-- ----------------start modal----------------- -->
<?php if(isset($_SESSION["loggedin"])){
	echo "welcome";
	header("location:login.php");
	exit;
} ?>
     <button onclick="document.getElementById('idA4').style.display='block'" class="w3-button w3-black">INFORMATION</button>
     
        <div id="idA4" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-red"> 
              <span onclick="document.getElementById('idA4').style.display='none'" 
                class="w3-button w3-display-topright">&times;</span>
                <p style="font-size:2vmax;">Unified Student Financial Assistance System for Tertiary Education </p>
            </header>   

          <div class="w3-container w3-justify" >
          
<p> &nbsp &nbsp The Unified Financial Assistance System for Tertiary Education Act, or UniFAST — also known as Republic Act No. 10687 — was signed into law in 15 October last year.The Unified Financial Assistance System for Tertiary Education Act, or UniFAST — also known as Republic Act No. 10687 — was signed into law in 15 October last year.UniFAST reconciles, improves, strengthens, expands, and puts under one body all government-funded modalities of Student Financial Assistance Programs (StuFAPs) for tertiary education – and special purpose education assistance – in both public and private institutions. These modalities include scholarships, grants-in-aid, student loans and other specialized forms of StuFAPs formulated by the UniFAST Board.</p>          
    <hr>

<p><b>What are the Qualifications?</p></b>
            <p> &nbsp &nbsp Starting AY 2018-2019, all Filipino undergraduates enrolled in SUCs and CHED-recognized LUCs will enjoy free tuition, miscellaneous, and other school fees, subject to the ff.</p>
              <ul>
                <li> Pass/meet the admission and retention policies of the institution (no age or financial requirements); </li>
                <li> No previous undergraduate degree; and </li>
                <li> Not overstaying at the college level (e.g., maximum residency rule plus one-year grace period as provided by law) </li> 
              </ul> 

<hr>
<p><b>Requirements </p></b>
              <ol>
                <li> 1pc. 2x2 colored picture</li>
                <li> 1pc. Photocopy of NSO|PSA</li>
                <li> Brgy. Residency (Minglanilla) </li>
                
              </ol>
           
              <p>To Know More: <a href="scholarship/UnifastApply.php" >CLICK HERE!</a></p>
  <button  class="w3-button w3-red w3-block" onclick="window.location.href='NewStudent/unifast.php';"> APPLY NOW!
               </div>
               <br>
          <footer class="w3-container w3-red">
          <button class="w3-button w3-right " 
   onclick="document.getElementById('idA4').style.display='none'">Close</button>

          </footer>
       </div>
     </div>
        <p></p>
     </div>
  </div>
</div></div>
<!-- ---------------------end modal------------- -->
<!-- ********************************************************************************************* -->




<br><br>
<!-- Promo Section "Statistics" -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
  <div class="w3-quarter">
    <span class="w3-xxlarge">509+</span>
    <br> Working Scholar
  </div>
  <div class="w3-quarter">
    <span class="w3-xxlarge">987+</span>
    <br>Academic Scholar
  </div>
  <div class="w3-quarter">
    <span class="w3-xxlarge">1900+</span>
    <br>CHED Scholar
  </div>
  <div class="w3-quarter">
    <span class="w3-xxlarge">1090+</span>
    <br>Unifast 
  </div>
</div>







<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
  <h3 class="w3-center">MARKETING AND SCHOLARSHIP DEPARTMENT</h3>
  <p class="w3-center w3-large">Hello Cecilians!
  Here are the following personnel under Marketing & Scholarship Department together with their duties and responsibilities.
  This way you will be able to identify where to address your scholarship concerns and inquiries.
 <br> The Scholarship Office is located at Mezzanine Room 108 near quadrangle.
<br><br>
  ALLEVO!
  </p>

  <div class="w3-row-padding" style="margin-top:64px">


<!---------------------------------------------------------Start DAGUPLO------------------------------------------------------------------>
 
<div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-card">
        <img src="img/team/DAGUPLO.jpg" alt="John" style="width:100%">
        <div class="w3-container">
          <h3>Mr. Gemini S. <br> Daguplo</h3>
          <p style="font-size:2.5vh" class="w3-opacity">Marketing & Scholarship Head</p>

<!-- Mr. Gemini S. Daguplo  modal -->
   <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Duties & Responsibilities</button>
     <div id="id01" class="w3-modal">
       <div class="w3-modal-content w3-card-4">
        <header class="w3-container w3-red"> 
          <span onclick="document.getElementById('id01').style.display='none'" 
           class="w3-button w3-display-topright">&times;</span>
           <p style="font-size:2vmax;">MARKETING AND SCHOLARSHIP DEPARTMENT</p>
         </header>   

       <div class="w3-container" >
	        <div class="w3-third">
            <img src="img/team/DAGUPLO.jpg" alt="Dan" style="padding:20px"  style="width:30%">
	        
          </div>
        <div class="w3-twothird w3-container">
           <h3>Mr. Gemini S. Daguplo - Marketing Office & Scholarship Head</h3>
            <p><b>Duties & Responsibilities.</p></b>
              <ul>
                <li> Crafting strategies for all Marketing teams, including Digital, Advertising, Communications</li>
                <li> Ensuring brand message and consistent across all channels and Marketing efforts in school</li>
                <li> Conducting career guidance talk in different schools to promote and its privileges </li>
                <li> Providing guidance and support to student's inquiries </li>
                <li> Focal Person in an organization specifically in government entities</li>
                <li> Implementing scholarship policies and agreements</li>
              </ul>
            <p><b>Where to contact? </p></b>
                <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope "></i> &nbsp 09190272108</button></p>

             </div>
            </div>
          <footer class="w3-container w3-red">
            <p></p>
          </footer>
       </div>
     </div>
        <p></p>
     </div>
    </div>
    </div>

<!---------------------------------------------------------END DAGUPLO--------------------------------------------------------------- -->
   

<!---------------------------------------------------------Start Secretary--------------------------------------------------------------- -->
<div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-card">
        <img src="img/team/HERUELA.jpg"  alt="Jane" style="width:100%">
        <div class="w3-container">
          <h3>Ms. Gabrielle B. Heruela</h3>
          <p style="font-size:2.5vh" class="w3-opacity">Marketing & Scholarship Secretary</p>
       
       
<!-- Ms. Gabrielle B. Heruela modal -->
<button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">Duties & Responsibilities</button>
    

<div id="id02" class="w3-modal">
       <div class="w3-modal-content w3-card-4">
        <header class="w3-container w3-red"> 
          <span onclick="document.getElementById('id02').style.display='none'" 
           class="w3-button w3-display-topright">&times;</span>
           <p style="font-size:2vmax;">MARKETING AND SCHOLARSHIP DEPARTMENT</p>
         </header>   

       <div class="w3-container" >
	        <div class="w3-third">
            <img src="img/team/HERUELA.jpg" alt="Dan" style="padding:20px"  style="width:30%">
	        </div>
        <div class="w3-twothird w3-container">
           <h3>Ms. Gabrielle B. Heruela - Marketing & Scholarship Secretary</h3>
            <p><b>Duties & Responsibilities.</p></b>
              <ul>
                <li> Preparing and processing scholarship application for students </li>
                <li> Performing clerical duties for school  administartion in terms of Validation, Billing, and Liquidation Requirements </li>
                <li> Communicating with parents and students in terms of scholarship guidelines and its requirements </li>
                <li> Providing information and upcoming announcements </li>
                <li> Answering and coordinating sholarship concerns and inquies</li>
                <li> Compliling data from a variety of  sources such as manual records and government entities </li>
</ul>
<p><b>Where to contact? </p></b>
                <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope "></i> &nbsp 09190727106</button></p>

        </div>
       </div>
          <footer class="w3-container w3-red">
            <p></p>
          </footer>

          
       </div>
     </div>
        <p></p>
     </div>
    </div>
    </div>
 
<!---------------------------------------------------------End Secretary--------------------------------------------------------------- -->
   

<!---------------------------------------------------------Start DEIPARINE--------------------------------------------------------------- -->
   
<div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-card">
        <img src="img/team/DEIPARINE.jpg" alt="Mike" style="width:100%">
        <div class="w3-container">
          <h3>Mr. James D. <br> Deiparine</h3>
          <p class="w3-opacity">Marketing Officer</p>


<!-- Deiparine modal -->
<button onclick="document.getElementById('id03').style.display='block'" class="w3-button w3-black">Duties & Responsibilities</button>
     <div id="id03" class="w3-modal">
       <div class="w3-modal-content w3-card-4">
        <header class="w3-container w3-red"> 
          <span onclick="document.getElementById('id03').style.display='none'" 
           class="w3-button w3-display-topright">&times;</span>
           <p style="font-size:2vmax;">MARKETING AND SCHOLARSHIP DEPARTMENT</p>
         </header>   

       <div class="w3-container" >
	        <div class="w3-third">
            <img src="img/team/DEIPARINE.jpg" alt="Dan" style="padding:20px"  style="width:30%">
	        </div>
        <div class="w3-twothird w3-container">
           <h3>Mr. James D. Deiparine - Marketing Officer</h3>
            <p><b>Duties & Responsibilities.</p></b>
              <ul>
                <li> Supporting the Marketing head in overseeing the department's operations</li>
                <li> Contributing the implementation of marketing strategies.</li>
                <li> Organizing and attending marketing activities or events for the school's advancement.</li>
                <li> Managing and developing marketing campaigns</li>
                <li> Evaluating the effectiveness of campaigns and strategies.</li>
                </ul>
            <p><b>Where to contact? </p></b>
                <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope "></i> &nbsp 09615271790</button></p>
                <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope "></i> &nbsp 09750775198</button></p>
             </div>
            </div>
          <footer class="w3-container w3-red">
            <p></p>
          </footer>
       </div>
     </div>
        <p></p>
     </div>
    </div>
    </div>



<!---------------------------------------------------------END DEIPARINE--------------------------------------------------------------- -->
   

<!---------------------------------------------------------Start CUTAS--------------------------------------------------------------- -->
<div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-card">
        <img src="img/team/CUTAS.jpg" alt="Dan" style="width:100%">
        <div class="w3-container">
          <h3>Mr. Jericho Vicente A. Cutas</h3>
          <p style="font-size:2.5vh" class="w3-opacity">Marketing Officer</p>


<!-- Ms. Gabrielle B. Heruela modal -->
   <button onclick="document.getElementById('id04').style.display='block'" class="w3-button w3-black">Duties & Responsibilities</button>
     <div id="id04" class="w3-modal">
       <div class="w3-modal-content w3-card-4">
        <header class="w3-container w3-red"> 
          <span onclick="document.getElementById('id04').style.display='none'" 
           class="w3-button w3-display-topright">&times;</span>
           <p style="font-size:2vmax;">MARKETING AND SCHOLARSHIP DEPARTMENT</p>
         </header>   

       <div class="w3-container" >
	        <div class="w3-third">
            <img src="img/team/CUTAS.jpg" alt="Dan" style="padding:20px"  style="width:30%">
	        </div>
        <div class="w3-twothird w3-container">
           <h3>Mr. Jericho Vicente A. Cutas - Marketing Officer</h3>
            <p><b>Duties & Responsibilities.</p></b>
              <ul>
                <li> Supporting the Marketing head in overseeing the department's operations</li>
                <li> Contributing the implementation of marketing strategies.</li>
                <li> Organizing and attending marketing activities or events for the school's advancement.</li>
                <li> Managing and developing marketing campaigns</li>
                <li> Evaluating the effectiveness of campaigns and strategies.</li>

                </ul>
            <p><b>Where to contact? </p></b>
                <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope "></i> &nbsp 09190272107</button></p>

             </div>
            </div>
          <footer class="w3-container w3-red">
            <p></p>
          </footer>
       </div>
     </div>
        <p></p>
     </div>
    </div>
    </div>

<!---------------------------------------------------------END CUTAS--------------------------------------------------------------- -->
   
   
</div>
 
</div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
<h1>EYES HERE!</h1> 

<h3>The Submition of scholarship application will end this Septermber 3, 2022. </h3>
<br>
<h3>Allevo!</h3>
<br>


  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  <p><a target="_blank" class="w3-hover-text-green">St. Cecilia's College Cebu-Inc.</a></p>
</footer>





<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
