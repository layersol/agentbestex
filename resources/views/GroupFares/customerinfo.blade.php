@include('layouts.header')

<div class="bodyload" style="margin-top:80px;display:none">
 <div class="rotatingDiv"></div>
</div>
<style>
/* Global Styles */


.dob-invalid select {
    border-color: red !important;
    position: relative;
}

.dob-invalid select:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    top: -30px; /* adjust above the select */
    left: 0;
    background: red;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8em;
    white-space: nowrap;
    z-index: 1000;
}



/* Card Styles */
.card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  padding: 25px;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
}

/* Traveller Section */
.traveller-header {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 15px;
}

.traveller-section h4 {
  margin-top: 15px;
  font-size: 16px;
  font-weight: 600;
  color: #000000ff;
}

.form-group {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  margin-bottom: 15px;
}

.form-group input,
.form-group select {
  flex: 1;
  min-width: 140px;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  background: #fafafa;
  transition: all 0.2s;
}

.form-group input:focus,
.form-group select:focus {
  border-color: #007bff;
  outline: none;
  background: #fff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

/* Right Summary Section */
.summary-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.summary-header .timer {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #333;
  font-weight: 600;
  font-size: 15px;
}

.timer span {
  color: red;
}

.flight-box {
  background: #007bff;
  border-radius: 10px;
  padding: 20px;
  color: white;
  text-align: center;
}

.flight-box img {
  width: 70px;
  margin-bottom: 10px;
}

.flight-box h4 {
  font-size: 18px;
  font-weight: 600;
  margin: 10px 0;
}

.flight-box p {
  font-size: 13px;
  margin: 4px 0;
}

.flight-info {
  display: flex;
  justify-content: space-around;
  border-top: 1px solid rgba(255,255,255,0.3);
  margin-top: 10px;
  padding-top: 10px;
  font-size: 13px;
}

.price-card {
  background: #f8f9fa;
  margin-top: 20px;
  padding: 15px;
  border-radius: 8px;
  font-size: 14px;
}

.price-card input {
  width: 100%;
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-top: 5px;
}

.price-card strong {
  color: #007bff;
}

/* Responsive Layout */
@media (max-width: 992px) {
  .container {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 600px) {
  body {
    padding: 10px;
  }

  .card {
    padding: 15px;
  }

  .form-group {
    flex-direction: column;
    gap: 10px;
  }

  .flight-box {
    padding: 15px;
  }

  .flight-info {
    flex-direction: column;
    gap: 5px;
  }

  .summary-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
  }
}
</style>

<main>





<div class="row">
    <div class="col-lg-8">
   <form action="{{ route('booking.confirmed') }}" method="POST">
  @csrf
 <div class="card traveller-section">
    <div class="traveller-header">Travellers Information</div>
<?php

    $itiniery = json_decode($bookingData['data']['flight']);

?>
<?php

if ($bookingData['passengers'] > 0) {?>

<input type="hidden" name="flight" value='<?php echo ($bookingData['data']['flight'])?>'>




<input type="hidden" name="totalseat" value='<?=$bookingData['data']['adult_count']+$bookingData['data']['child_count']?>'>



<input type="hidden" name="originalPrice" value="<?php echo (string) $bookingData['data']['total_fare']?>">


@foreach ($bookingData['passengers'] as $groupIndex => $group)


    @foreach ($group as $index => $traveller)
        <div class="traveller-form">


             <h4>{{ ucfirst($traveller['type']) }} Traveller {{ $index + 1 }}</h4>
    <div class="form-group">
      <select name="title[]" required><option>Mr</option><option>Ms</option><option>Mrs</option></select>
      <input type="text" name="firstname[]" placeholder="First Name" required>
      <input type="text" name="lastname[]" placeholder="Last Name" required>
    </div>
   <div class="row mt-1 g-2">
               <div class="col-md-6">
                  <div class="form-floating">
                     <select id="t-nationality-1" class="form-select nationality" name="nationality[]" required>
                                                <option value=""> Select</option>
<option value="AF">Afghanistan</option>
<option value="AX">Aland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia, Plurinational State of</option>
<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, the Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote d'Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CW">Curacao</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and McDonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
<option value="MK">Macedonia, the former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="BL">Saint Barthelemy</option>
<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="MF">Saint Martin (French part)</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SX">Sint Maarten (Dutch part)</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="SS">South Sudan</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela, Bolivarian Republic of</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
                     </select>
                     <label class="label-text">Nationality</label>
                  </div>
                   <div id="error-t-nationality-1" style="display: none;" class="invalid-feedback">
                   </div>
               </div>
               <div class="col-md-6">
                  <div class="row g-2">
                     <div class="col-5">
                        <div class="form-floating">
                           <select class="form-select form-select" name="dob_month[]" required>
                                                            <!-- <option value="1">Month</option> -->
                              <option value="01">01 Jan</option>
<option value="02">02 Feb</option>
<option value="03">03 Mar</option>
<option value="04">04 Apr</option>
<option value="05">05 May</option>
<option value="06">06 Jun</option>
<option value="07">07 Jul</option>
<option value="08">08 Aug</option>
<option value="09">09 Sep</option>
<option value="10">10 Oct</option>
<option value="11">11 Nov</option>
<option value="12">12 Dec</option>
                           </select>
                           <label class="label-text">Date of Birth</label>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="form-floating">
                           <select name="dob_day[]" class="form-select form-select" required>
                           <option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
                           </select>
                           <label class="label-text">Day</label>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-floating">
                           <select class="form-select form-select" id="<?php echo $traveller['type'] . '_' . $index + 1?>" name="dob_year[]" required>
                                                      <option value="2025">2025</option>                             
                                                      <option value="2024">2024</option>                                                      
                                                      <option value="2023">2023</option>                                                      
                                                      <option value="2022">2022</option>                                                      
                                                      <option value="2021">2021</option>                                                      
                                                      <option value="2020">2020</option>                                                      
                                                      <option value="2019">2019</option>                                                      
                                                      <option value="2018">2018</option>                                                      
                                                      <option value="2017">2017</option>                                                      
                                                      <option value="2016">2016</option>                                                      
                                                      <option value="2015">2015</option>                                                     
                                                       <option value="2014">2014</option>                                                     
                                                        <option value="2013">2013</option>                                                      
                                                        <option value="2012">2012</option>                                                      
                                                        <option value="2011">2011</option>                                                      
                                                        <option value="2010">2010</option>                                                      
                                                        <option value="2009">2009</option>                                                      
                                                        <option value="2008">2008</option>                                                      
                                                        <option value="2007">2007</option>                                                      
                                                        <option value="2006">2006</option>                                                      
                                                        <option value="2005">2005</option>                                                      
                                                        <option value="2004">2004</option>                                                      
                                                        <option value="2003">2003</option>                                                      
                                                        <option value="2002">2002</option>                                                      
                                                        <option value="2001">2001</option>                                                      
                                                        <option value="2000">2000</option>                                                      
                                                        <option value="1999">1999</option>                                                      
                                                        <option value="1998">1998</option>                                                      
                                                        <option value="1997">1997</option>                                                      
                                                        <option value="1996">1996</option>                                                      
                                                        <option value="1995">1995</option>                                                      
                                                        <option value="1994">1994</option>                                                      
                                                        <option value="1993">1993</option>                                                      
                                                        <option value="1992">1992</option>                                                      
                                                        <option value="1991">1991</option>                                                      
                                                        <option value="1990">1990</option>                                                      
                                                        <option value="1989">1989</option>                                                      
                                                        <option value="1988">1988</option>                                                      
                                                        <option value="1987">1987</option>                                                      
                                                        <option value="1986">1986</option>                                                      
                                                        <option value="1985">1985</option>                                                      
                                                        <option value="1984" selected="selected">1984</option>                                                      <option value="1983">1983</option>                                                      <option value="1982">1982</option>                                                      <option value="1981">1981</option>                                                      <option value="1980">1980</option>                                                      <option value="1979">1979</option>                                                      <option value="1978">1978</option>                                                      <option value="1977">1977</option>                                                      <option value="1976">1976</option>                                                      <option value="1975">1975</option>                                                      <option value="1974">1974</option>                                                      <option value="1973">1973</option>                                                      <option value="1972">1972</option>                                                      <option value="1971">1971</option>                                                      <option value="1970">1970</option>                                                      <option value="1969">1969</option>                                                      <option value="1968">1968</option>                                                      <option value="1967">1967</option>                                                      <option value="1966">1966</option>                                                      <option value="1965">1965</option>                                                      <option value="1964">1964</option>                                                      <option value="1963">1963</option>                                                      <option value="1962">1962</option>                                                      <option value="1961">1961</option>                                                      <option value="1960">1960</option>                                                      <option value="1959">1959</option>                                                      <option value="1958">1958</option>                                                      <option value="1957">1957</option>                                                      <option value="1956">1956</option>                                                      <option value="1955">1955</option>                                                      <option value="1954">1954</option>                                                      <option value="1953">1953</option>                                                      <option value="1952">1952</option>                                                      <option value="1951">1951</option>                                                      <option value="1950">1950</option>                                                      <option value="1949">1949</option>                                                      <option value="1948">1948</option>                                                      <option value="1947">1947</option>                                                      <option value="1946">1946</option>                                                      <option value="1945">1945</option>                                                      <option value="1944">1944</option>                                                      <option value="1943">1943</option>                                                      <option value="1942">1942</option>                                                      <option value="1941">1941</option>                                                      <option value="1940">1940</option>                                                      <option value="1939">1939</option>                                                      <option value="1938">1938</option>                                                      <option value="1937">1937</option>                                                      <option value="1936">1936</option>                                                      <option value="1935">1935</option>                                                      <option value="1934">1934</option>                                                      <option value="1933">1933</option>                                                      <option value="1932">1932</option>                                                      <option value="1931">1931</option>                                                      <option value="1930">1930</option>                                                      <option value="1929">1929</option>                                                      <option value="1928">1928</option>                                                      <option value="1927">1927</option>                                                      <option value="1926">1926</option>                                                      <option value="1925">1925</option>                                                      <option value="1924">1924</option>                                                      <option value="1923">1923</option>                                                      <option value="1922">1922</option>                                                      <option value="1921">1921</option>                                                      <option value="1920">1920</option>                                                      </select>
                           <label class="label-text">Year</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <hr>
<div class="row g-2">
               <div class="col-md-12">
                  <p class="m-0 text-end" style="position: absolute; z-index: 99; right: 32px; color: #b2b2b2; margin: 16px !important;"><small><strong>6 - 15 Numbers</strong></small></p>
                  <div class="form-floating">
                     <input type="text" id="t-passport-1" name="passport[]" class="form-control" placeholder="Passport or ID Number" value="" >
                     <label class="label-text">Passport or ID Number</label>
                  </div>
                   <div id="error-t-passport-1" style="display: none;" class="invalid-feedback">
                   </div>

               </div>
               <div class="col-md-6 mt-3">
                  <div class="row g-2">
                     <div class="col-5">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_issuance_month[]">
                                                            <!-- <option value="1">Month</option> -->
                              <option value="01">01 Jan</option>
<option value="02">02 Feb</option>
<option value="03">03 Mar</option>
<option value="04">04 Apr</option>
<option value="05">05 May</option>
<option value="06">06 Jun</option>
<option value="07">07 Jul</option>
<option value="08">08 Aug</option>
<option value="09">09 Sep</option>
<option value="10">10 Oct</option>
<option value="11">11 Nov</option>
<option value="12">12 Dec</option>
                           </select>
                           <label class="label-text"> Issuance Date</label>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_issuance_day[]">
                           <option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
                           </select>
                           <label class="label-text">Day</label>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_issuance_year[]">
                                                      <option value="2025">2025</option>
                                                      <option value="2024">2024</option>                                                      <option value="2023">2023</option>                                                      <option value="2022">2022</option>                                                      <option value="2021">2021</option>                                                      <option value="2020" selected="selected">2020</option>                                                      <option value="2019">2019</option>                                                      <option value="2018">2018</option>                                                      <option value="2017">2017</option>                                                      <option value="2016">2016</option>                                                      <option value="2015">2015</option>                                                      <option value="2014">2014</option>                                                      <option value="2013">2013</option>                                                      <option value="2012">2012</option>                                                      <option value="2011">2011</option>                                                      <option value="2010">2010</option>                                                      <option value="2009">2009</option>                                                      <option value="2008">2008</option>                                                      <option value="2007">2007</option>                                                      <option value="2006">2006</option>                                                      <option value="2005">2005</option>                                                      <option value="2004">2004</option>                                                      <option value="2003">2003</option>                                                      <option value="2002">2002</option>                                                      <option value="2001">2001</option>                                                      <option value="2000">2000</option>                                                      <option value="1999">1999</option>                                                      <option value="1998">1998</option>                                                      <option value="1997">1997</option>                                                      <option value="1996">1996</option>                                                      <option value="1995">1995</option>                                                      <option value="1994">1994</option>                                                      <option value="1993">1993</option>                                                      <option value="1992">1992</option>                                                      <option value="1991">1991</option>                                                      <option value="1990">1990</option>                                                      <option value="1989">1989</option>                                                      <option value="1988">1988</option>                                                      <option value="1987">1987</option>                                                      <option value="1986">1986</option>                                                      <option value="1985">1985</option>                                                      <option value="1984">1984</option>                                                      <option value="1983">1983</option>                                                      <option value="1982">1982</option>                                                      <option value="1981">1981</option>                                                      <option value="1980">1980</option>                                                      <option value="1979">1979</option>                                                      <option value="1978">1978</option>                                                      <option value="1977">1977</option>                                                      <option value="1976">1976</option>                                                      <option value="1975">1975</option>                                                      <option value="1974">1974</option>                                                      <option value="1973">1973</option>                                                      <option value="1972">1972</option>                                                      <option value="1971">1971</option>                                                      <option value="1970">1970</option>                                                      <option value="1969">1969</option>                                                      <option value="1968">1968</option>                                                      <option value="1967">1967</option>                                                      <option value="1966">1966</option>                                                      <option value="1965">1965</option>                                                      <option value="1964">1964</option>                                                      <option value="1963">1963</option>                                                      <option value="1962">1962</option>                                                      <option value="1961">1961</option>                                                      <option value="1960">1960</option>                                                      <option value="1959">1959</option>                                                      <option value="1958">1958</option>                                                      <option value="1957">1957</option>                                                      <option value="1956">1956</option>                                                      <option value="1955">1955</option>                                                      <option value="1954">1954</option>                                                      <option value="1953">1953</option>                                                      <option value="1952">1952</option>                                                      <option value="1951">1951</option>                                                      <option value="1950">1950</option>                                                      <option value="1949">1949</option>                                                      <option value="1948">1948</option>                                                      <option value="1947">1947</option>                                                      <option value="1946">1946</option>                                                      <option value="1945">1945</option>                                                      <option value="1944">1944</option>                                                      <option value="1943">1943</option>                                                      <option value="1942">1942</option>                                                      <option value="1941">1941</option>                                                      <option value="1940">1940</option>                                                      <option value="1939">1939</option>                                                      <option value="1938">1938</option>                                                      <option value="1937">1937</option>                                                      <option value="1936">1936</option>                                                      <option value="1935">1935</option>                                                      <option value="1934">1934</option>                                                      <option value="1933">1933</option>                                                      <option value="1932">1932</option>                                                      <option value="1931">1931</option>                                                      <option value="1930">1930</option>                                                      <option value="1929">1929</option>                                                      <option value="1928">1928</option>                                                      <option value="1927">1927</option>                                                      <option value="1926">1926</option>                                                      <option value="1925">1925</option>                                                      <option value="1924">1924</option>                                                      <option value="1923">1923</option>                                                      <option value="1922">1922</option>                                                      <option value="1921">1921</option>                                                      <option value="1920">1920</option>                                                      </select>
                           <label class="label-text">Year</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 mt-3">
                  <div class="row g-2">
                     <div class="col-5">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_month_expiry[]">
                                                            <!-- <option value="1">Month</option> -->
                              <option value="01">01 Jan</option>
<option value="02">02 Feb</option>
<option value="03">03 Mar</option>
<option value="04">04 Apr</option>
<option value="05">05 May</option>
<option value="06">06 Jun</option>
<option value="07">07 Jul</option>
<option value="08">08 Aug</option>
<option value="09">09 Sep</option>
<option value="10">10 Oct</option>
<option value="11">11 Nov</option>
<option value="12">12 Dec</option>
                           </select>
                           <label class="label-text">Expiry Date</label>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_day_expiry[]">
                           <option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
                           </select>
                           <label class="label-text">Day</label>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-floating">
                           <select class="form-select form-select" name="passport_year_expiry[]">
                                                      <option value="2045">2045</option>                                                      <option value="2044">2044</option>                                                      <option value="2043">2043</option>                                                      <option value="2042">2042</option>                                                      <option value="2041">2041</option>                                                      <option value="2040">2040</option>                                                      <option value="2039">2039</option>                                                      <option value="2038">2038</option>                                                      <option value="2037">2037</option>                                                      <option value="2036">2036</option>                                                      <option value="2035">2035</option>                                                      <option value="2034">2034</option>                                                      <option value="2033">2033</option>                                                      <option value="2032">2032</option>                                                      <option value="2031">2031</option>                                                      <option value="2030">2030</option>                                                      <option value="2029">2029</option>                                                      <option value="2028">2028</option>                                                      <option value="2027" selected="selected">2027</option>                                                      <option value="2026">2026</option>                                                      <option value="2025">2025</option>                                                      </select>
                           <label class="label-text">Year</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <hr>
            <div class="row g-2">
               <div class="col-md-6">
                  <div class="">
                  <label class="label-text"><small style="font-size:12px">Email Traveller 1</small></label>
                     <input id="t-email-1" type="text" name="email[]" class="form-control py-2" placeholder="Email Address" value="" required>
                     </div>
                   <div id="error-t-email-1" style="display: none;" class="invalid-feedback">
                   </div>
               </div>
               <div class="col-md-6">
                  <div class="">
                  <label class="label-text"><small style="font-size:12px">Phone Traveller 1</small></label>
                     <input id="t-phone-1" type="text" name="phone[]" class="form-control py-2" placeholder="Phone" value="" required>
                     </div>
                   <div id="error-t-phone-1" style="display: none;" class="invalid-feedback">
                   </div>
               </div>
            </div>
             </div>






    @endforeach
@endforeach

<?php }?>








  </div>
<div class="form-box mt-2">
   <div class="form-title-wrap">
      <h3 class="title">Payment Methods</h3>
   </div>
   <div class="form-content">
      <div class="section-tab check-mark-tab text-center pb-4">
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <div class="row g-1 w-100">


                                       <script>
                            window.onload = function() {
                                document.getElementById("gateway_wallet_balance").checked = true;
                            };
                        </script>
                                            <script>
                            window.onload = function() {
                                document.getElementById("gateway_wallet_balance").checked = true;
                            };
                        </script>
                                            <script>
                            window.onload = function() {
                                document.getElementById("gateway_wallet_balance").checked = true;
                            };
                        </script>
                                   <label class="nav-item col-md-6 form-check-label nav-item gateway_wallet_balance" for="gateway_wallet_balance" role="presentation">
                  <div class="col-md-12 mb-1 gateway_wallet_balance">
                     <div id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false" class=" nav-link ripple form-check nav-link p-2 px-3 m-1 d-flex border waves-effect" style="justify-content: space-between;border-radius: 4px !important;" tabindex="-1">
                        <div class="d-flex mb-2 input justify-content-start gap-3 align-items-center">
                           <input class="form-check-input mx-auto" type="radio" name="payment_gateway" id="gateway_wallet_balance" value="wallet_balance" required="">
                           <span class="d-block pt-2 text-capitalize">
                           Pay With                            <strong>wallet balance</strong></span>
                        </div>
                        <div class="d-block">
                           <img src="https://agentbestex.com/assets/img/gateways/wallet_balance.png" style="max-height:40px;background:transparent" alt="Wallet Balance">
                        </div>
                     </div>
                  </div>
               </label>
                           </div>
         </ul>
      </div>




         </div>
      <style>
         .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
         background:#fff;
         color: var(--theme-bg) !important;
         border: 1px solid var(--theme-bg) !important
         }
      </style>
   </div>
   <div class="col-lg-12">
                     <div class="input-box">
                        <div class="">
                           <div class="d-flex gap-3 alert border">
                              <input class="form-check-input" type="checkbox" id="agreechb" onchange="document.getElementById('booking').disabled = !this.checked;">
                              <label for="agreechb"> I agree to all<a target="_blank" href="https://agentbestex.com/page/terms-of-use" class=" waves-effect"> &nbsp; Terms &amp; Condition</a></label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-12 mb-5">
                     <div class="btn-box mt-3">
                        <button style="height:50px" class="btn btn-primary w-100 btn-lg book waves-effect" type="submit" id="booking" disabled=""> Booking Confirm</button>
                     </div>
                  </div>
                  </form>
