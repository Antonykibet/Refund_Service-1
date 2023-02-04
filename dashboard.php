<?php

session_start();

if (!$_SESSION['logged_in']) {
   header('Location: error.php');
   exit();
}

extract($_SESSION['userData']);
$storeErr = $phoneErr = $orderErr = $credentialsErr = $amountErr = "";
?>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,900&display=swap" rel="stylesheet">
    <meta content="width=device-width, initial-stages" name="viewport"/>
</head>
<body>
    <div id="header">
        <span id="uname"><?php echo $name;?></span>
        <div id="miniHeader">
                <div id="logo">
                    Jer
                    <img src="icons8-hamburger-menu-24.png" alt="">
                </div>
                
                <div id="links">
                   <a href="home.html">
                   <div id="home">
                        Home
                    </div>
                   </a> 
                    <!-- <div id="refundable">Refundable Stores</div> -->
                    <a href="dashboard.php">
                        <div id="refunds">
                            Refunds
                            <div id="homeTab"></div>
                        </div>
                    </a>
                </div>
                <button id="login">
                    <img id="icon" src="icons8-discord-new-48.png" alt="">
                    <?php  echo $name?>
                </button>
            </div>
    </div>
                <div id="logo">
                    Jer
                    <div id="hambuger">
                    <img id="hamburgerIcon" src="icons8-hamburger-menu-24.png" alt="">
                    <div id="menubar">
                        <div id="mobileHome">Home</div>
                        <div id="mobileRefundForm">Refund</div>
                    </div>
                    </div>
                    
                </div>
                
    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <div id="Body">
        <div id="form">
        <h3 id="formTitles">Country</h3>
            <div id="radioButtons">
                <input type="radio" id="usa" name="country" value="USA" checked>
                <label for="usa" class="country">USA</label><br>
                <input type="radio" id="canada" name="country" value="Canada">
                <label for="canada" class="country">Canada</label><br>
                <input type="radio" id="uk" name="country" value="UK">
                <label for="uk" class="country">UK</label><br>
            </div>
            
               <label id="formTitles" for="username">Discord Username</label>
                    <input  type="text" id="textBox" name="username" value="<?php echo $name?>">
            <label id="formTitles" for="store">Store</label>
            <select  name="store" id="store"></select>
            <span id="errorMessage" class="error"><?php echo $storeErr?></span><br>
    
        
            <label id="formTitles" for="phone">Phone</label>
                <input type="tel" name="phone" id="textBox">
                <span id="errorMessage" class="error"><?php echo $phoneErr?></span>

            <label id="formTitles" for="orderNumber">Order Number</label><br>
            <input class="textBox" type="text" name="orderNumber" id="textBox">
            <span id="errorMessage" class="error"><?php echo $orderErr?></span>
            <span id="extraInfo">If multiple, separate them by commas. e.g. "orderid1,orderid2"</span>
        
            <label id="formTitles" for="credentials">Login Credentials</label>
            <input class="textBox" type="text" name="credentials" id="textBox">
            <span id="errorMessage" class="error"><?php echo $credentialsErr?></span><br>
            <span id="extraInfo">It must be in email:password format.</span>
            <span id="extraInfoGuestOrder">If guest order pls put shipping/billing info for password so we <br> can find your order!</span>
    
            <label id="formTitles" for="amount">Full total(including taxes&shipping)</label><br>
            <input class="textBox" type="text" name="amount" id="textBox"><br>
            <span id="errorMessage" class="error"><?php echo $amountErr?></span><br>
    
             <span id="extraInfo">By clicking Submit, you agree to the Terms & Conditions</span><br>
             <input type="submit" name="submit" id="submit" value="Submit">    
        </div>
        <div id="terms">
            <h1 id="RefundTitle">Refund Form</h1>
            <p id="paragraph">Do you require a refund for an online purchase? Fill out the refund form, and the refund staff will get to work on it.</p>
            <h3 id="termsAndCondition">Terms and Conditions</h3>
            <p id="paragraph">You consent to the following by utilizing our refunding service: <br> You must pay as soon as the return is confirmed, not when the funds are credited to your account or card. <br>You risk being barred from using our service if you submit refunds and fail to reply to DMs as required.
