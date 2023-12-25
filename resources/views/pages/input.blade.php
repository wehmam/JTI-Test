@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card w-25 d-flex justify-center m-auto border-0 shadow">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <h3>Data No Handphone</h3>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">No Handphone</label>
                        <input type="number" class="form-control" id="phoneNumber">
                    </div>
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <select class="form-select form-control" aria-label="Default select example" id="provider">
                            <option value="xl">XL</option>
                            <option value="indosat">Indosat</option>
                            <option value="three">Three</option>
                            <option value="telkomsel">Telkomsel</option>
                            <option value="smartfren">Smartfren</option>
                        </select>
                    </div>
                </form>
                <button class="btn btn-success" onclick="savePhone(true)">Save</button>
                <button id="autoField()" class="btn btn-primary" onclick="autoField(this)">Auto</button>
                <input type="button" id="stop" value="stop" style="display: none;" onclick="reloadWindow()" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    function reloadWindow() {
        window.location.reload();
    }

    function autoField( e ) {
        e.setAttribute('disabled', 'disabled');
        e.innerHTML = "Loading...";
        document.getElementById('stop').style.display = null;
        const providers = ['three', 'smartfren', 'xl', 'indosat', 'telkomsel'];
        const keys = Object.keys(providers)

        for (let i = 0; i < 500; i++) {
            if (e.getAttribute('data-stop') == 'true') {
                break;
            }
            let random = Math.floor(Math.random() * keys.length);
            let randomPhone = Math.floor(Date.now() / 1000) + Math.floor(Math.random() * 1000000);
            setTimeout(function(){
                console.log(i);
                document.getElementById('phoneNumber').value = '08'+randomPhone;
                document.getElementById('provider').value = providers[random];
                savePhone(false)
                if (i == 499) {
                    e.removeAttribute('disabled');
                    e.setAttribute('data-stop', 'true');
                    e.innerHTML = "Auto";
                    document.getElementById('stop').style.display = "flex";
                }
            },i * 1000);
        }
    };

    function savePhone( al ) {
        let phoneNumber = document.getElementById('phoneNumber').value;
        let provider = document.getElementById('provider').value;
        axios.post('/api/phones', {
            phone_number: phoneNumber,
            provider: provider
        }, { headers: apiHeaders })
            .then(response => {
                let res = response.data;
                if (res.success == true) {
                    if (al) {
                        alert('success');
                    }
                } else {
                    alert('failed, ' + res.message + ' ' + JSON.stringify(res.data.errors));
                }
            })
    }
</script>
@endsection