</div>


<div class="col-lg-4">
                  <div class="sticky-top mb-5">


    <div class="d-flex justify-content-between p-3 mb-2 border rounded-3 bg-white">
        <div class="d-flex gap-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6316 8.40423L19.5895 7.45788C19.7877 7.25988 19.8991 6.99134 19.8991 6.71132C19.8991 6.43131 19.7877 6.16276 19.5895 5.96476C19.3913 5.76676 19.1225 5.65552 18.8422 5.65552C18.5618 5.65552 18.293 5.76676 18.0948 5.96476L17.1474 6.92162C15.6722 5.78164 13.8599 5.16313 11.9948 5.16313C10.1297 5.16313 8.31737 5.78164 6.84216 6.92162L5.88427 5.95424C5.68466 5.75624 5.41448 5.64556 5.13318 5.64655C4.85188 5.64753 4.58248 5.7601 4.38427 5.9595C4.18606 6.1589 4.07525 6.42878 4.07624 6.70978C4.07723 6.99078 4.18992 7.25988 4.38953 7.45788L5.35795 8.41475C4.20323 9.88426 3.57668 11.6989 3.57901 13.5671C3.57557 14.9082 3.89318 16.2307 4.50535 17.4243C5.11752 18.6178 6.0065 19.6479 7.09816 20.4286C8.18981 21.2092 9.4525 21.7178 10.7809 21.912C12.1093 22.1061 13.465 21.9802 14.7347 21.5447C16.0045 21.1092 17.1517 20.3767 18.0805 19.4083C19.0093 18.44 19.6929 17.2638 20.0743 15.9779C20.4556 14.6921 20.5236 13.3337 20.2727 12.0163C20.0217 10.6988 19.4591 9.46036 18.6316 8.40423ZM12.0001 19.8761C10.7509 19.8761 9.52982 19.5061 8.49119 18.8128C7.45257 18.1196 6.64306 17.1342 6.16503 15.9814C5.687 14.8286 5.56193 13.5601 5.80563 12.3363C6.04932 11.1124 6.65084 9.98829 7.53412 9.10596C8.4174 8.22363 9.54277 7.62276 10.7679 7.37933C11.9931 7.13589 13.2629 7.26083 14.417 7.73834C15.5711 8.21586 16.5575 9.02449 17.2514 10.062C17.9454 11.0995 18.3159 12.3193 18.3159 13.5671C18.3159 15.2403 17.6504 16.8451 16.466 18.0282C15.2816 19.2114 13.6751 19.8761 12.0001 19.8761ZM9.8948 4.10361H14.1053C14.3845 4.10361 14.6522 3.99282 14.8496 3.79563C15.0471 3.59844 15.158 3.33098 15.158 3.05211C15.158 2.77323 15.0471 2.50578 14.8496 2.30859C14.6522 2.11139 14.3845 2.00061 14.1053 2.00061H9.8948C9.61562 2.00061 9.34788 2.11139 9.15047 2.30859C8.95307 2.50578 8.84216 2.77323 8.84216 3.05211C8.84216 3.33098 8.95307 3.59844 9.15047 3.79563C9.34788 3.99282 9.61562 4.10361 9.8948 4.10361ZM13.0527 10.4126C13.0527 10.1337 12.9418 9.86627 12.7444 9.66907C12.547 9.47188 12.2792 9.3611 12.0001 9.3611C11.7209 9.3611 11.4531 9.47188 11.2557 9.66907C11.0583 9.86627 10.9474 10.1337 10.9474 10.4126V12.3999C10.7091 12.6129 10.5411 12.8931 10.4657 13.2035C10.3902 13.5139 10.4109 13.8399 10.5251 14.1383C10.6392 14.4367 10.8413 14.6935 11.1047 14.8746C11.368 15.0558 11.6803 15.1528 12.0001 15.1528C12.3198 15.1528 12.6321 15.0558 12.8955 14.8746C13.1588 14.6935 13.361 14.4367 13.4751 14.1383C13.5892 13.8399 13.6099 13.5139 13.5345 13.2035C13.459 12.8931 13.291 12.6129 13.0527 12.3999V10.4126Z" fill="#1882FF"></path></svg>
        <p class="m-0">Time Remaining</p>
        </div>
        <h4 class="m-0"><strong id="timer">09:43</strong></h4>
    </div>

    <script>

        $(function() {
        let seconds = 600; // 10 minutes in seconds
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            timerElement.textContent = (m < 10 ? '0' + m : m) + ':' + (s < 10 ? '0' + s : s);

            if (--seconds < 0) {
                    clearInterval(interval);
                    window.location.href = 'https://agentbestex.com/'; // Replace with your URL
            }
        }

        // Update immediately and then every second
        updateTimer();
        const interval = setInterval(updateTimer, 1000);
        });

    </script>


                     <!-- ONEWAY FLIGHT -->
                     <div class="form-box booking-detail-form mb-2">
                        <div class="form-title-wrap p-3">
                           <h6 class="text-capitalize m-0">Oneway Flight Details</h6>
                        </div>
                        <div class="form-content">
                           <div class="card-item shadow-none radius-none mb-0">
                                                            <div class="row g-2">
                                 <div class="col-md-3">
                                    <img class="w-100" src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?php echo strtoupper($itiniery->airline_code) ?>.svg" style="background: #fff; border-radius: 5px; padding: 7px; margin-bottom: 13px;height: 75px;">
                                 </div>
                                 <div class="col-md-9">

                              <li class="fs-6 d-flex align-items-center gap-1 ">
                                 <span class="text-white w-100" style="line-height: 16px">
                                    <strong class="d-flex align-items-center gap-2 justify-content-between">
                                       <div>

                                          <?php echo strtoupper($itiniery->departure_airport) ?>
                                          <small class="d-block time">
                                            <?php echo date('h:i A', strtotime($itiniery->departure_time)) ?>


                                          </small>
                                       </div>
                                       <svg style="min-width:50px;margin-top:18px;" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M5 12h13M12 5l7 7-7 7"></path>
                                       </svg>
                                       <div class="text-end">
                                       <?php echo strtoupper($itiniery->arrival_airport) ?>

                                         <small class="d-block time">
                                          <?php echo date('h:i A', strtotime($itiniery->arrival_time)) ?>
                                        </small>
                                       </div>
                                    </strong>
                                 </span>
                              </li>
                              <ul class="list-items list-items-2 py-3 pb-0 pt-0">
                                 <li class="d-flex mt-1 gap-1">
                                    <ul class="mx-0 w-100 mb-2">
                                      <li class="lh-1 mt-0 d-flex justify-content-between">
                                          <div class="color-light">Flight</div>
                                          <div class=""><?php echo $itiniery->number ?></div>
                                       </li>

                                        <li class="lh-1 mt-2 d-flex justify-content-between">
                                          <div class="color-light">Airline</div>
                                          <div class=""><?php echo $itiniery->airline_code ?></div>
                                       </li>
                                                                           </ul>
                                 </li></ul>
                                 </div>
                              </div>
                              <ul class="list-items list-items-2 py-3 pb-0 pt-0">
                              <li class="section-block my-3 mb-3 mt-2"></li>
                              </ul>
                                                                  <ul class="list-items list-items-2 py-3 pb-0 pt-0">
                                                                     <li class="lh-1 mt-0"><span>Baggage</span>1 PC</li>
                                                                     <li class="lh-1 mt-3"><span>Cabin Baggage</span><?php echo $itiniery->baggaes ?> KG</li>
                                                                </ul>
                           </div>
                        </div>
                     </div>


                     <div class="form-box booking-detail-form mb-4">
                       <div class="form-title-wrap p-3">
                           <h6 class="text-capitalize m-0">Price Details</h6>
                        </div>



                        <div class="form-box booking-detail-form mb-0">
                        <div class="form-content">
                           <div class="card-item shadow-none radius-none mb-0">



