<template lang="">
    <div
        class="card notification p-3"
        :style="{ backgroundColor: to ? '#ddd' : '#969595' }"
    >
        <div class="row justify-content-between pr-5">
            <div class="col-8">
                <span class="">{{
                    user ? user.firstname + " " + user.lastname : to
                }}</span>
            </div>

            <a
                class="btn btn-danger btn-sm rounded text-light p-2"
                id="del"
                data-url="http://127.0.0.1:8000/customer/1"
                data-toggle="tooltip"
                data-placement="top"
                title=""
                data-original-title="Delete"
                ><i class="fa fa-trash"></i
            ></a>
        </div>
        <hr class="bg-light" />
        <div class="row align-items-center">
            <div class="col-2">
                <span class="icon-not">
                    <i class="fa fa-check text-success" v-if="type == 'success'"></i>
                    <i class="fa fa-exclamation text-danger" v-if="type == 'danger'"></i>
                </span>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <span>fdsf</span>
                        <span class="span-time">10:02</span>
                    </div>
                    <div class="col-12">
                        Lorem ipsum dolor sit amet {{ id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "card-notification",
    props: {
        id: Int8Array,
        title: String,
        content: String,
        to: String,
        type: String,
        user: Object,
    },
};
</script>
<style lang="css" scoped>
.icon-not {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
}
.icon-not i {
    font-size: 20px;
}
.span-time {
    font-size: 13px;
}
.card {
    margin: 5px;
}
.notification {
    background-color: #969595;
    font-family: "Tajawal", sans-serif !important;
}
.del i {
    font-size: 20px;
}
</style>
