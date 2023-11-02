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
            <h2>Welcome to CrazzyGift</h2>
        </div>
        <div class="content">
            <p>Dear {{$user->name}},</p>
            <p>Welcome to CrazzyGift, your go-to destination for unique and exciting gifts that will make every occasion memorable! We're thrilled to have you as a part of our growing community of gift enthusiasts. At CrazzyGift, we believe in the power of thoughtful gifting, and we're here to make your gift-giving experience as fun and hassle-free as possible. Whether it's a birthday, anniversary, holiday, or just a spontaneous gesture, we've got the perfect gift waiting for you.</p>
            <p>Here's a quick overview of what you can expect as a registered member:</p>
            <ul>
                <li>Exclusive Offers: As a CrazzyGift member, you'll be the first to know about our special promotions, discounts, and exciting offers. Keep an eye on your inbox for exclusive deals!</li>
                <li>Wishlist and Favorites: Easily save your favorite items to your wishlist, making it simple to keep track of the gifts you love.</li>
                <li>Personalized Recommendations: Our advanced recommendation system will suggest unique gift ideas based on your preferences and past searches.</li>
                <li>Fast Checkout: Enjoy a seamless and speedy checkout process to ensure your gifts are on their way in no time.</li>
                <li>Order History: Access your order history to keep track of your previous purchases and reorder your favorite items with ease.</li>
            </ul>
            <p>We're committed to providing you with a fantastic shopping experience, so if you have any questions or need assistance with anything, our friendly customer support team is here to help. Just drop us a line at <a href="mailto:support@crazzygift.com">support@crazzygift.com</a>.</p>
            <p>Thank you for choosing CrazzyGift. We're excited to embark on this gift-giving journey with you. Start exploring our collection of unique gifts today!</p>
        </div>
        <div class="footer">
            <p>Regards,</p>
            <p>Team CrazzyGift</p>
            <p>No 19, Annapoorneshwari Industrial Estate,</p>
            <p>Near Metro Pillar 152 and Konanakunte Cross Metro Station,</p>
            <p>Kanakapura Rd,</p>
            <p>Bengaluru, Karnataka 560062</p>
            <p>P.S. Follow us on social media for daily gift inspiration, updates, and contests. Join our community of gift enthusiasts!</p>
        </div>

        <div class="social-footer">
            <p>Follow us on social media for daily gift inspiration, updates, and contests.</p>
            <div class="social-icons">
                <a href="#" style="text-decoration: none;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Facebook_icon.svg/1200px-Facebook_icon.svg.png" alt="Facebook"></a>
                <a href="#" style="text-decoration: none;"><img src="https://e7.pngegg.com/pngimages/708/311/png-clipart-twitter-twitter-thumbnail.png" alt="Twitter"></a>
                <a href="#" style="text-decoration: none;"><img src="https://img.freepik.com/premium-vector/vinnytsia-ukraine-april-27-2023-popular-social-media-icon-instagram-vector-design_545793-1681.jpg" alt="Instagram"></a>
            </div>
        </div>

    </div>
</body>
</html>

