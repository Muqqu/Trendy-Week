@extends('layouts.app2')

@section('title', 'Landing Page')

@section('extra-css')
<style>
        /* General styling */
body {
    font-family: sans-serif;
    max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
}

a {
    text-decoration: none;
}

/* Header styling */
header {
    background-color: #f2f2f2;
    padding: 20px;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
}

.logo {
    width: 100px;
    height: auto;
}

h1 {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

/* Main content styling */
.main-container {
    padding: 20px;
}

.section {
    margin-bottom: 20px;
}

h2 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

p {
    font-size: 16px;
    line-height: 1.5;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

li {
    margin-bottom: 10px;
}

@media (max-width: 600px) {
            .container {
                width: 100%;
            }

            .avatar {
                width: 50px;
                height: 50px;
            }

            .icon {
                width: 20px;
                height: 20px;
            }
            header {
        text-align: center;
    }

    .logo {
        margin-bottom: 20px;
    }
        }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="main-content" style="margin-top: 131px;">
        <section class="section">
            <h2>Acceptance of Terms</h2>

            <p>By accessing or using our website or services, you agree to be bound by these Terms and Conditions. If you do not agree to these Terms and Conditions, you may not use our website or services.</p>
        </section>

        <section class="section">
            <h2>Definitions</h2>

            <p>In these Terms and Conditions, the following terms have the following meanings:</p>

            <ul>
                <li>"You" means the individual or entity accessing or using our website or services.</li>
                <li>"We" means Trendy Week.</li>
                <li>"Our" means of or relating to Trendy Week.</li>
                <li>"Services" means our website, applications, and other services.</li>
            </ul>
        </section>

        <section class="section">
            <h2>User Accounts</h2>

            <p>You may create a user account to access certain features of our website or services. You are responsible for maintaining the confidentiality of your account password and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account.</p>
        </section>

        <section class="section">
            <h2>User Conduct</h2>

            <p>You agree to use our website and services in a responsible and lawful manner. You agree not to use our website or services to:</p>

            <ul>
                <li>Upload, post, or transmit any content that is illegal, harmful, threatening, abusive, harassing, tortious, defamatory, vulgar, obscene, libelous, invasive of another's privacy, hateful, or racially, ethnically, or otherwise objectionable.</li>
                <li>Harm or exploit children.</li>
                <li>Impersonate any person or entity, or falsely state or otherwise misrepresent your affiliation with a person or entity.</li>
                <li>Forge headers or otherwise manipulate identifiers in order to disguise the origin of any content transmitted through our website or services.</li>
                <li>Interfere with or disrupt our website or services, or servers or networks connected to our website or services.</li>
                <li>Violate any applicable laws or regulations.</li>
            </ul>
        </section>

        <section class="section">
            <h2>Intellectual Property</h2>

            <p>Our website and services are protected by copyright, trademark, and other intellectual property laws. You may not use our website or services in any way that violates these laws.</p>
        </section>

        <section class="section">
            <h2>Links to Other Websites</h2>

            <p>Our website may contain links to other websites. We are not responsible for the content or practices of any other website. You are responsible for reviewing the terms and conditions of any other website that you visit.</p>
        </section>

        <section class="section">
            <h2>Disclaimer of Warranties</h2>

            <p>OUR WEBSITE AND SERVICES ARE PROVIDED "AS IS" AND "AS AVAILABLE". WE MAKE NO WARRANTIES, EXPRESS OR IMPLIED, ABOUT THE OPERATION OF OUR WEBSITE OR SERVICES, OR THE INFORMATION, CONTENT, MATERIALS, OR PRODUCTS INCLUDED ON OUR WEBSITE OR SERVICES. YOU EXPRESSLY AGREE THAT YOUR USE OF OUR WEBSITE AND SERVICES IS AT YOUR SOLE RISK.</p>
        </section>
</div>
</div>
@endsection


