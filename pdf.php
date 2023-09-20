
<?php  

ob_start();
 function fetch_data()  

 {  

      $output = '';  

      $conn = mysqli_connect("localhost", "root", "", "projectdb");  

      $sql = "SELECT * FROM tbl_orders ORDER BY id ASC";  

      $result = mysqli_query($conn, $sql);  

      while($row = mysqli_fetch_array($result))  

      {       

      $output .= '<tr>  

                          <td>'.$row["id"].'</td>  

                          <td>'.$row["user_id"].'</td>  

                          <td>'.$row["total"].'</td>  

                          <td>'.$row["date_ordered"].'</td>  
						  
						  <td>'.$row["date_cancelled"].'</td> 

                     </tr>  

                          ';  

      }  

      return $output;  

 }  

 if(isset($_POST["generate_pdf"]))  

 {  

      require_once('tcpdf/tcpdf.php');  

      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		
      $obj_pdf->SetCreator(PDF_CREATOR);  

      $obj_pdf->SetTitle("ORDERS SUMMARY OF THE CLIENTS");  

      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  

      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  

      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  

      $obj_pdf->SetDefaultMonospacedFont('helvetica');  

      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  

      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  

      $obj_pdf->setPrintHeader(false);  

      $obj_pdf->setPrintFooter(false);  

      $obj_pdf->SetAutoPageBreak(TRUE, 10);  

      $obj_pdf->SetFont('helvetica', '', 11);  

      $obj_pdf->AddPage();  

      $content = '';  

      $content .= '  

      <h4 align="center">ORDERS SUMMARY OF THE CLIENTS</h4><br /> 

      <table border="1" cellspacing="1" cellpadding="5">  

           <tr>  

                <th width="20%">Reference Number</th>  

                <th width="10%">User</th>  

                <th width="20%">Total</th>  

                <th width="25%">Date Ordered</th> 
				
				<th width="25%">Date Cancelled</th>  

           </tr>  

      ';  

      $content .= fetch_data();  

      $content .= '</table>';  

      $obj_pdf->writeHTML($content);  

      $obj_pdf->Output('file.pdf', 'I');  

 }  

 ?>  

 <!DOCTYPE html>  

 <html>  

      <head>  

           <title>ORDERS SUMMARY OF THE CLIENTS</title>  

           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            

      </head>  

      <body>  

           <br />

           <div class="container">  

                <h4 align="center"> ORDERS SUMMARY OF THE CLIENTS</h4><br />  

                <div class="table-responsive">  

                	<div class="col-md-12" align="right">

                     <form method="post">  

                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  

                     </form>  

                     </div>

                     <br/>

                     <br/>

                     <table class="table table-bordered">  

                          <tr>  

                               <th width="5%">Id</th>  

                               <th width="10%">User_id</th>  

                               <th width="10%">Total</th>  

                               <th width="10%">Date_Ordered</th>  
							    <th width="10%">date_cancelled</th>  

                          </tr>  

                     <?php  

                     echo fetch_data();  

                              ?>  

                              </table>  

                         </div>  

                    </div>  

               </body>  

          </html>

