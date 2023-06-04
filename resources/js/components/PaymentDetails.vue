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
                            <th>Amount Received On</th>
                            <th>Monthly Installments</th>
                            <th>3 Months &amp; Half Year Payment</th>
                            <th>Remaining Amount</th>
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
                                    record.amount_received
                                        ? record.amount_received.toLocaleString(
                                              "en-IN"
                                          )
                                        : "-"
                                }}
                            </td>
                            <td></td>
                            <td>
                                {{ record.monthly_amount.toLocaleString() }}
                            </td>
                            <td>
                                <span v-if="record.id === 3">
                                    {{
                                        allotment.three_months_amount
                                            ? allotment.three_months_amount.toLocaleString(
                                                  "en-IN"
                                              )
                                            : "-"
                                    }}</span
                                >
                                <span v-else-if="record.id % 6 === 0">
                                    {{
                                        allotment.six_months_amount
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
                                    record.remaining_amount.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
                        </tr>
                        <tr class="bottom-row">
                            <td></td>
                            <td></td>
                            <td>
                                {{
                                    totalAmountReceived.toLocaleString("en-IN")
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
    props: ["allotment", "schedules"],
    mounted() {
        // console.log("Component mounted.");
        // console.log(this.allotment);
        // console.log("----------------");
        console.log(this.schedules);
        this.calculateTotalAmountReceived();
        this.calcMonthlyAmountSum();
        this.calcThreeSixMonthsAmountSum();
    },
    data() {
        return {
            monthlyAmountSum: 0,
            threeSixMonthsAmountSum: 0,
            totalAmountReceived: 0,
        };
    },
    filters: {
        moment: function (date) {
            return moment(date).format("DD-MM-YYYY");
        },
    },
    methods: {
        formattedDate(date) {
            return moment(date).format("DD-MM-YYYY");
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
                .map((record) => record.monthly_amount)
                .reduce((a, b) => a + b, 0);
        },
        calcThreeSixMonthsAmountSum() {
            this.threeSixMonthsAmountSum = this.schedules
                .map((record) => record.three_or_six_month)
                .reduce((a, b) => a + b, 0);
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
</style>
