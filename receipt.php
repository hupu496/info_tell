<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['last_receipt_id'])) {
    die('No quotation found. Please <a href="quotation_form.php">create one</a>.');
}

$receipt_id = $_SESSION['last_receipt_id'];
$sql = "SELECT * FROM reciept WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $receipt_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Quotation not found. <a href="quotation_form.php">Go back</a>');
}

$row = $result->fetch_assoc();

$items = json_decode($row['items'], true);
if (!is_array($items)) {
    $items = [];
}

$display_total = $row['totalprice'];

function format_money($amount) {
    return '₹' . number_format($amount, 2);
}

// Fallback for missing date
$added_on = !empty($row['added_on']) ? $row['added_on'] : date('Y-m-d');

$pageTitle = "INFOTELL · Quotation Receipt";
include 'header.php';
?>

<style>
    /* A4 styles – COMPACT VERSION */
    .quotation-wrapper {
        width: 210mm;
        margin: 0 auto;
        background: white;
        padding: 5px 0 15px 0;
        box-sizing: border-box;
        overflow: visible;
        font-family: 'Noto Sans', Arial, sans-serif;
    }

    /* ----- HEADER (new design with tagline) ----- */
    .letterhead {
        text-align: left;
        margin-bottom: 1.5rem;
    }
    .company-main {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #1e2a3a;
        line-height: 1.2;
    }
    .company-tagline {
        font-size: 0.95rem;
        color: #4b5563;
        margin: 0.2rem 0 0.8rem 0;
        font-weight: 400;
    }
    .ref-date-line {
        font-size: 0.95rem;
        color: #2c3e50;
        margin: 0.25rem 0 0.5rem;
    }
    .ref-date-line span {
        margin-right: 2rem;       /* space between ref and date */
    }
    .header-rule {
        border: 0;
        border-top: 2px solid #1e2a3a;
        margin: 0.5rem 0 0;
        opacity: 0.8;
    }

    .receipt-title {
        font-size: 1.6rem;
        font-weight: 600;
        color: #1e2a3a;
        margin: 1rem 0 0.5rem 0;
        border-left: 5px solid #0d6efd;
        padding-left: 1rem;
    }

    /* Info grid – two rows, three columns */
    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        margin: 1rem 0 1.5rem 0;
    }
    .info-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    .info-cell {
        flex: 1 1 150px;
        background: #f8fafc;
        padding: 0.5rem 0.8rem;
        border-radius: 10px;
        border-left: 4px solid #0d6efd;
    }
    .info-cell .label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #4b5563;
        margin-bottom: 2px;
    }
    .info-cell .value {
        font-size: 1rem;
        font-weight: 600;
        color: #1e2a3a;
        word-break: break-word;
    }

    /* Download button (hidden when printing) */
    .download-btn-container {
        text-align: right;
        margin-bottom: 10px;
    }
    .download-btn {
        background: #2878EB;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        font-size: 0.9rem;
    }
    .download-btn:hover {
        background: #1f5fcc;
    }

    /* Items table – FIXED LAYOUT */
    .table-items {
        margin: 1rem 0 0.5rem;
    }
    .table-items table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .table-items th,
    .table-items td {
        padding: 6px 4px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    .table-items th:nth-child(1) { width: 40%; }  /* Product */
    .table-items th:nth-child(2) { width: 15%; }  /* Quantity */
    .table-items th:nth-child(3) { width: 20%; }  /* Rate */
    .table-items th:nth-child(4) { width: 25%; }  /* Total */

    .table-items th {
        background: #1e2a3a;
        color: white;
        font-weight: 600;
        text-align: left;
    }
    .table-items th:last-child,
    .table-items td:last-child {
        text-align: right;
    }
    .item-qty, .item-price, .item-total {
        text-align: right;
    }
    .item-total {
        font-weight: 600;
        color: #0b5ed7;
    }

    .total-line {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 1.5rem;
        padding: 5px 0 40px 0;
        border-top: 2px dashed #94a3b8;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e2a3a;
        margin-top: 0.5rem;
        page-break-inside: avoid;
    }
    .total-line span:first-child {
        font-weight: 400;
        font-size: 0.9rem;
        color: #475569;
    }

    /* Notes section – compact */
    .notes-section {
        margin-top: 1rem;
        background: #f1f5f9;
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
    }
    .notes-section h5 {
        font-weight: 600;
        color: #1e2a3a;
        margin-bottom: 0.3rem;
        font-size: 1rem;
    }
    .notes-section p {
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    /* ----- FOOTER ----- */
    .receipt-footer {
        margin-top: 2rem;
        text-align: center;
        page-break-inside: avoid;
    }
    .footer-rule {
        border: 0;
        border-top: 1px dashed #94a3b8;
        margin: 1rem 0 0.5rem;
    }
    .footer-text {
        font-size: 0.8rem;
        color: #475569;
        line-height: 1.4;
    }

    /* PRINT STYLES */
    @media print {
        /* Hide website header/navbar/footer */
        header,
        footer,
        .header,
        .footer,
        .navbar,
        .nav,
        .container-fluid:first-child {
            display: none !important;
        }

        /* Hide print button */
        .no-print {
            display: none !important;
        }

        .quotation-wrapper {
            page-break-inside: avoid;
            page-break-after: avoid;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        table, tr, td, th, .total-line, .notes-section,
        .letterhead, .receipt-footer {
            page-break-inside: avoid;
        }
    }

    /* A4 page setup */
    @page {
        size: A4;
        margin: 15mm;
    }

    /* Make receipt use full page */
    body {
        margin: 0;
        padding: 0;
    }
</style>

<div class="quotation-wrapper">
    <!-- HEADER (new design with tagline) -->
    <div class="letterhead">
        <div class="company-main">INFOTELL SUPPLIES & SOLUTIONS</div>
        <div class="company-tagline">Computer Hardware, IT Infrastructure & Office Supply Solutions</div>
        <div class="ref-date-line">
            <span>Ref No: INTSS <?php echo htmlspecialchars($row['id']); ?></span>
            <span>Date: <?php echo date("d-m-Y", strtotime($added_on)); ?></span>
        </div>
        <hr class="header-rule">
    </div>

    <h2 class="receipt-title">Receipt</h2>

    <!-- Info Grid (two rows, three columns) -->
    <div class="info-grid">
        <div class="info-row">
            <div class="info-cell">
                <div class="label">Company Name</div>
                <div class="value"><?php echo htmlspecialchars($row['quotation_for']); ?></div>
            </div>
            <div class="info-cell">
                <div class="label">Buyer</div>
                <div class="value"><?php echo htmlspecialchars($row['buyer'] ?? '—'); ?></div>
            </div>
            <div class="info-cell">
                <div class="label">Project Name</div>
                <div class="value"><?php echo htmlspecialchars($row['project_name']); ?></div>
            </div>
        </div>
        <div class="info-row">
            <div class="info-cell">
                <div class="label">Added on</div>
                <div class="value"><?php echo date("d-m-Y", strtotime($added_on)); ?></div>
            </div>
            <div class="info-cell">
                <div class="label">Due Date</div>
                <div class="value"><?php echo !empty($row['due_date']) ? date("d-m-Y", strtotime($row['due_date'])) : '—'; ?></div>
            </div>
            <div class="info-cell">
                <div class="label">Status</div>
                <div class="value"><?php echo ($row['status'] ?? 1) == 1 ? 'Active' : 'Inactive'; ?></div>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-items">
        <h5 style="margin-bottom: 0.5rem; font-weight: 600;"><i class="bi bi-list-check me-2"></i>Items</h5>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['description'] ?? $item['itemname'] ?? ''); ?></td>
                    <td class="item-qty"><?php echo htmlspecialchars($item['quantity'] ?? 0); ?></td>
                    <td class="item-price"><?php echo number_format($item['unit_price'] ?? 0, 2); ?></td>
                    <td class="item-total">
                        <?php
                            $qty = floatval($item['quantity'] ?? 0);
                            $rate = floatval($item['unit_price'] ?? 0);
                            echo number_format($qty * $rate, 2);
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Total Line -->
    <div class="total-line">
        <span>Total amount (India)</span>
        <span><?php echo format_money($display_total); ?></span>
    </div>

    <!-- Notes (if any) -->
    <?php if (!empty($row['description'])): ?>
    <div class="notes-section">
        <h5><i class="bi bi-chat-text-fill me-2"></i>Notes</h5>
        <p class="mb-0"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
    </div>
    <?php endif; ?>

    <!-- FOOTER (inside wrapper) -->
    <div class="receipt-footer">
        <hr class="footer-rule">
        <p class="footer-text">
            INFOTELL SUPPLIES & SOLUTIONS · 123 Business Street, City · +91 98765 43210 · info@infotell.com<br>
            <span style="font-size:0.75rem;">Thank you for your business</span>
        </p>
    </div>
</div> <!-- end quotation-wrapper -->

<!-- Print button (hidden when printing) -->
<div class="no-print" style="text-align: center; margin: 20px 0;">
    <button onclick="window.print()" class="btn btn-primary" style="background: #2878EB; color: white; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; font-size: 1rem; margin-right: 10px;">
        <i class="bi bi-printer"></i> Print Receipt
    </button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
// Optional JavaScript
</script>

<?php include 'footer.php'; ?>