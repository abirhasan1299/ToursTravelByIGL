

<div id="credit-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">
                            <h4 class="mb-1 fw-bold text-uppercase">Buy Credit</h4>
                            <p class="text-success">1 Credit = BDT 100</p>

                            <form action="{{route('pay')}}" method="post" autocomplete="off">
                                @csrf
                                <input type="number" name="credit" max="500" min="5" placeholder="e.g 50"  id="credit" class="form-control" required>
                                <span class="text-danger" id="totalAmount"></span>
                                <br/>

                                <button type="submit" class="btn btn-primary">Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</div>

<script>
    const creditInput = document.getElementById('credit');
    const totalAmount = document.getElementById('totalAmount');

    creditInput.addEventListener('input', function () {
        let credit = parseFloat(this.value);

        if (!isNaN(credit) && credit > 0) {
            let amount = credit * 100;
            totalAmount.innerText = "Total Amount: BDT " + amount;
        } else {
            totalAmount.innerText = "";
        }
    });
</script>
