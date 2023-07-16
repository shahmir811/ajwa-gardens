<template>
    <div class="">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SR #</th>
                            <th>Date</th>
                            <th>Amount Received</th>
                            <th>Payment Mode</th>
                            <th>Amount Received On</th>
                            <th>Monthly Installments</th>
                            <th>3 Months &amp; Half Year Payment</th>
                            <th>Remaining Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(record, index) in schedules" :key="index">
                            <td>{{ ++index }}</td>
                            <td>
                                {{ formattedDate(record.date) }}
                            </td>
                            <td>
                                {{
                                    record.amount_received &&
                                    record.amount_received > 0
                                        ? record.amount_received.toLocaleString(
                                              "en-IN"
                                          )
                                        : "-"
                                }}
                            </td>
                            <td>{{ record.payment_mode }}</td>
                            <td>
                                {{ formattedDate(record.amount_received_on) }}
                            </td>
                            <td>
                                {{ record.monthly_amount.toLocaleString() }}
                            </td>
                            <td>
                                <span v-if="record.id === 3">
                                    {{
                                        allotment.three_months_amount > 0
                                            ? allotment.three_months_amount.toLocaleString(
                                                  "en-IN"
                                              )
                                            : "-"
                                    }}</span
                                >
                                <span v-else-if="record.id % 6 === 0">
                                    {{
                                        allotment.six_months_amount > 0
                                            ? allotment.six_months_amount.toLocaleString(
                                                  "en-IN"
                                              )
                                            : "-"
                                    }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                {{
                                    allotment.total_remaining_amount.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
                            <td>
                                <span
                                    v-if="
                                        record.amount_received &&
                                        record.amount_received > 0
                                    "
                                >
                                    <a
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Print Installment"
                                        class="print-installment"
                                        @click.prevent="
                                            printInstallment(record.id)
                                        "
                                    >
                                        <i
                                            class="fa fa-print"
                                            aria-hidden="true"
                                        ></i>
                                    </a>
                                    <a
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete Installment"
                                        class="remove-installment"
                                        @click.prevent="
                                            removeInstallment(record.id)
                                        "
                                        v-if="role === 'admin'"
                                    >
                                        <i
                                            class="fa fa-trash-o"
                                            aria-hidden="true"
                                        ></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <tr class="bottom-row">
                            <td></td>
                            <td></td>
                            <td>
                                {{
                                    allotment.total_received_amount.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
                            <td></td>
                            <td>
                                {{ monthlyAmountSum.toLocaleString("en-IN") }}
                            </td>
                            <td>
                                {{
                                    threeSixMonthsAmountSum.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
                            <td>
                                {{
                                    allotment.total_remaining_amount.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "PaymentDetails",
    props: ["allotment", "schedules", "role"],
    mounted() {
        this.calculateTotalAmountReceived();
        this.calcMonthlyAmountSum();
        this.calcThreeSixMonthsAmountSum();
        const url = window.location.href;
        const id = url.substring(url.lastIndexOf("/") + 1);
        this.currentURLID = id;
    },
    data() {
        return {
            monthlyAmountSum: 0,
            threeSixMonthsAmountSum: 0,
            totalAmountReceived: 0,
            currentURLID: null,
        };
    },
    methods: {
        formattedDate(date) {
            if (date) return moment(date).format("DD-MM-YYYY");
            else return "";
        },
        calculateTotalAmountReceived() {
            const sumOfReceivedPayments = this.schedules
                .map((record) => record.amount_received)
                .reduce((a, b) => a + b, 0);
            this.totalAmountReceived =
                sumOfReceivedPayments + this.allotment.down_amount;
        },
        calcMonthlyAmountSum() {
            this.monthlyAmountSum = this.schedules
                .map((record) => parseInt(record.monthly_amount))
                .reduce((a, b) => a + b, 0);
        },
        calcThreeSixMonthsAmountSum() {
            this.threeSixMonthsAmountSum = this.schedules
                .map((record) => parseInt(record.three_or_six_month))
                .reduce((a, b) => a + b, 0);
        },
        printInstallment(id) {
            // console.log("printInstallment id: " + id);
            axios
                .get(`${APP_URL}print-installment-slip/${id}`, {
                    responseType: "arraybuffer",
                })
                .then((response) => {
                    let blob = new Blob([response.data], {
                        type: "application/pdf",
                    });
                    let link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "print_slip.pdf";
                    link.click();
                });
        },
        removeInstallment(id) {
            console.log("removeInstallment ID: " + id);

            this.$swal
                .fire({
                    title: "Are you sure to remove this receiving amount?",
                    text: "You won't be able to recover this.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3D7448",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, remove it!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .delete(`${APP_URL}remove-installment/${id}`)
                            .then(() => {
                                window.location.href =
                                    APP_URL +
                                    "allotment/view/" +
                                    this.currentURLID;
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

.bottom-row {
    font-weight: bold;
    font-size: 15px;
}

.remove-installment {
    color: red;
    cursor: pointer;
    margin-left: 7px;
}

.print-installment {
    cursor: pointer;
}
</style>
