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
  margin-bottom: 20px;
  margin-top:20px;
}

p {
  font-size: 16px;
  line-height: 1.5;
  margin:10px;
}

ul {
  list-style: none;
  padding: 0;
  margin: 20px;
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
                <h1>Shipping Policy</h1>
            </div>
        </header>

        <main class="main-container">
            <section class="section">

                <p>Thank you for shopping at [Your Store Name]! We strive to provide you with an exceptional shopping experience, including a seamless and reliable shipping process. Please review our shipping policy to understand how we handle orders, deliveries, and related matters.</p>
            </section>

            <section class="section">
                <h2>1. Processing Time:</h2>

                <ul>
                    <li>All orders are processed within 1-3 business days (excluding weekends and holidays) after receiving payment.</li>
                    <li>During peak seasons or promotional events, processing times may vary, and we appreciate your patience.</li>
                </ul>
            </section>

            <section class="section">
                <h2>2. Shipping Rates:</h2>

                <ul>
                    <li>We offer transparent and competitive shipping rates based on the weight of your order and the destination.</li>
                    <li>Shipping costs will be calculated at checkout before you complete your purchase.</li>
                </ul>
            </section>

            <section class="section">
                <h2>3. Shipping Methods:</h2>
                <ul>
                    <li>We utilize trusted carriers to ensure the safe and timely delivery of your items.</li>
                    <li>Available shipping options, including standard and expedited services, will be displayed at checkout.</li>
                </ul>
            </section>

            <section class="section">
                <h2>4. Estimated Delivery Time:</h2>

                <ul>
                    <li>The estimated delivery time depends on your location and the chosen shipping method.</li>
                    <li>Standard shipping typically takes 4 business days, while expedited options may deliver within 5 business days.</li>
                </ul>
            </section>

             <section class="section">
        <h2>5. Order Tracking:</h2>
        <ul>
            <li>Once your order is shipped, you will receive a confirmation email with a tracking number.</li>
            <li>Use the provided tracking information to monitor the progress of your delivery.</li>
        </ul>
    </section>

    <section class="section">
        <h2>6. International Shipping:</h2>
        <ul>
            <li>We offer international shipping to select countries.</li>
            <li>International orders may be subject to customs duties and taxes, which are the responsibility of the recipient.</li>
        </ul>
    </section>

    <section class="section">
        <h2>7. Order Changes and Cancellations:</h2>
        <ul>
            <li>Contact our customer support team promptly if you need to make changes or cancel your order.</li>
            <li>Once an order is shipped, changes may not be possible, and standard return policies will apply.</li>
        </ul>
    </section>

    <section class="section">
        <h2>8. Undeliverable Packages:</h2>
        <ul>
            <li>Please ensure that the shipping address provided is accurate and complete.</li>
            <li>In the event of an undeliverable package due to an incorrect address, additional shipping charges may apply for reshipment.</li>
        </ul>
    </section>

    <section class="section">
        <h2>9. Lost or Stolen Packages:</h2>
        <ul>
            <li>Contact us immediately if you believe your package is lost or stolen.</li>
            <li>We will work with the carrier to locate your package or provide a suitable resolution.</li>
        </ul>
    </section>

    <section class="section">
        <h2>10. Shipping Restrictions:</h2>
        <ul>
            <li>Some products may be restricted for shipping to certain locations.</li>
            <li>Customers are responsible for complying with local laws and regulations regarding the import of specific items.</li>
        </ul>
    </section>

    <section class="section">
        <h2>Contact Information:</h2>
        <p>If you have any questions or concerns about our shipping policy, please contact our customer support team at
            <a href="mailto:your@email.com">your@email.com</a> or <a href="tel:+1234567890">+1234567890</a>.</p>
    </section>

        </main>
    </div>
</body>
</html>
@endsection
