
      
      document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const photoSection = document.getElementById('photoSection');
            const formSection = document.getElementById('formSection');
            const listSection = document.getElementById('listSection');
            const video = document.getElementById('video');
            const captureBtn = document.getElementById('captureBtn');
            const switchCamera = document.getElementById('switchCamera');
            const previewImg = document.getElementById('previewImg');
            const photoUpload = document.getElementById('photoUpload');
            const uploadTrigger = document.getElementById('uploadTrigger');
            const nextToForm = document.getElementById('nextToForm');
            const idCardForm = document.getElementById('idCardForm');
            const studentsList = document.getElementById('studentsList');
            const idCardModal = new bootstrap.Modal(document.getElementById('idCardModal'));
            const printBtn = document.getElementById('printBtn');
            const downloadBtn = document.getElementById('downloadBtn');
            
    // Step indicators
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step3 = document.getElementById('step3');
            
            let stream = null;
            let currentFacingMode = 'user'; // 'user' for front camera, 'environment' for back camera
            let capturedPhotoData = null;
            let students = [];

        
            
             // Footer button actions
document.getElementById("homeBtn").addEventListener("click", function () {
    goToStep("capture");
});

document.getElementById("listBtn").addEventListener("click", function () {
    // Hide other sections
    document.getElementById("photoSection").classList.add("d-none");
    document.getElementById("formSection").classList.add("d-none");

    // Show list section
    document.getElementById("listSection").classList.remove("d-none");

    // Remove active from step indicator
    document.querySelectorAll(".step").forEach(step => step.classList.remove("active"));
});
function reverseGoToStep(stepId) {
    // Hide all sections
    photoSection.classList.add("d-none");
    formSection.classList.add("d-none");
    listSection.classList.add("d-none");

    // Reset step indicators
    step1.classList.remove("active", "completed");
    step2.classList.remove("active", "completed");
    step3.classList.remove("active", "completed");

    if (stepId === "capture") {
        // Go back to Step 1 (Capture Photo)
        photoSection.classList.remove("d-none");
        initCamera(); // restart camera
        step1.classList.add("active");
if (lastStudent.photo) {
    capturedPhotoData = lastStudent.photo;
    previewImg.src = capturedPhotoData;
    previewImg.style.display = 'block';
    document.querySelector('.photo-preview i').style.display = 'none';
}
    } else if (stepId === "form") {
        // Go back to Step 2 (Form) with last entered data
        formSection.classList.remove("d-none");
        step1.classList.add("completed");
        step2.classList.add("active");

      
      
        if (savedStudents.length > 0) {
            let lastStudent = savedStudents[savedStudents.length - 1];
            document.getElementById("studentId").value = lastStudent.id;
            document.getElementById("studentName").value = lastStudent.name;
            document.getElementById("class").value = lastStudent.class;
             document.getElementById("section").value = lastStudent.section;
            document.getElementById("father").value = lastStudent.father;
            document.getElementById("dob").value = lastStudent.dob;
            document.getElementById("bloodGroup").value = lastStudent.bloodGroup;
            document.getElementById("phone").value = lastStudent.phone;
        }

    } else if (stepId === "preview") {
        // Stay at Step 3 (List/Preview)
        listSection.classList.remove("d-none");
        step1.classList.add("completed");
        step2.classList.add("completed");
        step3.classList.add("active");
    }
}

// Attach reverse navigation to step buttons
step1.addEventListener("click", () => reverseGoToStep("capture"));
step2.addEventListener("click", () => reverseGoToStep("form"));
step3.addEventListener("click", () => reverseGoToStep("preview"));
// Wrapper for Home button navigation
function goToStep(stepId) {
    reverseGoToStep(stepId);

    if (stepId === "capture") {
        // Reset form fields
        document.getElementById("idCardForm").reset();

        // Reset photo preview
        capturedPhotoData = null;
        previewImg.src = "";
        previewImg.style.display = "none";
        document.querySelector(".photo-preview i").style.display = "block";

        // Disable "Continue to Form" until new photo is captured/uploaded
        nextToForm.disabled = true;

        // Restart camera
        initCamera();
    }
}

           // Initialize camera
            function initCamera(facingMode = 'user') {
                stopCamera(); // Stop any existing stream
                
                const constraints = {
                    video: { 
                        facingMode: facingMode,
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                };
                
                navigator.mediaDevices.getUserMedia(constraints)
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        video.srcObject = stream;
                        currentFacingMode = facingMode;
                    })
                    .catch(function(err) {
                       console.error("Error accessing camera: ", err);
                       alert("Unable to access camera: " + err.message);
                  });
            }
            
            // Stop camera
            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            }
            
            // Switch camera
            switchCamera.addEventListener('click', function() {
                const newFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
                initCamera(newFacingMode);
            });
            
            // Capture photo
            captureBtn.addEventListener('click', function() {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                capturedPhotoData = canvas.toDataURL('image/png');
                previewImg.src = capturedPhotoData;
                previewImg.style.display = 'block';
                document.querySelector('.photo-preview i').style.display = 'none';
                
                nextToForm.disabled = false;
            });
            
            // Upload photo trigger
            uploadTrigger.addEventListener('click', function() {
                photoUpload.click();
            });
            
            // Handle photo upload
            photoUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        capturedPhotoData = event.target.result;
                        previewImg.src = capturedPhotoData;
                        previewImg.style.display = 'block';
                        document.querySelector('.photo-preview i').style.display = 'none';
                        
                        nextToForm.disabled = false;
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Next to form
            nextToForm.addEventListener('click', function() {
                photoSection.classList.add('d-none');
                formSection.classList.remove('d-none');
                stopCamera();
                
                step1.classList.remove('active');
                step1.classList.add('completed');
                step2.classList.add('active');
            });
            
          // Modified form submission
          
   // through id form submit then load js and save into save_student.php

