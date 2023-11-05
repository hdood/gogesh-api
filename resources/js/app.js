import "./bootstrap";
import "bootstrap";

import { createApp } from "vue";

import ExampleCounter from "./components/ExampleCounter.vue";
import MethodStripe from "./components/MethodStripe.vue";
import MethodPaypal from "./components/MethodPaypal.vue";
import Notification from "./pages/Notification.vue";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
// import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const app = createApp({});

app.use(VueSweetalert2);
// app.use(ZiggyVue, Ziggy);
app.component("example-counter", ExampleCounter);
app.component("method-stripe", MethodStripe);
app.component("method-paypal", MethodPaypal);
app.component("notification", Notification);

const mountedApp = app.mount("#app");
