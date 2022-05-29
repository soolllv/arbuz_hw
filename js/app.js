const Shop = Vue.createApp({
    data(){
        return{
            title: 'Garden of Watermelons',
            garden: null,
            qty: null,
            howToCut: 'as whole',   
            itemsToCart: [],
            showCart: false,
            toPurchase: false,
            custName: '',
            custCity: '',
            custAddress: '',
            custPhN: '',
            deliverDate: '',
            minDate: '',
            maxDate: '',
            purchaseCompleted: false
        }
    }, 
    mounted(){
        fetch('http://localhost/arbuz/api/watermelons/read.php')
            .then(res => res.json())
            .then(data => this.garden = data.data)
            .catch(err => console.log(err.message));
    },
    methods: {
        addToCart(id){
            let arr = [id, this.qty, this.howToCut];
            this.itemsToCart.push(arr);
        },
        toggleShowCart(){
            this.showCart = !this.showCart;    
        },
        toggleToPurchase(){
            this.toPurchase = !this.toPurchase;
        },
        togglePurchaseCompleted(){
            this.purchaseCompleted = !this.purchaseCompleted;
        },
        findLimitDates(){
            let today = new Date();
            let tomorrow = new Date(today);
            let afterNine = new Date(today);
            tomorrow.setDate(tomorrow.getDate()+1);
            afterNine.setDate(afterNine.getDate()+9);
            this.minDate = tomorrow.toISOString().split("T")[0] + "T" + "10:00";
            this.maxDate = afterNine.toISOString().split("T")[0] + "T" + "22:00";
        },
        clearCart(){
            this.itemsToCart = [];
        }
    }
})
Shop.mount("#shop");
