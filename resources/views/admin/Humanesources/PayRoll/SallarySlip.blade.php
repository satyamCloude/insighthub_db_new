

<link rel="stylesheet" href="{{ asset('public/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{asset('public/css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>  
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

<style>
    .salary-slip{
      margin: 15px;
      .empDetail {
        width: 100%;
        text-align: left;
        border: 2px solid black;
        border-collapse: collapse;
        table-layout: fixed;
      }
      
      .head {
        margin: 10px;
        margin-bottom: 50px;
        width: 100%;
      }
      
      .companyName {
        text-align: right;
        font-size: 25px;
        font-weight: bold;
      }
      
      .salaryMonth {
        text-align: center;
      }
      
      .table-border-bottom {
        border-bottom: 1px solid;
      }
      
      .table-border-right {
        border-right: 1px solid;
      }
      
      .myBackground {
        padding-top: 10px;
        text-align: left;
        border: 1px solid black;
        height: 40px;
      }
      
      .myAlign {
        text-align: center;
        border-right: 1px solid black;
      }
      
      .myTotalBackground {
        padding-top: 10px;
        text-align: left;
        background-color: #EBF1DE;
        border-spacing: 0px;
      }
      
      .align-4 {
        width: 25%;
        float: left;
      }
      
      .tail {
        margin-top: 35px;
      }
      
      .align-2 {
        margin-top: 25px;
        width: 50%;
        float: left;
      }
      
      .border-center {
        text-align: center;
      }
      .border-center th, .border-center td {
        border: 1px solid black;
      }
      
      th, td {
        padding-left: 6px;
      }
}
</style>
<style>  
 
footer {  
 background: #31a6e3; 
  margin-top:25px;  
}  
footer a {  
  color: #fff;  
  font-size: 14px;  
  transition-duration: 0.2s;  
}  
footer a:hover {  
  color: #FA944B;  
  text-decoration: none;  
}  
.copy {  
  font-size: 12px;  
  padding: 10px;  
  border-top: 1px solid #FFFFFF;  
}  
.footer-middle {  
  padding-top: 2em;  
  color: white;  
}  
ul.social-network {  
  list-style: none;  
  display: inline;  
  margin-left: 0 !important;  
  padding: 0;  
}  
ul.social-network li {  
  display: inline;  
  margin: 0 5px;  
}  
  
.social-network a.icoFacebook:hover {  
  background-color: #3B5998;  
}  
.social-network a.icoLinkedin:hover {  
  background-color: #007bb7;  
}  
.social-network a.icoFacebook:hover i  
{  
  color: #fff;  
}  
.social-network a.icoLinkedin:hover i {  
  color: #fff;  
}  
.social-network a.socialIcon:hover {  
  color: #44BCDD;  
}  
.socialHoverClass {  
  color: #44BCDD;  
}  
.social-circle li a {  
  display: inline-block;  
  position: relative;  
  margin: 0 auto 0 auto;  
  -moz-border-radius: 50%;  
  -webkit-border-radius: 50%;  
  border-radius: 50%;  
  text-align: center;  
  width: 30px;  
  height: 30px;  
  font-size: 15px;  
}  
.social-circle li i {  
  margin: 0;  
  line-height: 30px;  
  text-align: center;  
}  
.social-circle li a:hover i  
{  
  -moz-transform: rotate(360deg);  
  -webkit-transform: rotate(360deg);  
  -ms--transform: rotate(360deg);  
  transform: rotate(360deg);  
  -webkit-transition: all 0.2s;  
  -moz-transition: all 0.2s;  
  -o-transition: all 0.2s;  
  -ms-transition: all 0.2s;  
  transition: all 0.2s;  
}  
.triggeredHover {  
  -moz-transform: rotate(360deg);  
  -webkit-transform: rotate(360deg);  
  -ms--transform: rotate(360deg);  
  transform: rotate(360deg);  
  -webkit-transition: all 0.2s;  
  -moz-transition: all 0.2s;  
  -o-transition: all 0.2s;  
  -ms-transition: all 0.2s;  
  transition: all 0.2s;  
}  
.social-circle i {  
  color: #595959;  
  -webkit-transition: all 0.8s;  
  -moz-transition: all 0.8s;  
  -o-transition: all 0.8s;  
  -ms-transition: all 0.8s;  
  transition: all 0.8s;  
}  
.social-network a {  
  background-color: #F9F9F9;  
}  
..social-network a:hover {  
background: #ff304d;  
}  
</style> 

<! DOCTYPE html>  
<html lang="en"> 

