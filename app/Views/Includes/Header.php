<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BAPBAST</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <ul class="nav flex-column shadow d-flex sidebar mobile-hid">
        <li class="nav-item logo-holder">
            <div class="text-center text-white logo py-4 mx-4">
                <a class="text-white text-decoration-none" id="title" href="#">
                    <strong>BAPBAST</strong>
                </a>
                <a class="text-white float-right" id="sidebarToggleHolder" href="#">
                    <i class="fas fa-bars" id="sidebarToggle"></i>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left text-white<?php echo isset($isPageDashboard) ? ' active' : ''; ?>" href="/">
                <i class="fas fa-tachometer-alt nav-link-icon"></i>
                <span class="text-nowrap">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left text-white<?php echo isset($isPagePegawai) ? ' active' : ''; ?>" href="/pegawai">
                <i class="fas fa-user nav-link-icon"></i>
                <span class="text-nowrap">Pegawai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left text-white<?php echo isset($isPagePenyedia) ? ' active' : ''; ?>" href="/penyedia">
                <i class="far fa-life-ring nav-link-icon"></i>
                <span class="text-nowrap">Penyedia</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left text-white<?php echo isset($isPageUpload) ? ' active' : ''; ?>" href="/upload">
                <i class="fas fa-archive nav-link-icon"></i>
                <span class="text-nowrap">Upload</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left text-white" href="/logout">
                <i class="fas fa-sign-out-alt nav-link-icon"></i>
                <span class="text-nowrap">Log out</span>
            </a>
        </li>
    </ul>
