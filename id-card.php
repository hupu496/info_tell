<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ID Card System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header text-center">
        <div class="container">
            <h1 class="display-5"><i class="bi bi-person-badge"></i> Student ID Card System</h1>
            <p class="lead">Register and generate your student ID card</p>
        </div>
    </div>
 <div class="container">
    <!-- Step Indicator -->
    <div class="step-indicator">
        <button class="step active" id="step1" onclick="goToStep('capture')">
            1
            <span class="step-label">Capture Photo</span>
        </button>
        <button class="step" id="step2" onclick="goToStep('form')">
            2
            <span class="step-label">Fill Form</span>
        </button>
        <button class="step" id="step3" onclick="goToStep('preview')">
            3
            <span class="step-label">Preview ID</span>
        </button>
    </div>
</div>

        <!-- Photo Capture Section -->
        <div class="row" id="photoSection">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-camera"></i> Capture Student Photo</h5>
                    </div>
                    <div class="card-body">
                        <div class="camera-container text-center">
                            <video id="video" autoplay playsinline></video>
                            <div class="camera-options justify-content-center mt-3">
                                <button id="captureBtn" class="btn btn-primary"><i class="bi bi-camera"></i> Capture Photo</button>
                                <button id="switchCamera" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-right"></i> Switch Camera</button>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="instruction">Or upload a photo instead</p>
                            <input type="file" id="photoUpload" accept="image/*" class="d-none">
                            <button id="uploadTrigger" class="btn btn-outline-primary"><i class="bi bi-upload"></i> Upload Photo</button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <h6>Photo Preview</h6>
                            <div class="photo-preview mx-auto">
                                <i class="bi bi-person fs-1 text-secondary"></i>
                                <img id="previewImg" src="" alt="Preview">
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button id="nextToForm" class="btn btn-success" disabled><i class="bi bi-arrow-right"></i> Continue to Form</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Form Section (Initially Hidden) -->
        <div class="row d-none" id="formSection">
            <div class="col-lg-10 mx-auto">
                <div class="card form-section">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> Student Information Form</h5>
                    </div>
                    <div class="card-body">
                        
<form id="idCardForm">
    <div class="row justify-content-center">

        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" id="studentName" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Student ID & Roll Number</label>
                <input type="text" id="rollNumber" class="form-control" placeholder="Roll Number">
            </div>

            <div class="mb-3">
                <label class="form-label">Class/Grade</label>
                <input type="text" class="form-control" id="class" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Section</label>
                <input type="text" class="form-control" id="section" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Father Name</label>
                <input type="text" class="form-control" id="fatherName" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Blood Group</label>
                <select class="form-select" id="bloodGroup">
                    <option value="">Select</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone">
            </div>
        </div>

    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary btn-lg">
            Generate ID Card
        </button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- List Section (Initially Hidden) -->
        <div class="row d-none" id="listSection">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0"><i class="bi bi-list-ul"></i> Registered Students</h5>
    <div>
        <button id="downloadAllBtn" class="btn btn-light btn-sm me-2">
            <i class="bi bi-download"></i> Download All (PDF)
        </button>
        <button id="deleteSelectedBtn" class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i> Delete Selected
        </button>
    </div>
</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Actions</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsList">
                                    <!-- Students will be listed here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ID Card Preview Modal -->
        <div class="modal fade" id="idCardModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                         <h5 class="modal-title">ID Card Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
             <button id="printBtn" class="btn btn-success me-2">
                  <i class="bi bi-printer"></i> Print ID Card
                          </button>
                    <button id="downloadBothBtn" class="btn btn-primary">
                     <i class="bi bi-download"></i> Download Front & Bac
                    </button>
                             </div>
                        <div class="d-flex flex-column align-items-center gap-4"></div>
                       <div class="id-card-container" id="idCardContainer">
                            <!-- Front of ID Card -->
                             
                            <div class="id-card mb-4" id="idCardFront">
                                <div class="p-4 position-relative">
                                     <!-- School Name -->
                                        <div class="university-logo">UNIVERSITY OF TECHNOLOGY</div>
                                        <div class="id-number">ID: <span id="previewId">STU-0000</span></div>
                                    </div>
                                     <!-- Centered Photo -->
                                        <div class="me-3">
                                            <div class="photo-preview" id="cardPhotoPreview">
                                                <img id="cardPhotoImg" src="" alt="">
                                            </div>
                                        </div>
                                         <!-- Student Details (below the photo) -->
                                            <div class="student-details text-center">
                                          <h5 id="previewName">Student Name</h5>
                                    <p><strong>Roll No:</strong> <span id="previewRoll"></span></p>
                                              <p id="previewDob">DOB: DD/MM/YYYY</p>
                                            <p id="previewBloodGroup">Blood Group:</p>
                                                 <p id="previewPhone">Phone:</p>
                                     <p><strong>Class:</strong> <span id="previewclass">10</span></p>
                                     <p><strong>Section:</strong> <span id="previewsection">A</span></p>
                                        </div>

                                      <!-- Signature & Website -->
                                   <div class="text-center mt-3">
                             <div class="authorized-signature"></div>
                          <div class="small university-url">
                         <i class="bi bi-globe me-1"></i> www.university.edu
      </div>
    </div>

  </div>
</div>
                            
                            <!-- Back of ID Card -->
                            <div class="id-card id-card-back" id="idCardBack">
                                <div class="p-4">
                                    <h6 class="text-center mb-3">UNIVERSITY OF TECHNOLOGY</h6>
                                    <div class="barcode"></div>
                                    <div class="student-info">
                                        <div class="student-info">
                                    <p><strong>Name:</strong> <span id="backPreviewName"></span></p>
                                        <p><strong>ID:</strong> <span id="backPreviewId"></span></p>
                                    <p><strong>Roll No:</strong> <span id="backPreviewRoll"></span></p>
                                      <p><strong>Father Name:</strong> <span id="backPreviewfather"></span></p>
                                      <p><strong>Valid Until:</strong> <span id="validUntil">31/12/2025</span></p>
                                        </div>

                                    <div class="mt-4 small">
                                        <p class="mb-1"><strong>Address:</strong> 123 University Avenue, City, State</p>
                                        <p class="mb-1"><strong>Phone:</strong> +1 (123) 456-7890</p>
                                        <p class="mb-0"><strong>Email:</strong> info@university.edu</p>
                                    </div>
                                    <div class="text-center mt-4">
                                        <div class="small text-muted">In case of emergency, please return this card to the address above</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <!-- Fixed Footer -->
<!-- FOOTER MUST BE HERE -->
<div class="footer-nav">
  <div class="footer-content">
    <button id="homeBtn" class="footer-btn">
      <i class="bi bi-house"></i>
    </button>

    <button id="listBtn" class="footer-btn">
      <i class="bi bi-list-ul"></i>
    </button>
  </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="script.js"></script>

</body>
</html>  