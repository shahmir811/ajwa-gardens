<template>
    <div class="mt-25">
        <h1 class="">Installment Plan</h1>

        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SR #</th>
                            <th>Date</th>
                            <th>Amount Received</th>
                            <th>Monthly Installments</th>
                            <th>3 Months &amp; Half Year Payment</th>
                            <th>Remaining Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(record, index) in comingRecords"
                            :key="index"
                        >
                            <td>{{ ++index }}</td>
                            <td>{{ record.date }}</td>
                            <td></td>
                            <td>
                                {{ record.monthly_amount.toLocaleString() }}
                            </td>
                            <td>
                                {{
                                    threeOrSixMonth(index).toLocaleString(
                                        "en-IN"
                                    )
                                }}
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
                                    allotment.down_amount.toLocaleString(
                                        "en-IN"
                                    )
                                }}
                            </td>
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
                                    comingRecords[0].remaining_amount.toLocaleString(
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
export default {
    name: "PaymentSchedule",
    props: ["records", "allotment"],
    mounted() {
        this.calcMonthlyAmountSum();
        this.calcThreeSixMonthsAmountSum();
    },
    computed: {
        //
    },
    updated() {
        this.calcMonthlyAmountSum();
        this.calcThreeSixMonthsAmountSum();
    },
    data() {
        return {
            comingRecords: this.records,
            monthlyAmountSum: 0,
            threeSixMonthsAmountSum: 0,
        };
    },
    methods: {
        threeOrSixMonth(month) {
            if (month === 3)
                return this.comingRecords[0].three_months_amount
                    ? this.comingRecords[0].three_months_amount
                    : "-";
            else if (month % 6 === 0)
                return this.comingRecords[0].six_months_amount
                    ? this.comingRecords[0].six_months_amount
                    : "-";
            return "-";
        },
        calcMonthlyAmountSum() {
            this.monthlyAmountSum = this.records
                .map((record) => record.monthly_amount)
                .reduce((a, b) => a + b, 0);
        },
        calcThreeSixMonthsAmountSum() {
            this.threeSixMonthsAmountSum = this.records
                .map((record) => {
                    if (record.id === 3)
                        return parseInt(record.three_months_amount);
                    else if (record.id % 6 === 0)
                        return parseInt(record.six_months_amount);
                    else return 0;
                })
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