<?php
    // print_r($bookingData);
    // print_r(count($bookingData['passengers'][0]));
    // print_r(count($bookingData['passengers'][1]));
    // print_r(count($bookingData['passengers'][2]));

?>

  <ul class="list-items list-items-2 py-0">

<?php if (count($bookingData['passengers'][0]) > 0): ?>
      <li class="lh-1 mt-0 d-flex gap-2">
        <span>Adult (                                                                                                                                                                         <?php echo count($bookingData['passengers'][0]) ?> )</span> INR
        <div id="adult-price">

          <?php echo number_format($itiniery->adult_price * (count($bookingData['passengers'][0])), 2) ?>

        </div>
      </li>
    <?php endif; ?>

    <?php if (count($bookingData['passengers'][1]) > 0): ?>
      <li class="lh-1 mt-2 d-flex gap-2">
        <span>Child (                                                                                                                                                                         <?php echo count($bookingData['passengers'][1]) ?> )</span> INR
        <div id="adult-price">

       <?php echo number_format($itiniery->child_price * (count($bookingData['passengers'][1])), 2) ?>

        </div>
      </li>
    <?php endif; ?>

    <?php if (count($bookingData['passengers'][2]) > 0): ?>
      <li class="lh-1 mt-2 d-flex gap-2">
        <span>Infant (                                                                                                                                                                                 <?php echo count($bookingData['passengers'][2]) ?> )</span> INR
        <div id="adult-price">
                 <?php echo number_format($itiniery->infant_price * (count($bookingData['passengers'][2])), 2) ?>


        </div>
      </li>
    <?php endif; ?>

