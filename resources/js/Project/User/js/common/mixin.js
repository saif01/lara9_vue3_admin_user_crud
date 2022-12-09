import axios from "axios";
import store from '../store'

import {
    mapGetters
} from 'vuex'


import paginateMethods from './paginate_methods'
import imageMethods from './image_methods'
import createUpdate from './crud'
import translateToBangla from './englishToBangla'

import i18n from '../../../../../Plugins/i18n';



import {
    debounce
} from './../../../../helpers'


export default {
    data() {
        return {

            // DataTbl Common Featurs 
            paginate: 10,
            search: '',
            search_field: '',
            sort_direction: 'desc',
            sort_field: 'id',
            currentPageNumber: null,
            // Tbl number of data show
            tblItemNumberShow: [5, 10, 15, 25, 50, 100],
            // Our data object that holds the Laravel paginator data
            allData: {},
            totalValue: '',
            dataShowFrom: '',
            dataShowTo: '',
            editmode: false,
            dataModelTitle: 'Store Data',
            // Loading Animation
            dataLoading: false,

            imageMaxSize: '2111775',
            fileMaxSize: '5111775',
            overlayshow: false,

            purchaseItem: [],

            // sales cart
            bottomSheet: false,
            bottomSheetKey: 1,
            // sales cart end

            foodItems2: '',
            previousOrders: '',

            // sheet,
            sheet: true,

            setPrevOrderCount: 1,

        }
    },

    methods: {


        // Permission Role check
        // ...globalRolePermissions,

        // Paginate Methods
        ...paginateMethods,

        // Image Upload Methods
        ...imageMethods,

        // create Update Methods
        ...createUpdate,

        // english to bangla
        ...translateToBangla,

        // For Translate 
        translate(lang) {
            axios.post("/setLanguage/"+ lang).then((response) => {
                store.commit('setLang', lang);
            });
            i18n.locale = lang;
        },

        // remove
        removeProduct(item) {
            const removeIndex = this.cart.findIndex( obj => obj.id === item.id );
            this.cart.splice(removeIndex, 1);
        },



        // get all food item
        getFoodItem() {
            this.loading = true;
            axios
                .get(
                "/item/index?sort_field=" +
                    this.sort_field +
                    "&search=" +
                    this.search2
                )
            .then((response) => {
                this.foodItems = response.data;
                this.loading = false;
            });
        },


        // get all food item for order
        getFoodItemForOrder() {
        this.loading = true;
        axios
            .get(
            "/order/food_item_for_order?sort_field=" +
                this.sort_field +
                "&search=" +
                this.search2
            )
            .then((response) => {
            this.foodItems = response.data;
            this.loading = false;
            });
        },


        // get all food item
        getFoodItemWithModifyOrder() {
            //this.orderLoading = true;
            axios
                .get(
                    "/order/food_item_with_modify_order?sort_type=" +
                    this.sort_type +
                    "&search=" + this.search2 +
                    "&order_number=" + this.CurrOrderSummary.order_number
                )
                .then((response) => {

                    this.foodItems2 = response.data.food_items;
                    if (this.setPrevOrderCount <= 1) {
                        this.setPrevOrderCount++;
                        this.orderList = response.data.previousorder;
                    }
                    
                    //this.orderLoading = false;
                });
        },

        // get all food type
        getType() {
            axios.get("/item/type").then((response) => {
                this.typesData = response.data;

                const allType = {
                    name_en: "All",
                    name_bn: "সব",
                    id: "All",
                };

                this.typesData.unshift(allType);
            });
        },

        logout() {
            sessionStorage.counter = 0;
        }
        
        // End Methods
    },

    watch: {

        //Excuted When make change value 
        paginate: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        },

        //Excuted When make change value 
        search: debounce(function () {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        }, 500),

        //Excuted When make change value 
        search_field: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        },

      

        
    },


    computed: {

        // map this.count to store.state.count getLoading 
        ...mapGetters({
            'auth': 'getAuth',
            'roles': 'getRoles',
            'cart': 'getCart',
            'cDetails': 'getCdetails',
            'currentLang': 'getLang',
        }),

    },



}
