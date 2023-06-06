<template>
    <div style="text-align: center;">
        <transition-group tag="div" class="TransitionBox" :name="transitionName">
            <div class="page" v-for="(img, index) of imgs" :key="index" v-show="index === show">
                <img :src="img" class="dishimg" @mouseover="handleMouseOver" @mouseout="handleMouseLeave"> 
            </div>
        </transition-group>
        <span class="btnsapn">
            <button class="btn btn-one" @click="setshow(show-1)"><i class="fa fa-angle-double-left"></i></button>
            <button class="btn btn-one" v-for="num of imgs.length" :key="num-1" @click="setshow(num-1)">{{num}}</button>
            <button class="btn btn-one" @click="setshow(show+1)"><i class="fa fa-angle-double-right"></i></button>
        </span>
    </div>
</template>

<script>
export default {
    props: {
        imgs: {
            type: Array,
        }
    },
    data () {
        return {
            transitionName: 'right',
            show: 0,
            isPaused: false,
        }   
    },
    mounted () {
        // 監聽滑鼠懸停事件
        this.$el.addEventListener('mouseover', this.handleMouseOver);
        // 監聽滑鼠離開事件
        this.$el.addEventListener('mouseleave', this.handleMouseLeave);
        const interval = 5000;
        this.timer = setInterval(() => {
            if (!this.isPaused) {
            this.nextShow();
            }
        }, interval);
        // timer = setInterval (this.nextShow, interval)
    },
    methods: {
        setshow (index) {
            this.show = index
        },
        nextShow () {
            this.show++
        },
        handleMouseOver() {
            // 滑鼠懸停時，將isPaused設置為true，暫停輪播
            this.isPaused = true;
        },
        handleMouseLeave() {
            // 滑鼠離開時，將isPaused設置為false，恢復輪播
            this.isPaused = false;
        }
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
    watch: {
        show (nVal, oVal) {
            if (nVal < 0) {
                this.show = this.imgs.length -1
            }
            else if (nVal > this.imgs.length -1) {
                this.show = 0
            }
            else {
                if (oVal <0)  this.transitionName = 'left'
                else if (oVal > this.imgs.length -1) this.transitionName = 'right'
                else {
                    this.transitionName = nVal > oVal ? 'right' : 'left'
                }
            }
        }
    }
}
</script>

<style scoped>
    .right-enter {
        left: 100%;
    }
    .right-enter-active, .right-leave-active {
        transition: left 1s;
    }
    .right-enter-to, .right-leave {
        left: 0%;
    }
    .right-leave-to {
        left: -100%;
    }
    .left-enter {
        left: -100%;
    }
    .left-enter-active, .left-leave-active {
        transition: left 1s;
    }
    .left-enter-to, .left-leave {
        left: 0%;
    }
    .left-leave-to {
        left: 100%;
    }
    .TransitionBox {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
    }
    .page {
        position: absolute;
        width: 100%;
        height: 400px;
    }
    .dishimg {
        width: 100%;
        height: 400px;
    }
    /* btn */
    .btnsapn{
        text-align: center;
        width: 320px;
        height: 33%;
        margin: 0 auto;
    }
    .btn {
        position: relative;
        color: #a385bb;
        border: 1px solid rgba(255, 255, 255);
        width: 45px;
        height: 30px;
        transition: all 0.3s;
        font-size: 15px;
        font-weight: 550;
    }
    .btn::before, .btn::after {
        content: '';
        position: absolute;
        transition: all 0.3s;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    .btn-one::before {
        opacity: 0;
        background: rgba(0, 0, 0, 0.1);
        transform: scale(0.1, 0.1);
    }

    .btn-one:hover::before {
        opacity: 1;
        transform: scale(1, 1);
    }

</style>