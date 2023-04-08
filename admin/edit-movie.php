<?php
require_once __DIR__ . '../../controllers/Movie.php';
require_once __DIR__ . '../../helpers/flashMessage.php';
session_start();

// JIka user belum login lempar ke halaman login
if (!isset($_SESSION["auth"])) {
    header('location: ../sign_in.php', true);
    exit;
}

// JIka user bukan admin lempar halaman movie
if ($_SESSION['auth']['role'] != 'admin') {
    header('location: ../dashboard.php', true);
    exit;
}

// Ambil data movie
$movie = movie($_GET['id']);


// Panggil fungsi untuk menambah movie
if (isset($_POST['editMovie'])) {
    editMovie($_GET['id']);
}


?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream | Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.1/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
    </style>

    <script src="../assets/script/tailwind-config.js"></script>

    <style type="text/tailwindcss">
        @layer components{
            .side-link{
                @apply flex items-center font-normal text-stream-gray text-base w-full p-4 rounded-2xl gap-[10px] transition-all;
            }
            .side-link.active{
                @apply bg-softpur font-semibold text-white;
            }
        }
    </style>
</head>

<body class="bg-stream-dark font-poppins">
    <!-- Desktop Only -->
    <div class="mx-auto max-w-screen hidden lg:block">
        <!-- START: Sidebar -->
        <aside class="fixed z-50 w-[360px] bg-stream-dark">
            <div class="flex flex-col p-12 border-r border-softpur overflow-y-auto h-screen">
                <a href="/">
                    <img src="assets/images/stream.svg" alt="">
                </a>
                <div class="links flex flex-col mt-16 gap-2">
                    <a href="dashboard-admin.php" class="side-link active">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 17L12 22L22 17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Movie
                    </a>

                    <a href="../controllers/Auth.php?action=logout" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.36 6.64001C19.6184 7.8988 20.4753 9.50246 20.8223 11.2482C21.1693 12.994 20.9909 14.8034 20.3096 16.4478C19.6284 18.0921 18.4748 19.4976 16.9948 20.4864C15.5148 21.4752 13.7749 22.0029 11.995 22.0029C10.2151 22.0029 8.47515 21.4752 6.99517 20.4864C5.51519 19.4976 4.36164 18.0921 3.68036 16.4478C2.99909 14.8034 2.82069 12.994 3.16772 11.2482C3.51475 9.50246 4.37162 7.8988 5.63 6.64001" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 2V12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Log Out
                    </a>
                </div>
            </div>
        </aside>
        <!-- END: Sidebar -->

        <!-- START: Content -->
        <div class="ml-[410px] pr-[50px] overflow-hidden">
            <div class="py-[70px] flex flex-col gap-[50px]">
                <!-- Navbar -->
                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-[10px]">
                        <div class="font-bold text-[32px] text-white">
                            Dashboard Admin
                        </div>
                    </div>
                    <div class="flex items-center gap-[26px]">
                        <span class="text-white text-base">Welcome, <?= $_SESSION['auth']['name'] ?></span>
                        <!-- user avatar -->
                        <div class="collapsible-dropdown flex flex-col gap-2 relative">
                            <a href="#!" class="outline outline-2 outline-stream-gray p-[6px] rounded-full w-[60px] dropdown-button" data-target="#dropdown-stream">
                                <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['auth']['name'] ?>&background=random&rounded=true&bold=true" class="rounded-full object-cover w-full" alt="stream" />
                            </a>
                            <div class="bg-white rounded-2xl text-stream-dark font-medium flex flex-col gap-1 absolute z-[999] right-0 top-[80px] min-w-[180px] hidden overflow-hidden" id="dropdown-stream">
                                <a href="../controllers/Auth.php?action=logout" class="transition-all hover:bg-sky-100 p-4">Sign Out</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Navbar -->

                <div>
                    <div class="font-semibold text-[22px] text-white mb-[18px]">Manage Movie -  Edit</div>

                    <?php Flasher::flash(); ?>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <form class="space-y-6" action="" enctype="multipart/form-data" method="POST">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" value="<?= $movie['title'] ?>" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required><?= $movie['description'] ?></textarea>
                        </div>
                        <div>
                            <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                            <input type="text" name="genre" value="<?= $movie['genre'] ?>" id="genre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="ex: Action, Love, Social" required>
                        </div>
                        <div>
                            <label for="link_movie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Movie</label>
                            <input type="url" name="link_movie" value="<?= $movie['link_movie'] ?>" id="link_movie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Link form youtube" required>
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year Release</label>
                            <input type="text" name="year" value="<?= $movie['year'] ?>" id="year" min="4" max="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="ex: 2022" required>
                        </div>
                        <div>
                            <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                            <input type="number" name="rating" value="<?= $movie['rating'] ?>" id="rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" max="5" min="1" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="img_movie">Upload Poster Movie</label>
                            <input type="hidden" name="img_old" value="<?= $movie['img_movie'] ?>">
                            <input name="img_movie" class="block w-full text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="img_movie_help" id="img_movie" type="file">
                            <img class="my-2" src="../<?= $movie['img_movie'] ?>" width="100" alt="">
                        </div>
                        <div>
                            <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                <input name="is_feature" type="checkbox" class="sr-only peer" 
                                <?php echo $movie['is_feature'] ? 'checked' : '' ?>
                                >
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-400 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Feature</span>
                            </label>
                        </div>


                        <button type="submit" name="editMovie" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Movie</button>

                    </form>
                    </div>


                </div>

            </div>
        </div>
        <!-- END: Content -->
    </div>

    <div class="mx-auto px-4 w-full md:w-7/12 h-screen block lg:hidden flex">
        <div class="text-white text-2xl text-center leading-snug font-medium my-auto">
            Sorry, this page only supported on 1024px screen or above
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/script/script.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.1/flowbite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.watched-movies').removeClass('hidden').flickity({
                // options
                "cellAlign": "left",
                "contain": true,
                "groupCells": 1,
                "wrapAround": false,
                "pageDots": false,
                "prevNextButtons": false,
                "draggable": ">1"
            });
        })
    </script>
</body>

</html>