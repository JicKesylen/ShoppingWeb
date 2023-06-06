<template>
    <div>
        <!-- Loding動畫 -->
        <Row v-show="ShowLoading">
            <Spin fix style="position: fixed">
                <Icon type="ios-loading" size=26 class="demo-spin-icon-load"></Icon>
                <div style="font-size: 18px">Loading</div>
            </Spin>
        </Row>
        <Modal v-model="dialog.show" :closable="false" :mask-closable="false">
            <pre
                style="text-align: left; white-space: pre-wrap; word-wrap: break-word"
                v-html="dialog.content"
            ></pre>
            <div slot="footer">
                <Button v-show="dialog.type == 'confirm'" @click="dialogNo">{{ dialog.noText }}</Button>
                <Button @click="dialogYes">{{ dialog.yesText }}</Button>
            </div>
        </Modal>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    beforeCreate() {
        window.alert = (content) => {
            this.setDailog(content, "alert");
        };
        window.loading = (isShow = true) => {
            this.ShowLoading = isShow;
        };
    },
    data() {
        return {
            ShowLoading: false,
            showMenu: true,
            LifeNumber: {},
            defaultDialog: {
                show: false,
                content: "",
                yesText: "確定",
                noText: "取消",
            },
            dialog: {
                show: false,
                content: "",
                yesText: "",
                noText: "",
            },
        }
    },
    methods: {
        setDailog(content) {
            Object.assign(this.dialog, this.defaultDialog);
            this.dialog.show = true;
            if (typeof content == "string") {
                this.dialog.content = content;
                this.dialog.yesText = this.defaultDialog.yesText;
                this.dialog.noText = this.defaultDialog.noText;
            } else if (typeof content == "object") {
                Object.assign(this.dialog, content);
            }
        },
        dialogYes() {
            this.dialog.show = false;
        },
        dialogNo() {
            this.dialog.show = false;
        }
    }
}
</script>>

<style>
    .demo-spin-icon-load{
        animation: ani-demo-spin 1s linear infinite;
    }
    @keyframes ani-demo-spin {
        from { transform: rotate(0deg);}
        50%  { transform: rotate(180deg);}
        to   { transform: rotate(360deg);}
    }
    
</style>