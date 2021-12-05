<form method="post" action="/paypal/process-transaction">
    @csrf
    <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
    <input type="hidden" name="total" class="form-control" value="19">
    <div class="col-12">
        <button class="paypal-button  btn-primary w-100">
            <span class="paypal-button-title">Pay now with</span>
            <span class="paypal-logo"><i>Pay</i><i>Pal</i></span>
        </button>
    </div>
</form>
