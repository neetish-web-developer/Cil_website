<?php
include 'admin/connection.php';

$aboutImage = $aboutName = $aboutParagraph = '';
$aimTitle = '';
$aimPoints = [];

$q = mysqli_query($conn, "SELECT * FROM about LIMIT 1");
if ($q && mysqli_num_rows($q) > 0) {
    $d = mysqli_fetch_assoc($q);
    $aboutImage = $d['image'];
    $aboutName = $d['name'];
    $aboutParagraph = $d['paragraph'];
    $aimTitle = $d['title'];

    for ($i = 1; $i <= 11; $i++) {
        if (!empty($d["p$i"])) $aimPoints[] = $d["p$i"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About | CIL Innovation & Incubation Centre</title>

<style>
/* =========================
   GLOBAL
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f2f4f5;
    color: #333;
}

/* =========================
   HEADER
========================= */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    background: #003366;
}

header img {
    height: 45px;
}

.navbar ul {
    display: flex;
    list-style: none;
    gap: 20px;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
}

.navbar a.active {
    border-bottom: 2px solid #ffcc00;
}

/* =========================
   PAGE HEADING
========================= */
.heading {
    text-align: center;
    padding: 60px 20px 20px;
}

.heading h1 {
    font-size: 40px;
    color: #003366;
}

.heading p {
    color: #666;
    margin-top: 10px;
    letter-spacing: 1px;
}

/* =========================
   STORY EXPERIENCE
========================= */
.story-wrapper {
    max-width: 1200px;
    margin: 80px auto;
    padding-left: 60px;
    position: relative;
}

.story-line {
    position: absolute;
    left: 25px;
    top: 0;
    width: 4px;
    height: 0;
    background: linear-gradient(to bottom, #0ba29d, #003366);
    border-radius: 10px;
}

/* =========================
   STORY BLOCKS
========================= */
.story-block {
    margin-bottom: 120px;
    opacity: 0.25;
    transform: translateY(40px);
    transition: all 0.8s ease;
}

.story-block.active {
    opacity: 1;
    transform: translateY(0);
}

/* =========================
   ABOUT SECTION
========================= */
.about {
    display: flex;
    gap: 50px;
    align-items: center;
}

.about-image {
    flex: 1;
    perspective: 800px;
}

.about-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    transition: transform 0.2s ease;
}

.about-content {
    flex: 1;
}

.about-content h2 {
    font-size: 30px;
    color: #003366;
    margin-bottom: 15px;
}

.about-content p {
    font-size: 16px;
    line-height: 1.7;
}

/* =========================
   AIM SECTION
========================= */
.container2 h1 {
    font-size: 32px;
    color: #003366;
    margin-bottom: 30px;
}

.aim {
    list-style: none;
}

.aim li {
    background: #fff;
    margin-bottom: 14px;
    padding: 16px 20px;
    border-left: 6px solid #0ba29d;
    border-radius: 6px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.06);
}

/* =========================
   FOOTER
========================= */
footer {
    background: #003366;
    color: #fff;
    padding: 40px 20px;
    margin-top: 80px;
    text-align: center;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 900px) {
    .about {
        flex-direction: column;
        text-align: center;
    }
    .story-wrapper {
        padding-left: 30px;
    }
}
</style>
</head>

<body>

<header>
    <img src="Logo.jpeg" alt="CIL">
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="about.php">About</a></li>
            <li><a href="incubation.php">Incubation</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="heading">
    <h1>About Us</h1>
    <p>CIL INNOVATION & INCUBATION CENTRE</p>
</div>

<div class="story-wrapper">
    <div class="story-line"></div>

    <!-- ABOUT BLOCK -->
    <?php if ($aboutImage): ?>
    <section class="story-block">
        <div class="about">
            <div class="about-image">
                <img src="admin/img/about/<?php echo htmlspecialchars($aboutImage); ?>">
            </div>
            <div class="about-content">
                <h2><?php echo htmlspecialchars($aboutName); ?></h2>
                <p><?php echo htmlspecialchars($aboutParagraph); ?></p>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- AIM BLOCK -->
    <?php if ($aimTitle): ?>
    <section class="story-block">
        <div class="container2">
            <h1><?php echo htmlspecialchars($aimTitle); ?></h1>
            <ul class="aim">
                <?php foreach ($aimPoints as $p): ?>
                <li><?php echo htmlspecialchars($p); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>
</div>

<footer>
    © <?php echo date("Y"); ?> CIL Innovation & Incubation Centre | IIT (ISM) Dhanbad
</footer>

<script>
/* =========================
   STORY SCROLL LOGIC
========================= */
const wrapper = document.querySelector('.story-wrapper');
const line = document.querySelector('.story-line');
const blocks = document.querySelectorAll('.story-block');

window.addEventListener('scroll', () => {
    const rect = wrapper.getBoundingClientRect();
    const view = window.innerHeight;

    let progress = Math.min(Math.max((view - rect.top) / rect.height, 0), 1);
    line.style.height = (progress * rect.height) + 'px';

    blocks.forEach(b => {
        if (b.getBoundingClientRect().top < view * 0.75) {
            b.classList.add('active');
        }
    });
});

/* =========================
   MAGNETIC IMAGE EFFECT
========================= */
const img = document.querySelector('.about-image img');

if (img) {
    img.addEventListener('mousemove', e => {
        const r = img.getBoundingClientRect();
        const x = e.clientX - r.left - r.width / 2;
        const y = e.clientY - r.top - r.height / 2;
        img.style.transform =
            `rotateX(${ -y / 20 }deg) rotateY(${ x / 20 }deg) scale(1.04)`;
    });

    img.addEventListener('mouseleave', () => {
        img.style.transform = 'rotateX(0) rotateY(0) scale(1)';
    });
}
</script>

</body>
</html>
