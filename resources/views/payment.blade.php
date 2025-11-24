<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/spartanicon.ico') }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">


<!-- END: Custom CSS -->
<title>Razorpay Payment</title>
 
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body onload="openRazorpay()">

   

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                      
                        <!-- Greetings Card ends -->

                        <!-- Subscribers Chart Card starts -->
                       
                        <!-- Subscribers Chart Card ends -->

                        <!-- Orders Chart Card starts -->
                       
                        <!-- Orders Chart Card ends -->
                    

                    <!-- List DataTable -->
                    <div class="container">
                     

    <h2>Processing payment...</h2>

<script>
function openRazorpay() {
    var options = {
        "key": "{{ $razorpay_key }}",
        "amount": "{{ $amount * 100 }}", // amount in paise
        "currency": "INR",
        "name": "LearnLoop",
        "description": "Subject Payment",
        "handler": function (response) {
            // Called on successful payment from Razorpay
            fetch("{{ route('payment.success') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_id: response.razorpay_payment_id,
                    user_id: "{{ $user_id }}",
                    subject_id: "{{ $subject_id }}"
                })
            })
            .then(res => {
                if (!res.ok) throw new Error("Server error");
                return res.json();
            })
            .then(data => {
                window.location.href = "{{ route('thank.you') }}";
            })
            .catch(error => {
                alert("Error saving payment: " + error.message);
                window.location.href = "{{ route('payment.failed') }}";
            });
        },
        "theme": {
            "color": "#3399cc"
        },
        "modal": {
            "ondismiss": function () {
                // User closed the Razorpay modal without completing payment
                window.location.href = "{{ route('payment.failed') }}";
            }
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
}
</script>

                    

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
   
    <!-- END: Footer-->


<!-- BEGIN: Vendor JS-->

    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>