<body id="invoice-print" onload="window.print()" id="page-top">

    
<div class="salary-slip" id="generate-slip">
            <table class="empDetail">
              <tr height="100px" style='background-color: #e6e6e6c4'>
                <td colspan='10'>
                  <div class="row">
                  <div class="col-md-12">
                  <a href="https://ibb.co/M7V4bJP">
                    <img src="https://i.ibb.co/m4qwmPh/jhgfds.png" alt="jhgfds" border="0" style="    margin-top: -8px; width: 120%;"></a>
                  </div>
                  </div>
                </td>
               
              </tr>
              
              <tr style="font-size:14px;">
                <th>
                  Name
      </th>
                <td>
                @if(!empty($PayRoll->profile_img))


{{ $PayRoll->first_name }} {{ $PayRoll->last_name }}
@else


{{ $PayRoll->first_name }} {{ $PayRoll->last_name }}
@endif
      </td>
                
                <td></td>
                <td></td>
                <th>
                 Working Days
      </th>
                <td>
                {{$PayRoll->workingdays}}
      </td>
      </td>
                
                <td></td>
                <td></td>
                <th>
                 Working Days
      </th>
                <td>
                {{$PayRoll->leaves}}
      </td>
     <tr>
     <td></td>
      <td></td>
      <td></td>
     </tr>
              </tr>
              <tr>
                <th>
                  EmployeeJobRole
      </th>
      <td></td>
      <td></td>
                <td>
               @if($JobRole && $JobRole->name) {{ $JobRole->name }} @endif
      </td>
               
                
              </tr>
       
              <tr class="myBackground">
                <th colspan="2">
                  Actual(Rs.)
      </th>
                <th >
                  <!-- Particular -->
      </th>
                <th class="table-border-right">
                  Amount (Rs.)
      </th>
                <th colspan="2">
                  Earning Amount
      </th>
                <th >
                  <!-- Particular -->
      </th>
                <th class="table-border-right">
                  Amount (Rs.)
      </th>

      <th colspan="2">
                 Deduction
      </th>
                <th >
                  <!-- Particular -->
      </th>
                <th >
                  Amount (Rs.)
      </th>

              </tr>
             
              <tr>
                <th colspan="2">
                  Gross Salary
      </th>
                <td></td>
                <td class="myAlign">
                {{$PayRoll->net_salary}}
      </td>
      <th colspan="2">
                  Gross Salary
      </th>
                <td></td>
                <td class="myAlign">
                {{$PayRoll->net_salary}}
      </td>
                
              </tr >
              <tr>
                <th colspan="2">
                Basic Salary
      </th>
                <td></td>

                <td class="myAlign">
                {{$PayRoll->basic}}
      </td>
                <th colspan="2" >
                Basic Salary
      </th >
                <td></td>

                <td class="myAlign">
                {{$PayRoll->basic}}
      </td>
      <th colspan="2" >
                  Deduction
      </th >
                <td></td>

                <td class="myAlign">
                {{$PayRoll->deduction}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                HRA
      </th>
                <td></td>

                <td class="myAlign">
                 {{$PayRoll->hra}}
      </td>
                <th colspan="2" >
                HRA
      </th >
                <td></td>

                <td class="myAlign">
                {{$PayRoll->hra}}
      </td>
      <th colspan="2" >
                  TDS
      </th >
                <td></td>

                <td class="myAlign">
                {{$PayRoll->tds}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                Special Allowance
      </th>
                <td></td>
                <td class="myAlign">
                {{$PayRoll->allowance}}
      </td>
                <th colspan="2" >
                Special Allowance
      </th >
                <td></td>
                <td class="myAlign">
                {{$PayRoll->allowance}}
      </td>
      <!-- <th colspan="2" >
                  Others Allowance
      </th >
                <td></td>
                <td class="myAlign">
                {{$PayRoll->others}}
      </td> -->
              </tr >
              <tr>
                <th colspan="2">
                Conveyance(Fixed Amount)
      </th>
                <td></td>

                <td class="myAlign">
                {{$PayRoll->conveyance}}
      </td>
                <th colspan="2" >
                Conveyance(Fixed Amount)
      </th >
                <td></td>

                <td class="myAlign">
                {{$PayRoll->conveyance}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  Medical Allowance
      </th> <td></td>
                <td class="myAlign">
                  {{$PayRoll->medical_allowance}}
      </td>
                <th colspan="2" >
                Medical Allowance
      </th >
                <td></td>
                <td class="myAlign">
                {{$PayRoll->medical_allowance}}
      </td>
              </tr >
              <tr>
                <th colspan="2">
                <!-- Working Days -->
                <td></td>
                <td class="myAlign">
                 <!-- {{$PayRoll->workingdays}} -->
      </td>
                <th colspan="2" >
                <!-- Working Days -->
      </th >
                <td></td>
                <td class="myAlign">
                <!-- {{$PayRoll->workingdays}} -->
      </td>
              </tr >
              <tr>
                <th colspan="2">
                  <!-- Leaves -->
      </th>
                <td></td>
                <td class="myAlign">
                  <!-- {{$PayRoll->leaves}} -->
      </td>
                <th colspan="2" >
                <!-- Leaves -->
      </th >
                <td></td>
                <td class="myAlign">
                <!-- {{$PayRoll->leaves}} -->
      </td>
              </tr >
              <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                Others Allowance
      </th >
                <td></td>
                <td class="myAlign">
                {{$PayRoll->others}}
      </td>
     
              </tr >
              <!-- <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  Advance
      </th >
                <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr > -->
              <!-- <tr>
                <td colspan="4" class="table-border-right"></td>
                <th colspan="2" >
                  Income Tax
      </th > <td></td>
                <td class="myAlign">
                  00.00
      </td>
              </tr > -->
              <tr class="myBackground">
                <th colspan="3">
                  Total Payments
      </th>
                <td class="myAlign">
                {{$PayRoll->net_paid}}
            </td>
                <th colspan="3" >
                  Total Earning
      </th >
                <td class="myAlign">
                {{$PayRoll->net_paid}}
      </td>
      <th colspan="3" >
                  Total Deductions
      </th >
                <td class="myAlign">
                  {{ $PayRoll->deduction + $PayRoll->tds }}
      </td>
 </tr>
 <tr class="myBackground">
                <th colspan="3">
                <!-- <input type="file" name="picture"/> -->
      </th>
      
                <td class="myAlign">
                <!-- {{$PayRoll->net_paid}} -->
            </td>
                <th colspan="3" >
                <!-- <input type="file" name="uploadfile"/> -->
      </th >
                <td class="myAlign">
                <!-- {{$PayRoll->net_paid}} -->
      </td>
      <th colspan="3" >
      <!-- <input type="file" name="attachment"/> -->
      </th >
                <td class="myAlign">
                  <!-- 1000 -->
      </td>
      </tr>

      <tr class="myBackground">
                <th colspan="3">
                  Prepared By
      </th>
                <td class="myAlign">
                <!-- {{$PayRoll->net_paid}} -->
            </td>
                <th colspan="3" >
                  Authorized Sign.
      </th >
                <td class="myAlign">
                <!-- {{$PayRoll->net_paid}} -->
      </td>
      <th colspan="3" >
                  Employee Sign.
      </th >
                <td class="myAlign">
                  <!-- 1000 -->
      </td>
</tr>

            </table >

          </div >

<footer class="mainfooter" role="contentinfo">  
  <div class="footer-middle">  
  <div class="container">  
    <div class="row">   
      <div class="col-md-3">  
        <div class="footer-pad">  
          <ul class="social-network social-circle">  
             <li> <a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-envelope-open-o"> </i> 
             <p style="margin-left: 42px;margin-top: -33px;">
             sales@cloudtechtiq.com
             info@cloudtechtiq.com
            </p>
            </a> </li>  
            </ul>
        </div>  
      </div>  
      <div class="col-md-3">  
        <div class="footer-pad">  
          <ul class="social-network social-circle">    
             <li> <a href="#" class="icoLinkedin" title="Linkedin"> <i class="fa fa-phone"> </i> 
             <p style="margin-left: 42px;margin-top: -33px;">
             <p style="width: 200px; margin-top:-45px;">+91-141-3500931</p>
             <p style="width:119px; margin-top: -10px;margin-left: 39px;">+1 (571) 4630501</p>
            </p>
            </a> </li>  
            </ul>
            
        </div>  
      </div>  
        <div class="col-md-3">  
            <ul class="social-network social-circle">    
    <li> <a href="#"> <i class="fa fa-map-marker" aria-hidden="true"> </i> 
    <p style="margin-left: 42px;margin-top: -33px;">
            <p style="margin-top: -46px;
    width: 357px;"> Ground Floor,33-B,Shakti Sarovar,Narayan Vihar,Jaipur (Raj),302035</p>
            </p>
</a> </li>  
            </ul>               
    </div> 
    <div class="col-md-3">  
            <!-- <ul class="social-network social-circle">    
    <li> <a href="#"> <i class="fa fa-map-marker" aria-hidden="true"> </i> </a> </li>  
            </ul>                -->
    </div>

    </div>  
    <br><br>
     <div class="row">
     <div class="col-md-12 copy">  
    <p class="text-center"> www.CLOUDTECHTIQ.com | www.SERVERSCTRL.com | www.BOOKMYTODAY.com </p>  
    </div> 
     </div>
  </div>  
  </div>  
</footer>  
  </body>  
</html>  



