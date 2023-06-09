<?php
require_once  __DIR__ . '/controllers/UserSubcription.php';
require_once  __DIR__ . '/controllers/Movie.php';
session_start();

if (isset($_SESSION['auth'])) {
  $user_subcription = checkSubcription($_SESSION['auth']['id']);

  // JIka user yg login belum berlnagnanan maka lempar ke kalaman pembayar, suruh bayar dlu
  if (!$user_subcription['status']) {
    header('location: dashboard-subscription.php', true);
    exit;
  }
}

// Ambil data movie
$movie = movie($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stream</title>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
  </style>
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="assets/script/tailwind-config.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video-js.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/videojs.css" />
</head>

<body>
  <section class="mx-auto w-screen relative watching-page font-poppins" id="stream">
    <!-- <video-js id="stream-video" class="overflow-hidden h-screen w-screen">
      <source src="http://techslides.com/demos/sample-videos/small.mp4" type="video/mp4" />
      <p class="vjs-no-js text-twmdark">
        To view this video please enable JavaScript, and consider upgrading to
        a web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
      </p>
    </video-js> -->

    <iframe class="overflow-hidden h-screen w-screen" src="<?=$movie['link_movie']?>?autoplay=1" allowfullscreen allowtransparency allow="autoplay" frameborder="0" id="__existing-iframe-id"></iframe>
    <!-- Button back to dashboard -->
    <div class="absolute top-5 left-5 z-20">
      <a href="dashboard.php">
        <img src="assets/images/ic_arrow-left.svg" class="transition-all btn-back w-[46px]" alt="stream" />
      </a>
    </div>

    <!-- Video Title -->
    <div class="absolute title-video top-7 left-1/2 -translate-x-1/2 max-w-[310px] md:max-w-[620px] text-center">
      <span class="font-medium text-2xl transition-all text-white drop-shadow-md select-none">
        Details Screen of <?=$movie['title']?>
      </span>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="assets/script/script.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video.min.js"></script>

  <script>
    // videojs data-setup
    videojs("stream-video", {
      controls: true,
      autoplay: true,
      preload: "auto",
      poster: "/assets/images/poster.png",
      disablePictureInPicture: true,
      noUTitleAttributes: true,
    });

    var lastTimeMouseMoved = "";
    $(document).mousemove(function(e) {
      $(".btn-back").css({
        opacity: "1",
        transition: "all .3s",
      });
      $(".title-video").css({
        opacity: "1",
        transition: "all .3s",
      });
      $(".vjs-control-bar").css({
        opacity: "1",
        transition: "all .3s",
      });
      lastTimeMouseMoved = new Date().getTime();
      setTimeout(function() {
        var currentTime = new Date().getTime();
        if (currentTime - lastTimeMouseMoved > 800) {
          $(".btn-back").css("opacity", "0");
          $(".title-video").css("opacity", "0");
          $(".vjs-control-bar").css("opacity", "0");
        }
      }, 800);
    });
  </script>
</body>

</html>