<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <article class="col-item">
                        <div class="photo" @mouseover="isShowInfo = true;" @mouseleave="isShowInfo = false">
                            <a href="#">
                                <img :src="src" class="image" alt="Product Image">
                            </a>
                        </div>
                        <div style="position: relative;width: 100%;height: 84px;transform: translateY(-100%);" @mouseover="isShowInfo = true;" @mouseleave="isShowInfo = false">
                            <transition name="ProductInformation">
                                <div class="info" v-show="isShowInfo">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <h1 style="font-size: large;">{{ cardtext }}</h1>
                                            <span class="price-new">${{price}}</span>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                        <p class="btn-details">
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Compare"><i class="fa fa-exchange"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        src: {
            type: String,
            default: "https://unsplash.it/500/300?image=0",
        },
        price: {
            type: Number,
            default: 100,
        },
        cardtext: {
            type: String,
            default: "This is Example Product.",
        },
        buttontext: {
            type: String,
            default: "Go somewhere",
        }
    },
    data() {
        return {
            isShowInfo: false,
        }
    },
    methods: {
    },
}
</script>

<style scoped>
    @import 'animate.css';
    .col-item {
        margin-bottom: 12px;
    }
    .col-item .photo {
        overflow: hidden;
    }
    .col-item .photo img {
        margin: 0 auto;
        width: 100%;
    }
    .col-item .info {
        width: 100%;
        padding: 10px;
        margin-top: 1px;
        position: absolute;
    }
    .col-item .price-details {
        width: 100%;
        margin-top: 5px;
    }
    .col-item .price-details h1 {
        font-size: 14px;
        line-height: 20px;
        margin: 0;
        float: left;
    }
    .col-item .price-details span {
        float: right;
    }
    .col-item .price-details .price-new {
        font-size: 16px;
    }
    .col-item .separator {
        border-top: 1px solid #E1E1E1;
    }
    .col-item .separator a {
        text-decoration: none;
    }
    .col-item .separator p {
        margin-bottom: 0;
        margin-top: 6px;
        text-align: center;
    }
    .col-item .separator p i {
        margin-right: 5px;
    }
    .col-item .btn-add {
        width: 60%;
        float: left;
    }
    .col-item .btn-add a {
        display: inline-block !important;
    }
    .col-item .btn-add {
        border-right: 1px solid #E1E1E1;
    }
    .col-item .btn-details {
        width: 40%;
        float: left;
        padding-left: 10px;
    }
    .col-item .btn-details a {
        display: inline-block !important;
    }
    .col-item .btn-details a:first-child {
        margin-right: 12px;
    }
    .image {
        -webkit-transition: all 0.5s;
        -o-transition: all 0.5s;
        transition: all 1s;
    }
    .image:hover {
        transform: scale(1.3);
    }
    .ProductInformation-enter, .ProductInformation-leave-to {
        opacity: 0;
    }
    .ProductInformation-enter-active, .ProductInformation-leave-active {
        transition: opacity 0.5s, transform 1s;
    }
    .ProductInformation-enter {
        transform: translateY(100%);
    }
</style>