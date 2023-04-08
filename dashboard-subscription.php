<?php
require_once  __DIR__ . '/controllers/UserSubcription.php';
session_start();

// Jika ada user yg login
if (isset($_SESSION['auth'])) {

    // ambil data user tersebut punya langganan atau tidak
    $user_subcription = checkSubcription($_SESSION['auth']['id']);

    // JIka tidak lempar kehalaman beli paket langganan
    if (!$user_subcription['status']) {
        header('location: pricing.php', true);
        exit;
    }
    // ambil data berlangganan user
    $data_user_subcription = getUserSubcriptionPlan($_SESSION['auth']['id']);

    // ambil data paket langganan
    $data_subcription_plan = getSubcriptionPlan($data_user_subcription['id_subcription_plan']);

    // Hitung jumlah hari berlangganan
    $date_start = date('Y-m-d', strtotime("-" . $data_subcription_plan['active_period_in_month'] . " months", strtotime($data_user_subcription['expirate_date'])));
    $diff = strtotime($data_user_subcription['expirate_date']) - strtotime($date_start);
    $totalDaySubcription =  round($diff / 86400);

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
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
    </style>

    <script src="assets/script/tailwind-config.js"></script>

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
                    <a href="dashboard.php" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 17L12 22L22 17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Watch
                    </a>
                    <a href="!#" class="side-link group">
                        <svg width="24" height="24" class="group" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12H22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 2C14.5013 4.73835 15.9228 8.29203 16 12C15.9228 15.708 14.5013 19.2616 12 22C9.49872 19.2616 8.07725 15.708 8 12C8.07725 8.29203 9.49872 4.73835 12 2V2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Discover
                    </a>
                    <a href="!#" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.84 4.60999C20.3292 4.099 19.7228 3.69364 19.0554 3.41708C18.3879 3.14052 17.6725 2.99817 16.95 2.99817C16.2275 2.99817 15.5121 3.14052 14.8446 3.41708C14.1772 3.69364 13.5708 4.099 13.06 4.60999L12 5.66999L10.94 4.60999C9.9083 3.5783 8.50903 2.9987 7.05 2.9987C5.59096 2.9987 4.19169 3.5783 3.16 4.60999C2.1283 5.64169 1.54871 7.04096 1.54871 8.49999C1.54871 9.95903 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6053C22.3095 9.93789 22.4518 9.22248 22.4518 8.49999C22.4518 7.77751 22.3095 7.0621 22.0329 6.39464C21.7563 5.72718 21.351 5.12075 20.84 4.60999V4.60999Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        My Favorites
                        <span class="bg-[#6EC2DF] text-[#1E5062] text-base rounded-full font-semibold text-center px-[7px] py-[1px]">6</span>
                    </a>
                    <a href="!#" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 7L16 12L23 17V7Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 5H3C1.89543 5 1 5.89543 1 7V17C1 18.1046 1.89543 19 3 19H14C15.1046 19 16 18.1046 16 17V7C16 5.89543 15.1046 5 14 5Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Playlist
                    </a>
                    <!-- <a href="!#" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 12V22H4V12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M22 7H2V12H22V7Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 22V7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 7H16.5C17.163 7 17.7989 6.73661 18.2678 6.26777C18.7366 5.79893 19 5.16304 19 4.5C19 3.83696 18.7366 3.20107 18.2678 2.73223C17.7989 2.26339 17.163 2 16.5 2C13 2 12 7 12 7Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 7H7.5C6.83696 7 6.20107 6.73661 5.73223 6.26777C5.26339 5.79893 5 5.16304 5 4.5C5 3.83696 5.26339 3.20107 5.73223 2.73223C6.20107 2.26339 6.83696 2 7.5 2C11 2 12 7 12 7Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        Your Gifts
                    </a> -->
                    <div class="flex border-t border-softpur"></div>
                    <a href="dashboard-subscription.php" class="side-link active">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 4H3C1.89543 4 1 4.89543 1 6V18C1 19.1046 1.89543 20 3 20H21C22.1046 20 23 19.1046 23 18V6C23 4.89543 22.1046 4 21 4Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 10H23" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Subscription
                    </a>
                    <a href="!#" class="side-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Account Settings
                    </a>
                    <a href="controllers/Auth.php?action=logout" class="side-link">
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
                            Subscription
                        </div>
                        <p class="mb-0 text-stream-gray text-base">Spend to get more good memories</p>
                    </div>
                    <div class="flex items-center gap-[26px]">
                        <span class="text-white text-base">Welcome, <?= $_SESSION['auth']['name'] ?></span>
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
                    </div>
                </div>
                <!-- /Navbar -->

                <?php if ($user_subcription['status']) : ?>

                    <!-- Subscription Stat -->
                    <div class="flex items-center gap-3">
                        <img src="assets/images/ic_subscription.svg" alt="">
                        <div class="flex flex-col gap-2">
                            <div class="text-white text-[22px] font-semibold">
                                <?= $data_subcription_plan['name_plan'] ?> Package
                            </div>
                            <div class="flex items-center gap-[10px]">
                                <!-- <div class="progress-bar w-[248px] h-[6px] bg-softpur rounded-full">
                                    <div class="progress bg-[#22C58B] w-[113px] h-full rounded-full"></div>
                                </div> -->
                                <div class="text-stream-gray text-sm">
                                    <?= $totalDaySubcription + 1?> days

                                    <br>
                                    Your subscription package will expire on the date <strong><?= date('d F Y' ,strtotime($data_user_subcription['expirate_date'])) ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Subscription Stat -->

                    <!-- Benefits -->
                    <!-- <div class="flex flex-col gap-6 font-medium text-base text-white -mt-[10px] px-[18px]">
                        <div class="flex gap-4 items-center">
                            <img src="assets/images/ic_check-dark.svg" alt="">
                            <span>7 Users Limits</span>
                        </div>
                        <div class="flex gap-4 items-center">
                            <img src="assets/images/ic_check-dark.svg" alt="">
                            <span>Up to 8K Quality</span>
                        </div>
                        <div class="flex gap-4 items-center">
                            <img src="assets/images/ic_check-dark.svg" alt="">
                            <span>All Platforms Streaming</span>
                        </div>
                        <div class="flex gap-4 items-center">
                            <img src="assets/images/ic_check-dark.svg" alt="">
                            <span>900+ Movies Available</span>
                        </div>
                        <div class="flex gap-4 items-center">
                            <img src="assets/images/ic_check-dark.svg" alt="">
                            <span>120 Origin Countries</span>
                        </div>
                    </div> -->
                    <!-- /Benefits -->

                    <!-- Action Button -->
                    <!-- <div class="flex flex-col gap-[14px] max-w-max">
                        <a href="#!" class="py-[13px] px-[58px] bg-[#5138ED] rounded-full text-center">
                            <span class="text-white font-semibold text-base">
                                Make a Renewal
                            </span>
                        </a>
                        <a href="#!" class="py-[13px] px-[58px] outline outline-1 outline-stream-gray outline-offset-[-3px] rounded-full text-center">
                            <span class="text-stream-gray font-normal text-base">
                                Change Plan
                            </span>
                        </a>
                    </div> -->
                    <!-- /Action Button -->

                    <!-- Stop Subscribe -->
                    <div class="rounded-2xl bg-[#19152E] p-[30px] w-max">
                        <div class="text-xl text-red-500 font-semibold">
                            Danger Zone
                        </div>
                        <p class="text-base text-white leading-[30px] max-w-[500px] mt-3 mb-[30px]">
                            If you wish to stop subscribe our movies please continue
                            by clicking the button below. Make sure that you have read our
                            terms & conditions beforehand.
                        </p>
                        <button onclick="stopSubcription(this)" data-id="<?php echo $data_user_subcription['id_user_subcription'] ?>" class="px-[19px] py-[13px] bg-[#FE4848] rounded-full text-center">
                            <span class="text-white font-semibold text-base">
                                Stop Subscribe
                            </span>
                        </button>
                    </div>
                    <!-- /Stop Subscribe -->

                <?php else : ?>

                    <div class="pt-[50px] flex flex-col items-center  gap-5">
                        <p class="text-sky-300 text-base font-semibold">
                            START TODAY
                        </p>
                        <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
                            Up Your Imagination
                        </div>

                        <!-- Card Content -->
                        <div class="mt-[40px] flex justify-center gap-[40px] bg-slate-800 p-10 rounded-lg flex-wrap">
                            <!-- Card -->
                            <div class="pricing-card">
                                <p class="text-white font-medium text-base">
                                    Standard
                                </p>
                                <div class="text-3xl text-white font-semibold my-1">
                                    Rp 380.000
                                </div>
                                <p class="text-sm text-stream-gray">
                                    /bulan
                                </p>
                                <hr class="my-[30px]">

                                <!-- item benefits -->
                                <div class="flex flex-col gap-6">
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            2 Users Limits
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            720 & 1080 full HD
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            TV & Laptop Streaming
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            180 Movies Available
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            24 Origin Countries
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                </div>

                                <a href="success_page.html" class="mt-10 py-3 block outline outline-1 outline-stream-gray rounded-full text-center">
                                    <span class="text-stream-gray text-base font-normal">
                                        Subscribe
                                        Now
                                    </span>
                                </a>
                            </div>
                            <!-- Card -->
                            <div class="pricing-card">
                                <p class="text-white font-medium text-base">
                                    Gold
                                </p>
                                <div class="text-3xl text-white font-semibold my-1">
                                    Rp 699.000
                                </div>
                                <p class="text-sm text-stream-gray">
                                    /bulan
                                </p>
                                <hr class="my-[30px]">

                                <!-- item benefits -->
                                <div class="flex flex-col gap-6">
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            7 Users Limits
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            Up to 8K Quality
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            All Platforms Streaming
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            900+ Movies Available
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                    <!-- benefits -->
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="li-benefits text-white">
                                            120 Origin Countries
                                        </span>
                                        <img src="assets/images/ic_check.svg" alt="stream" />
                                    </div>
                                </div>

                                <a href="success_page.html" class="mt-10 py-3 block bg-indigo-600 rounded-full text-center">
                                    <span class="text-white text-base font-semibold">
                                        Subscribe
                                        Now
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
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
    <script src="assets/script/script.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.13/dist/sweetalert2.all.min.js"></script>
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

        // Fungsi untuk melakukan berhenti berlangganan
        function stopSubcription(element) {
            // ambil id berlangganannya
            let idUserSubcription = element.getAttribute("data-id")

            Swal.fire({
                title: "Anda Yakin ?",
                text: "Akan berhenti berlangganan pada paket ini ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Berhenti Sekarang",
            }).then((result) => {
                if (result.isConfirmed) {
                    // masukkan data kedalam fungsi PHP
                    let ajax = $.ajax({
                        url: `${ENDPOINT}controllers/Subcription.php?action=stop`,
                        method: "POST",
                        datatype: JSON,
                        data: {
                            id: idUserSubcription
                        },
                        async: true,
                    });

                    // JIka Sukses
                    ajax.done((res) => {
                        Swal.fire({
                            // title: 'Are you sure?',
                            text: "Berhasil berhenti berlangganan",
                            icon: "success",
                            // showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            location.reload();
                        });
                    });

                    // JIka gagal
                    ajax.fail((err) => {
                        Swal.fire("Fail!", "Gagal berhenti berlangganan!", "error");
                    });
                }
            });
        }
    </script>
</body>

</html>