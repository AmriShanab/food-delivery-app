<?php
require_once('vendor/autoload.php');
require_once('database/dbconfig.php');

// Get order ID from URL
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($orderId <= 0) {
    die('Invalid order ID');
}

// Fetch order details with restaurant information
$orderQuery = $db->prepare("
    SELECT o.*, r.name as restaurant_name, r.image as restaurant_logo, 
           r.address as restaurant_address, r.city as restaurant_city,
           r.telephone_no as restaurant_phone, r.email as restaurant_email
    FROM orders o
    LEFT JOIN restaurants r ON o.restaurant_id = r.id
    WHERE o.id = ?
");
$orderQuery->execute([$orderId]);
$order = $orderQuery->fetch();

if (!$order) {
    die('Order not found');
}

// Fetch order items
$itemsQuery = $db->prepare("SELECT * FROM order_items WHERE order_id = ?");
$itemsQuery->execute([$orderId]);
$items = $itemsQuery->fetchAll();

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($order['restaurant_name']);
$pdf->SetTitle('Invoice #' . $order['order_number']);
$pdf->SetSubject('Order Invoice');
$pdf->SetKeywords('Invoice, Order, ' . $order['restaurant_name']);

// Set margins
$pdf->SetMargins(15, 25, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Add a page
$pdf->AddPage();

// Restaurant Logo (if exists)
$logoPath = 'assets/images/' . $order['restaurant_logo'];
if (file_exists($logoPath) && is_file($logoPath)) {
    $pdf->Image($logoPath, 15, 10, 30, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
}

// Invoice Header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 10, 'INVOICE', 0, 1, 'C');
$pdf->Ln(10);

// Restaurant Info
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 6, $order['restaurant_name'], 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 6, $order['restaurant_address'], 0, 1);
$pdf->Cell(0, 6, $order['restaurant_city'], 0, 1);
$pdf->Cell(0, 6, 'Phone: ' . $order['restaurant_phone'], 0, 1);
$pdf->Cell(0, 6, 'Email: ' . $order['restaurant_email'], 0, 1);
$pdf->Ln(10);

// Invoice Details
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 6, 'Invoice Number:', 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 6, $order['order_number'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 6, 'Invoice Date:', 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 6, date('F j, Y', strtotime($order['created_at'])), 0, 1);
$pdf->Ln(10);

// Customer Information
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 6, 'Bill To:', 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 6, $order['first_name'] . ' ' . $order['last_name'], 0, 1);
$pdf->Cell(0, 6, $order['address'], 0, 1);
$pdf->Cell(0, 6, 'Phone: ' . $order['phone'], 0, 1);
$pdf->Cell(0, 6, 'Email: ' . $order['email'], 0, 1);
$pdf->Ln(15);

// Items Table Header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 7, 'Description', 1, 0, 'L');
$pdf->Cell(25, 7, 'Size', 1, 0, 'C');
$pdf->Cell(25, 7, 'Qty', 1, 0, 'C');
$pdf->Cell(35, 7, 'Price', 1, 1, 'R');

// Items Table Content
$pdf->SetFont('helvetica', '', 12);
foreach ($items as $item) {
    $pdf->Cell(100, 7, $item['item_name'], 'LR', 0, 'L');
    $pdf->Cell(25, 7, $item['size'], 'LR', 0, 'C');
    $pdf->Cell(25, 7, $item['quantity'], 'LR', 0, 'C');
    $pdf->Cell(35, 7, '$' . number_format($item['price'], 2), 'LR', 1, 'R');
}

// Closing line
$pdf->Cell(185, 0, '', 'T', 1);

// Summary
$pdf->Ln(10);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(140, 7, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(45, 7, '$' . number_format($order['subtotal'], 2), 0, 1, 'R');

$pdf->Cell(140, 7, 'Delivery Fee:', 0, 0, 'R');
$pdf->Cell(45, 7, '$' . number_format($order['delivery_fee'], 2), 0, 1, 'R');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(140, 7, 'Total:', 0, 0, 'R');
$pdf->Cell(45, 7, '$' . number_format($order['total'], 2), 0, 1, 'R');

// Payment Method
$pdf->Ln(15);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 7, 'Payment Method: ' . ($order['payment_method'] == 'COD' ? 'Cash on Delivery' : 'Credit/Debit Card'), 0, 1);

// Footer
$pdf->Ln(20);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 7, 'Thank you for your order from ' . $order['restaurant_name'], 0, 1, 'C');
$pdf->Cell(0, 7, 'For any inquiries, please contact: ' . $order['restaurant_phone'], 0, 1, 'C');

// Output the PDF
$pdf->Output('invoice_' . $order['order_number'] . '.pdf', 'I');
?>