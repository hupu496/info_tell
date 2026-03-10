<?php
session_start();
$pageTitle = "INFOTELL · New Quotation";
include 'header.php';
?>
<style>
    .quotation-wrapper { max-width: 1200px; margin: 0 auto; }
    .letterhead { border-bottom: 2px solid #1e2a3a; padding-bottom: 1rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; }
    .company { font-size: 2.2rem; font-weight: 700; letter-spacing: 2px; color: #1e2a3a; line-height: 1; }
    .ref-date { font-size: 1rem; color: #2c3e50; background: #e9ecef; padding: 0.6rem 1.2rem; border-radius: 30px; }
    .ref-date i { margin-right: 6px; color: #0d6efd; }
    .form-card { background: white; border-radius: 24px; box-shadow: 0 20px 40px -10px rgba(0,20,40,0.15); padding: 2rem; margin-bottom: 2rem; }
    .section-title { font-size: 1.2rem; font-weight: 600; color: #1e2a3a; margin-bottom: 1.5rem; border-left: 5px solid #0d6efd; padding-left: 1rem; }
    .form-label { font-weight: 500; color: #2c3e50; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .form-control, .form-select { border-radius: 14px; border: 1px solid #dde1e7; padding: 0.6rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.15); }
    .btn-generate { background: #1e2a3a; color: white; border-radius: 40px; padding: 0.7rem 3rem; font-weight: 600; border: none; font-size: 1.1rem; }
    .btn-generate:hover { background: #0b1a2a; }
    .item-row { margin-bottom: 10px; }
    .remove-row { color: red; cursor: pointer; margin-left: 10px; }
    .small-note { color: #6c757d; font-size: 0.85rem; }
    .total-display { font-weight: 600; margin-right: 10px; }
    .action-col { display: flex; align-items: center; }
</style>

<div class="quotation-wrapper">
    <div class="letterhead">
        <div class="company">INFOTELL</div>
        <div class="ref-date">
            <i class="bi bi-pencil-fill"></i> fill in details · receipt opens after save
        </div>
    </div>

    <div class="form-card">
        <h2 class="section-title"><i class="bi bi-file-text-fill me-2"></i>Create quotation</h2>
        <form action="save_quotation.php" method="POST" id="quotationForm">
            <div class="row g-4">
                <!-- Company Name -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-building me-1"></i>Select Company Name</label>
                    <input type="text" class="form-control" name="company_name" value="Indian Oil" placeholder="Company name" required>
                </div>
                <!-- Buyer -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-person me-1"></i>Select Buyer</label>
                    <input type="text" class="form-control" name="buyer" value="" placeholder="Buyer name">
                </div>
                <!-- Ref No (auto-generated) -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-tag-fill me-1"></i>Ref No</label>
                    <input type="text" class="form-control" value="INTSS- (auto)" readonly>
                </div>

                <!-- Project Name (full width) -->
                <div class="col-12">
                    <label class="form-label"><i class="bi bi-folder-symlink-fill me-1"></i>Enter Project Name</label>
                    <input type="text" class="form-control" name="project_name" value="Cloud Migration" required>
                </div>

                <!-- Added on (disabled, for info only) -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-calendar-plus-fill me-1"></i>Added on (auto)</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                </div>
                <!-- Due date -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-calendar-check-fill me-1"></i>Due date</label>
                    <input type="date" class="form-control" name="due_date" value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
                </div>
                <!-- Status (disabled, shows default "Draft") -->
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-info-circle-fill me-1"></i>Status (auto)</label>
                    <select class="form-select" disabled>
                        <option value="1" selected>Draft</option>
                        <option value="2">Sent</option>
                        <option value="3">Accepted</option>
                    </select>
                </div>
            </div>

            <!-- Items Table (Unit column removed) -->
            <div class="mt-4">
                <h5 class="mb-3"><i class="bi bi-list-check me-2"></i>Items</h5>
                <table class="table table-bordered" id="itemsTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Total / Remove</th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody">
                        <tr class="item-row">
                            <td><input type="text" name="product[]" class="form-control" placeholder="Product name"></td>
                            <td><input type="number" name="quantity[]" class="form-control quantity" step="0.01" min="0" value="1"></td>
                            <td><input type="number" name="rate[]" class="form-control rate" step="0.01" min="0" value="0"></td>
                            <td class="action-col">
                                <span class="total-display row-total">0.00</span>
                                <span class="remove-row btn btn-danger btn-sm">✖</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="addRow" class="btn btn-primary btn-sm">+ Click to add column</button>
            </div>

            <!-- Notes -->
            <div class="mt-4">
                <label class="form-label"><i class="bi bi-chat-text-fill me-1"></i>Notes</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn-generate"><i class="bi bi-file-earmark-check-fill me-2"></i>Save & open receipt</button>
            </div>
            <div class="text-center mt-3 small-note">
                <i class="bi bi-shield-lock-fill me-1"></i>Data is saved in the database.
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsBody = document.getElementById('itemsBody');
    const addRowBtn = document.getElementById('addRow');

    function updateRowTotal(row) {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const rate = parseFloat(row.querySelector('.rate').value) || 0;
        const total = qty * rate;
        row.querySelector('.row-total').textContent = total.toFixed(2);
    }

    function attachEvents(row) {
        row.querySelector('.quantity').addEventListener('input', () => updateRowTotal(row));
        row.querySelector('.rate').addEventListener('input', () => updateRowTotal(row));
        row.querySelector('.remove-row').addEventListener('click', function() {
            if (document.querySelectorAll('.item-row').length > 1) {
                row.remove();
            } else {
                alert('At least one item row is required.');
            }
        });
    }

    // Attach events to existing rows
    document.querySelectorAll('.item-row').forEach(row => attachEvents(row));

    // Add new row
    addRowBtn.addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.className = 'item-row';
        newRow.innerHTML = `
            <td><input type="text" name="product[]" class="form-control" placeholder="Product name"></td>
            <td><input type="number" name="quantity[]" class="form-control quantity" step="0.01" min="0" value="1"></td>
            <td><input type="number" name="rate[]" class="form-control rate" step="0.01" min="0" value="0"></td>
            <td class="action-col">
                <span class="total-display row-total">0.00</span>
                <span class="remove-row btn btn-danger btn-sm">✖</span>
            </td>
        `;
        itemsBody.appendChild(newRow);
        attachEvents(newRow);
    });
});

</script>

<?php include 'footer.php'; ?>