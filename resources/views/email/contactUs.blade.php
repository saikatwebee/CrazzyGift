
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }


        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #3498db;
            color: #fff;
            padding: 20px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .content {
            padding: 20px 0;
        }

        .button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
        }
        .social-footer {
            background-color: #3498db; /* Background color for the footer */
            color: #fff; /* Text color for the footer */
            padding: 20px 0;
            text-align: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .social-icons img {
            width: 32px;
            height: 32px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://regastores.com/CrazzyGiftBeta/images/logo.png" alt="CrazzyGift Logo" class="logo">
            <h2>CrazzyGift-Online Enquiry</h2>
        </div>
        <div class="content">
           
            <p>User Details are stated below:</p>
            

            <table style="width: 100% !important;margin-bottom: 1rem !important;color: #212529 !important;border:1px solid #212529;">
                <tr style="border:1px solid #212529 !important;">
                    <th style="border:1px solid #212529 !important;">Name</th>
                    <td style="border:1px solid #212529 !important;">{{$user['name']}}</td>
                </tr>
                 <tr style="border:1px solid #212529 !important;">
                      <th style="border:1px solid #212529 !important;">Phone</th>
                    <td style="border:1px solid #212529 !important;">{{$user['phone']}}</td>
                 </tr>
                  <tr style="border:1px solid #212529 !important;">
                       <th style="border:1px solid #212529 !important;">Query</th>
                    <td style="border:1px solid #212529 !important;">{{$user['desc']}}</td>
                  </tr>
                 

            </table>



            

        <div class="social-footer">
            <p>Follow us on social media for daily gift inspiration, updates, and contests.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/Crazzygift/" target="_blank" style="text-decoration: none;"><img src="https://static-00.iconduck.com/assets.00/facebook-icon-512x512-seb542ju.png" alt="Facebook"></a>
                <a href="https://twitter.com/undergrndmedia" target="_blank" style="text-decoration: none;"><img src="https://www.iconpacks.net/icons/2/free-twitter-logo-icon-2429-thumb.png" alt="Twitter"></a>
                {{-- <a href="#" style="text-decoration: none;"><img src="https://img.freepik.com/premium-vector/vinnytsia-ukraine-april-27-2023-popular-social-media-icon-instagram-vector-design_545793-1681.jpg" alt="Instagram"></a> --}}
            </div>
        </div>

    </div>
</body>
</html>



