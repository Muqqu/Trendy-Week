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
}

.logo {
  width: 100px;
  height: auto;
}

h1 {
  font-size: 24px;
  font-weight: bold;
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

/* Responsive design */
@media (max-width: 600px) {
  header {
    text-align: center;
  }

  .logo {
    margin-bottom: 20px;
  }
}

   </style>>
@endsection

@section('content')
    <div class="container" style="margin-top: 131px;">
        <header>
            <div class="header-container">
                <h1>Privacy Policy</h1>
            </div>
        </header>

        <main class="main-container">
            <section class="section">
                <h2>Introduction</h2>

                <p>This privacy policy ("Privacy Policy") describes how Trendy Week ("Company," "we," "us," or "our") collects, uses, and discloses your personal information when you visit our website  (the "Website") or use our services (the "Services").</p>
            </section>

            <section class="section">
                <h2>Information We Collect</h2>

                <p>We collect the following types of information from you:</p>

                <ul>
                    <li>**Personal Information:** This includes your name, email address, mailing address, phone number, and other information that you voluntarily provide to us.</li>
                    <li>**Tracking Information:** We use cookies and other tracking technologies to collect information about your use of the Website, such as the pages you visit, the links you click, and the searches you perform. This information helps us to improve the Website and to provide you with a better experience.</li>
                    <li>**Device Information:** We collect information about the device you use to access the Website, such as your IP address, browser type, and operating system. This information helps us to diagnose problems and to improve the Website.</li>
                </ul>
            </section>

            <section class="section">
                <h2>Use of Your Information</h2>

                <p>We use your information to:</p>

                <ul>
                    <li>Provide you with the Services;</li>
                    <li>Process your orders;</li>
                    <li>Send you marketing communications;</li>
                    <li>Improve the Website and the Services;</li>
                    <li>Protect our rights and property;</li>
                    <li>Comply with applicable laws and regulations.</li>
                </ul>
            </section>

            <section class="section">
                <h2>Sharing of Your Information</h2>

                <p>We may share your information with the following third parties:</p>

                <ul>
                    <li>Service providers who help us to operate the Website and provide the Services, such as payment processors, web hosting companies, and email marketing providers.</li>
                    <li>Business partners who help us to market our products and services.</li>
                    <li>Law enforcement agencies and other government agencies when required by law or to protect our rights or property.</li>
                </ul>
            </section>

            <section class="section">
                <h2>Your Choices</h2>

                <p>You have the following choices regarding your information:</p>

                <ul>
                    <li>You can opt out of receiving marketing communications from us by clicking on the "unsubscribe" link in any marketing email that you receive from us.</li>
                    <li>You can control the use of cookies by adjusting your browser settings.</li>
                    <li>You can request that we delete your information by contacting us at support@trendyweek.site</li>
                </ul>
            </section>

            <section class="section">
                <h2>Data Security</h2>

                <p>We use a variety of security measures to protect your information, including encryption, access controls, and physical security measures.</p>
            </section>

            <section class="section">
                <h2>Changes to Our Privacy Policy</h2>

                <p>We may update this Privacy Policy from time to time. If we make any material changes, we will notify you by email or by posting a notice on the Website.</p>
            </section>

            <section class="section">
                <h2>Contact Us</h2>

                <p>If you have any questions about this Privacy Policy, please contact us at support@trendyweek.site</p>
            </section>
        </main>
    </div>
</body>
</html>
@endsection
