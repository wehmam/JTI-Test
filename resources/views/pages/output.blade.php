@extends('layouts.app')

@section('content')

<div class="row">
@include('pages.modal-update')
    <div class="col-md-12">
        <div id="parentNotification" class="alert alert-success alert-dismissible fade show d-none" role="alert">
            <ul id="alertNotification">
            </ul>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
    </div>
        <div class="card w-75 d-flex justify-center m-auto border-0 shadow">
            <div class="card-body">
                <div class="mb-3">
                    <h3>Output</h3>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                    <th scope="col">Ganjil</th>
                                    </tr>
                                </thead>
                                <tbody  id="odd">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Genap</th>
                                    </tr>
                                </thead>
                                <tbody id="even">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    let oddRow = document.getElementById("odd");
    let evenRow = document.getElementById("even");
    const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
        keyboard: false
    })

    let deletePhone = ( phoneId )=> {
        console.log(phoneId);
        axios.delete('/api/phones/'+phoneId,  { headers: apiHeaders })
        .then(response => {
            let res = response.data;
            if (res.success == true) {
                alert('data removed')
                let phone = document.getElementById(phoneId);
                phone.remove();
            }else{
                alert("failed: "+ res.message);
            }
        })
        .catch((error) => {
            console.log('error ' + error);
        });
    }

    let savePhone = ( phoneId ) => {
        let phone = document.getElementById(phoneId);
        let phoneNumber = document.getElementById('phoneNumber').value;
        let provider = document.getElementById('provider').value;
        axios.put('/api/phones/'+phoneId, {
            phone_number: phoneNumber,
            provider: provider
        }, { headers: apiHeaders })
        .then(response => {
            let res = response.data;
            if (res.success == true) {
                phone.remove();
                viewPhone(res.data.phone_number, res.data.provider, res.data.id);
                editModal.hide();
            }else{
                alert("failed: "+ res.message);
            }
        })
        .catch((error) => {
            console.log('error ' + error);
        });
    }

    let editPhone = ( phoneId ) => {
        let saveBtn         = document.getElementById('saveEdit')
        let inputPhone      = document.getElementById('ph-'+phoneId).textContent;
        let inputProvider   = document.getElementById('pv-'+phoneId).textContent;
        document.getElementById('phoneNumber').value = inputPhone;
        document.getElementById('provider').value = inputProvider;
        saveBtn.setAttribute('onclick', 'savePhone('+phoneId+')');
        editModal.show()
    }

    function viewPhone( phone, provider, id ) {
        let deleteBtn       = ' <input type="button" value="delete" class="btn btn-sm btn-danger" onclick="deletePhone('+id+')"> ';
        let editBtn         = ' <input type="button" value="edit" class="btn btn-sm btn-primary" onclick="editPhone('+id+')"> ';
        let phoneProvider   = ' <span id="pv-'+id+'">'+provider+'</span> - ';
        let phoneNumber     = ' <span id="ph-'+id+'">'+phone+'</span> ';
        if ( phone % 2 == 0 ) {
            let addEvenRow = evenRow.insertRow(0);
            let addEvenCell = addEvenRow.insertCell(-1);
            addEvenCell.setAttribute('id', id);
            addEvenCell.innerHTML = phoneProvider + phoneNumber + editBtn + deleteBtn;
        } else {
            let addOddRow = oddRow.insertRow(0);
            let addOddCell = addOddRow.insertCell(-1);
            addOddCell.setAttribute('id', id);
            addOddCell.innerHTML = phoneProvider + phoneNumber + editBtn + deleteBtn;
        }
    }

    axios.get('/api/phones',  { headers: apiHeaders })
        .then(response => {
            let res = response.data;
            if (res.success == true) {
                let phones = res.data;
                phones.forEach(phone => {
                    viewPhone(phone.phone_number, phone.provider, phone.id);
                })
            }
        })
        .catch((error) => {
            console.log('error ' + error);
        });

    channel.bind('phone-created', function(data) {
        viewPhone(data.phone_number, data.provider, data.id);
        playNotification();
        let ul = document.getElementById('alertNotification');
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(data.phone_number + " added"));
        ul.appendChild(li);
        document.getElementById('parentNotification').classList.remove('d-none');
    });

</script>
@endsection