idCardForm.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!capturedPhotoData) {
        alert("Please capture or upload photo first");
        return;
    }

    const formData = new FormData();
    formData.append("name", document.getElementById("studentName").value);
    formData.append("roll", document.getElementById("rollNumber").value); 
    formData.append("class", document.getElementById("class").value);
    formData.append("section", document.getElementById("section").value);
    formData.append("father", document.getElementById("fatherName").value);
    formData.append("dob", document.getElementById("dob").value);
    formData.append("bloodgroup", document.getElementById("bloodGroup").value);
    formData.append("phone", document.getElementById("phone").value);
    formData.append("photo", capturedPhotoData); // base64 → PHP

    fetch("save_student.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            alert("ID Card Generated Successfully");

            formSection.classList.add("d-none");
            listSection.classList.remove("d-none");

            step2.classList.add("completed");
            step3.classList.add("active");

            loadStudents(); // reload from backend
            idCardForm.reset();
        } else {
            alert(data.message || "Failed to save student");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Server error");
    });
});
            
let studentss = []; // store all students from Google Sheet

// Fetch all students from your Apps Script Web App
async function loadStudents() {
    try {
        const response = await fetch("fetch_students.php");
        studentss = await response.json();
        updateStudentsList();
    } catch (err) {
        console.error("Failed to fetch students", err);
    }
}


