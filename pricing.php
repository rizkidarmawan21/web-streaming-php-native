<?php
require_once  __DIR__ . '/controllers/UserSubcription.php';

session_start();

if (isset($_SESSION['auth'])) {
    $user_subcription = checkSubcription($_SESSION['auth']['id']);
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
    </style>

    <script src="assets/script/tailwind-config.js"></script>

    <style type="text/tailwindcss">
        @layer components{
            .li-benefits{
                @apply font-medium text-base text-stream-dark capitalize;
            }

            .pricing-card{
                @apply flex flex-col p-[30px] bg-white rounded-2xl w-full lg:w-[330px] md:max-w-max lg:max-w-[330px];
            }
        }
    </style>
</head>

<body class="bg-stream-dark">

    <div class="relative">
        <div class="hidden lg:block fixed">
            <img src="assets/images/banner.png" class="max-h-screen" alt="stream" />
        </div>
    </div>
    <div class="grid md:grid-cols-12 font-poppins relative pb-20">

        <!-- Ornament -->
        <span class="fixed -z-10 top-0">
            <img src="assets/images/pricing_ornament.svg" class="h-screen w-screen" alt="stream" />
        </span>
        <!-- ./ -->

        <div class="col-span-12 col-start-1 lg:col-start-2 xl:col-start-4">
            <div class="px-5 lg:px-[60px] pt-[30px] relative">
                <!-- Logo & User Avatar -->
                <div class=" flex flex-row justify-between items-center relative">
                    <a href="/index.html" class="block">
                        <img src="assets/images/stream.svg" alt="stream" />
                    </a>

                    <?php if (isset($_SESSION["auth"])) : ?>
                        <!-- user avatar -->
                        <div class="collapsible-dropdown flex flex-col gap-2 relative">
                            <a href="#!" class="outline outline-2 outline-stream-gray p-[6px] rounded-full w-[60px] dropdown-button" data-target="#dropdown-stream">
                                <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['auth']['name'] ?>&background=random&rounded=true&bold=true" class="rounded-full object-cover w-full" alt="stream" />
                            </a>
                            <div class="bg-white rounded-2xl text-stream-dark font-medium flex flex-col gap-1 absolute z-[999] right-0 top-[80px] min-w-[180px] hidden overflow-hidden" id="dropdown-stream">
                                <a href="dashboard.php" class="transition-all hover:bg-sky-100 p-4">Watch</a>
                                <a href="#!" class="transition-all hover:bg-sky-100 p-4">Settings</a>
                                <a href="controllers/Auth.php?action=logout" class="transition-all hover:bg-sky-100 p-4">Sign Out</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="sign_in.php" class="px-8 py-3 mt-3 text-center outline outline-2 outline-stream-gray rounded-3xl lg:mt-0">
                            <span class="text-base text-normal text-stream-gray">Sign In</span>
                        </a>
                    <?php endif ?>
                </div>

                <div class="pt-[85px] flex flex-col items-center gap-5">
                    <p class="text-sky-300 text-base font-semibold">
                        START TODAY
                    </p>
                    <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
                        Up Your Imagination
                    </div>

                    <!-- Card Content -->
                    <div class="mt-[70px] flex justify-center gap-[40px] flex-wrap">
                        <!-- Card -->
                        <div class="pricing-card">
                            <p class="text-stream-dark font-medium text-base">
                                Basic
                            </p>
                            <div class="text-3xl text-stream-dark font-semibold my-1">
                                Rp 100.000
                            </div>
                            <p class="text-sm text-stream-gray">
                                3 bulan
                            </p>
                            <hr class="my-[30px]">

                            <!-- item benefits -->
                            <div class="flex flex-col gap-6">
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        2 Users Limits
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        720 & 1080 full HD
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        TV & Laptop Streaming
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        180 Movies Available
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        24 Origin Countries
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION["auth"])) : ?>
                                <?php if (!$user_subcription['status']) : ?>
                                    <button onclick="subcriptionCheckout(1,'Basic')" class="mt-10 py-3 block outline outline-1 outline-stream-gray rounded-full text-center">
                                        <span class="text-stream-gray text-base font-normal">
                                            Subscribe
                                            Now
                                        </span>
                                    </button>
                                <?php else : ?>
                                    <button onclick="subcriptionTrue()" class="mt-10 py-3 block outline outline-1 outline-stream-gray rounded-full text-center">
                                        <span class="text-stream-gray text-base font-normal">
                                            Subscribe
                                            Now
                                        </span>
                                    </button>
                                <?php endif ?>
                            <?php else : ?>
                                <a href="sign_in.php" class="mt-10 py-3 block outline outline-1 outline-stream-gray rounded-full text-center">
                                    <span class="text-stream-gray text-base font-normal">
                                        Subscribe
                                        Now
                                    </span>
                                </a>
                            <?php endif ?>
                        </div>
                        <!-- Card -->
                        <div class="pricing-card">
                            <p class="text-stream-dark font-medium text-base">
                                Gold
                            </p>
                            <div class="text-3xl text-stream-dark font-semibold my-1">
                                Rp 300.000
                            </div>
                            <p class="text-sm text-stream-gray">
                                6 bulan
                            </p>
                            <hr class="my-[30px]">

                            <!-- item benefits -->
                            <div class="flex flex-col gap-6">
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        7 Users Limits
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        Up to 8K Quality
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        All Platforms Streaming
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        900+ Movies Available
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                                <!-- benefits -->
                                <div class="flex items-center justify-between gap-3">
                                    <span class="li-benefits">
                                        120 Origin Countries
                                    </span>
                                    <img src="assets/images/ic_check.svg" alt="stream" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION["auth"])) : ?>
                                <?php if (!$user_subcription['status']) : ?>
                                    <button onclick="subcriptionCheckout(2,'Gold')" class="mt-10 py-3 block bg-indigo-600 rounded-full text-center">
                                        <span class="text-white text-base font-semibold">
                                            Subscribe
                                            Now
                                        </span>
                                    </button>
                                <?php else : ?>
                                    <button onclick="subcriptionTrue()" class="mt-10 py-3 block bg-indigo-600 rounded-full text-center">
                                        <span class="text-white text-base font-semibold">
                                            Subscribe
                                            Now
                                        </span>
                                    </button>
                                <?php endif ?>
                            <?php else : ?>
                                <a href="sign_in.php" class="mt-10 py-3 block bg-indigo-600 rounded-full text-center">
                                    <span class="text-white text-base font-semibold">
                                        Subscribe
                                        Now
                                    </span>
                                </a>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.13/dist/sweetalert2.all.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <script src="assets/script/script.js"></script>
</body>

</html>