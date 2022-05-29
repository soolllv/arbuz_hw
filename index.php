<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbuz Shop</title>
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="shop">
        <div id="header">
            <h2>Arbuz</h2>
            <div id="home_and_cart">
                <h3>Home</h3>
                <h3 @click="toggleShowCart()">Cart</h3>
            </div>
        </div>
        <div id="shop_wtrms">
            <h2>{{ title }}</h2>
            <ul>
                <li v-for="wm in garden">
                    <div v-if="!wm.is_collected">
                        <div v-if="wm.is_ripe">
                            <img src="watermelon.png" alt="">
                            <div>
                                <h4>From row {{wm.row}}</h4>
                                <p>Ripe</p>
                                <p>Mass: {{wm.mass}} kg</p>
                                <div class="toCart">
                                    <select name="howToCut" id="select_type" v-model="howToCut">
                                        <option value="as whole" default>As Whole</option>
                                        <option value="sliced">Sliced</option>
                                    </select>
                                    <div class="quant">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" id="quantity" name="quantity" min="1" :max="wm.quantity" v-model="qty">
                                    </div>
                                    <button @click="addToCart(wm.id)">Add to Cart</button>
                                </div>
                            </div>
                        </div>    
                        <div v-if="!wm.is_ripe">
                            <img src="watermelon.png" alt="" class="unripe_img">
                            <h4>From row {{wm.row}}</h4>
                            <p>Unripe</p>
                            <p>Sorry, wait for the watermelon/s to ripen</p>
                        </div>
                    </div>
                    <div v-if="wm.is_collected">
                        <img src="watermelon.png" alt="" class="plucked_img">
                        <h4>From row {{wm.row}}</h4>
                        <p>Plucked</p>
                        <p>Sorry, the watermelon has already picked</p>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="showCart" class="backdrop" @click.self="toggleShowCart()">
            <div id="cart" >
                <div class="cart_def">
                    <p></p>
                    <p>ID</p>
                    <p>Qty</p>
                    <p>Option</p>
                </div>
                <div v-for="item in itemsToCart" class="cart_item">
                    <img src="watermelon.png" alt="" class="cart_img">
                    <p>{{item[0]}}</p>
                    <p>{{item[1]}}</p>
                    <p>{{item[2]}}</p>
                </div>
                <button @click="toggleToPurchase(),findLimitDates()" id="checkout_btn">Checkout</button>
            </div>
        </div>
        <div v-if="toPurchase" class="backdrop" @click.self="toggleToPurchase()">
            <div class="purchase">
                <div class="form">
                    <label for="name">Name & Surname</label>
                    <input type="text" name="name" v-model="custName" required>

                    <label for="city">City</label>
                    <input type="text" name="city" required v-model="custCity">

                    <label for="address">Address</label>
                    <input type="text" name="address" required v-model="custAddress">

                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" name="phoneNumber" required v-model="custPhN">
                    
                    <label for="date">Deliver Date</label>
                    <input type="datetime-local" name="date" id="deliverDate" :min="minDate" :max="maxDate">

                    <button @click="togglePurchaseCompleted(), toggleToPurchase(), clearCart()">CONFIRM</button>
                </div>
            </div>
        </div>
        <div v-if="purchaseCompleted" class="backdrop" @click.self="togglePurchaseCompleted()">
            <div class="purcDone"><h1>Your request send successfully!</h1></div>
        </div>
    </div>
    
    <div id="footer">
        <p>Thanks for shopping with us</p>
        <p>Made by Sultan Orynbay</p>
    </div>
    <script src="js/app.js"></script>
</body>
</html>