</ul>







                           </div>
                        </div>
                        <div class="form-title-wrap p-3">
                           <ul class="row">
                              <li class="col-6 d-flex align-items-center">
                                 <strong class="text-uppercase">Booking Price</strong>
                              </li>
                              <strong class="col-6 d-flex align-items-center h4 m-0"><strong><small class="mx-2"><?php echo $itiniery->currency ?></small></strong>
               <?php echo $bookingData['data']['total_fare'] ?>
                            </strong>

                           </ul>
                        </div>
                     </div>

                     </div>
                  </div>
               </div>

</div>






</main>
<script>
        const ageRules = {
            adult: {
                min: 12,
                max: 100
            },
            child: {
                min: 2,
                max: 11
            },
            infant: {
                min: 0,
                max: 1
            }
        };

        // Calculate age from DOB selects
        function calculateAge(day, month, year) {
            const birthDate = new Date(`${year}-${month}-${day}`);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        // Validate a single traveller's DOB
        function validateDOB(traveller) {
            const type = traveller.querySelector('h4').textContent.split(' ')[0].toLowerCase();
            let valid = true;

            traveller.querySelectorAll('.traveller-dob-wrapper').forEach(wrapper => {
                const select = wrapper.querySelector('select');
                const tooltip = wrapper.querySelector('.dob-tooltip');

                const day = traveller.querySelector('select[name="dob_day[]"]').value;
                const month = traveller.querySelector('select[name="dob_month[]"]').value;
                const year = traveller.querySelector('select[name="dob_year[]"]').value;

                if (day && month && year) {
                    const age = calculateAge(day, month, year);
                    if (age < ageRules[type].min || age > ageRules[type].max) {
                        tooltip.textContent = `${type.charAt(0).toUpperCase()+type.slice(1)} age must be between ${ageRules[type].min} and ${ageRules[type].max}`;
                        tooltip.style.display = 'block';
                        wrapper.classList.add('dob-invalid');
                        valid = false;
                    } else {
                        tooltip.textContent = '';
                        tooltip.style.display = 'none';
                        wrapper.classList.remove('dob-invalid');
                    }
                } else {
                    tooltip.textContent = '';
                    tooltip.style.display = 'none';
                    wrapper.classList.remove('dob-invalid');
                }
            });

            return valid;
        }

        // Live validation
        document.querySelectorAll('.traveller-form').forEach(traveller => {
            traveller.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', () => validateDOB(traveller));
            });
        });

        // Form submission
        document.getElementById('travellerForm').addEventListener('submit', function(e) {
            let formValid = true;
            document.querySelectorAll('.traveller-form').forEach(traveller => {
                if (!validateDOB(traveller)) formValid = false;
            });

            if (!formValid) {
                alert('Please fix DOB errors before submitting.');
                e.preventDefault();
            }
        });
    </script>
@include('layouts.footer')
