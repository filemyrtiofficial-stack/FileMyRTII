<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <style>
                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 400;
                    src: url('fonts/poppins-v21-latin-regularregular.eot');
                    src: url('fonts/poppins-v21-latin-regular.eot?#iefix') format('embedded-opentype'),
                        url('fonts/poppins-v21-latin-regular.woff2') format('woff2'),
                        url('fonts/poppins-v21-latin-regular.woff') format('woff'),
                        url('fonts/poppins-v21-latin-regular.ttf') format('truetype'),
                        url('fonts/poppins-v21-latin-regular.svg#Poppins') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 500;
                    src: url('fonts/poppins-v21-latin-500.eot');
                    src: url('fonts/poppins-v21-latin-500.eot?#iefix') format('embedded-opentype'),
                        url('fonts/poppins-v21-latin-500.woff2') format('woff2'),
                        url('fonts/poppins-v21-latin-500.woff') format('woff'),
                        url('fonts/poppins-v21-latin-500.ttf') format('truetype'),
                        url('fonts/poppins-v21-latin-500.svg#Poppins') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 600;
                    src: url('fonts/poppins-v21-latin-600.eot');
                    src: url('fonts/poppins-v21-latin-600.eot?#iefix') format('embedded-opentype'),
                        url('fonts/poppins-v21-latin-600.woff2') format('woff2'),
                        url('fonts/poppins-v21-latin-600.woff') format('woff'),
                        url('fonts/poppins-v21-latin-600.ttf') format('truetype'),
                        url('fonts/poppins-v21-latin-600.svg#Poppins') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 700;
                    src: url('fonts/poppins-v21-latin-700.eot');
                    src: url('fonts/poppins-v21-latin-700.eot?#iefix') format('embedded-opentype'),
                        url('fonts/poppins-v21-latin-700.woff2') format('woff2'),
                        url('fonts/poppins-v21-latin-700.woff') format('woff'),
                        url('fonts/poppins-v21-latin-700.ttf') format('truetype'),
                        url('fonts/poppins-v21-latin-700.svg#Poppins') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 800;
                    src: url('fonts/poppins-v21-latin-800.eot');
                    src: url('fonts/poppins-v21-latin-800.eot?#iefix') format('embedded-opentype'),
                        url('fonts/poppins-v21-latin-800.woff2') format('woff2'),
                        url('fonts/poppins-v21-latin-800.woff') format('woff'),
                        url('fonts/poppins-v21-latin-800.ttf') format('truetype'),
                        url('fonts/poppins-v21-latin-800.svg#Poppins') format('svg');
                }
                html {
                    width: 100%;
                }
                body {
                    margin: 0;
                    padding: 0;
                    background: #e1e1e1;
                    font-family: "Poppins", sans-serif;
                    width: 100%;
                    height: 100%;
                    background-color: #ffffff;
                    -webkit-font-smoothing: antialiased;
                }
                div, p, a, li, td {
                    -webkit-text-size-adjust: none;
                }
                p {
                    padding: 0 !important;
                    margin-top: 0 !important;
                    margin-right: 0 !important;
                    margin-bottom: 0 !important;
                    margin-left: 0 !important;
                }

                

                
                .full-w-table {
                  max-width: 800px;
                  margin-left: auto;
                  margin-right: auto;
                  background-color: #ffffff;
                  border-radius: 10px;
                  margin-top: 20px;
                  margin-bottom: 20px;
                }
                .wrapper {
                  padding: 20px;
                }
                .header h1 {
                  font-size: 40px;
                  color: #000000;
                  font-family: 'Poppins', sans-serif;
                  font-weight: 400;
                  line-height: 1;
                  text-align: center;
                }
                .top-section {
                  margin-left: 30px;
                  margin-right: 30px;
                }
                .col_left {
                  float: left;
                  width: 50%;
                }
                .col_right {
                  float: left;
                  width: 50%;
                }
                .address_wrap {
                  text-align: right;
                }
                .address_heading {
                  margin-top: 0;
                  margin-bottom: 20px;
                }
                .clear {
                  clear: both;
                }
                .seperator {
                  height: 1px;
                  width: auto;
                  margin-left: 30px;
                  margin-right: 30px;
                  background-color: #b8e4ff;
                }
                .system-info {
                  font-size: 14px;
                  font-family: 'Poppins', sans-serif;
                  line-height: 1.3;
                  text-align: center;
                  margin-left: 30px;
                  margin-right: 30px;
                  width: auto;
                }
                .dspace {
                  height: 40px;
                }
                .mspace {
                  height: 30px;
                  display: none;
                }
                .middle-section {
                  margin-left: 30px;
                  margin-right: 30px;
                }
                .c_address_wrap {
                  text-align: left;
                }
                .c_smallheading {
                  margin-top: 0;
                  margin-bottom: 20px;
                  font-size: 16px;
                  color: #000000;
                  font-family: 'Poppins', sans-serif;
                  font-weight: 700;
                  line-height: 1;
                  text-align: left;
                }
                .c_largeheading {
                  margin-top: 0;
                  margin-bottom: 20px;
                  font-size: 24px;
                  color: #333333;
                  font-family: 'Poppins', sans-serif;
                  font-weight: 700;
                  line-height: 1;
                  text-align: left;
                }
                .billing {
                  width: 90%;
                  margin-left: auto;
                }
                .billing .address {
                  text-align: right;
                }
                .s_space {
                  height: 15px;
                }
                .order_table {
                  margin-left: 30px;
                  margin-right: 30px;
                }
                .bottom-section {
                  margin-left: 30px;
                  margin-right: 30px;
                }
                .tax {
                  font-size: 16px;
                  font-family: 'Poppins', sans-serif;
                  color: #333333;
                  line-height: 1.2;
                  text-align: right;
                }
                .price {
                  font-size: 30px;
                  font-family: 'Poppins', sans-serif;
                  color: #000000;
                  font-weight: 700;
                  line-height: 1.2;
                  text-align: right;
                }

                @media (max-width: 420px) {
                  .dspace {
                    display: none;
                  }
                  .mspace {
                    display: block;
                  }
                  .top-section {
                    margin-left: 0;
                    margin-right: 0;
                  }
                  .middle-section {
                    margin-left: 0;
                    margin-right: 0;
                  }
                  .col_left {
                    float: none;
                    width: 100%;
                  }
                  .col_right {
                    float: none;
                    width: 100%;
                  }
                  .address_wrap {
                    text-align: left;
                  }
                  .billing {
                    width: 100%;
                    margin-left: 0;
                  }
                  .billing .address {
                      text-align: left;
                  }
                  .seperator {
                    margin-left: 0;
                    margin-right: 0;
                  }
                  .order_table {
                    margin-left: 0;
                    margin-right: 0;
                  }
                  .bottom-section {
                    margin-left: 0;
                    margin-right: 0;
                  }
                  .system-info {
                    margin-left: 0;
                    margin-right: 0;
                  }
                }
            </style>

    </head>
    <body>
      <div class="full-w-table">
                  <div class="wrapper">
                    <div class="header">
                      <h1>Invoice</h1>
                    </div>
                    <div class="top-section">
                      <div class="col_left">
                        
                        <img src="{{ $logo ?? '' }}" width="130" height="120" alt="logoss" border="0" />
                      </div>
                      <div class="col_right">
                        <div class="address_wrap">
                          <h2 class="address_heading">{{$company['company_name'] ?? ''}}</h2>
                          <div class="address">
                           
                            {{$company['address'] ?? ''}}
                          </div>
                        </div>
                      </div>
                      <div class="clear"></div>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="seperator"></div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="middle-section">
                      <div class="col_left">
                        <div class="c_address_wrap">
                          <h5 class="c_smallheading">Bill To</h5>
                          <h2 class="c_largeheading">{{$application['first_name']}} {{$application['last_name']}}</h2>
                          <div class="address">
                          {{$application['address']}} {{$application['city']}} {{$application['state']}} {{$application['postal_code']}} 
                          </div>
                          <div class="mspace"></div>
                        </div>
                      </div>
                      <div class="col_right">
                        <div class="billing">
                          <div class="address">
                            Invoice Number: {{$application->invoice_number ?? ''}} <br>
                            <div class="s_space"></div>
                          
                            Date: {{ InvoiceDate($application->created_at) }}
                         <br>
                            <div class="s_space"></div>
                            Paid: {{ $paymentdata['method']}} <br>
                            <div class="s_space"></div>
                            <!-- Bank: Null -->
                          </div>
                        </div>
                      </div>
                      <div class="clear"></div>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="seperator"></div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="order_table">
                      <?php
                      $gst = (18/100)*($application->charges ?? 0);
                      ?>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15); -webkit-box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15); -moz-box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15); -o-box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15); -ms-box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15);">
                        <tbody>
                            <tr>
                                <td height="10" colspan="4"></td>
                            </tr>
                          <tr>
                            <th style="font-size: 16px; color: #0384d4; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: top; text-align: left; padding: 20px 20px 10px;" width="50%" align="center">
                            Particulars
                            </th>
                            <th style="font-size: 16px; color: #0384d4; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: top; text-align: center; padding: 20px 10px 10px;" align="center">
                              Qty
                            </th>
                            <!-- <th style="font-size: 16px; color: #0384d4; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: top; text-align: center; padding: 20px 10px 10px;" align="center">
                              Prize
                            </th> -->
                            <th style="font-size: 16px; color: #0384d4; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: top; text-align: center; padding: 20px 10px 10px;" align="center">
                              Amount
                            </th>
                          </tr>
                          <tr>
                            <td height="1" style="background: #ffffff;" colspan="4"></td>
                          </tr>
                          <tr>
                            <td height="5" colspan="4"></td>
                          </tr>
                          <tr>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1.4; vertical-align: top; text-align: left; padding:10px 10px 10px 20px;" class="article">
                              RTI Application No. {{$application->application_no ?? ''}}
                            </td>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;">1</td>
                            <!-- <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center">Rs.599</td> -->
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center">Rs.{{($application->charges ?? 0)-$gst}}</td>
                          </tr>
                          <tr>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1.4; vertical-align: top; text-align: left; padding:10px 10px 10px 20px;" class="article">
                              
                            </td>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;">GST (18%)</td>
                            <!-- <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center">Rs.599</td> -->
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center">Rs.{{$gst}}</td>
                          </tr>

                          <tr>
                            <td height="1" colspan="4" style="border-bottom:1px solid #ffffff"></td>
                          </tr>
                         
                          <tr>
                            <td height="20" colspan="4"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="bottom-section">
                      <!-- <div class="price">
                        GST (18%): {{$gst}}
                      </div> -->
                      <div class="dspace"></div>
                      <div class="mspace"></div>
                      <div class="price">
                        Total: Rs.{{$application->charges ?? ''}}
                      </div>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="system-info">
                      THIS IS COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE
                    </div>
                  </div>
      </div>
    </body>
</html>