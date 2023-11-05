<template lang="">
    <div>
        <table class="table payment-method-item">
            <tbody>
                <tr class="border-pay-row">
                    <td class="border-pay-col">
                        <i class="fa fa-theme-payments"></i>
                    </td>
                    <td style="width: 20%">
                        <img
                            class="filter-black"
                            src="../assets/paypal.svg"
                            alt="stripe"
                        />
                    </td>
                    <td class="border-right">
                        <ul>
                            <li>
                                <a href="https://paypal.com/" target="_blank"
                                    >Paypal</a
                                >
                                <p>
                                    Customer can buy product and pay directly
                                    via PayPal
                                </p>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td colspan="3">
                        <div class="float-start" style="margin-top: 5px">
                            <div class="payment-name-label-group">
                                <span class="payment-note v-a-t">Use:</span>
                                <label
                                    class="ws-nm inline-display method-name-label"
                                    >Pay online via Paypal</label
                                >
                            </div>
                        </div>
                        <div class="float-end">
                            <a
                                class="toggle-payment-item edit-payment-item-btn-trigger"
                                @click="toggle($event)"
                                >Edit</a
                            >
                        </div>
                    </td>
                </tr>
                <tr
                    class="paypal-online-payment payment-content-item"
                    :class="{ hidden: showSetting }"
                >
                    <td class="border-left" colspan="3">
                        <form @submit.prevent="submitComment">
                            <div class="row">
                                <div class="col-sm-6 p-5">
                                    <ul>
                                        <li>
                                            <label
                                                >Configuration instruction for
                                                PayPal To use PayPal, you
                                                need:</label
                                            >
                                        </li>
                                        <li class="payment-note">
                                            <p>To use Paypal, you need:</p>
                                            <ul
                                                class="m-md-l"
                                                style="list-style-type: decimal"
                                            >
                                                <li
                                                    style="
                                                        list-style-type: decimal;
                                                    "
                                                >
                                                    <a
                                                        href="https://www.paypal.com/vn/merchantsignup/applicationChecklist?signupType=CREATE_NEW_ACCOUNT&productIntentId=email_payments"
                                                        target="_blank"
                                                    >
                                                        Register with PayPal
                                                    </a>
                                                </li>
                                                <li
                                                    style="
                                                        list-style-type: decimal;
                                                    "
                                                >
                                                    <p>
                                                        After registration at
                                                        PayPal, you will have
                                                        Client ID, Client Secret
                                                    </p>
                                                </li>
                                                <li
                                                    style="
                                                        list-style-type: decimal;
                                                    "
                                                >
                                                    <p>
                                                        Enter Client ID, Secret
                                                        into the box in right
                                                        hand
                                                    </p>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <div class="well bg-white">
                                        <div class="form-group mb-3">
                                            <label
                                                class="text-title-field"
                                                for="stripe_name"
                                                >Method name</label
                                            >
                                            <input
                                                type="text"
                                                name="PAYPAL_NAME"
                                                placeholder=""
                                                class="form-control border"
                                                v-model="formStrip.PAYPAL_NAME"
                                                required
                                            />
                                        </div>
                                        <p class="payment-note">
                                            Please provide information
                                            <a
                                                target="_blank"
                                                href="http://www.paypal.com/"
                                                >PayPal:</a
                                            >:
                                        </p>
                                        <div class="form-group mb-3">
                                            <label
                                                class="text-title-field"
                                                for="PAYPAL_ID"
                                                >Client ID</label
                                            >
                                            <input
                                                type="text"
                                                name="PAYPAL_ID"
                                                placeholder="AX_*************"
                                                class="form-control border"
                                                v-model="formStrip.PAYPAL_ID"
                                                required
                                            />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label
                                                class="text-title-field"
                                                for="PAYPAL_SECRET"
                                                >Client Secret</label
                                            >
                                            <div class="input-option">
                                                <input
                                                    type="text"
                                                    name="PAYPAL_SECRET"
                                                    placeholder="sk_*************"
                                                    class="form-control border"
                                                    v-model="
                                                        formStrip.PAYPAL_SECRET
                                                    "
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white text-end">
                                <button
                                    class="btn btn-info save-payment-item btn-text-trigger-update"
                                    type="submit"
                                >
                                    Update
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from "axios";

export default {
    props: {
        route: URL,
        paypal_id: String,
        paypal_secret: String,
        paypal_name: String,
    },
    data() {
        return {
            showSetting: true,
            csrfToken: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            formStrip: {
                method: "paypal",
                PAYPAL_SECRET: this.paypal_secret,
                PAYPAL_ID: this.paypal_id,
                PAYPAL_NAME: this.paypal_name,
            },
        };
    },
    methods: {
        toggle: function () {
            this.showSetting = !this.showSetting;
        },
        submitComment(event) {
            event.preventDefault();
            axios
                .post(this.route, this.formStrip)
                .then((response) => {
                    this.showToast(response);
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showToast(response) {
            this.$swal({
                icon: "success",
                title: response.data,
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", this.$swal.stopTimer);
                    toast.addEventListener(
                        "mouseleave",
                        this.$swal.resumeTimer
                    );
                },
            });
        },
    },
};
</script>
<style lang="css">
.edit-payment-item-btn-trigger {
    background-color: #ff9d01;
    cursor: pointer;
    padding: 5px 20px;
    display: inline-block;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    font-size: 1.2rem;
    font-weight: bold;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.edit-payment-item-btn-trigger:hover {
    background-color: transparent;
    border: 1px solid #ff9d01;
    color: #ff9d01 !important;
}
.payment-note ul {
    margin: auto 30px;
}
</style>
