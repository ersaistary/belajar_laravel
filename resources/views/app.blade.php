<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $tittle ?? '' }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('inc.css')
</head>

<body>
    {{-- header --}}
    @include('inc.header')

    {{-- sidebar --}}
    @include('inc.sidebar')


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <div class="content">
        @yield('content')
    </div>


  </main><!-- End #main -->

  @include('inc.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  {{-- js --}}
  @include('inc.js')


<!-- Javascript -->
<script>
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#myTable tbody'); // untuk mengambil tbody dari table dengan id myTable
    const select = document.querySelector('#id_service'); // untuk mengambil select id_product
    const grandTotal = document.getElementById('grandTotal'); // untuk mengambil input grand total
    const grandTotalInput = document.getElementById('grandTotalInput'); // untuk mengambil input grand total



    let no = 1; // untuk nomor urut
    button.addEventListener('click', function() {
        // alert ('Tombol Add Row Diklik');
        const selectedProduct = select.options[select.selectedIndex]; // mengambil opsi yang dipilih

        const productValue = selectedProduct.value; // id produk yang dipilih
        if (!productValue) {
            alert("Please select a product first!"); // jika tidak ada produk yang dipilih
            return; // keluar dari fungsi
        }
        const productName = selectedProduct.textContent; // nama produk yang dipilih
        const productPrice = selectedProduct.dataset.price; // harga produk yang dipilih
        const tr = document.createElement('tr'); // membuat elemen tr baru
        tr.innerHTML =
        `<td>${no}</td>
        <td> <input type='hidden' name='id_service[]' class='id_products' value='${productValue}'>${productName}</td>
        <td>
            <input type='number' name='qty[]' value='1' class='form-control qtys' step='any'>
            <input type='hidden' class="priceInput" name='price[]' value='${productPrice}'>
        </td>
        <td> <input type='hidden' name='total[]' class='totals' value='${productPrice}'><span class='totalText'>${productPrice}</span></td>
        <td>
            <button type='button' class='btn btn-danger removeRow' type='button'>Delete</button>
        </td>`;
        tbody.appendChild(tr); // menambahkan elemen tr ke tbody
        no++; // menambah nomor urut

        select.value = ""; // mengosongkan pilihan select setelah menambahkan baris baru
        updateGrandTotal(); // update grand total
    });

    tbody.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeRow')) {
            e.target.closest('tr').remove(); // menghapus baris yang diklik
        }
        updateRowNumbers(); // update nomor urut
        updateGrandTotal(); // update grand total
    });

    function updateRowNumbers() {
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(function(row, index){
            row.cells[0].textContent = index + 1; // update nomor urut
        });

        no= rows.length + 1; // update nomor urut untuk baris berikutnya
    }

    function updateGrandTotal() {
        const totalCells = tbody.querySelectorAll('.totals'); // mengambil semua input total
        let grand = 0; // inisialisasi grand total

        totalCells.forEach(function(input) {
            grand += parseInt(input.value) || 0; // menambahkan nilai total ke grand total
        });

        grandTotal.textContent = grand.toLocaleString('id-ID'); // update teks grand total
        grandTotalInput.value = grand; // update nilai input hidden grand total
    }

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('qtys')) {
            const row = e.target.closest('tr'); // mengambil baris terdekat
            const qty = parseFloat(e.target.value) || 0; // mengambil nilai qty
            const price = parseInt(row.querySelector('.priceInput').value) || 0; // mengambil harga produk
            row.querySelector('.totalText').textContent = qty * price; // print total di elemen span
            row.querySelector('.totals').value = qty * price; // update nilai total di input hidden
            updateGrandTotal(); // update grand total
        }
    });

</script>

<script>
    const orderPay = document.getElementById('order_pay');
    const orderChange = document.getElementById('order_change');
    const orderChangeDisplay = document.getElementById('order_change_display');
    const totalInput = document.getElementById('totalInput');

    function updateOrderChange(){
        const pay = parseInt(orderPay.value) || 0;
        const total = parseInt(totalInput.value) || 0;
        const change = pay - total;
        orderChangeDisplay.value = change.toLocaleString('id-ID');
        orderChange.value = change;
    }

    orderPay.addEventListener('input', updateOrderChange);
</script>

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e){
        e.preventDefault();

        const form=e.target;
        const method = form.querySelector('[name="payment_method"]:checked, [name="payment_method"]:focus') ?.value;

        const data = {
            order_pay: document.getElementById('order_pay').value,
            order_change: document.getElementById('order_change').value,
            payment_method: method,
            _token: '{{ csrf_token() }}'
        }

        const orderId = form.dataset.orderId;

        if(method === 'cash'){
            form.submit();
        }else{
            fetch(`/trans/${orderId}/snap`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data._token
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(res => {
                if(res.token){
                    snap.pay(res.token, {
                        onSuccess: function(result){
                            window.location.href = 'trans';
                        },
                        onPending: function(result) {
                            alert("Silakan selesaikan pembayaran.");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal.");
                        }
                    });
                }else{
                    alert("Gagal ambil token pembayaran.");
                }
            });
        }
    });
</script>
</body>

</html>
