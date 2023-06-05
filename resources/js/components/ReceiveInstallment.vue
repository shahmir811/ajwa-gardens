<template>
    <form @submit="submitForm">
        <div class="row make-it-center">
            <div class="col">
                <div class="mb-3">
                    <label for="monthlyInstalment" class="form-label"
                        >Amount</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="monthlyInstalment"
                        placeholder="Amount"
                        v-model="form.amount"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="receivingDate" class="form-label">Date</label>
                    <input
                        type="date"
                        class="form-control"
                        id="receivingDate"
                        v-model="form.date"
                    />
                </div>
            </div>
            <div class="col pt-12">
                <div class="d-grid gap-2">
                    <button
                        class="btn btn-primary btn-custom"
                        type="submit"
                        :disabled="!form.amount"
                    >
                        Receive Amount
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "ReceiveInstallmentComponent",
    mounted() {
        const url = window.location.href;
        const id = url.substring(url.lastIndexOf("/") + 1);
        this.currentURLID = id;
    },
    data() {
        return {
            currentURLID: null,
            form: {
                amount: null,
                date: new Date().toISOString().substr(0, 10),
            },
        };
    },
    methods: {
        submitForm(e) {
            e.preventDefault();

            this.$swal
                .fire({
                    title: "Are you sure to save the receiving amount?",
                    text: "Double check the receiving amount before saving",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3D7448",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post(`${APP_URL}received-monthly-installment`, {
                                ...this.form,
                            })
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
.make-it-center {
    display: flex;
    justify-content: center;
    align-items: center;
}

.pt-12 {
    padding-top: 12px;
}

.btn-custom {
    background-color: #1c78c2;
    border-color: #1c78c2;
}
</style>
