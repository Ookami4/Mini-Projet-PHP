<?php 
include('include/functions.php');
if(isset($_SESSION['logged']) && $_SESSION['logged'] === true)
{
  $html = '
  <style>
    .orderinfo th{
      background-color: #DC143C;
      color: #FFFFFF;
    }
    .orderinfo{
      padding: 10px;
    }
  </style>
  <p><img style="width:35px;height:45px;" src="logo/red1.png"><b style="color:#ff0000;">Red</b>One Store</p>
  <table>
   <tr><td><b>Client </b>'.$_SESSION['userid'].'</td></tr>
   <tr><td><b>Full Name </b>'.$_SESSION['username'].'</td></tr>
   <tr><td><b>Shipping Adress </b>'.$_SESSION['useradress'].'</td></tr>
   <tr><td><b>ZIP Code </b>'.$_SESSION['userzip'].'</td></tr>
  </table>
  <div style="border-bottom: 1px solid black;"></div>
  <table>
    <tr>
      <td><b>Invoice</b></td>
    </tr>
    <tr>
     <td><b>Date </b>'.date('d-m-Y  h:i:sa').'</td>
    </tr>
  </table>
  <div style="border-bottom: 1px solid #000000;"></div>
  <br />
  ';
  $total = $_GET['total'];
	$user = $_SESSION['userid'];   
    $html .= '<table class="orderinfo">
           <tr>
             <th width="10%">Id</th>
             <th width="40%">Name</th>
             <th width="20%">Unit Price</th>
             <th width="15%">Quantity</th>
             <th width="15%">Total</th>
           </tr>
    ';
		$cookie_data = stripslashes($_COOKIE['cart']);
		$cart_data = json_decode($cookie_data, true);
		$result = mysqli_query($connection, "INSERT INTO orders (order_id, order_total, user_id) VALUES ('',$total,$user)");
		if (!$result) 
		{
			echo("Error description: " . mysqli_error($connection));
		}
    $last_id = mysqli_insert_id($connection);
    //saving the products cat_Id which the customer buy to show him suggestion in home page
    if(isset($_COOKIE["buy"]))
    {
      $buy_data = stripslashes($_COOKIE['buy']);
      $buy_data = json_decode($buy_data, true);
    }else{
      $buy_data = array();
    }
    $item_cat_id = array_column($buy_data, 'cat');
		foreach($cart_data as $keys => $values)
		{   
      if (!in_array($values['item_cat'], $item_cat_id)) {
        $buy_data[]  = $values['item_cat'];
      }
     $price = $values["item_quantity"] * $values["item_price"];
     $item_id = $values['item_id']; 
     $quantity = $values['quantity'];
     $req ="INSERT INTO orderdetails (order_id, pro_id, quantity, price) VALUES ($last_id,$item_id,$quantity,$price)";
      $result1 = mysqli_query($connection, $req);
     if (!$result1) 
     {
     	  echo("Error description: " . mysqli_error($connection));
     }
     $html .= '
           <tr>
              <td>'.$values["item_id"].'</td>
              <td>'.$values["item_name"].'</td>
              <td>$'.$values["item_price"].'</td>
              <td>'.$values["item_quantity"].'</td>
              <td>$'.number_format($price, 2).'</td>
           </tr>
     ';
		}
    $cat_data = json_encode($buy_data);
    setcookie('buy', $cat_data, time() + (86400 * 30));
	  $html .= '<tr>
    <td colspan="4"></td>
    <th>$'.number_format($total, 2).'</th>
    </tr>
    </table>
    ';
    require_once('TCPDF-master/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Redouan');
$pdf->SetTitle('INVOICE');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
//clear cart after customer validate his cart
  setcookie("cart", "", time() - 3600);    
}else{
	redirect('login.php?message=login to make order');
}




