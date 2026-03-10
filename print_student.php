<?php
if (!isset($_POST['students'])) {
    die("No students selected");
}

$students = json_decode($_POST['students'], true);

if (!$students) {
    die("Invalid student data");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Print ID Cards</title>

<style>
@page {
     size: A4 portrait;
    margin: 5mm;  /* Reduce page margins if needed */
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
}

/* A4 grid */
.page {
      display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(4, min-content); /* Adjust height to content */
    gap: 2mm;  /* Reduced gap */
    page-break-after: always;
}

.page:last-child {
    page-break-after: auto;
}

/* Card size */
.card {
    /* width: 52mm;
    height: 60mm;  vertical */
    /* width: 85mm;
    /* height: 60mm; Horizontal*/ 
    width: 52mm;
    height: 60mm;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* FRONT DESIGN */
.card-front {
    background: linear-gradient(to bottom, #0d3b66 40%, #1d5fa7 40%);
    color: white;
    padding: 6px;
    height: 100%;
    box-sizing: border-box;
}

.card-front h2 {
    text-align: center;
    margin: 0;
    font-size: 12px;
}

.id-number {
    text-align: center;
    font-size: 10px;
    background: white;
    color: #0d3b66;
    padding: 2px;
    border-radius: 15px;
    margin: 4px auto;
    width: 85%;
}

.photo-box {
    text-align: center;
    margin: 4px 0;
}

.photo-box img {
    width: 40px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
    border: 2px solid white;
}

.details {
    font-size: 12px;
    line-height: 1.3;
    text-align: center;
}

/* BACK DESIGN */
.card-back {
    background: #ffffff;
    padding: 6px;
    height: 100%;
    box-sizing: border-box;
    border-top: 5px solid #1d5fa7;
    font-size: 12px;
    text-align: center;
}

.card-back h2 {
    text-align: center;
    color: #1d5fa7;
    font-size: 11px;
    margin-bottom: 3px;
}

.barcode img {
    width: 100%;
    height: 20px;
    object-fit: contain;
}
</style>
</head>

<body>

<?php
$total = count($students);
$index = 0;

while ($index < $total) {
?>
    <div class="page">

        <?php for ($i = 0; $i < 4; $i++) { ?>

            <?php if ($index < $total) {

                $student = array_merge([
                    'name' => '',
                    'id' => '',
                    'roll' => '',
                    'dob' => '',
                    'blood' => '',
                    'phone' => '',
                    'class' => '',
                    'section' => '',
                    'father' => '',
                    'valid' => '',
                    'address' => '',
                    'email' => '',
                    'photo' => ''
                ], $students[$index]);
            ?>

                <!-- FRONT -->
                <div class="card">
                    <div class="card-front">
                        <h2>UNIVERSITY OF TECHNOLOGY</h2>

                        <div class="id-number">
                            ID: <?php echo $student['id']; ?>
                        </div>

                        <div class="photo-box">
                            <img src="<?php echo $student['photo']; ?>">
                        </div>

                        <div class="details">
                            <strong><?php echo $student['name']; ?></strong><br>
                            Roll No: <?php echo $student['roll']; ?><br>
                            DOB: <?php echo $student['dob']; ?><br>
                            Blood Group: <?php echo $student['blood']; ?><br>
                            Phone: <?php echo $student['phone']; ?><br>
                            Class: <?php echo $student['class']; ?><br>
                            Section: <?php echo $student['section']; ?>
                        </div>
                    </div>
                </div>

                <!-- BACK -->
                <div class="card">
                    <div class="card-back">
                        <h2>UNIVERSITY OF TECHNOLOGY</h2>

                        <div class="barcode">
                            <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo urlencode($student['id']); ?>&code=Code128&dpi=96">
                        </div>

                        <strong>Name:</strong> <?php echo $student['name']; ?><br>
                        <strong>ID:</strong> <?php echo $student['id']; ?><br>
                        <strong>Roll No:</strong> <?php echo $student['roll']; ?><br>
                        <strong>Father Name:</strong> <?php echo $student['father']; ?><br>
                        <strong>Valid Until:</strong> <?php echo $student['valid']; ?><br>
                        <strong>Address:</strong> <?php echo $student['address']; ?><br>
                        <strong>Phone:</strong> <?php echo $student['phone']; ?><br>
                        <strong>Email:</strong> <?php echo $student['email']; ?><br>
                    </div>
                </div>

            <?php
                $index++;
            } ?>

        <?php } ?>

    </div>
<?php } ?>

<script>
window.onload = function() {
    window.print();
};
</script>

</body>
</html>