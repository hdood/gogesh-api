<template lang="">
    <div>
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Notification</h3>
            <ul>
                <li>All Notification</li>
                <li>
                    <a href="/">home</a>
                </li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title"></div>
                    <a
                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                        >Add Notification</a
                    >
                </div>
                <div class="row justify-content-around">
                    <CardNotification
                        v-for="(item, index) in notification"
                        :key="index"
                        :id="item.id"
                        :title="item.title"
                        :content="item.content"
                        :type="item.type"
                        :to="item.to"
                        :user="item.user"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CardNotification from "../components/CardNotification.vue";
export default {
    components: {
        CardNotification,
    },
    data() {
        return {
            notification: this.notifications,
        };
    },
    props: {
        notifications: Array,
    },
};
</script>
