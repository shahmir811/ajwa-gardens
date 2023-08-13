<template>
    <div class="">
        <div class="text-center allotment-div">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select
                            class="form-select"
                            id="floatingSelectGrid"
                            v-model="allotment.customer_id"
                        >
                            <option
                                :value="customer.id"
                                v-for="customer in customers"
                                key="customer.id"
                            >
                                {{ customer.name }}
                            </option>
                        </select>
                        <label for="floatingSelectGrid">Customers List</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select
                            class="form-select"
                            id="floatingSelectGrid1"
                            v-model="allotment.plot_id"
                        >
                            <option
                                :value="plot.id"
                                v-for="plot in plots"
                                key="plot.id"
                            >
                                {{ plot.plot_no }}
                            </option>
                        </select>
                        <label for="floatingSelectGrid1">Plots List</label>
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="totalAmount"
                            placeholder="Total Amount"
                            v-model="allotment.total_amount"
                        />
                        <label for="totalAmount"
                            >Total Amount
                            <span v-if="isCorner">+ 10% Corner</span></label
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="downPayment"
                            placeholder="Down Amount"
                            v-model="allotment.down_amount"
                        />
                        <label for="downPayment">Down Amount</label>
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="monthlyAmount"
                            placeholder="Monthly Amount"
                            v-model="allotment.monthly_amount"
                        />
                        <label for="monthlyAmount">Monthly Instalment</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="per_marla_rate"
                            placeholder="Per Marla Rate"
                            v-model="allotment.per_marla_rate"
                        />
                        <label for="per_marla_rate">Per Marla Rate</label>
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="three_months_amount"
                            placeholder="Amount"
                            v-model="allotment.three_months_amount"
                        />
                        <label for="three_months_amount"
                            >3 Months Conformation</label
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="number"
                            class="form-control"
                            id="six_months_amount"
                            placeholder="Amount"
                            v-model="allotment.six_months_amount"
                        />
                        <label for="six_months_amount"
                            >Half Year Installment</label
                        >
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="form-floating">
                        <select
                            class="form-select"
                            id="total_months"
                            v-model="allotment.total_months"
                        >
                            <option
                                :value="month"
                                v-for="(month, index) in allotment.monthsCount"
                                :key="index"
                            >
                                {{ month }}
                            </option>
                        </select>
                        <label for="total_months">Total Number of Months</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="date"
                            class="form-control"
                            id="starting_date"
                            placeholder="Amount"
                            v-model="allotment.starting_date"
                        />
                        <label for="starting_date">Date</label>
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            id="registration_no"
                            placeholder="Registration Number"
                            v-model="allotment.registration_no"
                            :class="{ ' is-invalid': errors.registration_no }"
                        />
                        <label for="registration_no">Registration Number</label>
                        <span
                            class="invalid-feedback"
                            v-if="errors.registration_no"
                        >
                            <strong>{{ errors.registration_no[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            id="form_no"
                            placeholder="Form Number"
                            v-model="allotment.form_no"
                            :class="{ ' is-invalid': errors.form_no }"
                        />
                        <label for="form_no">Form Number</label>
                        <span class="invalid-feedback" v-if="errors.form_no">
                            <strong>{{ errors.form_no[0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select
                            class="form-select"
                            id="floatingSelectGrid"
                            v-model="allotment.down_payment_mode"
                        >
                            <option v-for="mode in modes" :value="mode">
                                {{ mode }}
                            </option>
                        </select>
                        <label for="floatingSelectGrid"
                            >Down Payment Mode</label
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="receipt_no"
                            placeholder="Receipt No"
                            v-model="down_payment_bank_receipt_no"
                            :disabled="allotment.down_payment_mode === 'Cash'"
                        />
                        <label for="receipt_no"
                            >Bank Receipt Number / Cheque Number</label
                        >
                    </div>
                </div>
            </div>

            <div class="row mt-25">
                <div class="col">
                    <div class="d-grid gap-2">
                        <button
                            type="button"
                            class="btn btn-success"
                            @click.prevent="showPlan"
                            :disabled="!allFilled"
                        >
                            {{ displayButtonText }}
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <div class="d-grid gap-2">
                            <button
                                type="button"
                                class="btn btn-success"
                                @click.prevent="savePlan"
                                :disabled="enableSavePlanButton"
                            >
                                Save Plan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <payment-schedule
            v-if="paymentScheduleCreated"
            :records="paymentSchedule"
            :allotment="allotment"
        ></payment-schedule>
    </div>
</template>

<script>
import moment from "moment";
import PaymentSchedule from "./PaymentSchedule.vue";

export default {
    name: "AllotmentComponent",
    props: ["plots", "customers"],
    mounted() {
        this.allotment.customer_id = this.customers[0].id;
        this.allotment.plot_id = this.plots[0].id;
        this.bringMonthsCount();
    },
    components: {
        "payment-schedule": PaymentSchedule,
    },
    computed: {
        isCorner() {
            if (this.allotment.plot_id) {
                const index = this.plots.findIndex(
                    (plot) => plot.id == this.allotment.plot_id
                );
                return this.plots[index].corner_plot === 1;
            }

            return false;
        },
        allFilled() {
            for (let key in this.allotment) {
                if (this.allotment.hasOwnProperty(key)) {
                    if (
                        this.allotment[key] === null ||
                        this.allotment[key] === undefined ||
                        this.allotment[key] === ""
                    ) {
                        return false; // Found a null property
                    }
                }
            }
            return true; // No null properties found
        },
        enableSavePlanButton() {
            return !this.allFilled || !this.paymentScheduleCreated;
        },
        displayButtonText() {
            return this.paymentSchedule.length > 0
                ? "Regenerate Plan"
                : "Generate Plan";
        },
    },
    data() {
        return {
            allotment: {
                customer_id: null,
                plot_id: null,
                total_amount: null,
                down_amount: null,
                monthly_amount: null,
                per_marla_rate: null,
                three_months_amount: null,
                six_months_amount: null,
                total_months: 30,
                monthsCount: [],
                starting_date: new Date().toISOString().substr(0, 10),
                registration_no: null,
                form_no: null,
                down_payment_mode: "Cash",
            },
            down_payment_bank_receipt_no: "",
            paymentScheduleCreated: false,
            paymentSchedule: [],
            errors: [],
            modes: ["Cash", "Bank Transfer", "Cheque"],
        };
    },
    methods: {
        bringMonthsCount() {
            for (let index = 1; index <= 72; index++) {
                this.allotment.monthsCount.push(index);
            }
        },
        showPlan() {
            this.paymentSchedule.length = 0;
            this.generateSchedule();
            this.paymentScheduleCreated = true;
        },
        generateSchedule() {
            let selected = new Date(this.allotment.starting_date);

            for (let i = 0; i < this.allotment.total_months; i++) {
                const record = {
                    id: i + 1,
                    date: moment(selected)
                        .add(i, "months")
                        .format("DD-MM-YYYY"),
                    monthly_amount: this.allotment.monthly_amount,
                    three_months_amount: this.allotment.three_months_amount,
                    six_months_amount: this.allotment.six_months_amount,
                    remaining_amount:
                        this.allotment.total_amount -
                        this.allotment.down_amount,
                };

                this.paymentSchedule.push(record);
            }
        },
        savePlan() {
            let errors = this.errors;
            this.$swal
                .fire({
                    title: "Are you sure to save this plan?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3D7448",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post(`${APP_URL}save-allotment`, {
                                ...this.allotment,
                                down_payment_bank_receipt_no:
                                    this.down_payment_bank_receipt_no,
                                paymentSchedule: this.paymentSchedule,
                            })
                            .then((response) => {
                                this.$swal.fire(
                                    "Saved!",
                                    "Plan has been saved.",
                                    "success"
                                );
                                window.location.href = APP_URL + "allotment";
                            })
                            .catch((error) => {
                                console.log(error);
                                this.errors = error.response.data.errors;
                            });
                        /////////////////////////
                    }
                });
        },
    },
};
</script>

<style scoped="css">
.mt-25 {
    margin-top: 25px;
}

.allotment-div {
    margin: 25px 0px;
}
</style>
