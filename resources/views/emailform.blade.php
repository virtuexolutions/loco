<!doctype html>
<html lang="en">

<head>
  <title>Email | Loco Locators</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="assests/style.css">

</head>

<body class="email-form">
    <header>
        <nav class="navbar navbar-expand-sm">
              <div class="container-fluid px-5">
                <a class="navbar-brand" href="index.html"><img id="logo" src="assests/logo.png" /></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="#">ABOUT US</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="listing.html">RENTAL</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="#">LOCO REWARDS</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="form.html">SIGN UP</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="#">LOG IN</a>
                        </li>
                    </ul>
                </div>
          </div>
        </nav>
        
    </header>

    <form action="/send-mail" method="post" id="msform">
        @csrf
        <!-- fieldsets -->
        
        <fieldset class="email-from-filedset">
            <div class="email-text-sec">
            <img src="assests/logo.png"/>
            <h2>Send an email to House of BTPN</h2>
            <h3>What would you like to learn more about?</h3>
        </div>
        <div class="email-feild-sec">
           <textarea id="textarea" name="msg" required placeholder="Select a topic below or compose your own message"></textarea>
            <h4>Most renters ask about</h4>
            <div class="bottom-email">
                <h6 onclick="show_para(' I am interested in learning more about 2-3 bedroom units under $1,800.')">Pricing and Availablity</h6>
                <h6 onclick="show_para(' I would like to schedule a tour!')">Schedule a Tour</h6>
                <h6 onclick="show_para(' What is the total move-in cost?')">Move-in Costs</h6>
            </div>
            <div class="bottom-email">
                <h6  onclick="show_para(' When is the best time to apply for a move-in date of 2022-10-29?')">Best Time to Apply</h6>
                <h6  onclick="show_para(' Are there any upcoming or ongoing rent specials?')">Rent Specials</h6>
                <h6  onclick="show_para(' Can you send me a link to your 3D tour or can we schedule a time for a video walk through?')">Request Live Remote Tour</h6>
            </div>
            <div class="bottom-email">
                <h6 onclick="show_para(' What are the schools and school districts people in the area usually attend?')">Nearby Schools</h6>
                <h6 onclick="show_para(' What are the parking options like?')">Parking</h6>
            </div>
        </div>

          <!-- <input type="button" name="previous" class="previous action-button-previous" value="Previous"/> -->
          <input type="submit" name="next" class="next action-button" value="Send Email"/>
          <!-- <input type="button" name="next" class="skip-button" value="Cancel"/> -->

          <a href="{{ url()->previous() }}"  class="btn skip-button" > Cancel </a>
        </fieldset> 
        </form>
    







    <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

<script>
    function show_para(id)
    {
        var start = "Hi I'm {{Auth::user()->name}}!";
            $('#textarea').text(start + id);
        
    }
</script>
</html>