</p>
                    </div>
    </div>        
    </form>
</body>
    
<script>
    let country = "";
    let USA_Stores = [
        "Windsorstore", "Amazon", "Amazon Third Party", "Target (Grocerry)", "Apple",
        "Adidas", "Macy's", "Victoria's Secret", "Bath & Body Works", "Hollister",
        "Abercrombie & Fitch", "Lululemon", "Glasses / Contacts", "H&M", "Gymshark",
        "SHEIN", "Levis", "Ralph Lauren", "UGG", "Designer Stores", "Crocs", "Microsoft",
        "REI", "Home Depot", "Reebok", "evo", "Estee Lauder", "awaytravel", "1800flowers",
        "kohl's", "Crunchyroll Store", "LEGO", "HSN", "QVC", "casper.com", "Crateandbarrel",
        "New Balance", "META"
    ];

    let canadaStores = [
        "Amazon.ca", "Victoria's Secret", "Ralph Lauren", "BestBuy", "Apple.ca", "Wayfair.ca",
        "Reebok.ca", "FANATICS.CA"
    ];

    let UK_Stores = [
        "Amazon", "ZALANDO", "Pretty Little Thing", "Bohoo"
    ];

    let storeElement = document.getElementById('store');

    for (let i = 0; i <= USA_Stores.length; i++) {
        let option_element = document.createElement("option");
        option_element.value = USA_Stores[i];
        option_element.innerHTML = USA_Stores[i];
        storeElement.appendChild(option_element);
    }

    document.getElementById('usa').onclick = () => {
        country = "USA";
        updateStores(country);
    };

    document.getElementById('canada').onclick = () => {
        country = "Canada";
        updateStores(country);
    };

    document.getElementById('uk').onclick = () => {
        country = "UK";
        updateStores(country);
    };

    function updateStores(Country) {
        storeElement.innerHTML = "";
        if (Country == "USA") {
            for (let i = 0; i < USA_Stores.length; i++) {
                let optionElement = document.createElement("option");
                optionElement.value = USA_Stores[i];
                optionElement.innerHTML = USA_Stores[i];
                storeElement.appendChild(optionElement);
            }
        } else if (Country == "Canada") {
            for (let i = 0; i < canadaStores.length; i++) {
                let optionElement = document.createElement("option");
                optionElement.value = canadaStores[i];
                optionElement.innerHTML = canadaStores[i];
                storeElement.appendChild(optionElement);
            }
        } else {
            for (let i = 0; i < UK_Stores.length; i++) {
                let optionElement = document.createElement("option");
                optionElement.value = UK_Stores[i];
                optionElement.innerHTML = UK_Stores[i];
                storeElement.appendChild(optionElement);
            }
        }
    }
</script>

<?php

$servername = "localhost";
$username = "owuorian";
$password = "Valmamucera95";
$database = "discord_records";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

$store = $phone = $orderNum = $credentials = $amount = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["store"])) {
        $storeErr = "Store is required";
    } else {
        $store = test_input($_POST['store']);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST['phone']);
    }

    if (empty($_POST["orderNumber"])) {
        $orderErr = "Order Number is required";
    } else {
        $orderNum = test_input($_POST['orderNumber']);
    }

    if (empty($_POST["credentials"])) {
        $credentialsErr = "Login credentials are required";
    } else {
        $credentials = test_input($_POST['credentials']);
    }

    if (empty($_POST["amount"])) {
        $amountErr = "Amount is required";
    } else {
        $amount = test_input($_POST['amount']);
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $sql = "INSERT INTO refund_requests (username, Store, Phone, order_number, login_credentials, amount) 
    VALUES ('$username', '$store', '$phone', '$orderNum', '$credentials', '$amount')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




mysqli_close($conn);
?>