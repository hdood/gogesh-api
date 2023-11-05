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
                            src="http://hoskadev.net/vendor/core/plugins/stripe/images/stripe.svg"
                            alt="stripe"
                        />
                    </td>
                    <td class="border-right">
                        <ul>
                            <li>
                                <a href="https://stripe.com" target="_blank"
                                    >Stripe</a
                                >
                                <p>
                                    Customer can buy product and pay directly
                                    using Visa, Credit card via Stripe
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
                                    >Pay online via Stripe</label
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
                                                Stripe</label
                                            >
                                        </li>
                                        <li class="payment-note">
                                            <p>To use Stripe, you need:</p>
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
                                                        href="https://dashboard.stripe.com/register"
                                                        target="_blank"
                                                    >
                                                        Register with Stripe
                                                    </a>
                                                </li>
                                                <li
                                                    style="
                                                        list-style-type: decimal;
                                                    "
                                                >
                                                    <p>
                                                        After registration at
                                                        Stripe, you will have
                                                        Public, Secret keys
                                                    </p>
                                                </li>
                                                <li
                                                    style="
                                                        list-style-type: decimal;
                                                    "
                                                >
                                                    <p>
                                                        Enter Public, Secret
                                                        keys into the box in
                                                        right hand
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
                                                name="STRIPE_NAME"
                                                placeholder=""
                                                class="form-control border"
                                                v-model="formStrip.STRIPE_NAME"
                                                required
                                            />
                                        </div>
                                        <p class="payment-note">
                                            Please provide information
                                            <a
                                                target="_blank"
                                                href="//www.stripe.com"
                                                >Stripe</a
                                            >:
                                        </p>
                                        <div class="form-group mb-3">
                                            <label
                                                class="text-title-field"
                                                for="stripe_client_id"
                                                >Stripe Public Key</label
                                            >
                                            <input
                                                type="text"
                                                name="STRIPE_KEY"
                                                placeholder="pk_*************"
                                                class="form-control border"
                                                v-model="formStrip.STRIPE_KEY"
                                                required
                                            />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label
                                                class="text-title-field"
                                                for="stripe_secret"
                                                >Stripe Private Key</label
                                            >
                                            <div class="input-option">
                                                <input
                                                    type="text"
                                                    name="STRIPE_SECRET"
                                                    placeholder="sk_*************"
                                                    class="form-control border"
                                                    v-model="
                                                        formStrip.STRIPE_SECRET
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
        stripe_key: String,
        stripe_secret: String,
        stripe_name: String,
    },
    data() {
        return {
            showSetting: true,
            csrfToken: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            formStrip: {
                method: "stripe",
                STRIPE_SECRET: this.stripe_secret,
                STRIPE_KEY: this.stripe_key,
                STRIPE_NAME: this.stripe_name,
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
                    console.log(response.data);
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
<style lang="scss"></style>
