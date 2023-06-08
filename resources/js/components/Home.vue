<template>
    <div>
        <nav class="navbar navbar-dark navbar-expand-md sticky-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
                            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                        </svg>
                    </span>
                    <span>Brand</span>
                </a>
                <!-- navbar選項 -->
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item dropdown menu_links" v-for="(item, key) in ProductData" :key="key">
                            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" style="margin-right: 10px;">
                                <strong>
                                    <span style="color: rgba(255, 255, 255, 0.75);">{{ key }}</span>
                                </strong>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" v-for="(value, index) in item" :key="index">{{ value }}</a>
                            </div>
                        </li>
                    </ul>
                    <router-link to="/SignUp" class="btn btn-primary shadow" role="button">Sign up</router-link>
                </div>
            </div>
        </nav>
        <!-- 輪播圖 -->
        <SimpleCarousel :imgs="imgs" style="width: 100%;"></SimpleCarousel>
        <!-- 品牌故事 -->
        <section class="py-5" style="margin: 1px;">
            <div class="container text-center py-5" style="height: 300px;">
                <p class="mb-4" style="font-size: 1.6rem;padding: 10px;text-align: justify;"><span style="background-color: rgb(45, 44, 56);">在這裡，我們相信每個人都應該享受到方便、有趣和豐富的線上購物體驗。我們的品牌故事始於對創新科技和時尚的熱愛。我們的團隊致力於精心挑選最新的潮流商品，從時尚服飾到家居用品，為客戶提供獨特和優質的選擇。我們追求卓越的品質和卓越的客戶服務，並不斷努力超越期望。無論您身在何處，透過這裡，您都能輕鬆尋找到您喜愛的商品，享受到便捷的購物體驗。</span></p>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <ProductItemCard
                    v-for="(value, key) in ProductInformation"
                    :key="key"
                    :src="value.ImageUrl"
                    :name="value.Name"
                    :price="value.Price"
                    :id="`${value.ProductID}`"
                >
                    {{ value.ImageURL }}
                </ProductItemCard>
            </div>
        </div>
        <FooterCard></FooterCard>
    </div>
</template>

<script>
import ADImageApiHelper from '../script/Utility/ADImgaeApiHelper';
import ProductApiHelper from '../script/Utility/ProductApiHelper';
    export default {
        data() {
            return {
                imgs: [],
                ProductInformation: [],
                ProductData: "",
            }
        },
        methods: {
        },
        mounted(){
            ADImageApiHelper.GetADImageURL().then(($response) => {
                loading(false);
                if($response.success) {
                    this.imgs = $response.data;
                } else {
                    alert("伺服器忙碌中...")
                }
            })
            .catch((error) => {
                loading(false);
                alert(error.message);
            });
            ProductApiHelper.GetProduct().then(($response) => {
                this.ProductInformation = $response.data;
                const ProductData = $response.data.map(obj => {
                    return {
                        Class: obj.Class,
                        Name: obj.Name,
                        ProductID: obj.ProductID
                    };
                });
                const mergedObject = {};
                ProductData.forEach(jsonObject => {
                    const { Class, Name } = jsonObject;
                    if(!mergedObject[Class]) {
                        mergedObject[Class] = [Name];
                    } else {
                        mergedObject[Class].push(Name)
                    }
                });
                this.ProductData = mergedObject;
            })
            .catch((error) => {
                loading(false);
                alert(error.message);
            });
        }
    }
</script>