
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('frontend/images/logo.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">
    <title>viho - Premium Admin Template</title>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/fontawesome.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
      body{
        text-align: center;
        margin: 0 auto;
        width: 650px;
        font-family: work-Sans, sans-serif;
        background-color: #f6f7fb;
        display: block;
      }
      ul{
        margin:0;
        padding: 0;
      }
      li{
        display: inline-block;
        text-decoration: unset;
      }
      a{
      text-decoration: none;
      }
      p{
      margin: 15px 0;
      }
      h5{
      color:#444;
      text-align:left;
      font-weight:400;
      }
      .text-center{
      text-align: center
      }
      .main-bg-light{
      background-color: #fafafa;
      //- box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);
      }
      .title{
      color: #444444;
      font-size: 22px;
      font-weight: bold;
      margin-top: 10px;
      margin-bottom: 10px;
      padding-bottom: 0;
      text-transform: uppercase;
      display: inline-block;
      line-height: 1;
      }
      table{
      margin-top:30px
      }
      table.top-0{
      margin-top:0;
      }
      table.order-detail , .order-detail th , .order-detail td {
      border: 1px solid #ddd;
      border-collapse: collapse;
      }
      .order-detail th{
      font-size:16px;
      padding:15px;
      text-align:center;
      }
      .footer-social-icon tr td img{
      margin-left:5px;
      margin-right:5px;
      }
      .temp-social td{
        display:inline-block;
      }
      .temp-social td i{
          width:40px;
          height:40px;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          color:#24695c;
          //- padding:10px;
          background-color: #24695c3d;
          transition: all 0.5s ease;
      }
      .temp-social td:nth-child(n+2){
         margin-left:15px;
      }
      .deliver-status{
          display:flex;
          align-items:center;
          justify-content:center;
      }
      .deliver-status li{
        font-size:20px;
        font-weight:600;
        //- width:110px;
        width:145px;
        position:relative;
      }
      .deliver-status li h6{
         font-size:14px;
          margin-top:10px;
          margin-bottom: 0;
          color:#aba8a8;
          font-weight:600;
          text-transform: capitalize;
      }
      .deliver-status li::before{
        content: "";
          position: absolute;
          top:28%;
          left:0;
          width:100%;
          height:5px;
          background-color:#24695c; 
      }
      .deliver-status li:first-child::before,.deliver-status li:last-child::before{
        width:50%
      } 
      .deliver-status li:first-child::before,.deliver-status li:nth-child(1)::before{       
        right:0;
        left:unset;
      }
      .deliver-status li:nth-child(1)::before,.deliver-status li:last-child::before{
        background-color:#f8b028;
      }
      .deliver-status li .order-icon{
          width:35px;
          height:35px;
          border-radius: 50%;         
          margin-left: auto;
          margin-right: auto;
          background-color:#f8b028;
          position: relative;
          display:flex;
      }
      .deliver-status li .order-icon{
        color:#f8b028;
      }
      .deliver-status li .order-icon i{
        margin:auto;
        font-size:14px;
      }
      .deliver-status li .order-icon.active{
          background-color:#24695c;         
      }
      .deliver-status li .order-icon.active i{
        color:#ffffff;
      }
      
    </style>
  </head>
  <body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="padding:30px;background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
      <tbody>
        <tr>
          <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td><img src="{{asset('frontend/images/logo.png')}}" alt="" style=";margin-bottom: 30px;"></td>
                </tr>
                <tr>
                  <td>
                    <h2 class="title">Quotation Not Approved</h2>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="color:#941f1f;">Quote Request Received Successfully , But Your Quotation is not approved.</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div style="border-top:1px solid #777;height:1px;margin-top: 30px;"></div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h2 style="text-transform: capitalize;font-style: italic;color: #444444;">Quotation Canceled</h2>
                    <ul class="deliver-status">
                        <li>
                          <div class="order-icon active"><i class="fa fa-check"></i></div>
                          <h6>Received Succefully</h6>
                        </li>
                        <li>
                          <div class="order-icon"><i class="fa fa-check"></i></div>
                          <h6>Request Canceled</h6>
                        </li>
                      </ul>
                  </td>
                </tr>
              </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="left" style="width: 100%;margin-top: 30px;    margin-bottom: 30px;">
              <tbody>
                <tr>
                  <td style="background-color: #fafafa;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                    <h5 style="font-size: 16px; font-weight:600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">BOOKING FROM</h5>
                    <p style="text-align: left;font-weight: normal; font-size: 14px; color: #aba8a8;line-height: 21px;    margin-top: 0;">{{ $data['starting_point'] }}</p>
                  </td>
                  <td class="user-info" width="57" height="25"><img src="{{asset('admin/assets/images/email-template/space.jpg')}}" alt=" " height="25" width="20"></td>
                  <td style="background-color: #fafafa;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                    <h5 style="font-size: 16px;font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">BOOKING TO</h5>
                    <p style="text-align: left;font-weight: normal; font-size: 14px; color: #aba8a8;line-height: 21px;    margin-top: 0;">{{ $data['destination'] }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td>
                    <h2 class="title">YOUR QUOTATION DETAILS</h2>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="left">
              <tbody>
                <tr>
                  <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Quote For Event :</td>
                  
                  <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['event_name'] }}</b></td>
                </tr>
                <tr>
                  <td colspan="2" style="line-height: 49px;font-family: Arial;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;"><b>Your Quote Details :</b></td>
                  <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000; padding-left: 20px;text-align:left;border-right: unset;">Name :</td>
                  <td class="price" colspan="3" style=" line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['name'] }}</b></td>
                </tr>
                <tr>
                  <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Email :</td>
                  <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['email'] }}</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Phone :</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['phone'] }}</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Quote Request Date :</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['date'] }}</b></td>
                </tr> 
                <tr>
                    <td colspan="2" style="line-height: 49px;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">Your Message :</td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b>{{ $data['message'] }}</b></td>
                </tr>  
                <tr>
                    <td colspan="2" style="line-height: 49px;font-family: Arial;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;"><b>Quote Status :</b></td>
                    <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"></td>
                  </tr> 
                  <tr>
                    <td colspan="2" style="line-height: 49px;font-family: Arial;font-size: 13px;color: #000000;padding-left: 20px;text-align:left;border-right: unset;">{{ empty($data['customer_remarks'])?"No Feedback From Us.":$data['customer_remarks'] }}</td>
                  </tr> 
              </tbody>
            </table>
            <table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td style="padding: 30px;">
                    <div>
                      <h4 class="title" style="margin:0;text-align: center;">Follow us</h4>
                    </div>
                    <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:20px;">
                      <tbody>
                        <tr class="temp-social">
                          <td><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></td>
                          <td><a href="javascript:void(0)"><i class="fa fa-youtube-play"></i></a></td>
                          <td><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></td>
                          <td><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></td>
                          <td><a href="javascript:void(0)"><i class="fa fa-linkedin">                        </i></a></td>
                        </tr>
                      </tbody>
                    </table>
                    <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;">
                      <tbody>
                        <tr>
                          <td><a href="javascript:void(0)" style="color: #24695c;font-size:14px;text-transform: capitalize;font-weight:600;">Want to change how you receive these emails?</a></td>
                        </tr>
                        <tr>
                          <td>
                            <p style="font-size:14px; margin:8px 0; color:#aba8a8;">2021 - 22 Copy Right by Themeforest powerd by Pixel Strap</p>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="javascript:void(0)" style="color: #24695c;font-size: 14px;text-transform: capitalize;font-weight:600; margin:0;text-decoration: underline;">Unsubscribe</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>