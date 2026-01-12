<?php
// Include the database connection
include 'admin/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Archive | CIL Innovation & Incubation Centre</title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="stylenav.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <style>
        .newsletter-card {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border-radius: 20px;
            overflow: hidden;
            background: white;
            border: 1px solid #e2e8f0;
        }
        
        .newsletter-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

       .preview-window {
            height: 240px;
            overflow: hidden;
            position: relative;
            background: #f1f5f9;
            margin: 15px;
            border-radius: 15px;
        }
         

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        .main_body { 
            padding-top: 120px; 
            min-height: 80vh;
        }
        
        .heading h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
        } */
    </style>
    <link rel="stylesheet" href="css/style_about.css">
</head>

<body>

<header>
    <a href="index.php" class="logo">
        <span><img src="Logo.jpeg" alt="CIL"></span>
    </a>

    <div class="menu-toggle" id="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation Programs</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="team.php">Our Team</a></li>
            <li><a href="newsletter.php" class="active">Newsletters</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="main_body" style="background: linear-gradient(to bottom, #f8fafc, #eff6ff);">

    <div class="heading" style="text-align: center; margin-bottom: 50px;">
        <h1>Newsletter Section</h1>
        <p style="color: #64748b; font-size: 1.1rem;">Stay updated with our latest innovations and center activities</p>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div id="newsletterGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
            $query = "SELECT * FROM newsletters ORDER BY upload_date DESC";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $fileUrl = "admin/docs/newsletters/" . $row['file_path'];
                    $uniqueId = "pdf-" . $row['id'];
                    ?>
                    
                    <div class="newsletter-card">
                        <div class="preview-window group">
                            <canvas id="<?= $uniqueId ?>" data-pdf-url="<?= $fileUrl ?>"></canvas>
                            
                            <div id="loader-<?= $uniqueId ?>" class="absolute inset-0 flex items-center justify-center bg-slate-50">
                                <div class="w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                            </div>

                            <div class="absolute inset-0 bg-blue-600/80 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                 <a href="<?= $fileUrl ?>" target="_blank" class="bg-white text-blue-700 px-8 py-3 rounded-full font-bold shadow-lg no-underline hover:bg-gray-100 transition-colors">
                                    Read Newsletter
                                 </a>
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <!-- <span class="text-blue-500 font-bold text-[11px] uppercase tracking-widest">Innovation Update</span> -->
                                    <h3 class="text-xl font-bold text-slate-800 mt-1 mb-2 leading-tight">
                                        <?= htmlspecialchars($row['title']) ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="flex items-center text-slate-400 text-sm mt-4 pt-4 border-t border-slate-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <?= date('F d, Y', strtotime($row['upload_date'])) ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='col-span-full text-center py-20 text-slate-400 text-xl'>No newsletters found in the archive.</div>";
            }
            ?>
        </div>
    </div>

</div>

<footer class="footer">
    <div class="container">
        <div class="footer-columns">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Indian Institute of Technology (Indian School of Mines) Dhanbad establishes Coal India Innovation
                    Centre (CII), providing an enabling environment for young innovators to shape their ideas. It
                    contributes to youth development and societal growth.</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="quick-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="incubation.php">Incubation Programs</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="portfolio.php">Protfolio</a></li>
                    <li><a href="team.php">Our Team</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> 4<sup>th</sup> Floor, i2h Building, IIT (ISM),</li>
                    <li> Dhanbad, Jharkhand ,India</li>
                    <li><i class="fas fa-envelope"></i> cii@iitism.ac.in</li>
                    <li><i class="fas fa-phone"></i> +91 6299255860</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="scriptnav.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    async function renderThumbnails() {
        const canvases = document.querySelectorAll('canvas');
        for (const canvas of canvases) {
            const url = canvas.getAttribute('data-pdf-url');
            const loader = document.getElementById(`loader-${canvas.id}`);
            try {
                const loadingTask = pdfjsLib.getDocument(url);
                const pdf = await loadingTask.promise;
                const page = await pdf.getPage(1);
                const context = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: 1.2 });
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                await page.render({canvasContext: context, viewport: viewport}).promise;
                if (loader) loader.style.display = 'none';
            } catch (err) {
                if (loader) loader.innerHTML = "<span class='text-xs text-red-400'>Preview Unavailable</span>";
            }
        }
    }
    window.addEventListener('load', renderThumbnails);
</script>

</body>
</html>