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
           

                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-regularregular.eot")}}');
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-regular.eot?#iefix")}}') format('embedded-opentype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-regular.woff2")}}') format('woff2'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-regular.woff")}}') format('woff'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-regular.ttf")}}') format('truetype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-regular.svg#Poppins")}}') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 500;
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.eot")}}');
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.eot?#iefix")}}') format('embedded-opentype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.woff2")}}') format('woff2'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.woff")}}') format('woff'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.ttf")}}') format('truetype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-500.svg#Poppins")}}') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 600;
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.eot")}}');
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.eot?#iefix")}}') format('embedded-opentype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.woff2")}}') format('woff2'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.woff")}}') format('woff'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.ttf")}}') format('truetype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-600.svg#Poppins")}}') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 700;
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.eot")}}');
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.eot?#iefix")}}') format('embedded-opentype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.woff2")}}') format('woff2'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.woff")}}') format('woff'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.ttf")}}') format('truetype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-700.svg#Poppins")}}') format('svg');
                }

                @font-face {
                    font-display: swap;
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 800;
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.eot")}}');
                    src: url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.eot?#iefix")}}') format('embedded-opentype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.woff2")}}') format('woff2'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.woff")}}') format('woff'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.ttf")}}') format('truetype'),
                        url('{{ storage_path("fonts/poppins/poppins-v21-latin-800.svg#Poppins")}}') format('svg');
                }
                html {
                    width: 100%;
                }
                body {
                    /* margin: 0;
                    padding: 0;
                    background: #e1e1e1;
                    font-family: "Poppins", sans-serif;
                    width: 100%;
                    height: 100%;
                    background-color: #e1e1e1;
                    -webkit-font-smoothing: antialiased; */
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
                  padding: 60px 0 10px;
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
                  background-color: #3070be;
                  margin-top: 0px;
                  margin-right: 80px;
                }
                .inner-wrapper {
                  padding-left: 50px;
                  padding-right: 50px;
                }
                .top-section .inner-wrapper {
                  padding-right: 100px;
                }
                .col_left {
                  float: left;
                  width: 50%;
                }
                .invoice-logo {
                  padding: 0px;
                  border: 1px solid #3070be;
                  display: inline-block;
                  margin-top: -18px;
                  background-color: #ffffff;
                }
                .col_right {
                  float: left;
                  width: 50%;
                }
                .top-section .col_left {
                  width: 40%;
                }
                .top-section .col_right {
                  width: 60%;
                }
                .address_wrap {
                  text-align: right;
                  padding-top: 5px;
                  padding-bottom: 5px;
                }
                .address_heading {
                  font-size: 18pt;
                  font-weight: 500;
                  margin-top: 0;
                  margin-bottom: 0px;
                  color: #fff;
                }
                .address {
                  color: #000;
                }
                .top-section .address {
                  color: #fff;
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
                  /* margin-left: 30px;
                  margin-right: 30px; */
                }
                .c_address_wrap {
                  text-align: left;
                }
                .c_smallheading {
                  margin-top: 0;
                  margin-bottom: 5px;
                  font-size: 16px;
                  color: #000000;
                  font-family: 'Poppins', sans-serif;
                  font-weight: 700;
                  line-height: 1;
                  text-align: left;
                }
                .c_largeheading {
                  margin-top: 10px;
                  margin-bottom: 20px;
                  font-size: 30px;
                  color: #333333;
                  font-family: 'Poppins', sans-serif;
                  font-weight: 700;
                  line-height: 1;
                  vertical-align: top;
                  text-align: left;
                  text-decoration: underline;
                  text-transform: uppercase;
                }
                .invoice-area {
                  width: 90%;
                  /* margin-left: auto; */
                }
                .invoice-area .invoice-info {
                  text-align: right;
                }
                .invoice-info .add_left {
                  display: inline-block;
                  font-weight: bold;
                  padding-right: 5px;
                }
                .invoice-info .add_right {
                  display: inline-block;
                  width: 120px;
                  text-align: left;
                }
                .s_space {
                  height: 15px;
                }
                .order_table {
                  margin-left: 50px;
                  margin-right: 50px;
                }
                .bottom-section {
                  /* margin-left: 30px;
                  margin-right: 30px; */
                }
                .tax {
                  font-size: 16px;
                  font-family: 'Poppins', sans-serif;
                  color: #333333;
                  line-height: 1.2;
                  text-align: right;
                }
                .price {
                  font-size: 16px;
                  font-family: 'Poppins', sans-serif;
                  color: #000000;
                  font-weight: 400;
                  line-height: 1.2;
                  text-align: center;
                }
                .bottom-line {
                  height: 1px;
                  width: 100%;
                  margin-left: auto;
                  margin-right: auto;
                  background-color: #000000;
                }

                @media (max-width: 420px) {
                  .wrapper {
                    padding: 40px 0 10px;
                  }
                  .dspace {
                    display: none;
                  }
                  .mspace {
                    display: block;
                  }
                  .inner-wrapper {
                    padding-left: 20px;
                    padding-right: 20px;
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
                  .top-section .inner-wrapper {
                    padding-left: 20px;
                    padding-right: 20px;
                  }
                  .top-section .col_right {
                    width: 100%;
                  }
                  .invoice-area .invoice-info {
                      text-align: left;
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
                    margin-left: 20px;
                    margin-right: 20px;
                  }
                }
                footer{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 50px;
        margin-bottom: 0px;
        bottom: 0px;
        text-align: center;
      }

            </style>

    </head>
    <body>
    <footer>
    <p>{!! $company['invoice_footer'] ?? '' !!}</p>
                        
    </footer>
      <div class="full-w-table">
                  <div class="wrapper">
                    <div class="top-section">
                      <div class="inner-wrapper">
                      <div class="col_left">
                        <div class="invoice-logo">
                          <img src="{{$logo}}" width="130" height="120" alt="logo" border="0" />
                        </div>
                        <div class="mspace"></div>
                      </div>
                      <div class="col_right">
                        <div class="address_wrap">
                          <h2 class="address_heading">{{$company['company_name'] ?? ''}}</h2>
                          <div class="address">
                          {!! $company['address'] ?? '' !!}
                          </div>
                          <div class="mspace"></div>
                        </div>
                      </div>
                      <div class="clear"></div>
                    </div>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="middle-section">
                      <div class="inner-wrapper">
                          <div class="col_left">
                            <div class="c_address_wrap">
                              <h2 class="c_largeheading">Invoice</h2>
                            </div>
                          </div>
                          <div class="col_right">
                            <div class="invoice-area">
                              <div class="invoice-info">
                                <span class="add_left">Date:</span>
                                <span class="add_right">{{ InvoiceDate($application->created_at) }}</span>
                              </div>
                              <div class="invoice-info">
                                <span class="add_left">Invoice No:</span>
                                <span class="add_right">FMR25032243</span>
                              </div>
                              <div class="invoice-info">
                                <span class="add_left">Paid by:</span>
                                <span class="add_right">UPI</span>
                              </div>
                            </div>
                          </div>
                          <div class="clear"></div>
                      </div>
                      <div class="dspace"></div>
                      <div class="mspace"></div>
                      <div class="inner-wrapper">
                        <div class="col_left">
                          <div class="c_address_wrap">
                            <h5 class="c_smallheading">Bill TO</h5>
                            <div class="address">
                            {{$application['first_name']}} {{$application['last_name']}}, <br>
                            {{$application['address']}}  
                            <br>
                            {{$application['city']}} {{$application['state']}} <br>
                            {{$application['postal_code']}}
                            </div>
                            <div class="mspace"></div>
                          </div>
                        </div>
                        <div class="col_right">
                        </div>
                        <div class="clear"></div>
                    </div>
                    </div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="order_table">
                    <?php
                      $gst = (18/100)*($application->charges ?? 0);
                      ?>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="">
                        <tbody>
                            <tr>
                                <td height="10" colspan="4"></td>
                            </tr>
                          <tr style="background-color: #3070be;">
                            <th style="font-size: 16px; color: #ffffff; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: middle; text-align: center; padding: 10px;" width="5%" align="center">
                              Sl. No.
                            </th>
                            <th style="font-size: 16px; color: #ffffff; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: middle; text-align: center; padding: 10px; border-left: 1px solid rgba(255, 255, 255, 0.4); border-right: 1px solid rgba(255, 255, 255, 0.4);" width="50%" align="center">
                              Product
                            </th>
                            <th style="font-size: 16px; color: #ffffff; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: middle; text-align: center; padding: 10px 5px 10px; border-right: 1px solid rgba(255, 255, 255, 0.4);"  width="8%" align="center">
                              Qty
                            </th>
                            <th style="font-size: 16px; color: #ffffff; font-family: 'Poppins', sans-serif; font-weight: 700; line-height: 1; vertical-align: middle; text-align: center; padding: 10px;" align="center">
                              Amount
                            </th>
                          </tr>
                          <tr>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1.4; vertical-align: middle; text-align: left; padding:10px;" class="article">
                              01
                            </td>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1.4; vertical-align: middle; text-align: left; padding:10px;" class="article">
                              RTI Application No. {{$application->application_no ?? ''}}
                            </td>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: middle; text-align: center; padding:10px 5px 10px;">01</td>
                            <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: middle; text-align: right; padding:10px 40px 10px 10px;" align="center">
                              <span style="display: inline-block;">Rs.</span>
                              <span style="display: inline-block; width: 100px;"> {{($application->charges ?? 0)-$gst}}</span>
                            </td>
                          </tr>
                          <tr>
                          <td colspan="3" style="font-size: 16px; color: #000000; font-family: Helvetica, Arial, sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center"></td>
                          <!-- <td style="font-size: 20px; color: #000000; font-family: Helvetica, Arial, sans-serif; font-weight: bold; line-height: 1; vertical-align: top; text-align: center; padding:10px 40px 10px 10px; text-align: right;border-bottom: 1px solid #000" align="center"><span style="display: inline-block;">GST 18%</span><span style="display: inline-block; width: 100px;">{{$application->charges ?? ''}}</span></td> -->
                          <!-- <td style="font-size: 16px; color: #000000; font-family: Helvetica, Arial, sans-serif;line-height: 1; vertical-align: top; text-align: center; padding:10px 40px 10px 10px; text-align: right; display:flex" align="center"><span style="display: inline-block;">GST 18%</span><span style="display: inline-block; width: 100px;">{{$application->charges ?? ''}}</span></td> -->
                          <td style="font-size: 16px; color: #333333; font-family: 'Poppins', sans-serif; font-weight: 400; line-height: 1; vertical-align: middle; text-align: right; padding:10px 40px 10px 10px;border-bottom: 1px solid #000" align="center">
                              <span style="display: inline-block;">GST 18%</span>
                              <span style="display: inline-block; width: 80px;">{{$gst}}</span>
                            </td>
                          <!-- <td style="font-size: 16px; color: #000000; font-family: Helvetica, Arial, sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:5px 40px 3px 10px; text-align: right;border-bottom: 1px solid #000" align="center"><span style="display: inline-block;">GST 18%</span><span style="display: inline-block; width: 100px;">{{$gst}}</span></td>  -->
                          </tr>
                          <tr>
                            <td colspan="3" style="font-size: 16px; color: #000000; font-family: Helvetica, Arial, sans-serif; font-weight: 400; line-height: 1; vertical-align: top; text-align: center; padding:10px;" align="center"></td>
                            <td style="font-size: 20px; color: #000000; font-family: Helvetica, Arial, sans-serif; font-weight: bold; line-height: 1; vertical-align: top; text-align: center; padding:10px 40px 10px 10px; text-align: right;" align="center"><span style="display: inline-block;">Total</span><span style="display: inline-block; width: 100px;">{{$application->charges ?? ''}}</span></td>
                          </tr>
                          <tr>
                            <td height="1" style="background: #000000;" colspan="4"></td>
                          </tr>
                          <tr>
                            <td height="50" colspan="4"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="system-info">
                      <i>This is a computer generated invoice and does not require signature.</i>
                    </div>
                    
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="dspace"></div>
                    <div class="mspace"></div>
                    <div class="bottom-section">
                      <div class="bottom-line"></div>
                   
                    </div>
                  </div>
      </div>
    </body>
</html>