function updateStudentsList() {
    studentsList.innerHTML = '';

    studentss.forEach((student, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.id}</td>
            <td>${student.name}</td>
            <td>${student.class}</td>
            <td>${student.roll}</td>

            <td>
                <button class="btn btn-sm btn-primary view-btn" data-index="${index}">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-success download-btn" data-index="${index}">
                    <i class="bi bi-download"></i>
                </button>
                <button class="btn btn-sm btn-danger delete-btn" data-index="${index}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
            <td class="text-center">
                <input type="checkbox" class="select-card" data-index="${index}">
            </td>
        `;
        studentsList.appendChild(row);
    });

    // View card
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = parseInt(this.getAttribute('data-index'));
            showIdCard(studentss[index]);
        });
    });

    // Delete card
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = parseInt(this.getAttribute('data-index'));
            if (confirm(`Delete ID Card for ${studentss[index].name}?`)) {
                studentss.splice(index, 1);
              
                updateStudentsList();
            }
        });
    });

    // Download single card
    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', async function () {
            const index = parseInt(this.getAttribute('data-index'));
            await downloadStudentCard(studentss[index]);
        });
    });
}


            
            // Show ID card
          function showIdCard(student) {

    const formattedDob = new Date(student.dob).toLocaleDateString("en-GB");

    document.getElementById("previewName").textContent = student.name;
    document.getElementById("previewId").textContent = student.id;
    document.getElementById("previewRoll").textContent = student.roll || "N/A"; // ✅
    document.getElementById("previewclass").textContent = student.class;
    document.getElementById("previewsection").textContent = student.section;
    document.getElementById("previewDob").textContent = "DOB: " + formattedDob;
    document.getElementById("previewBloodGroup").textContent =
        "Blood Group: " + (student.bloodgroup || "N/A");
    document.getElementById("previewPhone").textContent =
        "Phone: " + (student.phone || "N/A");

    document.getElementById("backPreviewName").textContent = student.name;
    document.getElementById("backPreviewId").textContent = student.id;
    document.getElementById("backPreviewfather").textContent = student.father;

    const backRoll = document.getElementById("backPreviewRoll");
    if (backRoll) backRoll.textContent = student.roll || "N/A";

    // Photo
    const img = document.getElementById("cardPhotoImg");
    img.src = student.photo;
    img.style.display = "block";

    new bootstrap.Modal(document.getElementById("idCardModal")).show();
}

            
            // Print ID card
            printBtn.addEventListener('click', function() {
                const printContent = document.getElementById('idCardContainer').innerHTML;
                const originalContent = document.body.innerHTML;
                
                document.body.innerHTML = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Print ID Card</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
                       <style>
@page {
    size: A4 portrait;
    margin: 8mm;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
}

/* Each A4 page */
.page {
    display: grid;
    grid-template-columns: repeat(2, 1fr);  /* 2 columns */
    grid-template-rows: repeat(4, 1fr);     /* 4 rows */
    gap: 6mm;
    height: 100%;
    page-break-after: always;
}

.page:last-child {
    page-break-after: auto;
}

/* Card design */
.card {
    border: 1px solid #000;
    padding: 6px;
    box-sizing: border-box;
    font-size: 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card h3 {
    font-size: 13px;
    text-align: center;
    margin: 0 0 5px 0;
}

.card p {
    margin: 2px 0;
    font-size: 11px;
}

.photo {
    width: 50px;
    height: 50px;
    object-fit: cover;
    align-self: center;
    margin-bottom: 4px;
}
</style>
                    </head>
                    <body>
                        <div class="container">
                            ${printContent}
                        </div>
                    </body>
                    </html>
                `;
                
                window.print();
                document.body.innerHTML = originalContent;
                location.reload();
            });
            
            // Download both sides (front & back) as separate PNGs
 document.getElementById('downloadBothBtn').addEventListener('click', async function() {
    const front = document.getElementById('idCardFront');
    const back = document.getElementById('idCardBack');

    if (!front || !back) return;

    // 1. Temporarily convert CSS barcode to an image
    const barcode = back.querySelector('.barcode');
    let barcodeImg = null;
    if (barcode) {
        const barcodeCanvas = document.createElement('canvas');
        barcodeCanvas.width = barcode.offsetWidth;
        barcodeCanvas.height = barcode.offsetHeight;
        const ctx = barcodeCanvas.getContext('2d');

        // Fill white background
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, barcodeCanvas.width, barcodeCanvas.height);

        // Draw the barcode as black stripes
        const stripeWidth = 1;
        const gap = 20; // repeat pattern width
        for (let x = 0; x < barcodeCanvas.width; x += gap) {
            ctx.fillStyle = "#000";
            ctx.fillRect(x, 0, stripeWidth, barcodeCanvas.height);
        }

        // Replace original barcode with image for html2canvas
        barcodeImg = document.createElement('img');
        barcodeImg.src = barcodeCanvas.toDataURL('image/png');
        barcodeImg.style.width = '100%';
        barcodeImg.style.height = '80px';
        barcode.innerHTML = '';
        barcode.appendChild(barcodeImg);
    }

    // 2. Capture front and back as canvas
    const frontCanvas = await html2canvas(front, { scale: 3 });
    const backCanvas = await html2canvas(back, { scale: 3 });

    // 3. Create a combined canvas
    const combinedCanvas = document.createElement('canvas');
    const width = Math.max(frontCanvas.width, backCanvas.width);
    const height = frontCanvas.height + backCanvas.height;
    combinedCanvas.width = width;
    combinedCanvas.height = height;

    const ctx = combinedCanvas.getContext('2d');
    ctx.fillStyle = "#ffffff"; // white background
    ctx.fillRect(0, 0, width, height);
    ctx.drawImage(frontCanvas, 0, 0);
    ctx.drawImage(backCanvas, 0, frontCanvas.height);

    // 4. Trigger download
    const link = document.createElement('a');
    link.download = `IDCard_${document.getElementById('previewId').textContent}.png`;
    link.href = combinedCanvas.toDataURL('image/png');
    link.click();

    // 5. Restore original barcode CSS
    if (barcodeImg) {
        barcode.innerHTML = '';
        barcode.style.border = '1px solid #ddd';
        barcode.style.background = 'repeating-linear-gradient(90deg, #000 0px, #000 1px, transparent 1px, transparent 20px)';
    }
});


document.getElementById("downloadAllBtn").addEventListener("click", function () {

    const selectedCheckboxes = document.querySelectorAll(".select-card:checked");

    if (selectedCheckboxes.length === 0) {
        alert("Please select at least one student!");
        return;
    }

    const selectedStudents = [];

    selectedCheckboxes.forEach(cb => {
        const index = cb.getAttribute("data-index");
        if (studentss[index]) {
            selectedStudents.push(studentss[index]);
        }
        console.log();
    });

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "print_student.php";
    form.target = "_blank";

    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "students";
    input.value = JSON.stringify(selectedStudents);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
    
});



// Delete selected students
document.getElementById("deleteSelectedBtn").addEventListener("click", function () {
    const selectedCheckboxes = document.querySelectorAll(".select-card:checked");
    if (selectedCheckboxes.length === 0) {
        alert("Please select at least one student to delete.");
        return;
    }

    if (!confirm(`Are you sure you want to delete ${selectedCheckboxes.length} selected record(s)?`)) return;

    const indexesToDelete = Array.from(selectedCheckboxes).map(cb => parseInt(cb.getAttribute("data-index")));
    indexesToDelete.sort((a, b) => b - a); // delete from end to avoid reindex issues

    indexesToDelete.forEach(index => {
        studentss.splice(index, 1);
    });

   
    updateStudentsList();
    alert("Selected students deleted successfully!");
});

  
            loadStudents();
            // Initialize the app
            initCamera();
            
            // If we have students, show the list directly
            if (studentss.length > 0) {
                photoSection.classList.add('d-none');
                formSection.classList.add('d-none');
                listSection.classList.remove('d-none');
                updateStudentsList();
                
                step1.classList.add('completed');
                step2.classList.add('completed');
                step3.classList.add('active');
            }   
        });
        